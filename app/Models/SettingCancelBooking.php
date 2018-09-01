<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCancelBooking extends Model
{
    protected $table = 'setting_cancel_bookings';

    protected $guarded = ['id'];

    public function bus(){

        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function user(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userUpdate(){

        return $this->belongsTo(User::class, 'modify_user_id', 'id');
    }

}
