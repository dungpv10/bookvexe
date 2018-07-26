<?php

namespace App\Services;


use App\Models\Route;

class RouteService
{
    public $routeModel;

    public function __construct(Route $routeModel)
    {
        $this->routeModel = $routeModel;
    }

    public function getAllRoute()
    {
        return $this->routeModel->orderBy('route_name', 'ASC')->pluck('route_name','id');
    }
}
