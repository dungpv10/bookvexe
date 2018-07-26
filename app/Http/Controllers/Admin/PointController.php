<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PointService;
use App\Services\RouteService;
use App\Services\PointTypeService;

class PointController extends Controller
{
    public $pointService;
    public $routeService;
    public $pointTypeService;

    public function __construct(PointService $pointService, RouteService $routeService, PointTypeService $pointTypeService) {
        $this->pointService = $pointService;
        $this->routeService = $routeService;
        $this->pointTypeService = $pointTypeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointTypes = $this->pointTypeService->getAllPointType();
        return view('admin.point.index', [
            'pointTypes' => $pointTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = $this->routeService->getAllRoute();
        $pointTypes = $this->pointTypeService->getAllPointType();
        return view('admin.point.create', [
            'routes' => $routes,
            'pointTypes' => $pointTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        die('xxx2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routes = $this->routeService->getAllRoute();
        $pointTypes = $this->pointTypeService->getAllPointType();
        $point = $this->pointService->getPointById($id);
        return view('admin.point.edit', [
            'routes' => $routes,
            'pointTypes' => $pointTypes,
            'point' => $point,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataPoint = $request->except('_token', '_method');
        $result = $this->pointService->updatePoint($id, $dataPoint);
        if ($result == true) {
            return back()->with('success', 'Cập nhật thành công');
        } else {
            return back()->with('err', 'Cập nhật thất bại');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->pointService->destroy($id);
        if ($result) {
            if($request->ajax())
            {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/bus')->with('message', 'Xoá thành công');
        }
        if($request->ajax())
        {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/bus')->with('message', 'Failed to delete');
    }

    public function getJSONData(Request $request)
    {
        $search = $request->get('search')['value'];
        $pointTypeId = $request->get('point_type_id');
        return $this->pointService->getJSONData($pointTypeId, $search);
    }
}
