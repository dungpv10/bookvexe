<?php

namespace App\Observers;


use App\Models\Agent;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentObserver
{
    use SoftDeletes;

    public function deleted(Agent $agent){
        $agent->users()->delete();
        $agent->promotions()->delete();
    }
}
