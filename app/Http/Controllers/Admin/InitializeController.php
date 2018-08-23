<?php

namespace App\Http\Controllers\Admin;

use App\Services\BookingService;
use App\Services\BusService;
use App\Services\InitializeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InitializeController extends Controller
{
    protected $bookingService;
    protected $service;
    protected $busService;

    public function __construct(BookingService $bookingService, InitializeService $service, BusService $busService)
    {
        $this->bookingService = $bookingService;
        $this->service = $service;
        $this->busService = $busService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = $this->busService->all();
        return view('admin.initialize.index', compact('buses'));
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
        //
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
        $initialize = $this->service->findById($id);
        if(!$initialize){
            return response()->json([
                'code' => 404,
                'msg' => 'Initialize not found'
            ]);
        }
        $this->service->destroy($initialize);

        return response()->json([
            'code' => 200,
            'msg' => 'Delete successfully',
        ]);
    }

    public function getEvents(Request $request){
        $data = $this->bookingService->getBookingForCalendar($request->except('_token'));
        return response()->json([
            'code' => 200,
            'msg' => 'get event successfully',
            'events' => $data
        ]);
    }


    public function getJsonData(Request $request){
        return $this->service->getJsonData();
    }
}
