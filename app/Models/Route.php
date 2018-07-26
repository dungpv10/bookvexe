<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';

    protected $guarded = ['id'];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

}
