<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = $this->bookingService->getStatus();

        return view('admin.bookings.index', compact('statuses'));
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
        $booking = $this->bookingService->getBooking($id);

        if(!$booking){
            return response()->json(['code' => 0, 'msg' => 'booking not found']);
        }

        return response()->json(['code' => 1, 'msg' => 'get booking customer successfully', 'data' => $booking]);
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
        //
    }

    public function getJsonData(Request $request) {
        $user = auth()->user();
        $query = $this->bookingService->getJsonData(['status' => $request->get('status')]);

        if(!$user->hasRole('admin')){
            $busIds = $user->getBusIds();
            $query->whereIn('bookings.bus_id', $busIds);
        }
        return DataTables::of($query)
            ->addColumn('status_name', function(Booking $booking){
                return $booking->statuses[$booking->payment_status];
            })
            ->make(true);
    }


    public function updateStatus(Request $request, $id){
        $booking = $this->bookingService->getBooking($id);
        if(!$booking) return response()->json([
            'code' => 0,
            'msg' => 'Booking not found'
        ]);

        $booking->payment_status = $request->get('status');
        $booking->update();
        return response()->json([
            'code' => 1,
            'msg' => 'Update status booking successfully',
            'data' => true
        ]);
    }
}
