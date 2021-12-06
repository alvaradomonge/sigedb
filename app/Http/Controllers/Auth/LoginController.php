<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    //protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function redirectTo(){
        // switch(Auth::user()->id_rol_usuario){
        //     case 1:
        //     $redirectTo = 'adminDashboard';
        //     return $redirectTo;
        //         break;
        //     case 1:
        //     $redirectTo = 'docenteDashboard';
        //     return $redirectTo;
        //         break;
        //     default:
        //         $redirectTo = '/';
        //         return $redirectTo;
        // }
        return '/';
    }
}
