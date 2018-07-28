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
        $result = $this->pointModel->where('points.id', '!=', 0)->with('route')->with('pointType');
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
            $dataPoint['drop_time'] = $this->getTime($dataPoint['drop_time']);
            $point->update($dataPoint);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function insertPoint($dataPoint)
    {
        $dataPoint['drop_time'] = $this->getTime($dataPoint['drop_time']);
        $this->pointModel->fill($dataPoint)->save();
        return $this->pointModel->id;
    }

    public function findById($pointId)
    {
        return $this->pointModel->with('route.bus')->with('pointType')->find($pointId);
    }

    public function getTime($time)
    {
        $chunks = explode(':', $time);
        if (strpos( $time, 'AM') === false && $chunks[0] !== '12') {
            $chunks[0] = $chunks[0] + 12;
        } else if (strpos( $time, 'PM') === false && $chunks[0] == '12') {
            $chunks[0] = '00';
        }
        $chunks[1] = str_replace(' PM', ':00', $chunks['1']);
        $chunks[1] = str_replace(' AM', ':00', $chunks['1']);
        return preg_replace('/\s[A-Z]+/s', '', implode(':', $chunks));
    }
}
