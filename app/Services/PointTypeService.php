<?php

namespace App\Services;


use App\Models\PointType;

class PointTypeService
{
    protected $pointTypeModel;

    public function __construct(PointType $pointTypeModel)
    {
        $this->pointTypeModel = $pointTypeModel;
    }

    public function getAllPointType()
    {
        return $this->pointTypeModel->where('id', '!=', '')->orderBy('point_type_name', 'ASC')->pluck('point_type_name','id');
    }
}
