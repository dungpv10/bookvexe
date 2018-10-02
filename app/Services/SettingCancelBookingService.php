<?php

namespace App\Services;


use App\Models\SettingCancelBooking;
use Illuminate\Support\Facades\Auth;
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

    public function getJsonData($filters)
    {
        $builder = $this->model->with('bus');
        $ids = $this->busService->getAllIdBusOfAgent();

//        if(!empty($ids)){
//            $builder->whereIn('bus_id', $ids);
//        }

        foreach($filters as $key => $filter){
            if($filter != ''){

                $builder->where($key, $filter);
            }
        }

        return $this->dataTables->of($builder)
            ->addColumn('userCreate', function(SettingCancelBooking $booking){
                return $booking->user ? $booking->user->name : '';
            })
            ->addColumn('userUpdate', function(SettingCancelBooking $booking){
                return $booking->userUpdate ? $booking->userUpdate->name : 'Chưa cập nhật';
            })
            ->make(true);
    }

    public function destroy($setting){
        return $setting->delete();
    }

    public function findById($id){
        $setting = $this->model->find($id);

        return !$setting ? false : $setting;
    }

    public function store($data){
        $data['user_id'] = Auth::user()->id;
        $data['modify_user_id'] = Auth::user()->id;
        return $this->model->fill($data)->save();
    }

    public function update($id, $data){
        $data['modify_user_id'] = Auth::user()->id;
        $setting = $this->findById($id);
        if(!$setting){
            return false;
        }

        return $setting->fill($data)->save();
    }
}
