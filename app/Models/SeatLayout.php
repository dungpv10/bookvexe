<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatLayout extends Model
{
    use SoftDeletes;

    protected $table = 'seat_layouts';

    protected $guarded = ['id'];


}
