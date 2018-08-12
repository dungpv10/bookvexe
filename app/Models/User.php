<?php

namespace App\Models;

use App\Models\Agent;
use App\Notifications\ResetPassword;
use App\Notifications\ActivateUserEmail2;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Gravatar;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public static $status = [
        USER_STATUS_INACTIVE => 'Chưa kích hoạt',
        USER_STATUS_ACTIVE => 'Đã kích hoạt'
    ];

    public static $gender = [
        USER_GENDER_FEMALE => 'Nữ',
        USER_GENDER_MALE => 'Nam'
    ];

    const AVATAR_PATH = "upload/avatars";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * User UserMeta
     *
     */
    public function meta()
    {
        return $this->hasOne(UserMeta::class);
    }

    /**
     * User Roles
     *
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Check if user has role
     *
     * @param  string  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        $roleName = $this->role->name;
        return $roleName == $role;
    }

    /**
     * Check if user has permission
     *
     * @param  string  $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        return $this->roles->each(function ($role) use ($permission) {
            if (in_array($permission, explode(',', $role->permissions))) {
                return true;
            }
        });

    }

    /**
     * Teams
     *
     * @return Relationship
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Team member
     *
     * @return boolean
     */
    public function isTeamMember($id)
    {
        $teams = array_column($this->teams->toArray(), 'id');
        return array_search($id, $teams) > -1;
    }

    /**
     * Team admin
     *
     * @return boolean
     */
    public function isTeamAdmin($id)
    {
        $team = $this->teams->find($id);

        if ($team) {
            return (int) $team->user_id === (int) $this->id;
        }

        return false;
    }

    /**
     * Find by Email
     *
     * @param  string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function promotions(){
        return $this->hasMany(Promotion::class, 'agent_id', 'id');
    }

    public function buses(){
        return $this->hasMany(Bus::class, 'user_id', 'id');
    }

    public function getStatusNameAttribute() {

        return self::$status[$this->getAttribute('status')];
    }

    public function getGenderNameAttribute() {

        return self::$gender[$this->getAttribute('gender')];
    }

    public function points(){
        return $this->hasMany(Point::class, 'user_id','id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }


    public function getAvatar() {
        if (!empty($this->avatar)) {
            return asset($this->avatar);
        }
        return Gravatar::src($this->email);
    }

    /**
     * @des get array bus ids of user
     * @return \Illuminate\Support\Collection
     */
    public function getBusIds(){
        return $this->buses()->pluck('id');
    }
   public function sendEmailActive()
    {
        $this->notify(new ActivateUserEmail2($this->status));
    }
}
