<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Upload;
use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use App\Services\AgentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    protected $service;

    public function __construct(AgentService $agentService)
    {
        $this->service = $agentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = array_merge(['' => 'Chọn trạng thái'], $this->service->status);
        return view('admin.agent.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent = $this->service->store($request->except('_token'));
        if($agent){
            return redirect()->back()->with('success', 'Tạo mới nhà xe thành công');
        }
        return redirect()->back()->with('error', 'Tạo mới nhà xe thất bại');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = $this->service->findByid($id);

        if(!$agent)
            return response()->json([
                'code' => 400,
                'msg' => 'Agent not found'
            ]);
        return response()->json([
            'code' => 200,
            'msg' => 'get agent information successfully',
            'data' => $agent
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
        //
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
        $agent = $this->service->findByid($id);
        if(!$agent)
            return redirect()->back()->with('err', 'Nhà xe không tồn tại');

        $this->service->update($agent, $request->except('_token'));

        return redirect()->back()->with('success', 'Cập nhật nhà xe thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = $this->service->findByid($id);
        if(!$agent)
            return response()->json([
                'code' => 400,
                'msg' => 'Xoá nhà xe thất bại'
            ]);

        $this->service->destroy($agent);
        return response()->json([
            'code' => 200,
            'msg' => 'Xoá nhà xe thành công'
    ]);
    }

    public function getJsonData(Request $request){
        return $this->service->getJsonData($request->only('status'));
    }


    public function updateStatus(Request $request){
        $agent = $this->service->findByid($request->get('id'));
        if(!$agent)
            return redirect()->back()->with('err', 'Nhà xe không tồn tại');

        $this->service->update($agent, $request->except('_token'));

        return redirect()->back()->with('success', 'Cập nhật trạng thái nhà xe thành công');

    }


    public function getSetting(Request $request){
        return view('admin.agent.setting');
    }

    public function postSetting(AgentRequest $request){
        $agentId = auth()->user()->agent->id;
        $agent = $this->service->findByid($agentId);
        if(!$agent){
            return redirect()->back()->with('error', 'Bạn chưa thuộc trong nhà xe ');
        }

        $data = $request->except('_token', 'logo_file');

        if($request->hasFile('logo_file')){
            $logoFile = $request->file('logo_file');
            $data['logo_path'] = (new Upload($logoFile, 'upload/agent/' . $agentId, ['logo']))->upload();
        }
        $this->service->update($agent, $data);

        return redirect()->route('bus.index')->with('success', 'Cập nhật thông tin nhà xe thành công');

    }
}
