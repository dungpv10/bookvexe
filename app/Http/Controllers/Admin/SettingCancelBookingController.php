<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SettingCancellationRequest;
use App\Services\BusService;
use App\Services\SettingCancelBookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingCancelBookingController extends Controller
{
    protected $service;
    protected $busService;

    public function __construct(SettingCancelBookingService $service, BusService $busService)
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
        $buses = $this->busService->getAllBusName();
        $cancelTypes = $this->service->cancelTypes;

        return view('admin.cancellation.index', compact('buses', 'cancelTypes'));
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
    public function store(SettingCancellationRequest $request)
    {
        $setting = $this->service->store($request->except('_token'));
        if(!$setting){
            return redirect()->back()->with('error', 'Tạo mới cài đặt thất bại');
        }
        return redirect()->back()->with('success', 'Tạo mới cài đặt thành công');
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
        $setting = $this->service->findById($id);

        if(!$setting){
            return response()->json([
                'code' => 400,
                'msg' => 'Setting not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'msg' => 'get information successfully',
            'data' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingCancellationRequest $request, $id)
    {
        $setting = $this->service->update($id, $request->except('_token'));
        if(!$setting){
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = $this->service->findById($id);
        if($setting){
            $this->service->destroy($setting);
            return response()->json([
                'code' => 200,
                'msg' => 'Delete setting successfully'
            ]);
        }

        return response()->json([
            'code' => 400,
            'msg' => 'Delete setting fail'
        ]);
    }

    public function getJsonData(Request $request){
        return $this->service->getJsonData($request->only('cancel_type'));
    }
}
