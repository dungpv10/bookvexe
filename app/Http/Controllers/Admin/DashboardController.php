<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Services\AgentService;
use App\Services\BookingService;
use App\Services\BusService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $busService;
    protected $bookingService;
    protected $agentService;

    public function __construct(BusService $busService, BookingService $bookingService, AgentService $agentService)
    {
        $this->busService = $busService;
        $this->bookingService = $bookingService;
        $this->agentService = $agentService;
        
    }

    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalAgents = $this->agentService->totalAgents();
        $totalBuses = $this->busService->totalBuses();
        $totalCancelBooking = $this->bookingService->totalCancelBookings();

        return view('admin.dashboard.index', compact('totalAgents', 'totalBuses', 'totalCancelBooking'));
    }
}
