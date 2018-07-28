<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a given Closure or controller and enjoy the fresh air.
|
*/

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
*/

Route::get('/', 'PagesController@home');

/*
|--------------------------------------------------------------------------
| Login/ Logout/ Password
|--------------------------------------------------------------------------
*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*
|--------------------------------------------------------------------------
| Registration & Activation
|--------------------------------------------------------------------------
*/
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('activate/token/{token}', 'Auth\ActivateController@activate');
Route::group(['middleware' => ['auth']], function () {
    Route::get('activate', 'Auth\ActivateController@showActivate');
    Route::get('activate/send-token', 'Auth\ActivateController@sendToken');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'active']], function () {

    /*
    |--------------------------------------------------------------------------
    | General
    |--------------------------------------------------------------------------
    */

    Route::get('/users/switch-back', 'Admin\UserController@switchUserBack');
    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@update');
        Route::get('password', 'PasswordController@password');
        Route::post('password', 'PasswordController@update');
        Route::post('{id}/avatar', ['as' => 'avatar.uploads', 'uses' => 'SettingsController@postAvatar']);
        Route::put('{id}/avatar', ['as' => 'avatar.delete', 'uses' => 'SettingsController@deleteAvatar']);
    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', 'PagesController@dashboard');

    /*
    |--------------------------------------------------------------------------
    | Team Routes
    |--------------------------------------------------------------------------
    */

    Route::get('team/{name}', 'TeamController@showByName');
    Route::resource('teams', 'TeamController', ['except' => ['show']]);
    Route::post('teams/search', 'TeamController@search');
    Route::post('teams/{id}/invite', 'TeamController@inviteMember');
    Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
        Route::get('/', function(){
            return redirect()->route('bus.index');
        });
        Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        Route::resource('users', 'UserController', ['except' => ['show']]);
        Route::post('users/search', ['uses' => 'UserController@search', 'as' => 'users.search.post']);
        Route::get('users/invite', ['uses' => 'UserController@getInvite', 'as' => 'users.invite']);
        Route::get('users/switch/{id}', 'UserController@switchToUser');
        Route::post('users/invite', 'UserController@postInvite');
        Route::get('users/getJSONData', ['as'=>'users.datatable', 'uses'=>'UserController@getJSONData']);
        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        Route::resource('roles', 'RoleController', ['except' => ['show']]);
        Route::post('roles/search', 'RoleController@search');
        Route::get('roles/search', 'RoleController@index');
        Route::get('roles/getJSONData', ['as'=>'roles.datatable', 'uses'=>'RoleController@getJSONData']);


        /*
        |--------------------------------------------------------------------------
        | Setting
        |--------------------------------------------------------------------------
        */

        Route::resource('setting', 'SettingController', ['only' => ['index', 'update']]);

        /*
        |--------------------------------------------------------------------------
        | Bus
        |--------------------------------------------------------------------------
        */

        Route::resource('bus', 'BusController', ['except' => ['show', 'update']]);
        Route::get('bus/getJSONData', ['as'=>'bus.datatable', 'uses'=>'BusController@getJSONData']);
        Route::post('bus/update/{id}', ['as'=>'bus.update.bus', 'uses'=>'BusController@updateBus']);
        Route::get('bus/detail/{id?}', ['as'=>'bus.detail', 'uses'=>'BusController@detail']);

        /*
        |--------------------------------------------------------------------------
        | Bus Type
        |--------------------------------------------------------------------------
        */

        Route::resource('bus-type', 'BusTypeController', ['except' => ['show']]);
        Route::get('bus-type/getJSONData', ['as'=>'bus-type.datatable', 'uses'=>'BusTypeController@getJSONData']);

        /*
        |--------------------------------------------------------------------------
        | Route
        |--------------------------------------------------------------------------
        */

        Route::resource('routes', 'RouteController', ['except' => ['show']]);
        Route::post('routes/getJSONData', ['as'=>'routes.datatable', 'uses'=>'RouteController@getJSONData']);

        /*
        |--------------------------------------------------------------------------
        | Point
        |--------------------------------------------------------------------------
        */

        Route::resource('points', 'PointController');
        Route::get('point/getJSONData', ['as'=>'point.datatable', 'uses'=>'PointController@getJSONData']);

        /*
        |--------------------------------------------------------------------------
        | Promotion
        |--------------------------------------------------------------------------
        */

        Route::resource('promotions', 'PromotionController');

        /*
        |--------------------------------------------------------------------------
        | Booking
        |--------------------------------------------------------------------------
        */

        Route::resource('bookings', 'BookingController');
    });
});
