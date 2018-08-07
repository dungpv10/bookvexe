<?php

namespace App\Services;

use App\Models\Agent;
use DB;
use Auth;
use Mail;
use Config;
use Session;
use Exception;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Team;
use App\Models\Role;
use App\Events\UserRegisteredEmail;
use App\Notifications\ActivateUserEmail;
use Illuminate\Support\Facades\Schema;
use Yajra\Datatables\Datatables;
use Gate;

class UserService
{
    /**
     * User model
     * @var User
     */
    public $model;

    /**
     * User Meta model
     * @var UserMeta
     */
    protected $userMeta;

    /**
     * Team Service
     * @var TeamService
     */
    protected $team;

    protected $agent;
    /**
     * Role Service
     * @var RoleService
     */
    protected $role;
    protected $datatable;

    public function __construct(
        User $model,
        UserMeta $userMeta,
        Team $team,
        Role $role,
        DataTables $datatable,
        Agent $agent
    )
    {
        $this->model = $model;
        $this->userMeta = $userMeta;
        $this->team = $team;
        $this->role = $role;
        $this->datatable = $datatable;
        $this->agent = $agent;
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a user
     * @param  integer $id
     * @return User
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Search the users
     *
     * @param  string $input
     * @return mixed
     */
    public function search($input)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('users');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%' . $input . '%');
        };

