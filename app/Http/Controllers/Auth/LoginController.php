<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide this functionality to your appliations.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/bus';

    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userService = $userService;
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        if($this->userService->checkEmptyInformation()) {
            return redirect()->route('agents.setting');
        }

        if(!\Gate::allows('customer')){
            return redirect()->route('bus.index');
        }


        return redirect('/');
    }

    public function username()
    {
        return 'username';
    }
}
