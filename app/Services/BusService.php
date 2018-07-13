<?php

namespace App\Services;

use DB;
use App\Models\Bus;


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
}
