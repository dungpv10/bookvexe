<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RouteService;
use App\Services\BusService;

class RouteController extends Controller
{

    private $service;
    private $busService;

    public function __construct(RouteService $service, BusService $busService)
    {
        $this->service = $service;
        $this->busService = $busService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = $this->busService->all();
        $routes = $this->service->all();
        return view('admin.routes.index')->with('buses', $buses)->with('routes', $routes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buses = $this->busService->all();
        return view('admin.routes.create')->with(compact('buses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created = $this->service->create(array_replace($request->except('_token'), [
            'user_id' => auth()->user()->id
        ]));
        if ($created) {
            return back()->with('success', 'Thêm mới thành công');
        }

        return back()->with('err', 'Thêm mới thất bại');
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
        $route = $this->service->find($id);
        if(!$route){
            return response()->json([
                'code' => 400,
                'msg' => 'Promotion not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'data' => $route,
            'msg' => 'get promotion info successfully'
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
        $updated = $this->service->update($id, array_replace($request->except('_token', '_method'), [
            'modify_user_id' => auth()->user()->id
        ]));
        if ($updated) {
            return back()->with('success', 'Cập nhật thành công');
        }

        return back()->with('err', 'Cập nhật thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->service->destroy($id);
        if ($result) {
            if ($request->ajax()) {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/users')->with('message', 'Successfully deleted');
        }
        if ($request->ajax()) {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/users')->with('message', 'Failed to delete');
    }

    public function getJSONData(Request $request)
    {
        $busId = $request->get('bus_id');
        $routeId = $request->get('route_id');
        $search = $request->get('search')['value'];
        return $this->service->getJSONData($busId, $search, $routeId);
    }
}
