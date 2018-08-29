<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'ratings';

    protected $guarded = ['id'];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id')->where('user_id', '!=', 0);
    }
}
