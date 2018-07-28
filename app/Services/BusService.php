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

    public function getJSONData($busType = null, $search='')
    {
        $result = $this->busModel->with('busType')->select('id', 'bus_name', 'bus_reg_number', 'bus_type_id', 'number_seats', 'start_point', 'end_point', 'start_time', 'end_time')
            ->where('id', '!=', 0);
        if (!empty($busType)) {
            $result->where('bus_type_id', $busType);
        }
        return DataTables::of($result
        )->addColumn('busType', function(Bus $bus){
            return $bus->busType->bus_type_name;
        })->make(true);
    }

    public function findById($id = null)
    {
        return $this->busModel->with('busType')->with('images')->find($id);
    }

    public function updateBus($id = null, $dataRequest){
        $bus = $this->busModel->find($id);
        $dataRequest['start_time'] = $this->getTime($dataRequest['start_time']);
        $dataRequest['end_time'] = $this->getTime($dataRequest['end_time']);
        $bus->update($dataRequest);
        return true;
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
        $dataRequest['start_time'] = $this->getTime($dataRequest['start_time']);
        $dataRequest['end_time'] = $this->getTime($dataRequest['end_time']);
        $this->busModel->fill($dataRequest)->save();
        return $this->busModel->id;
    }
}
