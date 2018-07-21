<?php

namespace App\Services;

use DB;
use App\Models\BusImage;

class BusImageService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $busImageModel;

    /**
     * BusTypeService constructor.
     * @param BusType $busTypeModel
     */
    public function __construct(BusImage $busImageModel) {
        $this->busImageModel = $busImageModel;
    }

    public function saveBusImage($busId, $images)
    {
        $data = [];
        foreach($images as $image)
        {
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/images/', $name);
            $data[] = [
                'bus_id' => $busId,
                'image_path' => $name,
            ];
        }
        return $this->busImageModel->fill($data)->save();
    }

}
