<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:roles',
        'label' => 'required'
    ];

    /**
     * A Roles users
     *
     * @return Relationship
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Find a role by name
     *
     * @param  string $name
     * @return Role
     */
    public static function findByName($name)
    {
        return Role::where('name', $name)->firstOrFail();
    }


    public function getModuleIdsAsArrayAttribute(){
      $modulesIds = $this->getAttribute('module_ids');
      return $modulesIds ? explode(',', $modulesIds) : [];
    }
}
