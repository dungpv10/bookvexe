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
}
