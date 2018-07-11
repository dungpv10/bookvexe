<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'ratings';

    protected $guarded = ['id'];
}
