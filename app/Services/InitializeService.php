<?php
/**
 * Created by PhpStorm.
 * User: dungpv
 * Date: 8/22/18
 * Time: 02:33
 */

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
}
