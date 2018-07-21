<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BusRequest;
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

    /**
     * BusController constructor.
     * @param BusService $busService
     * @param BusTypeService $busTypeService
     */
    public function __construct(BusService $busService, BusTypeService $busTypeService, BusImageService $busImageService) {
        $this->busService = $busService;
        $this->busTypeService = $busTypeService;
        $this->busImageService = $busImageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show view list bus
        $result = $this->busService->all();
        $busTypes = $this->busTypeService->getAllBusType();
        return view('admin.bus.index')->with('listBus', $result)->with('busTypes', $busTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $busTypes = $this->busTypeService->getAllBusType();
        return view('admin.bus.create',[
            'busTypes' => $busTypes,
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
            $dataRequest = $request->except('_token', 'image_bus');
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
        $busTypes = $this->busTypeService->getAllBusType();
        return view('admin.bus.edit',[
            'busDetail' => $busDetail,
            'busTypes' => $busTypes
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
        $dataRequest = $request->except('_token');
        $result = $this->busService->updateBus($id, $dataRequest);
        if ($result == true) {
            return back()->with('success', 'Cập nhật thành công');
        }
        return back()->with('err', 'Cập nhật thất bại');
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
        $search = $request->get('search')['value'];
        $busType = $request->get('bus_type_id');
        return $this->busService->getJSONData($busType, $search);
    }

    public function detail($id = null)
    {
        $busDetail = $this->busService->findById($id);
        $busTypes = $this->busTypeService->getAllBusType();
        return view('admin.bus.detail',[
            'busDetail' => $busDetail,
            'busTypes' => $busTypes
        ]);
    }

    public function getAmenities()
    {
        return response()->json([]);
    }
}
