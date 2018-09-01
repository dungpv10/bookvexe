<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;
    protected $table = 'agents';

    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany(User::class, 'agent_id', 'id');
    }

    public function promotions(){
        return $this->hasMany(Promotion::class, 'agent_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userUpdate(){
        return $this->belongsTo(User::class, 'modify_user_id', 'id');
    }


}
