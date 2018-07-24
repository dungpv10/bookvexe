<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

}
