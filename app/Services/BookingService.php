<?php

namespace App\Services;


use App\Models\Booking;

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

}
