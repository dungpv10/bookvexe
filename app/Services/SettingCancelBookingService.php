<?php

namespace App\Services;


use App\Models\SettingCancelBooking;
use Yajra\DataTables\DataTables;

class SettingCancelBookingService
{
    public $model;
    public $dataTables;
    public $busService;

    public $cancelTypes = [
        PERCENTAGE => 'Theo %',
        FLAT => 'Theo số tiền'
    ];

    public function __construct(SettingCancelBooking $model, BusService $busService, DataTables $dataTables)
    {
        $this->model = $model;
        $this->dataTables = $dataTables;
        $this->busService = $busService;
    }

    public function getJsonData()
    {
        $builder = $this->model->with('bus');
        $ids = $this->busService->getAllIdBusOfAgent();

        if(!empty($ids)){
            $builder->whereIn('bus_id', $ids);
        }

        return $this->dataTables->of($builder)->make(true);
    }

    public function destroy($setting){
        return $setting->delete();
    }

    public function findById($id){
        $setting = $this->model->find($id);

        return !$setting ? false : $setting;
    }

    public function store($data){
        return $this->model->fill($data)->save();
    }
}
