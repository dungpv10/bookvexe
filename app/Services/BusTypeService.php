<?php

namespace App\Services;

use DB;
use App\Models\BusType;

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
}
