<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {   
        return ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        // return ['email' => $request->email, 'password' => $request->password, 'status' => 1];    
    }

    protected function authenticated(Request $request, $user) {
     
        $user->update([
            'login_time' => date("Y-m-d H:i:s")
        ]);

        if ($request->ajax()){
            return response()->json([
                 'auth' => auth()->check(),
                 'user' => $user,
                 'intended' => $this->redirectPath(),
             ]);
        }
        if ($user->user_type == "admin") {
            return redirect('/admin');
        } else if ($user->user_type == "chef") {
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
