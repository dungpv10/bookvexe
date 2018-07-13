<?php

namespace App\Services;

use DB;
use App\Models\Bus;
use Yajra\Datatables\Datatables;
use App\Models\BusAmenity;

class BusService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $busModel;
    protected $busAmenityModel;

    /**
     * BusService constructor.
     * @param Bus $busModel
     * @param BusAmenity $busAmenityModel
     */
    public function __construct(Bus $busModel, BusAmenity $busAmenityModel) {
        $this->busModel = $busModel;
        $this->busAmenityModel = $busAmenityModel;
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
            $this->busModel->select('id', 'bus_name', 'bus_reg_number', 'bus_type_id', DB::raw('(select bus_type_name from bus_types where bus_types.id = buses.bus_type_id) AS bus_type'), 'number_seats', 'start_point', 'end_point', 'start_time', 'end_time')
                ->where('id', '!=', 0)
        )
            ->filter(function ($query) use ($search) {
                if(!empty($search))
                {
                    $search = strtolower(trim($search));
                    $query->whereRaw('(LOWER(`roles`.`name`) LIKE "%' . $search . '%" OR LOWER(`roles`.`label`) LIKE "%' . $search . '%")');
                }
            })
            ->make(true);
    }

    public function findById($id = null)
    {
        return $this->busModel->find($id);
    }

    public function getAmenityById($id = null)
    {
        return $this->busAmenityModel->select('amenity_id')->where('bus_id', $id)->groupBy('amenity_id')->pluck('amenity_id')->toarray();
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
            $saveAmenity = [];
            foreach ($dataRequest['amenities'] as $amenity) {
                $saveAmenity[] = [
                    'bus_id' => $id,
                    'amenity_id' => $amenity
                ];
            }
            if(!empty($saveAmenity)) {
                die();
                $this->busAmenityModel->insert($saveAmenity);
            }
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
            $busId = $this->busModel->insertGetId($dataRequest['data']);
            //update data for amenity
            $saveAmenity = [];
            foreach ($dataRequest['amenities'] as $amenity) {
                $saveAmenity[] = [
                    'bus_id' => $busId,
                    'amenity_id' => $amenity
                ];
            }
            if (!empty($saveAmenity)) {
                $this->busAmenityModel->insert($saveAmenity);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
