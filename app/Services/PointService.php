<?php

namespace App\Services;


use App\Models\Point;
use Yajra\Datatables\Datatables;
use App\Models\Bus;

class PointService
{
    protected $pointModel;

    public function __construct(Point $pointModel)
    {
        $this->pointModel = $pointModel;
    }

    public function getJSONData($pointTypeId = null, $search='')
    {
        $result = $this->pointModel->where('id', '!=', 0)->with('route');
        if (!empty($pointTypeId)) {
            $result->where('point_type_id', $pointTypeId);
        }
        return DataTables::of($result)->addColumn('busName', function(Point $point){
            return $point->route->bus->bus_name;
        })->addColumn('boardingPoint', function(Point $point){
            return $point->route->from_place;
        })->addColumn('dropPoint', function(Point $point){
            return $point->route->arrived_place;
        })->addColumn('routeName', function(Point $point){
            return $point->route->route_name;
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

    public function getPointById($pointId = null)
    {
        return $this->pointModel->with('route')->find($pointId);
    }
}
