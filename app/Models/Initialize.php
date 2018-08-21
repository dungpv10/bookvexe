<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Initialize extends Model
{
    protected $table = 'initializes';

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
    public function accessory(){
        return $this->belongsTo(User::class, 'car_accessory_id', 'id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }


}
