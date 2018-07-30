<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\RoleService;
use App\Services\TeamService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserInviteRequest;
use Log;
use Gate;

class UserController extends Controller
{
    public function __construct(UserService $userService, RoleService $roleService, TeamService $teamService)
    {
        $this->service = $userService;
        $this->roleService = $roleService;
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = null;
        if (Gate::allows('admin')) {
            $roles = $this->roleService->all();
        }
        return view('admin.users.index')->with('roles', $roles);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if (!$request->search) {
            return redirect('admin/users');
        }

        $users = $this->service->search($request->search);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for inviting a customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvite()
    {
        return view('admin.users.invite');
    }

    /**
     * Show the form for inviting a customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function postInvite(UserInviteRequest $request)
    {
        $result = $this->service->invite($request->except(['_token', '_method']));

        if ($result) {
            return redirect('admin/users')->with('message', 'Successfully invited');
        }

        return back()->with('errors', ['Failed to invite']);
    }

    /**
     * Switch to a different User profile
     *
     * @return \Illuminate\Http\Response
     */
    public function switchToUser($id)
    {
        if ($this->service->switchToUser($id)) {
            return redirect('dashboard')->with('message', 'You\'ve switched users.');
        }

        return redirect('dashboard')->with('errors', ['Could not switch users']);
    }

    /**
     * Switch back to your original user
     *
     * @return \Illuminate\Http\Response
     */
    public function switchUserBack()
    {
        if ($this->service->switchUserBack()) {
            return back()->with('message', 'You\'ve switched back.');
        }

        return back()->with('errors', ['Could not switch back']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->service->find($id);
        $roles = null;
        $teams = null;
        if (Gate::allows('admin')) {
            $roles = $this->roleService->all();
            $teams = $this->teamService->all();
        }
        return view('admin.users.edit')->with('user', $user)->with('roles', $roles)->with('teams', $teams);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        if (Gate::allows('admin')) {
            $user = $this->service->find($id);
            $this->service->leaveAllTeams($id);
            if ($data['roles'] == 'agent') {
                $this->teamService->create($user->id, ['name' =>'Agent_' . $user->name]);
            }
            elseif($data['roles'] == 'staff' && !empty($data['team_id'])) {
                $this->service->joinTeam($data['team_id'], $id);
            }
        }
        $result = $this->service->update($id, $data);
        if ($result) {
            return back()->with('success', 'Cập nhật thành công');
        }

        return back()->with('err', 'Cập nhật thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
        $roleId = $request->get('role_id');
        $search = $request->get('search')['value'];
        return $this->service->getJSONData($roleId, $search);
    }

    public function create()
    {
        $roles = null;
        $teams = null;
        if (Gate::allows('admin')) {
            $roles = $this->roleService->pluckSelection('name');
            $teams = $this->teamService->all();
        }
        return view('admin.users.create', compact('roles', 'teams'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $user = $this->service->invite($data);
        if ($user) {

            if (Gate::allows('admin')) {
                if ($data['roles'] == 'agent') {
                    $this->teamService->create($user->id, ['name' =>'Agent_' . $user->name]);
                }
                if ($data['roles'] == 'staff' && !empty($data['team_id'])) {
                    $this->service->joinTeam($data['team_id'], $user->id);
                }
            }
            elseif (Gate::allows('agent'))
            {
                $team = $this->teamService->findByTeamLead(auth()->id());
                if ($team) {
                    $this->service->joinTeam($team->id, $user->id);
                }
            }
            if ($request->ajax()) {
                return response()->json(['code' => 1, 'msg' => 'success']);
            }
            return redirect()->back()->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->back()->with('error', 'Thêm mới người dùng thất bại');
    }
}
