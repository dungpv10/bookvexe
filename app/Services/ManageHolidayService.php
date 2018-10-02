<?php

namespace App\Services;


use App\Models\ManagerHoliday;
use Yajra\DataTables\DataTables;

class ManageHolidayService
{
    protected $holiday;
    protected $dataTable;

    public function __construct(ManagerHoliday $holiday, DataTables $dataTable)
    {
        $this->holiday = $holiday;
        $this->dataTable = $dataTable;
    }

    public function getJsonData()
    {
        $builder = $this->holiday->whereRaw('1=1');

        return $this->dataTable->of($builder)->make(true);
    }

    public function create($data){
        return $this->holiday->fill($data)->save();
    }

    public function findById($id){
        $holiday = $this->holiday->find($id);

        return $holiday ? $holiday : false;
    }

    public function destroy($holiday){
        return $holiday->delete();
    }

    public function update($holiday, $data){
      return $holiday->fill($data)->save();
    }
}
