<?php

namespace App\Services;

use DB;
use App\Models\BusType;
use Yajra\Datatables\Datatables;

class BusTypeService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $busTypeModel;

    /**
     * BusTypeService constructor.
     * @param BusType $busTypeModel
     */
    public function __construct(BusType $busTypeModel) {
        $this->busTypeModel = $busTypeModel;
    }

    /**
     * @return mixed
     */
    public function getAllBusType() {
        return $this->busTypeModel->select('id', 'bus_type_name')
            ->orderBy('bus_type_name', 'asc')
            ->pluck('bus_type_name', 'id')->toArray();
    }

    public function getJSONData($search = "")
    {
        return DataTables::of(
            $this->busTypeModel->select('id', 'bus_type_name', 'status', DB::raw('(CASE WHEN status = 1 THEN "action" ELSE "stop" END) AS cv_status')
            )
                ->where('id', '!=', 0)
        )->make(true);
    }

    public function insertBusType($dataRequest)
    {
        try {
            DB::beginTransaction();
            //insert data for bus type
            $saveBusType = [
               'bus_type_name' => $dataRequest['bus_type_name'],
               'status' => 1,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->busTypeModel->insert($saveBusType);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $this->busTypeModel->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findById($id)
    {
        return $this->busTypeModel->find($id);
    }

    public function updateBusType($id = null, $dataRequest)
    {

        $busType = $this->busTypeModel->find($id);
        $updateBusType = [
            'bus_type_name' => $dataRequest['bus_type_name'],
            'status' => 1
        ];
        return $busType->update($updateBusType);
    }
}
