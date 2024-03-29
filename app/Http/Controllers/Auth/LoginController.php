<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3;     // login_times
    protected $decayMinutes = 1;   //login_delaytime

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo'; //loginしたあとの偏移先の変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        // dd($request);
        return redirect('/login');
    }
}
