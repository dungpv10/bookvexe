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
     * Construct
     *
     * @param UserService $userService
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
            $this->busModel->select('bus_name', 'bus_reg_number', 'bus_type_id', DB::raw('(select bus_type_name from bus_types where bus_types.id = buses.bus_type_id) AS bus_type'), 'number_seats', 'start_point', 'end_point', 'start_time', 'end_time')
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
}
