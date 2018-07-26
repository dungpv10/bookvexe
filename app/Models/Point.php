<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points';

    protected $guarded = ['id'];

    public function route()
    {
        return $this->hasOne(Route::class, 'id', 'route_id');
    }

    public function pointType()
    {
        return $this->hasOne(PointType::class, 'id', 'point_type_id');
    }
}
