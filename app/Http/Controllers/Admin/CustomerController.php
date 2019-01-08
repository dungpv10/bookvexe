<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Log;
use Gate;

class CustomerController extends Controller
{
    protected $service;
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJSONData(Request $request)
    {
        $roleId = 4;
        $search = $request->get('search')['value'];
        return $this->service->getJSONData($roleId, $search);
    }
}
