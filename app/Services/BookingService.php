<?php

namespace App\Services;


use App\Models\Booking;
use DB;

class BookingService
{
    protected $model;

    public function __construct(Booking $booking)
    {
        $this->model = $booking;
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
        $booking = $this->model->with('customer')->find($id);

        return $booking ?? false;

    }

    public function getBookingForCalendar($filters){
        $bookingByData = $this->model->with('bus')->get()->groupBy('bus_id')->groupBy(function($item){
            return $item[0]->board_time->format('Y-m-d');
        });

        $data = [];
        foreach($bookingByData as $date => $returnData){
            $pushData = [
                'title' => '',
                'start' => $date
            ];

            foreach($returnData as $busOnDay){
                $pushData['title'] .= count($busOnDay) . ' KH - ' . $busOnDay[0]->bus->bus_name . ' <br/> ';
            }

            array_push($data, $pushData);
        }

        return $data;
    }

}
