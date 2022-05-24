<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\WelcomeMail;
use App\Mail\WelcomeMailChef;
use App\Mail\UserSignupAdmin;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify-email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:15'],
            'last_name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'max:30', 'email', 'regex:/^.+@.+$/i', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'max:10'],
            // 'g-recaptcha-response'=> ['required', 'recaptcha']

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $fileName = "";
        if(isset($data['picdata'])) {

            $imgdata = $data['picdata'];

            list($type, $imgdata) = explode(';', $imgdata);
            list(, $imgdata)      = explode(',', $imgdata);

            $imgdata = base64_decode($imgdata);
            $fileName = time().'.png';
            $path = public_path() . "/uploads/profiles/" . $fileName;

            file_put_contents($path, $imgdata);

        }

        // $this->redirectTo = $data['user-type'] . "/profile";
        // echo "<pre>"; print_r($data); echo "</pre>"; die();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'college' => isset($data['college']) ? $data['college'] : "",
            'user_type' => $data['user-type'],
            'email' => $data['email'],
            'profile_pic' => $fileName,
            'status' => 0,
            'password' => Hash::make($data['password']),
        ]);

        if($data['user-type'] == "chef") {
            $maildata = [
                'email'     => $data['email'],
                'status'    => 'subscribed',
                'firstname' => $data['first_name'],
                'lastname'  => $data['last_name'],
                'phone'  => $data['phone_number']
            ];

            $this->syncMailchimp($maildata, "810958076b");
            // Mail::to($data['email'])->send(new WelcomeMailChef($user));
        } else {
            Mail::to($data['email'])->send(new WelcomeMail($user));
        }

        Mail::to(env('ADMIN_EMAIL'))->send(new UserSignupAdmin($user));
       
        return $user;
    }

    public function syncMailchimp($data, $list_id) {

        $apiKey = '91f97911728daa1de8a8011718966db9-us4';
        $listId =  $list_id;

        $memberId = md5(strtolower($data['email']));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

        $json = json_encode([
            'email_address' => $data['email'],
            'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
            'merge_fields'  => [
                'FNAME'     => $data['firstname'],
                'LNAME'     => $data['lastname'],
                'PHONE'     => $data['phone']
            ]
        ]);

        try {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $httpCode;
        } catch (Exception $e) {
            return null;
        }  

    }

}
