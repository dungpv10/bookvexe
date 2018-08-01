<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        $currentUser = auth()->user();
        if($currentUser->hasRole('agent') && $currentUser->teams()->count() == 0){
            return redirect()->route('teams.confirm', [$currentUser->id]);
        }

        if ($currentUser->hasRole('admin') || $currentUser->hasRole('agent')) {
            return redirect('/admin/bus');
        }


        return redirect('/');
    }
}
