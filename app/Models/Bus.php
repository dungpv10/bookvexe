<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
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


    public function busType()
    {
        return $this->belongsTo(BusType::class, 'bus_type_id', 'id');
    }


    public function getStatusNameAttribute()
    {
        return self::$busStatus[$this->getAttribute('status')];
    }

}
