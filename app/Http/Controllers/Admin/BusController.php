<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BusRequest;
use App\Services\AgentService;
use App\Services\SeatLayoutService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusService;
use App\Services\BusTypeService;
use App\Services\BusImageService;
use DB;

class BusController extends Controller
{
    public $busService;
    public $busTypeService;
    public $busImageService;
    public $seatLayoutService;
    public $agentService;

    /**
     * BusController constructor.
     * @param BusService $busService
     * @param BusTypeService $busTypeService
     * @param BusImageService $busImageService
     * @param SeatLayoutService $seatLayoutService
     */
    public function __construct(BusService $busService, BusTypeService $busTypeService,
                                BusImageService $busImageService, SeatLayoutService $seatLayoutService, AgentService $agentService) {
        $this->busService = $busService;
        $this->busTypeService = $busTypeService;
        $this->busImageService = $busImageService;
        $this->seatLayoutService = $seatLayoutService;
        $this->agentService = $agentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->busService->all();
        $busTypes = $this->busTypeService->getAllBusType();
        $agents = $this->agentService->all();
        $busNames = $this->busService->getAllBusName();
        $busRegs = $this->busService->getAllBusReg()->toArray();
        return view('admin.bus.index')->with('listBus', $result)->with('busTypes', $busTypes)->with('agents', $agents)
        ->with('busNames', json_encode($busNames))->with('busRegs', json_encode($busRegs));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $busTypes = $this->busTypeService->getAllBusType();
        $busNames = $this->busService->getAllBusName();
        $busRegs = $this->busService->getAllBusReg()->toArray();
        return view('admin.bus.create',[
            'busTypes' => $busTypes,
            'busNames' => json_encode($busNames),
            'busRegs' => json_encode($busRegs),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusRequest $request)
    {
        try {
            DB::beginTransaction();
            $images = $request->file('image_bus');
            $dataRequest = array_replace($request->except('_token', 'image_bus'), [
                'user_id' => auth()->user()->id
            ]);

            $result = $this->busService->insertBus($dataRequest);
            if (!empty($images)) {
                $this->busImageService->saveBusImage($result, $images);
            }
            DB::commit();
            if ($result) {
                return back()->with('success', 'Cập nhật thành công');
            }
            return back()->with('err', 'Cập nhật thất bại');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('err', 'Cập nhật thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $busDetail = $this->busService->findById($id);
        $busNames = $this->busService->getAllBusName($id);
        $busRegs = $this->busService->getAllBusReg($id)->toArray();
        if(!$busDetail){
            return response()->json([
                'code' => 400,
                'msg' => 'Promotion not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'data' => $busDetail,
            'msg' => 'get promotion info successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBus(BusRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $images = $request->file('image_bus');
            $imagesRemove = $request->input('image_remove_bus');
            $dataRequest = array_replace($request->except('_token', 'image_bus', 'image_remove_bus'), [
                'modify_user_id' => auth()->user()->id
            ]);

            $result = $this->busService->updateBus($id, $dataRequest);
            if (!empty($images)) {
                $this->busImageService->saveBusImage($id, $images);
            }
            if (!empty($imagesRemove)) {
                $this->busImageService->removeBusImage($id, $imagesRemove);
            }
            DB::commit();
            if ($result == true) {
                return back()->with('success', 'Cập nhật thành công');
            }
            return back()->with('err', 'Cập nhật thất bại');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('err', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->busService->destroy($id);
        if ($result) {
            if($request->ajax())
            {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/bus')->with('message', 'Xoá thành công');
        }
        if($request->ajax())
        {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/bus')->with('message', 'Failed to delete');
    }

    public function getJSONData(Request $request)
    {
        $filters = $request->only('bus_type_id', 'agent_id');

        return $this->busService->getJSONData($filters);
    }

    public function detail($id = null)
    {
        $busDetail = $this->busService->findById($id);
        $busTypes = $this->busTypeService->getAllBusType();
        $seatLayout = $this->seatLayoutService->getSeatByBusId($id);
        if (empty($seatLayout)) {
            $layout = '';
        } else {
            $layout = $this->seatLayoutService->convertLayout($seatLayout->toArray());
        }
        return view('admin.bus.detail',[
            'busDetail' => $busDetail,
            'busTypes' => $busTypes,
            'layout' => $layout
        ]);
    }

    public function deleteMultiple(Request $request)
    {
        $listBusId = $request->input('data');
        $result = $this->busService->destroyList($listBusId);
        if ($result) {
            if($request->ajax())
            {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/bus')->with('message', 'Xoá thành công');
        }
        if($request->ajax())
        {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/bus')->with('message', 'Failed to delete');
    }


    public function getAllBus(Request $request){
        return response()->json([
            'code' => 200,
            'msg' => 'get all bus successfully',
            'data' => $this->busService->all()
        ]);
    }
}
