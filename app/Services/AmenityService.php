<?php

namespace App\Services;

use DB;
use App\Models\Amenity;

class AmenityService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $amenityModel;

    /**
     * AmenityService constructor.
     * @param Amenity $amenityModel
     */
    public function __construct(Amenity $amenityModel) {
        $this->amenityModel = $amenityModel;
    }

    /**
    Comment
     */
    public function getAllAmenity()
    {
        return $this->amenityModel->select('id', 'amenity_name')
            ->orderBy('amenity_name', 'asc')
            ->pluck('amenity_name', 'id')->toArray();
    }

    public function findById($id = null)
    {
        return $this->amenityModel->find($id);
    }
}
