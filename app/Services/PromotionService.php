<?php

namespace App\Services;


use App\Models\Promotion;
use Yajra\DataTables\DataTables;

class PromotionService
{
    protected $model;

    protected $dataTables;
    protected $userService;

    public function __construct(Promotion $promotion, DataTables $dataTables, UserService $userService)
    {
        $this->model = $promotion;
        $this->dataTables = $dataTables;
        $this->userService = $userService;
    }

    public function getJsonData($filters){
        $builder = $this->model->with('agent');

        foreach($filters as $key => $filter){
            if($filter == '') continue;

            $builder->where($key, $filter);
        }
        $userAgent = auth()->user()->agent;
        if($userAgent){
            $builder->where('agent_id', $userAgent->id);
        }

        return $this->dataTables->of($builder)->make(true);
    }


    public function destroy($promotion){
        return $promotion->delete();
    }


    public function findById($id){
        $promotion =  $this->model->find($id);
        return $promotion ? $promotion : false;
    }

    public function getPromotionTypes(){
        return array_replace(['' => 'Chọn loại giảm giá'], $this->model->getTypes());
    }

    public function getStatuses(){
        return array_replace(['' => 'Chọn loại giảm giá'], $this->model->getStatuses());
    }


    public function updateStatus($promotion){
        $promotion->status = $promotion->status == PROMOTION_DEACTIVE ? PROMOTION_ACTIVE : PROMOTION_DEACTIVE;

        return $promotion->save();
    }

    public function insert($data){
        return $this->model->fill($data)->save();
    }
}
