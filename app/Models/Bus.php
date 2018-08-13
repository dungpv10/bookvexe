<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use SoftDeletes;
    protected $table = 'buses';

    protected $guarded = ['id'];

    public static $busStatus = [BUS_INACTIVE => 'Chưa kích hoạt', BUS_ACTIVE => 'Đang hoạt động'];

    public function routes()
    {
        return $this->hasMany(Route::class, 'bus_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(BusImage::class, 'bus_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'bus_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function busType()
    {
        return $this->belongsTo(BusType::class, 'bus_type_id', 'id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'bus_id', 'id');
    }

    public function seatLayout()
    {
        return $this->hasOne(SeatLayout::class, 'bus_id', 'id');
    }

    public function settingCancelBookings()
    {
        return $this->hasMany(SettingCancelBooking::class, 'bus_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        $status = $this->getAttribute('status');

        return in_array($status, array_keys(self::$busStatus)) ? self::$busStatus[$this->getAttribute('status')] : '';
    }

}
