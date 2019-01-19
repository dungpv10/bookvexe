<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusService;
use App\Services\SeatLayoutService;
use Response;

class SeatLayoutsController extends Controller
{

	public $busService;
	public $seatLayoutService;

    public function __construct(BusService $busService, SeatLayoutService $seatLayoutService)
    {
    	$this->busService = $busService;
    	$this->seatLayoutService = $seatLayoutService;
    }

    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$bus = $this->busService->pluck();
    	return view('admin.seat_layout.index')->with('bus', $bus);
    }

    public function detail($busId)
    {
    	$seatLayout = $this->seatLayoutService->getSeatByBusId($busId);
    	$convertLayout = $this->seatLayoutService->convertLayout($seatLayout->toArray());
    	return Response::json(['seatData' => $seatLayout, 'convertLayout' => $convertLayout]);
    }

    public function update(Request $request)
    {
    	$dataRequet = $request->except('_token');
    	$result = $this->seatLayoutService->updateSeat($dataRequet);
    	if ($result) {
    		return back()->with('response', ['type' => 'success', 'msg' => 'Cập nhật thành công.'])->with('busId', $dataRequet['bus_id']);
    	}
    	return back()->with('response', ['type' => 'error', 'msg' => 'Cập nhật thành công.'])->with('busId', $dataRequet['bus_id']);
    }
}
