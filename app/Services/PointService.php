<?php

namespace App\Services;


use App\Models\Point;
use Yajra\Datatables\Datatables;


class PointService
{
    protected $pointModel;

    public function __construct(Point $pointModel)
    {
        $this->pointModel = $pointModel;
    }

    public function getJSONData($search='')
    {
        $result = $this->pointModel->where('id', '!=', 0)->with('route');
        return DataTables::of($result)->addColumn('busId', function(Point $point){
            return $point->route->bus_id;
        })->addColumn('boardingPoint', function(Point $point){
            return $point->route->from_place;
        })->addColumn('dropPoint', function(Point $point){
            return $point->route->arrived_place;
        })->addColumn('startTime', function(Point $point){
            return $point->route->start_time;
        })->make(true);
    }

    public function destroy($id = null)
    {
        try {
            $this->pointModel->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
