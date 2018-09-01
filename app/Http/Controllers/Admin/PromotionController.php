<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PromotionRequest;
use App\Services\PromotionService;
use App\Services\AgentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    protected $service;
    protected $agentService;

    public function __construct(PromotionService $promotionService, AgentService $agentService)
    {
        $this->service = $promotionService;
        $this->agentService = $agentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = $this->agentService->all();
        $promotionTypes = $this->service->getPromotionTypes();
        $statuses = $this->service->getStatuses();

        return view('admin.promotion.index', compact('agents', 'promotionTypes', 'statuses'));
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
    public function store(PromotionRequest $request)
    {
        $promotion = $this->service->insert(array_replace($request->except('_token'), [
            'user_id' => auth()->user()->id
        ]));
        if($promotion){
            return redirect()->back()->with('success', 'Thêm mới mã giảm giá thành công');
        }
        return redirect()->back()->with('error', 'Thêm mới mã giảm giá thất bại');
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
        $promotion = $this->service->findById($id);

        if(!$promotion){
            return response()->json([
                'code' => 400,
                'msg' => 'Promotion not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'data' => $promotion,
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
    public function update(PromotionRequest $request, $id)
    {
        $promotion = $this->service->findById($id);
        if(!$promotion){
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại');
        }

        $this->service->update($promotion, array_replace($request->except('_token'), [
            'modify_user_id' => auth()->user()->id
        ]));

        return redirect()->back()->with('success', 'Cập nhật mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = $this->service->findById($id);
        if(!$promotion) {
            return response()->json([
                'code' => 400,
                'msg' => 'Promotion not found'
            ]);
        }


        $this->service->destroy($promotion);

        return response()->json([
            'code' => 200,
            'msg' => 'delete promotion successfully'
        ]);

    }



    public function getJsonData(Request $request){
        return $this->service->getJsonData($request->only('status', 'promotion_type', 'agent_id'));
    }

    public function activePromotion(Request $request){
        $promotion = $this->service->findById($request->get('id'));
        if(!$promotion){
            return response()->json([
                'code' => 404,
                'msg' => 'Promotion not found'
            ]);
        }

        $update = $this->service->updateStatus($promotion);

        if(!$update){
            return response()->json([
                'code' => 400,
                'msg' => 'Something went wrong'
            ]);
        }

        return response()->json([
            'code' => 200,
            'msg' => 'Update status successfully'
        ]);
    }
}
