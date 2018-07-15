<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusService;
use App\Services\BusTypeService;
use App\Services\AmenityService;

class BusController extends Controller
{
    public $busService;
    public $busTypeService;
    public $amenityService;

    /**
     * BusController constructor.
     * @param BusService $busService
     * @param BusTypeService $busTypeService
     * @param AmenityService $amenityService
     */
    public function __construct(BusService $busService, BusTypeService $busTypeService, AmenityService $amenityService) {
        $this->busService = $busService;
        $this->busTypeService = $busTypeService;
        $this->amenityService = $amenityService;
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
        $amenities = $this->amenityService->getAllAmenity();
        return view('admin.bus.create',[
            'busTypes' => $busTypes,
            'amenities' => $amenities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataRequest = $request->input();
        $result = $this->busService->insertBus($dataRequest);
        if ($result) {
            return redirect()->route('bus.index')->with('success', 'save data bus');
        }
        return redirect()->back()->with('error', "can't save data bus");
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
        $amenities = $this->amenityService->getAllAmenity();
        $amenityInIds = $this->busService->getAmenityById($id);
        return view('admin.bus.edit',[
            'busDetail' => $busDetail,
            'busTypes' => $busTypes,
            'amenities' => $amenities,
            'amenityInIds' => $amenityInIds
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBus(Request $request, $id)
    {
        $dataRequest = $request->input();
        $result = $this->busService->updateBus($id, $dataRequest);
        if ($result == true) {
            return redirect()->route('bus.index')->with('success', 'save data bus');
        }
        return redirect()->back()->with('error', "can't save data bus");
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
            return redirect('admin/bus')->with('message', 'Successfully deleted');
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
        $amenities = $this->amenityService->getAllAmenity();
        $amenityInIds = $this->busService->getAmenityById($id);
        $busTypes = $this->busTypeService->getAllBusType();
        return view('admin.bus.detail',[
            'busDetail' => $busDetail,
            'busTypes' => $busTypes,
            'amenities' => $amenities,
            'amenityInIds' => $amenityInIds
        ]);
    }
}
