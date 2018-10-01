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

        Gate::define('dashboard_perm', function ($user) {
            return in_array(DASHBOARD_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('user_perm', function ($user) {
            return in_array(USER_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('bus_perm', function ($user) {
            return in_array(BUS_ROLE, $user->role->module_ids_as_array);
        });
        Gate::define('route_perm', function ($user) {
            return in_array(ROUTE_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('point_perm', function ($user) {
            return in_array(POINT_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('initialize_perm', function ($user) {
            return in_array(INITIALIZE_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('booking_perm', function ($user) {
            return in_array(BOOKING_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('cancellation_perm', function ($user) {
            return in_array(CANCELLATION_ROLE, $user->role->module_ids_as_array);
        });
        Gate::define('promotion_perm', function ($user) {
            return in_array(PROMOTION_ROLE, $user->role->module_ids_as_array);
        });
        Gate::define('rating_perm', function ($user) {
            return in_array(RATING_ROLE, $user->role->module_ids_as_array);
        });
        Gate::define('agent_perm', function ($user) {
            return in_array(AGENT_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('holiday_perm', function ($user) {
            return in_array(HOLIDAY_ROLE, $user->role->module_ids_as_array);
        });

        Gate::define('role_perm', function ($user) {
            return in_array(PERMISSION_ROLE, $user->role->module_ids_as_array);
        });
        Gate::define('setting_perm', function ($user) {
            return in_array(SETTING_ROLE, $user->role->module_ids_as_array);
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
