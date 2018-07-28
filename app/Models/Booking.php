<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = ['id'];

    public $statuses = [
        NOT_PAYMENT => 'Chưa thanh toán',
        PAYMENT_PROCESSING => 'Đang xử lý',
        PAYMENT_SUCCESS => 'Thành công',
        CANCEL_BOOKING => 'Đã huỷ'
    ];

    public $types = [

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function getList($filters)
    {
        $query = $this->with('customer')->with('bus');

        if(isset($filters['status']) && !empty($filters['status'])){

            $query->$this->where('payment_status', $filters['status']);
        }

        return $query;
    }

}
