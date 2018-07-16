<?php

namespace App\Services;

use DB;
use App\Models\Bus;
use Yajra\Datatables\Datatables;

class BusService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $busModel;

    /**
     * BusService constructor.
     * @param Bus $busModel
     */
    public function __construct(Bus $busModel) {
        $this->busModel = $busModel;
    }

    /**
    Comment
    */
    public function all() {
    	return $this->busModel->all();
    }

    public function getJSONData($search = "")
    {
        return DataTables::of(
            $this->busModel->with('busType')->select('id', 'bus_name', 'bus_reg_number', 'bus_type_id', 'number_seats', 'start_point', 'end_point', 'start_time', 'end_time')
                ->where('id', '!=', 0)
        )->addColumn('busType', function(Bus $bus){
            return $bus->busType->bus_type_name;
        })->make(true);
    }

    public function findById($id = null)
    {
        return $this->busModel->with('busType')->find($id);
    }

    public function updateBus($id = null, $dataRequest){
        if ($id == null){
            abort('404');
        }
        try {
            DB::beginTransaction();
            //update data for bus
            $bus = $this->busModel->find($id);
            $dataRequest['data']['start_time'] = $this->getTime($dataRequest['data']['start_time']);
            $dataRequest['data']['end_time'] = $this->getTime($dataRequest['data']['end_time']);
            $bus->update($dataRequest['data']);
            //update data for amenity
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getTime($time)
    {
        $chunks = explode(':', $time);
        if (strpos( $time, 'AM') === false && $chunks[0] !== '12') {
            $chunks[0] = $chunks[0] + 12;
        } else if (strpos( $time, 'PM') === false && $chunks[0] == '12') {
            $chunks[0] = '00';
        }
        return preg_replace('/\s[A-Z]+/s', '', implode(':', $chunks));
    }

    public function destroy($id)
    {
        try {
            $this->busModel->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function insertBus($dataRequest){
        try {
            DB::beginTransaction();
            //insert data for bus
            $dataRequest['data']['start_time'] = $this->getTime($dataRequest['data']['start_time']);
            $dataRequest['data']['end_time'] = $this->getTime($dataRequest['data']['end_time']);
            $dataRequest['data']['created_at'] = date('Y-m-d H:i:s');
            $dataRequest['data']['updated_at'] = date('Y-m-d H:i:s');
            $busId = $this->busModel->insertGetId($dataRequest['data']);
            //update data for amenity
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
