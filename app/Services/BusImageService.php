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

    /**
     * @param $busId
     * @param $images
     * @return mixed
     */
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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        return $this->busImageModel->insert($data);
    }

    public function removeBusImage($busId, $imagesRemove)
    {
        //remove image
        foreach ($imagesRemove as $image){
            unlink(public_path('images/' . $image));
        }
        return $this->busImageModel->where('bus_id', $busId)
            ->whereIn('image_path', $imagesRemove)->delete();
    }

}