        return $query->paginate(env('PAGINATE', 25));
    }

    /**
     * Find a user by email
     *
     * @param  string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->model->findByEmail($email);
    }

    /**
     * Find by Role ID
     * @param  integer $id
     * @return Collection
     */
    public function findByRoleID($id)
    {
        $usersWithRepo = [];
        $users = $this->model->all();
        foreach ($users as $user) {
            if ($user->role_id == $id) {
                $usersWithRepo[] = $user;
            }
        }

        return $usersWithRepo;
    }

    /**
     * Find by the user meta activation token
     *
     * @param  string $token
     * @return boolean
     */
    public function findByActivationToken($token)
    {
        $userMeta = $this->userMeta->where('activation_token', $token)->first();

        if ($userMeta) {
            return $userMeta->user();
        }

        return false;
    }

    /**
     * Create a user's profile
     *
     * @param  User $user User
     * @param  string $password the user password
     * @param  string $role the role of this user
     * @param  boolean $sendEmail Whether to send the email or not
     * @return User
     */
    public function create($user, $password, $role = 'staff', $sendEmail = true)
    {
        try {

            return $user;
        } catch (Exception $e) {
            throw $e;
//            throw new Exception("We were unable to generate your profile, please try again later.", 1);
        }
    }

    /**
     * Update a user's profile
     *
     * @param  int $userId User Id
     * @param  array $inputs UserMeta info
     * @return User
     */
    public function update($user, $data)
    {
        return $user->fill($data)->save();
    }

    /**
     * Invite a new member
     * @param  array $info
     * @return void
     */
    public function invite($info)
    {
        $password = substr(md5(rand(1111, 9999)), 0, 10);
        $user = null;
        return DB::transaction(function () use ($password, $info, $user) {
            $user = $this->model->create([
                'email' => $info['email'],
                'name' => $info['name'],
                'username' => $info['username'],
                'password' => bcrypt($password)
            ]);
            if (empty($info['roles'])) {
                $info['roles'] = null;
            }
            return $this->create($user, $password, $info['roles'], true);
        });

        return $user;
    }

    /**
     * Destroy the profile
     *
     * @param  int $id
     * @return bool
     */
    public function destroy($id)
    {
        $user = $this->model->find($id);
        return $user->delete();

    }

    /**
     * Switch user login
     *
     * @param  integer $id
     * @return boolean
     */
    public function switchToUser($id)
    {
        try {
            $user = $this->model->find($id);
            Session::put('original_user', Auth::id());
            Auth::login($user);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error logging in as user", 1);
        }
    }

    /**
     * Switch back
     *
     * @param  integer $id
     * @return boolean
     */
    public function switchUserBack()
    {
        try {
            $original = Session::pull('original_user');
            $user = $this->model->find($original);
            Auth::login($user);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error returning to your user", 1);
        }
    }

    /**
     * Set and send the user activation token via email
     *
     * @param void
     */
    public function setAndSendUserActivationToken($user)
    {
        $token = md5(str_random(40));

        $user->meta()->update([
            'activation_token' => $token
        ]);

//        $user->notify(new ActivateUserEmail($token));
    }

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    /**
     * Assign a role to the user
     *
     * @param  string $roleName
     * @param  integer $userId
     * @return void
     */
    public function assignRole($roleName, $userId)
    {
        $role = $this->role->findByName($roleName);
        $user = $this->model->find($userId);

        $user->roles()->attach($role);
    }

    /**
     * Unassign a role from the user
     *
     * @param  string $roleName
     * @param  integer $userId
     * @return void
     */
    public function unassignRole($roleName, $userId)
    {
        $role = $this->role->findByName($roleName);
        $user = $this->model->find($userId);

        $user->roles()->detach($role);
    }

    /**
     * Unassign all roles from the user
     *
     * @param  string $roleName
     * @param  integer $userId
     * @return void
     */
    public function unassignAllRoles($userId)
    {
        $user = $this->model->find($userId);
        $user->roles()->detach();
    }

    /*
    |--------------------------------------------------------------------------
    | Teams
    |--------------------------------------------------------------------------
    */

    /**
     * Join a team
     *
     * @param  integer $teamId
     * @param  integer $userId
     * @return void
     */
    public function joinTeam($teamId, $userId)
    {
        $team = $this->team->find($teamId);
        $user = $this->model->find($userId);

        $user->teams()->attach($team);
    }

    /**
     * Leave a team
     *
     * @param  integer $teamId
     * @param  integer $userId
     * @return void
     */
    public function leaveTeam($teamId, $userId)
    {
        $team = $this->team->find($teamId);
        $user = $this->model->find($userId);

        $user->teams()->detach($team);
    }

    /**
     * Leave all teams
     *
     * @param  integer $teamId
     * @param  integer $userId
     * @return void
     */
    public function leaveAllTeams($userId)
    {
        $user = $this->model->find($userId);
        $user->teams()->detach();
    }

    public function getJSONData($roleId = null, $search = "")
    {

        $builder = $this->model->with('role');

        $admin = $this->getAdminAgent();

        if(!empty($admin)){
            $agentId = $admin->agent->id;

            $builder->where('users.agent_id', $agentId);
        }

        if (!empty($roleId)) {
            $builder = $builder->where('role_id', '=', $roleId);
        }

        return $this->datatable->eloquent($builder)
            ->filter(function ($query) use ($search, $roleId) {
                if (!empty($search)) {
                    $search = strtolower(trim($search));
                    $query->whereRaw('(LOWER(`users`.`name`) LIKE "%' . $search . '%" OR LOWER(`users`.`email`) LIKE "%' . $search . '%")');
                }
            })
            ->addColumn('rName', function (User $user) {
                return $user->role->name;
            })
            ->addColumn('status_name', function (User $user) {
                return $user->status_name;
            })
            ->make(true);
    }


    public function store($data)
    {
        $data = array_merge($data, ['password' => bcrypt($data['password'] ?? 'secret')]);
        return $this->model->fill($data)->save();
    }


    public function getAdminAgent($user = null){
        if(empty($user)) $user = auth()->user();

        $agentId = $user->agent ? $user->agent->id : null;
        return $agentId != null ? $this->model->where('agent_id', $agentId)->where('role_id', 2)->first() : null;
    }

    public function getAdminAgentId($user = null){
        $admin = $this->getAdminAgent($user);

        return $admin ? $admin->id : false;
    }

    public function togleStatusUser($userId)
    {
        $user = $this->model->find($userId);
        if ($user) {
            if ($user->status == USER_STATUS_ACTIVE) {
                $user->status = USER_STATUS_INACTIVE;
            }
            else {
                $user->status = USER_STATUS_ACTIVE;
            }
        }
        if ($user->save()) {
            $user->sendEmailActive();
            return true;
        }
        return false;
    }

}
