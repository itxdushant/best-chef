<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Menu;

use App\Mail\WelcomeMail;
use App\Mail\WelcomeMailChef;
use App\Mail\UserSignupAdmin;
use Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use DB;


class AuthController extends Controller
{
	
	public function register(Request $request) {
  
		
		if(isset($request->first_name) && isset($request->last_name) && isset($request->email) && isset($request->phone_number) && isset($request->password)) {

    		$email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		   return response(['message'=>'Invalid email format', 'code'=>400], 400);
    		}
    		else {
        		$email = User::whereEmail($email)->count();
        		if($email>0){
        		    return response(['message'=>'Email already exist', 'code'=>400], 400);
        		}
    		}
    		
    		if(strlen($request->password) < 7){
    		    return response(['message'=>'Password must be more than 8 characters!', 'code'=>400], 400);
    		}

    		$user = new User;
    		$user->first_name = $request->first_name;
    		$user->last_name = $request->last_name;
    		$user->email = $request->email;
    		$user->password = bcrypt($request->password);
    		$user->phone_number = $request->phone_number;
    		$user->user_type = $request->user_type;
            $user->device_token = $request->device_token;
    		if(@$request->college){
    		  $user->college = $request->college;
    		}
    		$user->status = 1;
    		$user->save();
    		
    		$accessToken = $user->createToken('authToken')->accessToken;
    		
    		$user['menu_count'] = Menu::where('user_id', $user->id)->count();
    		
    		if($user->profile_pic){
    		$user['profile_pic'] = asset('uploads/profiles/'.$user->profile_pic);
    		}
    		else {
    		    $user['profile_pic'] = 'https://www.gravatar.com/avatar/';
    		}
    		
    		$user['service_tax'] = env('SERVICE_TAX');
    		$user['sales_tax'] = env('SALES_TAX');
            $user['device_token'] = @$request->device_token;
    		
    		if($request->user_type == "chef") {
                $maildata = [
                    'email'     => $request->email,
                    'status'    => 'subscribed',
                    'firstname' => $request->first_name,
                    'lastname'  => $request->last_name,
                    'phone'  => $request->phone_number
                ];
                
                
                $this->syncMailchimp($maildata, "810958076b");
                Mail::to($user->email)->send(new WelcomeMailChef($user));
            } else {
                Mail::to($user->email)->send(new WelcomeMail($user));
            }
            
            Mail::to(env('ADMIN_EMAIL'))->send(new UserSignupAdmin($user));
            $user->sendEmailVerificationNotification();

            if($request->filled('phone_number')) {
                $otp = rand(100000, 999999);
                $smsTxt = "Best Local Chef .\n";
                $smsTxt .= "Your OTP .\n";
                $smsTxt .= $otp;        
                $msg = $this->sendSMS($otp, $smsTxt, $user);
            }
            
    		
    		return response(['user'=>$user, 'access_token'=>$accessToken, 'message'=>'Register successfully', 'code'=>200], 200);

		}
		
