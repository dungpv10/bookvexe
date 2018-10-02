<?php

namespace App\Services;


use App\Models\Promotion;
use Yajra\DataTables\DataTables;
use Auth;

class PromotionService
{
    protected $model;

    protected $dataTables;
    protected $userService;

    public function __construct(Promotion $promotion, DataTables $dataTables, UserService $userService)
    {
        $this->model = $promotion;
        $this->dataTables = $dataTables;
        $this->userService = $userService;
    }

    public function getJsonData($filters){
        $builder = $this->model->with('agent');

        foreach($filters as $key => $filter){
            if($filter == '') continue;

            $builder->where($key, $filter);
        }
        $userAgent = auth()->user()->agent;
        if($userAgent){
            $builder->where('agent_id', $userAgent->id);
        }

        return $this->dataTables->of($builder)
            ->addColumn('userCreate', function(Promotion $promotion){
                return $promotion->user ? $promotion->user->name : '';
            })
            ->addColumn('agentName', function(Promotion $promotion){
                return $promotion->agent ? $promotion->agent->agent_name : '';
            })
            ->addColumn('userUpdate', function(Promotion $promotion){
                return $promotion->userUpdate ? $promotion->userUpdate->name : 'Chưa cập nhật';
            })
            ->make(true);
    }


    public function destroy($promotion){
        return $promotion->delete();
    }


    public function findById($id){
        $promotion =  $this->model->find($id);
        return $promotion ? $promotion : false;
    }

    public function getPromotionTypes(){
        return array_replace(['' => 'Chọn loại giảm giá'], $this->model->getTypes());
    }

    public function getStatuses(){
        return array_replace(['' => 'Chọn trạng thái'], $this->model->getStatuses());
    }


    public function updateStatus($promotion){
        $promotion->status = $promotion->status == PROMOTION_DEACTIVE ? PROMOTION_ACTIVE : PROMOTION_DEACTIVE;

        return $promotion->save();
    }

    public function insert($data){
        $data['user_id'] = Auth::user()->id;
        $data['modify_user_id'] = Auth::user()->id;
        return $this->model->fill($data)->save();
    }

    public function update($promotion, $data){
        $data['modify_user_id'] = Auth::user()->id;
        return $promotion->fill($data)->save();
    }
}
