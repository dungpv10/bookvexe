<?php

namespace App\Services;


use App\Models\Agent;
use Yajra\DataTables\DataTables;

class AgentService
{
    protected $model;

    protected $dataTables;

    public $status = [
        AGENT_INACTIVE => 'Chưa kích hoạt',
        AGENT_ACTIVE => 'Đang hoạt động'
    ];
    public function __construct(Agent $agent, DataTables $dataTables)
    {
        $this->model = $agent;
        $this->dataTables = $dataTables;
    }

    public function all(){
        return array_replace(['' => 'Chọn nhà xe'], $this->model->pluck('agent_name', 'id')->toArray());
    }


    public function getJsonData($filters){
        $builder = $this->model->with('users');
        foreach($filters as $key => $filter){
            if($filter != ''){
                $builder->where($key, $filter);
            }
        }
        return $this->dataTables->of($builder)
            ->addColumn('statusName', function($agent){
                return $this->status[$agent->status];
            })
            ->addColumn('userCreate', function($agent){
                return $agent->user ? $agent->user->name : '';
            })
            ->addColumn('userUpdate', function($agent){
                return $agent->userUpdate ? $agent->userUpdate->name : 'Chưa cập nhật';
            })
            ->make(true);
    }

    public function store($data){
        return $this->model->fill($data)->save();
    }

    public function destroy($agent){
        return $agent->delete();
    }

    public function findByid($id){
        $agent = $this->model->find($id);
        return $agent ? $agent : false;
    }

    public function update($agent, $data) {
        return $agent->fill($data)->save();
    }

    public function totalAgents(){
      return $this->model->count();
    }
}
