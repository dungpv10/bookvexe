<?php

namespace App\Services;


use App\Models\Bus;
use App\Models\Initialize;
use Yajra\DataTables\DataTables;

class InitializeService
{
    protected $model;
    protected $dataTable;

    public function __construct(Initialize $model, DataTables $dataTable)
    {
        $this->model = $model;
        $this->dataTable = $dataTable;
    }

    public function getJsonData(){
        $builder = $this->model->with(['user', 'driver', 'accessory', 'bus']);

        return $this->dataTable->of($builder)->make(true);
    }

    public function findById($id){
        $initialize = $this->model->find($id);

        return $initialize ? $initialize : false;
    }
    public function destroy($initialize){
        return $initialize->delete();
    }
}
