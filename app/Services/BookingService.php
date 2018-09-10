<?php

namespace App\Services;


use App\Models\Booking;
use App\Models\Bus;
use DB;

class BookingService
{
    protected $model;
    protected $userService;

    public function __construct(Booking $booking, UserService $userService)
    {
        $this->model = $booking;
        $this->userService = $userService;
    }

    public function getStatus()
    {
        return array_merge(['' => 'Chọn trạng thái'], $this->model->statuses);
    }

    public function getJsonData($filters)
    {
        return $this->model->getList($filters);
    }

    public function getBooking($id)
    {
        $booking = $this->model->with('customer')->with('bus')->find($id);

        return $booking ?? false;

    }

    public function getBookingForCalendar($filters){
        $bookingByData = $this->model->with('bus');


        $adminAgentId = $this->userService->getAdminAgentId();
        if (!empty($adminAgentId)) {
            $bookingByData = $bookingByData->whereHas('bus', function($q) use ($adminAgentId){
                $q->where('user_id', $adminAgentId);
            });
        }


        $bookingByData = $bookingByData->get()->groupBy('bus_id')->groupBy(function($item){
            return $item[0]->board_time->format('Y-m-d');
        });

        $data = [];
        foreach($bookingByData as $date => $returnData){
            $pushData = [
                'title' => 'Xem chi tiết',
                'start' => $date,
                'description' => ''
            ];

            foreach($returnData as $busOnDay){
                $pushData['description'] .= count($busOnDay) . ' KH - ' . $busOnDay[0]->bus->bus_name . ' <br/> ';
            }

            array_push($data, $pushData);
        }

        return $data;
    }

}
