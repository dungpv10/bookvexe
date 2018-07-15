<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusTypeService;

class BusTypeController extends Controller
{
    public $busTypeService;
    public function __construct(BusTypeService $busTypeService) {
        $this->busTypeService = $busTypeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bus_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataRequest = $request->input();
        $result = $this->busTypeService->insertBusType($dataRequest);
        if ($result) {
            return redirect()->route('bus-type.index')->with('success', 'save data bus');
        }
        return redirect()->back()->with('error', "can't save data bus");
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
        $busTypeDetail = $this->busTypeService->findById($id);
        return view('admin.bus_type.edit',[
            'busTypeDetail' => $busTypeDetail,
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
        $dataRequest = $request->input();
        $result = $this->busTypeService->updateBusType($id, $dataRequest);
        if ($result == true) {
            return redirect()->route('bus-type.index')->with('success', 'save data bus');
        }
        return redirect()->back()->with('error', "can't save data bus");
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->busTypeService->destroy($id);
        if ($result) {
            if($request->ajax())
            {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/bus')->with('message', 'Successfully deleted');
        }
        if($request->ajax())
        {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/bus')->with('message', 'Failed to delete');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getJSONData(Request $request)
    {
        $search = $request->get('search')['value'];
        return $this->busTypeService->getJSONData($search);
    }
}
