<?php

namespace App\Http\Controllers\Admin;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getJSONData(Request $request)
    {
        $search = $request->get('search')['value'];
        return $this->busService->getJSONData($search);
    }
}
