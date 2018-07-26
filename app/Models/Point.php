<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points';

    protected $guarded = ['id'];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function pointType()
    {
        return $this->belongsTo(PointType::class, 'point_type_id', 'id');
    }
}
