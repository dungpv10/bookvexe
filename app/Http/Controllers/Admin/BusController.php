<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BusRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusService;
use App\Services\BusTypeService;

class BusController extends Controller
{
    public $busService;
    public $busTypeService;

    /**
     * BusController constructor.
     * @param BusService $busService
     * @param BusTypeService $busTypeService
     */
    public function __construct(BusService $busService, BusTypeService $busTypeService) {
        $this->busService = $busService;
        $this->busTypeService = $busTypeService;
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
        return view('admin.bus.index')->with('listBus', $result);
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
        $dataRequest = $request->except('_token');
        $result = $this->busService->insertBus($dataRequest);
        if ($result) {
            return response()->json(['code' => 200, 'message' => 'Cập nhật xe thành công']);
        }
        return response()->json(['code' => 500, 'message' => 'Xảy ra lỗi trong quá trình cập nhật']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        die('xxx');
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
            return response()->json(['code' => 200, 'message' => 'Cập nhật xe thành công']);
        }
        return response()->json(['code' => 500, 'message' => 'Xảy ra lỗi trong quá trình cập nhật']);
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
        return $this->busService->getJSONData($search);
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
