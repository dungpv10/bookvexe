<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'buses';

    protected $guarded = ['id'];

    public function routes()
    {
        return $this->hasMany(Route::class, 'bus_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(BusImage::class, 'bus_id', 'id');
    }

    public function amenities(){
        return $this->belongsToMany(Amenity::class, 'bus_amenity', 'bus_id', 'amenity_id');
    }

    public function rates(){
        return $this->hasMany(Rate::class, 'bus_id', 'id');
    }


    public function busType(){
        return $this->belongsTo(BusType::class, 'bus_type_id', 'id');
    }

}
