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
        $result = $this->pointModel->where('points.id', '!=', 0)->with(['route' => function($route){
            return $route->with('bus');
        }])->with('pointType');

        if (!empty($pointTypeId)) {
            $result->where('point_type_id', $pointTypeId);
        }
        return DataTables::of($result)->addColumn('busName', function($result){
            return $result->route->bus->bus_name;
        })->addColumn('boardingPoint', function($result){
            return $result->route->from_place;
        })->addColumn('dropPoint', function($result){
            return $result->route->arrived_place;
        })->addColumn('routeName', function($result){
            return $result->route->route_name;
        })->addColumn('pointType', function($result){
            return $result->pointType->point_type_name;
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

    public function updatePoint($pointId, $dataPoint)
    {
        try {
            $point = $this->pointModel->find($pointId);
            $point->update($dataPoint);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function insertPoint($dataPoint)
    {
        $this->pointModel->fill($dataPoint)->save();
        return $this->pointModel->id;
    }

    public function findById($pointId)
    {
        return $this->pointModel->with('route.bus')->with('pointType')->find($pointId);
    }
}
