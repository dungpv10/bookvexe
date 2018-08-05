<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;
    protected $table = 'routes';

    protected $guarded = ['id'];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

}
