<?php

namespace App\Services;


use App\Models\Rate;
use Yajra\DataTables\DataTables;

class RatingService
{
    protected $model;

    protected $dataTable;

    protected $userService;

    public function __construct(Rate $rating, DataTables $dataTable, UserService $userService)
    {
        $this->model = $rating;
        $this->dataTable = $dataTable;
        $this->userService = $userService;
    }


    public function getJsonData($filters){
        $builder = $this->model->with('bus')->with('user');

        $adminAgentId = $this->userService->getAdminAgentId();

        foreach($filters as $key => $filter){
            if(!empty($filter)){
                $builder->where($key, $filter);
            }
        }


        if(!empty($adminAgentId)){
            $builder->whereHas('bus', function($q) use ($adminAgentId) {
                $q->where('user_id', $adminAgentId);
            });
        }

        return $this->dataTable->of($builder)->make(true);
    }
}
