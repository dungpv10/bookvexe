<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\Upload;
use App\Http\Requests\Admin\SettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = $this->settingService->getOne();
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $data = $request->except('_token', 'logo_img', 'favicon_img');

        if($request->hasFile('logo_img')){
            $logoFile = $request->file('logo_img');
            $data['logo_path'] = (new Upload($logoFile, 'upload/setting', ['logo']))->upload();
        }

        if($request->hasFile('favicon_img')){
            $faviconFile = $request->file('favicon_img');
            $data['favicon_path'] = (new Upload($faviconFile, 'upload/setting', ['favicon']))->upload();
        }

        $this->settingService->update($id, $data);

        return redirect()->back()->withSuccess('Cập nhật thành công');
    }

}
