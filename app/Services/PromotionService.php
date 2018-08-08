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

    public function getJsonData(){
        return $this->dataTables->of($this->model->with('agent'))
            ->make(true);
    }


    public function destroy($promotion){
        return $promotion->delete();
    }


    public function findById($id){
        $promotion =  $this->model->find($id);
        return $promotion ? $promotion : false;
    }

    public function getPromotionTypes(){
        return array_merge(['' => 'Chọn loại giảm giá'], $this->model->getTypes());
    }

    public function getStatuses(){
        return array_merge(['' => 'Chọn loại giảm giá'], $this->model->getStatuses());   
    }

}
