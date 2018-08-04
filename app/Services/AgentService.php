<?php

namespace App\Services;


use App\Models\Agent;

class AgentService
{
    protected $model;
    public function __construct(Agent $agent)
    {
        $this->model = $agent;
    }

    public function all(){
        return $this->model->pluck('agent_name', 'id');
    }
}
