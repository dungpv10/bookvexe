<?php

namespace App\Http\Controllers\Admin;

use App\Services\ManageHolidayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerHolidayController extends Controller
{
    protected $service;
    public function __construct(ManageHolidayService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.holiday.index');
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
        $holiday = $this->service->create($request->except('_token'));
        if($holiday){
            return redirect()->back()->with('success', 'Tạo mới thành công');
        }
        return redirect()->back()->with('error', 'Tạo mới thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $holiday = $this->service->findById($id);

      if(!$holiday){
        return response()->json([
          'code' => 404,
          'msg' => 'Not found'
        ]);
      }
      return response()->json([
        'code' => 200,
        'msg' => 'Get detail successfully',
        'data' => $holiday
      ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $holiday = $this->service->findById($id);

        if(!$holiday){
          return redirect()->back()->with('error','Ngày nghỉ không tồn tại');
        }

        $this->service->update($holiday, $request->except('_token'));
        return redirect()->back()->with('success','Cập nhật ngày nghỉ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holiday = $this->service->findById($id);
        if(!$holiday){
          return response()->json([
            'code' => 404,
            'msg' => 'Holiday not found'
          ]);
        }

        $this->service->destroy($holiday);

        return response()->json([
          'code' => 200,
          'msg' => 'Delete holiday successfully'
        ]);
    }


    public function getJSONData(Request $request){
        return $this->service->getJsonData();
    }
}
