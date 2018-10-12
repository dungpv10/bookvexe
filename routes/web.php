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

Route::group([
    'namespace' => 'FrontEnd'
], function () {
    Route::get('/', 'HomeController@home');
    Route::get('/list-bus', 'HomeController@getListBus');
    Route::get('/choose-seat', 'HomeController@getChooseSeat');
    Route::get('/choose-seat-floor', 'HomeController@getChooseSeatFloor');
    Route::get('/info-customer', 'HomeController@getInfoCustomer');
    Route::get('/payment-method', 'HomeController@getPaymentMethod');
});


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
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'is_manager'], function () {
        Route::get('/', function () {
            return redirect()->route('bus.index');
        });
        Route::get('dashboard', ['middleware' => 'roles:' . DASHBOARD_ROLE, 'uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . USER_ROLE], function () {
            Route::resource('users', 'UserController', ['except' => ['show']]);
            Route::post('users/search', ['uses' => 'UserController@search', 'as' => 'users.search.post']);
            Route::get('users/invite', ['uses' => 'UserController@getInvite', 'as' => 'users.invite']);
            Route::get('users/switch/{id}', 'UserController@switchToUser');
            Route::post('users/invite', 'UserController@postInvite');
            Route::get('users/getJSONData', ['as' => 'users.datatable', 'uses' => 'UserController@getJSONData']);
            Route::get('users/confirm/{id}', ['as' => 'users.confirm', 'uses' => 'UserController@getConfirm']);
            Route::post('users/multiple-delete', ['uses' => 'UserController@multipleDelete', 'as' => 'user.multiple.delete']);
            Route::post('users/togleStatusUser', ['uses' => 'UserController@togleStatusUser', 'as' => 'user.togleStatus']);
        });


        /*
        |--------------------------------------------------------------------------
        | Bus
        |--------------------------------------------------------------------------
        */

        Route::group(['middleware' => 'roles:' . BUS_ROLE], function () {
            Route::resource('bus', 'BusController', ['except' => ['show', 'update']]);
            Route::get('bus/getJSONData', ['as' => 'bus.datatable', 'uses' => 'BusController@getJSONData']);
            Route::post('bus/update/{id}', ['as' => 'bus.update.bus', 'uses' => 'BusController@updateBus']);
            Route::get('bus/detail/{id?}', ['as' => 'bus.detail', 'uses' => 'BusController@detail']);
            Route::post('bus/deleteMultiple', ['as' => 'bus.delete_multiple', 'uses' => 'BusController@deleteMultiple']);
            Route::get('bus/all', ['as' => 'bus.all', 'uses' => 'BusController@getAllBus']);

            /*
            |--------------------------------------------------------------------------
            | Bus Type
            |--------------------------------------------------------------------------
            */

            Route::resource('bus-type', 'BusTypeController', ['except' => ['show']]);
            Route::get('bus-type/getJSONData', ['as' => 'bus-type.datatable', 'uses' => 'BusTypeController@getJSONData']);
            Route::post('bustype/deleteMultiple', ['as' => 'bustype.delete_multiple', 'uses' => 'BusTypeController@deleteMultiple']);
        });


        /*
        |--------------------------------------------------------------------------
        | Route
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . ROUTE_ROLE], function () {
            Route::resource('routes', 'RouteController', ['except' => ['show']]);
            Route::post('routes/getJSONData', ['as' => 'routes.datatable', 'uses' => 'RouteController@getJSONData']);
        });
        /*
        |--------------------------------------------------------------------------
        | Point
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . POINT_ROLE], function () {
            Route::resource('points', 'PointController');
            Route::get('point/getJSONData', ['as' => 'point.datatable', 'uses' => 'PointController@getJSONData']);
            Route::post('point/deleteMultiple', ['as' => 'point.delete_multiple', 'uses' => 'PointController@deleteMultiple']);
        });
        /*
        |--------------------------------------------------------------------------
        | Promotion
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . PROMOTION_ROLE], function () {
            Route::get('promotions/getJsonData', ['as' => 'promotions.json_data', 'uses' => 'PromotionController@getJsonData']);
            Route::post('promotions/activePromotion', ['as' => 'promotions.active', 'uses' => 'PromotionController@activePromotion']);
            Route::resource('promotions', 'PromotionController', ['except' => ['create']]);
        });
        /*
        |--------------------------------------------------------------------------
        | Booking
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . BOOKING_ROLE], function () {
            Route::get('bookings/jsonData', [
                'uses' => 'BookingController@getJsonData',
                'as' => 'bookings.json_data'
            ]);
            Route::post('bookings/update-status/{id}', [
                'uses' => 'BookingController@updateStatus',
                'as' => 'bookings.update_status'
            ]);
            Route::resource('bookings', 'BookingController');
        });

        /*
        |--------------------------------------------------------------------------
        | Team Routes
        |--------------------------------------------------------------------------
        */

        Route::get('team/getJsonData', ['uses' => 'TeamController@getJsonData', 'as' => 'teams.get_json_data']);
        Route::get('team/{name}', 'TeamController@showByName');
        Route::resource('teams', 'TeamController', ['except' => ['show']]);
        Route::post('teams/search', 'TeamController@search');
        Route::post('teams/{id}/invite', 'TeamController@inviteMember');
        Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');

        Route::get('teams/confirms/{userId}', ['uses' => 'TeamController@confirmTeam', 'as' => 'teams.confirm']);
        Route::post('teams/confirms/{userId}', ['uses' => 'TeamController@postConfirmTeam', 'as' => 'teams.post.confirm']);


        /*
        |--------------------------------------------------------------------------
        | Agent
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . AGENT_ROLE], function () {
            Route::get('agents/jsonData', ['as' => 'agents.getJsonData', 'uses' => 'AgentController@getJsonData']);
            Route::post('agents/update-status', ['as' => 'agents.update_status', 'uses' => 'AgentController@updateStatus']);
            Route::get('agents/setting', ['as' => 'agents.setting', 'uses' => 'AgentController@getSetting']);
            Route::post('agents/setting', ['as' => 'agents.post.setting', 'uses' => 'AgentController@postSetting']);
            Route::resource('agents', 'AgentController');
        });

        /*
        |--------------------------------------------------------------------------
        | Cancellation
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => 'roles:' . CANCELLATION_ROLE], function () {
            Route::get('cancellations/getJsonData', ['as' => 'cancellations.getJsonData', 'uses' => 'SettingCancelBookingController@getJsonData']);
            Route::resource('cancellations', 'SettingCancelBookingController');
        });

        /*
        |--------------------------------------------------------------------------
        | Customer
        |--------------------------------------------------------------------------
        */
        Route::get('customer/getJsonData', ['as' => 'customer.getJsonData', 'uses' => 'CustomerController@getJsonData']);
        Route::resource('customer', 'CustomerController');


        /*
        |--------------------------------------------------------------------------
        | Cancellation
        |--------------------------------------------------------------------------
        */

        Route::group(['middleware' => 'roles:' . RATING_ROLE], function () {
            Route::get('ratings/getJsonData', ['as' => 'ratings.getJsonData', 'uses' => 'RatingController@getJsonData']);
            Route::resource('ratings', 'RatingController');
        });

        /*
        |--------------------------------------------------------------------------
        | Admin group
        |--------------------------------------------------------------------------
        */

        Route::group(['middleware' => 'roles:' . INITIALIZE_ROLE], function () {
            Route::get('initializes/get_events', ['uses' => 'InitializeController@getEvents', 'as' => 'initializes.get_events']);
            Route::get('initializes/getJsonData', ['uses' => 'InitializeController@getJsonData', 'as' => 'initializes.getJsonData']);
            Route::resource('initializes', 'InitializeController');
        });


        Route::group(['middleware' => 'roles:' . PERMISSION_ROLE], function () {

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */
            Route::resource('roles', 'RoleController', ['except' => ['show']]);
            Route::post('roles/search', 'RoleController@search');
            Route::get('roles/search', 'RoleController@index');
            Route::get('roles/getJSONData', ['as' => 'roles.datatable', 'uses' => 'RoleController@getJSONData']);
            Route::post('roles/multiple-delete', ['uses' => 'RoleController@multipleDelete', 'as' => 'role.multiple.delete']);

        });
        Route::group(['middleware' => 'roles:' . SETTING_ROLE], function () {
            /*
            |--------------------------------------------------------------------------
            | Setting
            |--------------------------------------------------------------------------
            */

            Route::resource('setting', 'SettingController', ['only' => ['index', 'update']]);

        });
        Route::group(['middleware' => 'roles:' . HOLIDAY_ROLE], function () {
            /*
            |--------------------------------------------------------------------------
            | Holiday management
            |--------------------------------------------------------------------------
            */
            Route::get('holidays/getJSONData', ['as' => 'holidays.datatable', 'uses' => 'ManagerHolidayController@getJSONData']);
            Route::resource('holidays', 'ManagerHolidayController');
        });

    });
});
