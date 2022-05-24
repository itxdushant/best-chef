<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

use App\Mail\WelcomeMailChef;
use App\User;
use Mail;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        //$this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    protected function redirectTo() {

        $id=Auth::user()->id;
        $user = User::where(['id' => $id])->first();
        //check if link is ot expired
                
            //send welcome email
           
            $user->status = 1;
            $user->save();
            
            if($user['user_type'] == "chef") {   
                Mail::to($user['email'])->send(new WelcomeMailChef($user));                
            }
        
        return url(Auth::user()->user_type);
    }

    public function verifyUser($id) {
   
        $user = User::where(['id' => $id])->first();
        //check if link is ot expired
        if($user->email_verified_at == null) {            
            //send welcome email
            $user->email_verified_at = date("Y-m-d h:i:s");
            $user->status = 1;
            $user->save();
            
            if($user['user_type'] == "chef") {   
                Mail::to($user['email'])->send(new WelcomeMailChef($user));                
            }
        }

        return redirect(url($user->user_type));
    }
}
