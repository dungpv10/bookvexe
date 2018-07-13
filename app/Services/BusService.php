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
}
