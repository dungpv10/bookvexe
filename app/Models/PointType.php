<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointType extends Model
{
    protected $table = 'point_types';
    protected $guarded = ['id'];

    public function points()
    {
        return $this->hasMany(Point::class, 'point_type_id', 'id');
    }

}
