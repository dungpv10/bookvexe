<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('dashboard', function ($user) {
            return in_array(0, $user->role->module_ids_as_array);
        });


        Gate::define('root', function ($user) {
            return $this->hasRole($user, ['root']);
        });

        Gate::define('admin', function ($user) {
            return $this->hasRole($user, ['admin', 'root']);
        });

        Gate::define('agent', function ($user) {
            return $this->hasRole($user, ['admin']);
        });

        Gate::define('staff', function ($user) {
            return $this->hasRole($user, ['staff']);
        });

        Gate::define('customer', function ($user) {
            return $this->hasRole($user, ['customer']);
        });

        Gate::define('team-member', function ($user, $team) {
            return ($user->teams->find($team->id));
        });
    }


    private function hasRole($user, $roles)
    {
        $roleName = $user->role->name;

        return (in_array($roleName, $roles));
    }
}
