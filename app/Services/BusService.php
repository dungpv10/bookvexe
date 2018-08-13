<?php

namespace App\Services;

use DB;
use App\Models\Bus;
use Yajra\Datatables\Datatables;

class BusService
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $busModel;

    protected $userService;

    /**
     * BusService constructor.
     * @param Bus $busModel
     */
    public function __construct(Bus $busModel, UserService $userService)
    {
        $this->busModel = $busModel;
        $this->userService = $userService;
    }

    /**
     * Comment
     */
    public function all()
    {
        $adminAgentId = $this->userService->getAdminAgentId();
        if (!empty($adminAgentId)) {
            return $this->busModel->where('user_id', $adminAgentId)->get();
        }

        return $this->busModel->all();
    }

    public function getJSONData($filters)
    {
        $result = $this->busModel->with('busType')->with('user')->where('id', '!=', 0);

        if(!empty($filters['bus_type_id'])){
            $result->where('bus_type_id', $filters['bus_type_id']);
        }

        if(!empty($filters['agent_id'])){
            $result->whereHas('user', function($q) use ($filters){
                $q->where('agent_id', $filters['agent_id']);
            });
        }

        $adminAgentId = $this->userService->getAdminAgentId();

        if(!empty($adminAgentId)){
            $result->where('buses.user_id', $adminAgentId);
        }



        return DataTables::of($result)
        ->addColumn('busType', function (Bus $bus) {
            return $bus->busType->bus_type_name;
        })
        ->addColumn('agentName', function($result){
            return isset($result->user->agent->agent_name) ? $result->user->agent->agent_name : '';
        })->make(true);
    }

    public function findById($id = null)
    {
        return $this->busModel->with('busType')->with('images')->find($id);
    }

    public function updateBus($id = null, $dataRequest)
    {
        $bus = $this->busModel->where('buses.id', $id);
        if (auth()->user()->hasRole('agent')) {
            $bus->where('buses.user_id', auth()->user()->id);
        }
        if (count($bus->get()) < 1) {
            return false;
        }
        $dataRequest['start_time'] = $this->getTime($dataRequest['start_time']);
        $dataRequest['end_time'] = $this->getTime($dataRequest['end_time']);
        $bus->update($dataRequest);
        return true;
    }

    public function getTime($time)
    {
        $chunks = explode(':', $time);
        if (strpos($time, 'AM') === false && $chunks[0] !== '12') {
            $chunks[0] = $chunks[0] + 12;
        } else if (strpos($time, 'PM') === false && $chunks[0] == '12') {
            $chunks[0] = '00';
        }
        $chunks[1] = str_replace(' PM', ':00', $chunks['1']);
        $chunks[1] = str_replace(' AM', ':00', $chunks['1']);
        return preg_replace('/\s[A-Z]+/s', '', implode(':', $chunks));
    }

    public function destroy($id)
    {
        try {
            $this->busModel->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function insertBus($dataRequest)
    {
        $dataRequest['user_id'] = auth()->user()->id;
        $dataRequest['start_time'] = $this->getTime($dataRequest['start_time']);
        $dataRequest['end_time'] = $this->getTime($dataRequest['end_time']);
        $this->busModel->fill($dataRequest)->save();
        return $this->busModel->id;
    }

    public function countBusByRegNumber($regNumber)
    {
        return $this->busModel->where('bus_reg_number', $regNumber)->count();
    }

    public function countBusByRegNumberAndId($id, $regNumber)
    {
        return $this->busModel->where('bus_reg_number', $regNumber)->where('id', '!=', $id)->count();
    }

    public function getAllBusName($busId = null)
    {
        return $this->busModel->where('id', '!=', $busId)->pluck('bus_name', 'id');
    }


    public function getAllBusReg ($busId = null)
    {
        return $this->busModel->where('id', '!=', $busId)->pluck('bus_reg_number', 'id');
    }

    public function destroyList($listBusId)
    {
        try {
            $this->busModel->whereIn('id', $listBusId)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAllIdBusOfAgent(){
        $adminAgent = $this->userService->getAdminAgentId();
        if(!empty($adminAgent))
            return $this->busModel->where('user_id', $adminAgent)->pluck('id')->toArray();
        return $this->busModel->pluck('id')->toArray();
    }
}
