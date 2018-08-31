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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userUpdate(){
        return $this->belongsTo(User::class, 'modify_user_id', 'id');
    }
}
