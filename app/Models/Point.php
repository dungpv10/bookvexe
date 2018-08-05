<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
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
