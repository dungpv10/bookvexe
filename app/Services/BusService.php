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
            $this->busModel->where('id', '!=', 0)
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
