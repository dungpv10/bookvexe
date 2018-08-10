<?php

namespace App\Services;


use App\Models\Promotion;
use Yajra\DataTables\DataTables;

class PromotionService
{
    protected $model;

    protected $dataTables;

    public function __construct(Promotion $promotion, DataTables $dataTables)
    {
        $this->model = $promotion;
        $this->dataTables = $dataTables;
    }

    public function getJsonData($filters){
        $builder = $this->model->with('agent');

        foreach($filters as $key => $filter){
            if($filter == '') continue;

            $builder->where($key, $filter);
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

}