		return response(['message'=>'Fields are required', 'code'=>400], 400);
	}
	
	
	public function login(Request $request){
		
		if(isset($request->email) && isset($request->password)){
		    
		    $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		   return response(['message'=>'Invalid email format', 'code'=>400], 400);
    		}
			
    		$loginData = [
    			'email' => $request->email,
    			'password' => $request->password
    		];
    		
    		if(!auth()->attempt($loginData)){
    			return response(['message'=>'Invalid credentials', 'code'=>400], 400);
    		}
    		
    		$checkStatus = User::where('email', $request->email)->first();
    		if(@$checkStatus->status==0){
				return response(['message'=>'Your Account is not active, contact administrator', 'code'=>400], 400);
			}
    		
    		
    		$accessToken = auth()->user()->createToken('authToken')->accessToken;
    		
    		$user = auth()->user();

            if(@$request->device_token) {
                User::where('id', $user->id)
                            ->update([ 'device_token' => $request->device_token ]);
            }

   
			
    		if(@$user->available_dates){
				$datesarray = unserialize($user->available_dates); 
				$available_dates = explode(',', $datesarray['available_dates']);
				/* $available_dates = array_filter($available_dates,function($date){
					return strtotime($date) >= strtotime('today');
				}); */
				
				$user['available_dates'] = array_values(array_filter($available_dates));
			}
			else {
				$user['available_dates'] = [];
			}
			
			$user['menu_count'] = Menu::where('user_id', $user->id)->count();
			
			if($user->certificate_data){
    		$user['certificate_data'] = unserialize($user->certificate_data);
    		}
			
    		if($user->profile_pic){
    		$user['profile_pic'] = asset('uploads/profiles/'.$user->profile_pic);
    		}
    		else {
    		    $user['profile_pic'] = 'https://www.gravatar.com/avatar/';
    		}
    		
    		$user['service_tax'] = env('SERVICE_TAX');
			$user['sales_tax'] = env('SALES_TAX');
            $user['device_token'] = @$request->device_token;
    		
    		return response(['user'=>$user, 'access_token'=>$accessToken, 'message'=>'Login successfully', 'code'=>200], 200);
		}
		
		return response(['message'=>'Email and Password fields are required', 'code'=>400], 400);
	}
	
	
	public function logout(Request $request)
    {
        auth()->user()->token()->revoke();
		return response()->json(["message"=>"Logged out"], 200);
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        if($request->filled('otp')) {

            $user = DB::table('users')->where('remember_token', $request->otp)->first();

            if($user) {   

             	DB::table('users')->where('id', $user->id)
                	->update([ "email_verified_at" => now(), "remember_token" => null]);
         
                         
                return response()->json([
                    "ReturnCode" => 1,
                    "ReturnMessage" => "Verified OTP.",
                    "data" => [
                        "user" => $user->id
                    ]
                ], 200);

            } else {
                return response()->json([                
                    "ReturnCode" => 0,
                    "ReturnMessage" => "Invalid OTP!",
                    "data" => []                
                ], 200);
            } 
        }

        return response()->json([                
            "ReturnCode" => 0,
            "ReturnMessage" => "Enter OTP",
            "data" => []                
        ], 200); 
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetOtp(Request $request)
    {
        if($request->has('phone')) {

            $phone = $request->phone;
            $user = DB::table('users')->where('phone_number', $phone)->first();

            if($user) {

                $otp = rand(100000, 999999);
                $smsTxt = "Best Local Chef .\n";
                $smsTxt .= "Your OTP .\n";
                $smsTxt .= $otp;        
                $msg = $this->sendSMS($otp, $smsTxt, $user);

                return response()->json([                
                    "ReturnCode" => 0,
                    "ReturnMessage" => $msg,
                    "data" => []                
                ], 200);

            } else {
                return response()->json([                
                    "ReturnCode" => 0,
                    "ReturnMessage" => "User not found!",
                    "data" => []                
                ], 200);
            }
            
        }        

        return response()->json([                
            "ReturnCode" => 0,
            "ReturnMessage" => "Please enter email or phone",
            "data" => []                
        ], 200); 

    }

    public function sendSMS($otp, $smsTxt, $user) {

        try {

            $sid = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");                       

            $client = new Client($sid, $token);
            $client->messages->create(
                $user->phone_number,
                array(
                    'from' => '+19797303790',
                    'body' =>  $smsTxt
                )
            );

            DB::table('users')->where('id', $user->id)
                ->update([ "remember_token" => $otp ]);

            return "Message sent successfully!";

        } catch (TwilioException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
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

    
    
    use SendsPasswordResetEmails;

    public function forgot(Request $request) {

        if($request->input('email')) {
            
            $user = User::whereEmail($request->email)->count();
            if($user==0){
                return response(['message'=>'Email not exist!', 'code'=>400], 400);
            }
            $response = $this->sendResetLinkEmail($request); 
           return response(['message'=>'Password reset link sent on your email', 'code'=>200], 200);
        }
        
    }
    
    
    public function verify() {

        auth()->user()->sendEmailVerificationNotification();
        return response(['message'=>'A fresh verification link has been sent to your email address.', 'code'=>200], 200);
    }
    
   
    
    
}
