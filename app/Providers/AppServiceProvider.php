<?php

namespace App\Providers;

use App\Models\Bus;
use App\Models\BusType;
use App\Models\User;
use App\Observers\BusObserver;
use App\Observers\BusTypeObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BusType::observe(BusTypeObserver::class);
        User::observe(UserObserver::class);
        Bus::observe(BusObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
