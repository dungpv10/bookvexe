<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    protected $table = 'bus_types';

    protected $guarded = ['id'];

    public function buses()
    {

        return $this->hasMany(Bus::class, 'bus_type_id', 'id');
    }
}
