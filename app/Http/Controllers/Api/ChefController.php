<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\PaymentDetails;
use App\Menu;
use App\Notifications;
use App\Favorite;
use App\ChefReview;
use App\Booking;
use App\SavedCards;
use App\PaymentHistory;
use App\Message;

use DB;
use Intervention\Image\Facades\Image;
use Stripe\Stripe;

use Mail;
use App\Mail\PartnerContact;
use App\Mail\PartnerContactUser;
use App\Mail\ContactUs;
use App\Mail\BookingUser;
use App\Mail\BookingChef;
use App\Mail\BookingAdmin;

use App\Mail\AddReview;
use App\Mail\BookingCompleted;
use App\Mail\BookingCompletedChef;
use App\Mail\FullPayment;
use App\Mail\FullPaymentUser;
use App\Mail\FullPaymentAdmin;
use App\Mail\BookingCanceledChef;
use App\Mail\BookingCanceledUser;

use App\Mail\BookingAcceptUser;
use App\Mail\BookingAcceptChef;
use App\Mail\BookingDeclinedUser;
use App\Mail\PaymentRequestAdmin;
use App\Mail\PaymentRequest;
use Validator;


class ChefController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        Stripe::setApiKey("sk_live_4VQLToGDAmwv2ZSFdMPQ0jTU00OxRNVH4W");
       //Stripe::setApiKey("sk_test_Z083v2mVu3T3xjWz6ZADdlLY00ZaMBejhq");
    }
	
	/**
		* Update the user profile.
	*/
	public function profile()
	{
	    
		$user = auth()->user();
		
		if(!$user->email_verified_at){
		    return response(['user'=>$user, 'message'=>'Email Not Verified', 'code'=>400], 400);
		}
		
		
		if(@$user->available_dates){
			$datesarray = @unserialize($user->available_dates); 
			$available_dates = explode(',', $datesarray['available_dates']);
			/* $available_dates = array_filter($available_dates,function($date){
				return strtotime($date) >= strtotime('today');
			}); */
			
			$user['available_dates'] = array_values(array_filter($available_dates));
		}
		else {
			$user['available_dates'] = [];
		}
		
		if($user->certificate_data){
    		$user['certificate_data'] = unserialize($user->certificate_data);
    	}
		
		if($user->profile_pic){
			$user['profile_pic'] = asset('uploads/profiles/'.$user->profile_pic);
		}
		else {
			$user['profile_pic'] = 'https://www.gravatar.com/avatar/';
		}
		$user['menu_count'] = Menu::where('user_id', $user->id)->count();
		
		$user['service_tax'] = env('SERVICE_TAX');
		$user['sales_tax'] = env('SALES_TAX');
    		
		return response(['user'=>$user, 'message'=>'Data Get', 'code'=>200], 200);
	}
	
	/**
		* Update the user profile.
	*/
	public function updateProfile(Request $request){
		
		$user = auth()->user();

		if($user->email != $request->email) {

			$validator = Validator::make($request->all(), [ 
                'email' => 'required|string|email|max:255|unique:users',
	        ]);

	        if ($validator->fails()) { 
	        	return response(['message'=>$validator->errors()->first(), 'code'=>400], 400);         
	        }
        }
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->college = @$request->college;
		$user->graduate_year = @$request->graduate_year;
		$user->experience = @$request->experience;
		if($request->filled('service_area')) {
			$latlong = $this->get_lat_long($request->service_area);
			$map = explode(',', $latlong);
			$user->service_area = $request->service_area;
			$user->latitude = @$map[0];
			$user->longitude = @$map[1];
		}
		$user->miles_away = @$request->miles_away;
		$user->video_url = @$request->video_url;
		$user->bio = @$request->bio;
		
		$user->address = @$request->address;
		$user->city = @$request->city;
		$user->state = @$request->state;
		$user->zip = @$request->zip;
		
		$user->save();
		
		if(@$user->available_dates){
			$datesarray = @unserialize($user->available_dates); 
			$available_dates = explode(',', $datesarray['available_dates']);
			/* $available_dates = array_filter($available_dates,function($date){
				return strtotime($date) >= strtotime('today');
			}); */
			
			$user['available_dates'] = array_values(array_filter($available_dates));
		}
		else {
			$user['available_dates'] = [];
		}
		
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
		$user['menu_count'] = Menu::where('user_id', $user->id)->count();
		
		return response(['user'=>$user, 'message'=>'Profile updated successfully!', 'code'=>200], 200);
	}
	
	
	/**
		* Update the user profile.
	*/
	public function updateCalendar(Request $request){
		$input = array();
		$input['available_dates'] = implode(',', $request->dates);
		
		$user = auth()->user();
		$user->available_dates = serialize($input);
		$user->save();
		
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
		
		if($user->profile_pic){
			$user['profile_pic'] = asset('uploads/profiles/'.$user->profile_pic);
		}
		else {
			$user['profile_pic'] = 'https://www.gravatar.com/avatar/';
		}
		$user['menu_count'] = Menu::where('user_id', $user->id)->count();
		
		return response(['user'=>$user, 'message'=>'Dates updated successfully!', 'code'=>200], 200);
		
    }
    
    
    /**
		* Update the user image.
	*/
	public function user_image(Request $request){
		$images = '';
		if ($request->avatarSource) {
			$img = $request->avatarSource;
			$data = $img['data'];
			$path = public_path('uploads/profiles/');
			
			$data = base64_decode($data);
			$ext = explode('/', $img['mime']);
			
			$fileName = uniqid() . base64_encode($img['modificationDate']) .'.'. $ext[1];
			$filePath = $path . $fileName;
			file_put_contents($filePath, $data);
			$images = $fileName;
		}
		
		$user = auth()->user();
		if(@$images){
			$user->profile_pic = $images;
		}
		$user->save();
		
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
		
		if($user->profile_pic){
			$user['profile_pic'] = asset('uploads/profiles/'.$user->profile_pic);
		}
		else {
			$user['profile_pic'] = 'https://www.gravatar.com/avatar/';
		}
		$user['service_tax'] = env('SERVICE_TAX');
		$user['sales_tax'] = env('SALES_TAX');
		$user['menu_count'] = Menu::where('user_id', $user->id)->count();
		
		return response(['user'=>$user, 'message'=>'Dates updated successfully!', 'code'=>200], 200);
		
    }
	
	
	/**
		* Update the user password.
	*/
	public function changePassword(Request $request){
		if (!(Hash::check($request->get('password'), auth()->user()->password))) {
            // The passwords matches
			return response(['message'=>'Your current password does not matches with the password you provided. Please try again.', 'code'=>400], 400);
        }
		
		if(strlen($request->get('new_password')) < 7){
		    return response(['message'=>'Password must be more than 8 characters!', 'code'=>400], 400);
		}
		
		if(strcmp($request->get('password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return response(['message'=>'New Password cannot be same as your current password. Please choose a different password.', 'code'=>400], 400);
        }
		
		if($request->get('confirm_password') !=  $request->get('new_password')) {
            //Current password and new password are same
            return response(['message'=>'Confirm Password to be same as your new password.', 'code'=>400], 400);
        }
		
		$user = auth()->user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
		return response(['message'=>'Password changed successfully.', 'code'=>200], 200);
	}
	
	
	/**
		* payment method list.
	*/
	public function payment()
	{
		$bank = PaymentDetails::where('user_id', auth()->user()->id)->get();
		
		$total = 0;
		$bookings = array();
		$payids = array();
		
		$bookings = DB::table('bookings')
						->join('menus', 'bookings.menu_id', '=', 'menus.id')
						->where('menus.user_id', auth()->user()->id)
						->whereIn('bookings.completed', ['completed', 'full-paid'])
						->select('menus.name','menus.ingredients','menus.cost', 'menus.images','bookings.*')
						->orderBy('bookings.id', 'desc')
						->get();
		
		foreach ($bookings as $key => $booking) {

			$booking->chef_share = @round((($booking->cost * $booking->guests) + $booking->desserts_cost + $booking->appetizers_cost) * 90 / 100, 2);
			
			/////////////////////////
			if($booking->appetizers_id) {
				$appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
				$bookings[$key]->appetizers_cost = $appetizers_cost;
			}
			else {
				$bookings[$key]->appetizers_cost = 0;
			}
			/////////////////////////
			if($booking->desserts_id) {
				$desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
				$booking->desserts_cost = $desserts_cost;
			}
			else {
				$booking->desserts_cost = 0;
			}
			
			/////////////////////////
			if($booking->completed == "full-paid" || $booking->completed == "completed"){
				$booking->completed = 'Payment Completed';
				$booking->total_cost = '$'.round((($booking->cost * $booking->guests) + $booking->desserts_cost + $booking->appetizers_cost) * 90 / 100, 2);
				if(!$booking->payment_request) {
					array_push($payids, $booking->id);
					$total = $total + $booking->tip + (round((($booking->cost * $booking->guests) + $booking->desserts_cost + $booking->appetizers_cost) * 90 / 100, 2));
				}
			}
			else {
				$booking->completed = 'Payment Pending';
				$booking->total_cost = 'N/A';
			}
			
			
			
			/////////////////////////
			if($booking->payment_request == 2){
				$booking->payment_request = 'Completed';
			}
			elseif($booking->payment_request == 1){
				$booking->payment_request = 'Requested';
			}
			else {
				$booking->payment_request = 'No';
			}
			/////////////////////////
			if($booking->cost > 0){
				if($booking->guests>0){
					$booking->cost = '$'.($booking->guests * $booking->cost);
				}
				else {
					$booking->cost = '$'.$booking->cost;
				}
			}
			/////////////////////////
			if($booking->desserts_cost > 0){
				$booking->desserts_cost = '$'.$booking->desserts_cost;
			}
			/////////////////////////
			if($booking->appetizers_cost > 0){
				$booking->appetizers_cost = '$'.$booking->appetizers_cost;
			}
			/////////////////////////
			if($booking->tip > 0){
				$booking->tip = '$'.$booking->tip;
			}

			if($booking->images) {
				$arr = @explode(',', $booking->images);
				$img = "";
				foreach ($arr as $value) {
					if($value) {
						$img = $value; break;
					}
				}
				$booking->images = asset('uploads/menu-images') . '/'. $img;
			}


		}
		
		$payids = implode(',', $payids);
		return response(['bank_info'=>$bank, 'payment_booking'=>$bookings, 'total_amount'=>$total, 'payids'=>$payids, 'message'=>'Data Get', 'code'=>200], 200);     

	}
	
	public function savePaymentInfo(Request $request)
    {
        $msg = "";
        $data = $request->all();
        $details = PaymentDetails::where(['user_id' => auth()->user()->id])->first();

        if(@$details) {

            if($details->account_number != $data['account_number']) {

                $validator = Validator::make($request->all(), [ 
		            'account_number' => 'required|string|unique:payment_details'
		        ]);
		        if ($validator->fails()) { 
		        	return response(['message'=>$validator->errors()->first(), 'code'=>400], 400);         
		        }
            }


            try {
                $account = \Stripe\Account::update(
                  $details->account,
                  [
                    'external_account' => [
                        'object' => 'bank_account',
                        'country' => 'US',
                        'currency' => 'usd',
                        'routing_number' => $data['routing_number'],
                        'account_number' => $data['account_number'],
                        'account_holder_name' => auth()->user()->name,
                    ],
                  ]
                );
                $data['account_id'] = $account->external_accounts->data[0]->id;
                $data['account'] = $account->external_accounts->data[0]->account;
                $data['bank_name'] = $account->external_accounts->data[0]->bank_name;
                $data['last4'] = $account->external_accounts->data[0]->last4;
                
                $details = PaymentDetails::find($details->id);
                $details->account_id = $account->external_accounts->data[0]->id;
                $details->account = $account->external_accounts->data[0]->account;
                $details->bank_name = $account->external_accounts->data[0]->bank_name;
                $details->last4 = $account->external_accounts->data[0]->last4;

                $details->save();
				return response(['message'=>'Payment Information updated successfully!', 'code'=>200], 200);

            } catch (\Stripe\Error\RateLimit $e) {
                $msg = $e->getMessage(); 
			} catch (\Stripe\Error\InvalidRequest $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\Authentication $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\ApiConnection $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\Base $e) {
                $msg = $e->getMessage();
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }            
			return response(['message'=>$msg, 'code'=>400], 400);
        } else {

        	$validator = Validator::make($request->all(), [ 
	            'account_number' => 'required|string|unique:payment_details'
	        ]);
	        if ($validator->fails()) { 
	        	return response(['message'=>$validator->errors()->first(), 'code'=>400], 400);         
	        }

            try {

                $account = \Stripe\Account::create([
                    'country' => 'US',
                    'type' => $data['account_type'],
                    'requested_capabilities' => ["transfers"],
                    'external_account'=> [
                        'object' => 'bank_account',
                        'country' => 'US',
                        'currency' => 'usd',
                        'routing_number' => $data['routing_number'],
                        'account_number' => $data['account_number'],
                        'account_holder_name' => auth()->user()->name,
                    ]
                ]);

                $data['user_id'] = auth()->user()->id;
                $data['account_id'] = $account->external_accounts->data[0]->id;
                $data['account'] = $account->external_accounts->data[0]->account;
                $data['bank_name'] = $account->external_accounts->data[0]->bank_name;
                $data['last4'] = $account->external_accounts->data[0]->last4;

                $details = new PaymentDetails($data);
                $details->save();
                return response(['message'=>'Payment Information saved successfully!', 'code'=>200], 200);
            } catch (\Stripe\Error\RateLimit $e) {
                $msg = $e->getMessage();              
            } catch (\Stripe\Error\InvalidRequest $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\Authentication $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\ApiConnection $e) {
                $msg = $e->getMessage();
            } catch (\Stripe\Error\Base $e) {
                $msg = $e->getMessage();
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }
			return response(['message'=>$msg, 'code'=>400], 400);

        }
       
    }
	
	//meals
	public function getMenus()
	{
		$menus = Menu::where('user_id', auth()->user()->id)->get();
		foreach ($menus as $menu) {
			if ($menu->images) {
				$imgs = explode(',', $menu->images);
				$images = array();
				foreach($imgs as $i => $img){
				    if($img){
					    $images[] = asset('uploads/menu-images/'.$img);
				    }
				}
				$menu->images = $images;
			}
		}
		return response(['menus'=>$menus, 'message'=>'Data Get', 'code'=>200], 200); 
	}
	
	
	
	
	//Add meals
	public function saveMenu(Request $request)
	{
		//return $request->all();
		
		$path = public_path('uploads/menu-images/');
		//
		$images = array();
		if(@$request->filePath){
    		foreach ($request->filePath as $key => $file) {
    			$data = $file['data'];
    			//Image::make($path.$fileName);
    			
    			$data = base64_decode($data);
    			$ext = explode('/', $file['mime']);
    			
    			$fileName = uniqid() . base64_encode($file['modificationDate']) .'.'. $ext[1];
    			$filePath = $path . $fileName;
    			file_put_contents($filePath, $data);
    			array_push($images, $fileName);
    		}
		}
		if(@$images){
		$image = implode(',', $images);
		}
		
		$menu = new Menu;
		$menu->category = $request->category;
		$menu->name = $request->name;
		$menu->meal_prefrences = $request->meal_prefrences;
		$menu->ingredients = $request->ingredients;
		$menu->requirements = $request->requirements;
		$menu->description = $request->description;
		$menu->calories = $request->calories;
		$menu->prep_time = $request->prep_time;
		$menu->cost = $request->cost;
		if(@$image){
		$menu->images = $image;
		}
		$menu->user_id = auth()->user()->id;
		
        $menu->save();
		
		return response(['data'=>$menu, 'message'=>'Meal Added Successfully', 'code'=>200], 200);
	}
	
	
	//updateMenu
	public function updateMenu(Request $request, $id)
	{
		$menu = Menu::where('id', $id)->first();
		$path = public_path('uploads/menu-images/');
		//
		$images = array();
		if(@$request->filePath){
    		foreach ($request->filePath as $key => $file) {
    			$data = $file['data'];
    			//Image::make($path.$fileName);
    			
    			$data = base64_decode($data);
    			$ext = explode('/', $file['mime']);
    			
    			$fileName = uniqid() . base64_encode($file['modificationDate']) .'.'. $ext[1];
    			$filePath = $path . $fileName;
    			file_put_contents($filePath, $data);
    			array_push($images, $fileName);
    		}
    	}
		if(@$images){
		$images = implode(',', $images);
		}
		
		$imgPath = asset('uploads/menu-images');
	
		$oldImg = array();
		if($request->storeImages){
		    foreach($request->storeImages as $img){
		        $img = str_replace($imgPath.'/', "", $img);
		        $oldImg[] = $img;
		    }
		}
		$oldImg = implode(',', $oldImg);
		
		$menu->category = $request->category;
		$menu->name = $request->name;
		$menu->meal_prefrences = $request->meal_prefrences;
		$menu->ingredients = $request->ingredients;
		$menu->requirements = $request->requirements;
		$menu->description = $request->description;
		$menu->calories = $request->calories;
		$menu->prep_time = $request->prep_time;
		$menu->cost = $request->cost;
		if(@$images){
		    $menu->images = $oldImg.','.$images;
		}
		else{
		    $menu->images = $oldImg;
		}
		$menu->user_id = auth()->user()->id;
		
        $menu->save();
		
		return response(['data'=>$menu, 'message'=>'Meal Updated Successfully', 'code'=>200], 200);
	}
	
	
	public function getMessageUsers(){
	    
	    if(auth()->user()->user_type=='chef'){
	    $users = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->where('menus.user_id', Auth::user()->id)
            ->select('menus.user_id','bookings.user_id','users.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->groupBy('users.id')
            ->get();
	    }
	    else if(auth()->user()->user_type=='user'){
	    $users = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'menus.user_id', '=', 'users.id')
            ->where('bookings.user_id', Auth::user()->id)
            ->select('bookings.user_id', 'users.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->groupBy('users.id')
            ->get();
	    }
	    
        foreach($users as $k => $valu) {
			if(@$valu->profile_pic){
				$valu->profile_pic = asset('uploads/profiles/'.$valu->profile_pic);
			}
			else {
				$valu->profile_pic = 'https://www.gravatar.com/avatar/';
			}
		}
			
        return response(['users'=>$users, 'message'=>'Data Get', 'code'=>200], 200);    
        
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getNotification()
	{
		$notifications = Notifications::where(['to_user' => auth()->user()->id])->get();
		
		foreach ($notifications as $key => $notification) {
			$notification->message = unserialize($notification->message);
			Notifications::where(['id' => $notification->id ])->update(["is_read" => 1]);
		}
		
		return response(['notifications'=>$notifications, 'message'=>'Data Get', 'code'=>200], 200); 
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function findChef(Request $request)
    {
        if($request->isMethod('post')) {

        	$nearchefs = [];
        	$all_nearchefs = [];

        	if($request->has("lat") && $request->has("lng")) {
        		$lat = $request->lat;
        		$lng = $request->lng;
        		$nearquery = DB::table('users')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where('users.user_type', '=', 'chef');  

	            $nearquery->select(DB::raw("users.*, menus.name, menus.ingredients, menus.description,  111.045 * DEGREES(ACOS(COS(RADIANS(".@$lat.")) * COS(RADIANS(users.latitude))  * COS(RADIANS(users.longitude) - RADIANS(".@$lng."))  + SIN(RADIANS(".@$lat.")) * SIN(RADIANS(users.latitude)))) AS distance"))
	                      ->groupBy('id')
	                      ->having('distance', '<', 30)
	                      ->having('distance', '>=', 0);  

	            $nearquery->where('users.status', '=', 1);
	            $nearquery->where('users.admin_approved', '=', 1);
	            $nearquery->where('menus.status', '=', 0);
	            $nearquery->whereNotNull('available_dates');    
	            if($request->filled('meal_prefrences')) {
	              $qr = str_replace("+", " ", $request->meal_prefrences);
	              $nearquery->where('menus.meal_prefrences', 'LIKE', "%{$qr}%");                
	            }
	           
	            $nearquery->groupBy('id');
	            $nearchefs = $nearquery->get();
	            
	        	$all_nearchefs = $nearchefs;
	            if($request->filled('available_dates')) { 
	            	$filter_date = date('Y-m-d', strtotime($request->available_dates));
		          	foreach ($nearchefs as $key => $value) {
			            $dts = @unserialize($value->available_dates);
			              if($dts && isset($dts['available_dates'])) {
			              	$avai_dates = explode(',', $dts['available_dates']);
			              	if (in_array($filter_date, $avai_dates)) {
			              		array_push($all_nearchefs, $nearchefs[$key]);
			              	}
			            }
		            }
	            }
        	}

        	$ids = [];
        	if(count($all_nearchefs)) {
	            foreach ($all_nearchefs as $key => $value) {
	               array_push($ids, $value->id);
	            }
        	}
    
            $query = DB::table('users')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where('users.user_type', '=', 'chef');                                              
            
            if($request->filled('service_area')) {
                $latlong = $this->get_lat_long($request->service_area);
                if($latlong == 0){
                  return response()->json(['chefs' => array(), 'favs' => array()]);   
                }else{
	                $map = explode(',' , $latlong);
	                $query->select(DB::raw("users.*, menus.name, menus.ingredients, menus.description,  111.045 * DEGREES(ACOS(COS(RADIANS(".@$map[0].")) * COS(RADIANS(users.latitude))  * COS(RADIANS(users.longitude) - RADIANS(".@$map[1]."))  + SIN(RADIANS(".@$map[0].")) * SIN(RADIANS(users.latitude)))) AS distance"))
	                        ->groupBy('id')
	                        ->having('distance', '<', 20)
	                        ->having('distance', '>=', 0);  
              	}
            } else {
              	$query->select('users.id', 'users.user_type', 'users.first_name', 'users.last_name', 'users.status','users.admin_approved', 'users.profile_pic', 'users.address', 'users.available_dates', 'users.miles_away', 'users.service_area', 'menus.name', 'menus.ingredients', 'menus.description'); 
            }

            $query->where('users.status', '=', 1);
            $query->where('users.admin_approved', '=', 1);
            $query->where('menus.status', '=', 0);
            $query->whereNotIn('users.id', $ids);
            $query->whereNotNull('available_dates');      
            if($request->filled('meal_prefrences')) {
              	$qr = str_replace("+", " ", $request->meal_prefrences);
              	$query->where('menus.meal_prefrences', 'LIKE', "%{$qr}%");                
            }
           
            $query->groupBy('id');
            $chefs = $query->get();
			
			foreach($chefs as $k => $valu) {
				if(@$valu->profile_pic){
					$valu->profile_pic = asset('uploads/profiles/'.$valu->profile_pic);
				}
				else {
					$valu->profile_pic = 'https://www.gravatar.com/avatar/';
				}
			}

			$all_chefs = $chefs;			
            if($request->filled('available_dates')) {        
       			$all_chefs = [];
	          	$filter_date = date('Y-m-d', strtotime($request->available_dates));
	          	foreach ($chefs as $key => $value) {
	              	$dts = @unserialize($value->available_dates);
	              	if($dts && isset($dts['available_dates'])) {
	              		$avai_dates = explode(',', $dts['available_dates']);
	              		if (in_array($filter_date, $avai_dates)) {
	              			array_push($all_chefs, $chefs[$key]);
	              		}
	              	}
	            }
	        }
           
            $favs = array();
			$wishlistdata = Favorite::select('chef_id')->where('user_id','=', auth()->user()->id)->get()->toArray();
			foreach($wishlistdata as $array)
			{
				foreach($array as $val) {
					array_push($favs, $val);
				}    
			}
       
			return response(['chefs' => $all_chefs, 'near_by_chefs' => $all_nearchefs, 'favs' => $favs, 'total_chef'=>count($chefs), 'message'=>'Data Get', 'code'=>200], 200);
        }
    }
	
	
	public function get_lat_long($address) {

        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyCbQhq3ry_ZkH73LzIeZP0Y9mVO_kvoasY");
        $json = json_decode($json);
        $lat = "";
        $long = "";
        if(count($json->results)) {
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        }
        return $lat.','.$long;
    }
	
	///chefProfile
	public function chefProfile($id)
    {
        $id = (int) $id;   

        if(isset($_GET['n'])) {
          Notifications::where(['id' => $_GET['n']])
                  ->update(['is_read' => 1]);
        }  
        $chef = User::findOrFail($id);
		if($chef->profile_pic){
			$chef['profile_pic'] = asset('uploads/profiles/'.$chef->profile_pic);
		}
		else {
		    $chef['profile_pic'] = 'https://www.gravatar.com/avatar/';
		}
		
		if($chef->certificate_data){
			$certificate_data = unserialize($chef->certificate_data);
			$certificate_data_count = sizeof($certificate_data['names']);
			
			$cert = array();
			for($i = 0; $i < $certificate_data_count; $i++){			
				$cert[$i]['names'] = $certificate_data['names'][$i];
				$cert[$i]['numbers'] = $certificate_data['numbers'][$i];			
			}
			
			$chef['certificate_data'] = (serialize($cert));
		}
		if(@$chef->available_dates){
			$datesarray = @unserialize($chef->available_dates); 
			$available_dates = explode(',', $datesarray['available_dates']);
			$available_dates = array_filter($available_dates,function($date){
				return strtotime($date) > strtotime('today');
			});
			sort($available_dates);
			$chef['available_dates'] = array_values(array_filter($available_dates));

			$bookings = DB::table('bookings')
	            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
	            ->where('menus.user_id', $id)
	            ->select('bookings.booking_date')
	            ->get()->toArray();

	        if(count($bookings)) {
	        	$bookings_dates = [];
	        	foreach ($bookings as $key => $booking) {
	        		array_push($bookings_dates, $booking->booking_date);
	        	}
	        
	        	$available_dates = array_filter($available_dates,function($date) use ($bookings_dates) {
	        		return !in_array($date, $bookings_dates);
				});

				sort($available_dates);
				$chef['available_dates'] = array_values(array_filter($available_dates));
	        }
		}
		
        $menus_meals = DB::table('menus')
                        ->where(['user_id' => $id, 'status' => 0, 'category' => 'Meal' ])
                        ->get();    
		foreach($menus_meals as $meals){
			if(@$meals->images){
				$imgs = explode(",", $meals->images);
				$meals->image = asset('uploads/menu-images/'.$imgs[0]);
				$images = array();
				foreach($imgs as $i => $img) {
					if($img) {
						array_push($images, asset('uploads/menu-images/'. $img));
					}
				}
				$meals->images = $images;
			}
		}
		
		
		$menus_desserts_list = array();
        $menus_desserts = DB::table('menus')
                        ->where(['user_id' => $id, 'status' => 0, 'category' => 'Dessert' ])
                        ->get();
		foreach($menus_desserts as $j => $dessert){
		    $menus_desserts_list[$j]['label'] = $dessert->name.' ($'.$dessert->cost.')';
		    $menus_desserts_list[$j]['value'] = $dessert->id;
		    
			if(@$dessert->images){
				$imgs = explode(",",$dessert->images);
				$dessert->image = asset('uploads/menu-images/'.$imgs[0]);
				
				$dimages = array();
				foreach($imgs as $i => $img){
					if($img) {
						array_push($dimages, asset('uploads/menu-images/'.$img));
					}
				}
				$dessert->images = $dimages;
			}
		}
		
        $menus_appetizers_list = array();
        $menus_appetizers = DB::table('menus')
                        ->where(['user_id' => $id, 'status' => 0, 'category' => 'Appetizer' ])
                        ->get(); 
		foreach($menus_appetizers as $j => $appetizer){
		    $menus_appetizers_list[$j]['label'] = $appetizer->name.' ($'.$appetizer->cost.')';
		    $menus_appetizers_list[$j]['value'] = $appetizer->id;
			if(@$appetizer->images){
				$imgs = explode(",",$appetizer->images);
				$appetizer->image = asset('uploads/menu-images/'.$imgs[0]);
				
				$aimages = array();
				foreach($imgs as $i => $img){
					if($img) {
						array_push($aimages, asset('uploads/menu-images/'. $img));
					}
				}
				$appetizer->images = $aimages;
			}
		}
		
        
        $reviews = ChefReview::join('users', 'chef_reviews.user_id','=', 'users.id')->where(['chef_id' => $id])
                      ->select('chef_reviews.*', 'users.first_name', 'users.last_name')
                      ->get();        

        $wishlist = 0;
		$wishlistdata = Favorite::select('chef_id')->where(['user_id' => auth()->user()->id, "chef_id" => $id])->first();
		if($wishlistdata) {
			$wishlist = 1;
		}

        if($chef->certificate_data && $chef->certificate_data != null) {
            $chef->certificate_data = unserialize($chef->certificate_data);
        }
        $ava_dates = @unserialize($chef->available_dates);
        $calendar_dates = isset($ava_dates["available_dates"]) ? explode(',', $ava_dates["available_dates"]) : '';

        $offweeksArr = [];
        $offweekstimeArr = [];
        $off_dates = [];
        $off_datestime = [];
        $on_dates = [];
        $on_datestime = [];

        $offweeks = "";
        $offweekstime = "";
        if($ava_dates) {
          if(isset($calendar_dates)) {
            $inx = 0;            
            foreach ($calendar_dates as $key => $value) {
              if(isset($value['close'])) {
                array_push($offweeksArr, $inx);
                array_push($offweekstimeArr, $value);
              }
              $inx++;
            }            
            $offweeks = implode(',', $offweeksArr);
            $offweekstime = serialize($offweekstimeArr);
          }


          if(isset($ava_dates["spl_dates"])) {
            foreach ($ava_dates["spl_dates"] as $key => $value) {
              if(isset($value['close'])) 
              {
                array_push($off_dates, $value['date']);
                array_push($off_datestime, $value);
              }  
              else{
                array_push($on_dates, $value['date']);
                array_push($on_datestime, $value);
              }
            }

          }

        }
        
        $favorite = Favorite::where('user_id', auth()->user()->id)->where('chef_id', $chef->id)->count();

		return response([
			"user" => $chef, 
			"chef" => $chef,
			"favorite" => $favorite,
			"menus_meals" => $menus_meals, 
			"menus_desserts" => $menus_desserts, 
			"menus_appetizers" => $menus_appetizers, 
			"reviews" => $reviews, 
			"wishlist" => $wishlist, 
			"offweeks" => $offweeks,
			"offweekstime" => $offweekstime, 
			"off_dates" => implode(',', $off_dates), 
			"off_datestime" => serialize($off_datestime), 
			"on_dates" => implode(',', $on_dates), 
			"on_datestime" => serialize($on_datestime),
			"menus_desserts_list" => $menus_desserts_list,
			"menus_appetizers_list" => $menus_appetizers_list,
			"code"=>200
		], 200);
    }
	
	
	
	public function getRequests()
    {
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('menus.user_id', Auth::user()->id)
            ->select('menus.name','menus.ingredients','menus.description','menus.cost','bookings.*')
            ->orderBy('bookings.id', 'desc')
            ->get();

        $past_requests = array();
        $upcoming_requests = array();
        $active_requests = array();
        $dec_requests = array();

        foreach ($bookings as $key => $booking) {
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if($booking->completed == "completed") {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                $location = str_replace("+", ", ", $booking->location);				
				$bookings[$key]->location = wordwrap($location,40,"\n");
				
				if($booking->desserts_id) {
                    $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                    $booking->desserts_cost = $desserts_cost;
                  } else {
                    $booking->desserts_cost = 0;
                  }
                  if($booking->appetizers_id) {
                    $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                    $bookings[$key]->appetizers_cost = $appetizers_cost;
                  } else {
                    $bookings[$key]->appetizers_cost = 0;
                  }
                array_push($past_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");
            if( $booking->completed == "confirm-pending" && strtotime($date_now) <= strtotime($dt1) ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                
				$location = str_replace("+", ", ", $booking->location);				
				$bookings[$key]->location = wordwrap($location,40,"\n");
				if($booking->desserts_id) {
                $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                $booking->desserts_cost = $desserts_cost;
              } else {
                $booking->desserts_cost = 0;
              }
              if($booking->appetizers_id) {
                $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                $bookings[$key]->appetizers_cost = $appetizers_cost;
              } else {
                $bookings[$key]->appetizers_cost = 0;
              }
                array_push($upcoming_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if(($booking->completed == "confirmed" || $booking->completed == "full-paid") && strtotime($date_now) <= strtotime($dt1) ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                
				$location = str_replace("+", ", ", $booking->location);				
				$bookings[$key]->location = wordwrap($location,40,"\n");
				if($booking->desserts_id) {
                    $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                    $booking->desserts_cost = $desserts_cost;
                  } else {
                    $booking->desserts_cost = 0;
                  }
                  if($booking->appetizers_id) {
                    $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                    $bookings[$key]->appetizers_cost = $appetizers_cost;
                  } else {
                    $bookings[$key]->appetizers_cost = 0;
                  }
                array_push($active_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {     
            if($booking->completed == "declined" ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                
				$location = str_replace("+", ", ", $booking->location);				
				$bookings[$key]->location = wordwrap($location,40,"\n");
				if($booking->desserts_id) {
                    $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                    $booking->desserts_cost = $desserts_cost;
                  } else {
                    $booking->desserts_cost = 0;
                  }
                  if($booking->appetizers_id) {
                    $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                    $bookings[$key]->appetizers_cost = $appetizers_cost;
                  } else {
                    $bookings[$key]->appetizers_cost = 0;
                  }
                array_push($dec_requests, $bookings[$key]);
            }
        }
    
        return response([
			"past_requests" => $past_requests, 
			"upcoming_requests" => $upcoming_requests, 
			"active_requests" => $active_requests, 
			"dec_requests" => $dec_requests,
			"status"=>true,
			"code"=>200
		], 200);
		
    }
    
    
    public function favorite(){
        $favs = DB::table('favorites')
            ->join('users', 'favorites.chef_id', '=', 'users.id')
            ->where('favorites.user_id', auth()->user()->id)
            ->where('users.status', '1')
            ->where('users.admin_approved', '1')
            ->get();
            
        foreach($favs as $k => $fav) {
			if(@$fav->profile_pic){
				$fav->profile_pic = asset('uploads/profiles/'.$fav->profile_pic);
			}
			else {
				$fav->profile_pic = 'https://www.gravatar.com/avatar/';
			}
		}
			
        return response([
            'data'=>$favs,
            'message'=>'Data get.',
			"code"=>200
		], 200);
    }
    
    public function favoriteAdd(Request $request){
        $chef_id = $request->chef_id;
        $is_already = Favorite::where('user_id', auth()->user()->id)->where('chef_id', $chef_id)->first();
        
        if(@$is_already){
            Favorite::where('user_id', auth()->user()->id)->where('chef_id', $chef_id)->delete();
            return response([
                'message'=>'Chef removed from your Favorite List.',
    			"code"=>200
    		], 200);
        }
        else {
            $fav = new Favorite;
            $fav->user_id = auth()->user()->id;
            $fav->chef_id = $chef_id;
            $fav->save();
            return response([
                'message'=>'Chef added in your Favorite List.',
    			"code"=>200
    		], 200);
        }
    }
    
    
    public function payChef(Request $request)
    {
        $data = $request->all();

        // @file_put_contents( auth()->user()->id.'-'.time().'-filename.txt', print_r($data, true));

        try {
            
            $menu = Menu::where(['id' => $request->menu])->first();
            if(isset($data['dessert_ids']) && !empty($data['dessert_ids'])) {
              $desserts_cost = Menu::whereIn('id' , ($data['dessert_ids']))->sum('cost');
            } else {
              $desserts_cost = 0;
            }
            if(isset($data['appetizer_ids']) && !empty($data['appetizer_ids'])) {
              $appetizers_cost = Menu::whereIn('id' , ($data['appetizer_ids']))->sum('cost');              
            } else {
              $appetizers_cost = 0;
            }
            
            $customer_id = 0;
    
            $token = \Stripe\Token::create([
                "card" => array(
                    'name' => $request->get('cardname'),
                    "number" => $request->get('cardNumber'),
                    "exp_month" => $request->get('expityMonth'),
                    "exp_year" => $request->get('expityYear'),
                    "cvc" => $request->get('cvCode')
                ),
            ]);

            if(auth()->check()) {

              $user = User::find(auth()->user()->id);

            } else {

                $user = User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'phone_number' => $data['phone_number'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zip' => $data['zip'],
                    'user_type' => 'user',
                    'email' => $data['email'],
                    'email_verified_at' => date("Y-m-d h:i:s"),
                    'status' => 1,
                    'password' => Hash::make($data['password']),
                ]);
            }

            if($user->customer_id) {
                $customer_id = $user->customer_id;
                $stripe_cust_id =  \Stripe\Customer::retrieve($customer_id);

            } 
            if(isset($stripe_cust_id) && ($stripe_cust_id->id != '' ||  $stripe_cust_id['id'] = '')) {
              
            }else{  
                $customer = \Stripe\Customer::create(
                    [
                        'source' => $token['id'],
                        'email' =>  auth()->user()->email,
                        'description' => 'My name is '. $data["first_name"]. '',
                    ]
                );
                $customer_id = $customer['id'];
            }


            User::where(['id' => $user->id ])
                        ->update([
                            "customer_id" => $customer_id,
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'email_verified_at' => date("Y-m-d h:i:s"),
                        ]);

            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rn = substr(str_shuffle(str_repeat($pool, 5)), 0, 10);
            $transfer_group = 'ORDER-'.$menu->id . '-' . $user->id . '-'.$rn;
            $price = $menu->cost;

            $order = new Booking();
            $order->menu_id = $menu->id;
            $order->desserts_id = isset($data['dessert_ids']) ? serialize($data['dessert_ids']) : '';
            $order->appetizers_id = isset($data['appetizer_ids']) ? serialize($data['appetizer_ids']) : '';
            $order->user_id = $user->id;
            $order->booking_date = date('Y-m-d', strtotime( $request->booking_date));
            $order->booking_time = $request->booking_time;
            $order->transfer_group = $transfer_group;
            $order->customer = $customer_id;
            $guests = $request->guests;
            //$location = $request->session()->get('location'); 

            $order->completed = "confirm-pending";
            $order->notes = $request->notes;

            $meal_cost = $menu->cost * $guests;
            $sales_tax = round(((($meal_cost + $appetizers_cost + $desserts_cost) * env('SALES_TAX')) / 100), 2); 
            $service_tax = number_format((float) (($meal_cost + $appetizers_cost + $desserts_cost) * env('SERVICE_TAX') / 100) , 2, '.', '');
            $order->price = round(($meal_cost + $appetizers_cost + $desserts_cost + $service_tax + $sales_tax), 2);

            $location = $request->input("b_address", "") ."+". $request->input("b_city", "") ."+". $request->input("b_state", "") ."+". $request->input("b_zip" ,"");
            
            $order->guests = $guests;
            $order->location = $location;
            $order->save();

            if ($request->has('save_card')) {    
                $card = new SavedCards();
                $card->user_id = $user->id;
                $card->card_name = $request->get('cardname');
                $card->card_number = $request->get('cardNumber');
                $card->card_month = $request->get('expityMonth');
                $card->card_year = $request->get('expityYear');
                $card->save();
            }

            //$request->session()->forget('booking_date');

            $chef = User::find($menu->user_id);

            // send push notification
            if($chef && $chef->device_token) {
            	$this->sendPush($chef->device_token, "You have new booking." , "chef_book");
            }


            $noti = new Notifications();
            $noti->to_user = $chef->id;
            if(Auth::check()) {
              $noti->from_user = Auth::user()->id;
            } else {
              $noti->from_user = $user->id;
            }
            $noti->message = serialize(array("type" => "chef-book", "menu_id" => $menu->id, "booking_date" => $request->booking_date, "booking_time" => $request->booking_time  ,"message" => "You have new booking."));
            $noti->save();

            if(Auth::check()) {
              $user_email = Auth::user()->email;
            } else {
              $user_email = $user->email;
            }
            Mail::to($user_email)
                ->send(new BookingUser($user, $chef, $order));
            
            Mail::to($chef->email)
                ->send(new BookingChef($menu, $user, $chef, $order));
        
            Mail::to(env('ADMIN_EMAIL'))
                ->send(new BookingAdmin($menu, $chef, $order));

			return response(['message'=>'Chef Hired Successfully', 'data'=>$order->id, 'code'=>200], 200);
			
        } catch (\Stripe\Error\RateLimit $e) {
          $msg = $e->getMessage(); 
        } catch (\Stripe\Error\InvalidRequest $e) {
          $msg = $e->getMessage(); 
        } catch (\Stripe\Error\Authentication $e) {
          $msg = $e->getMessage(); 
        } catch (\Stripe\Error\ApiConnection $e) {
          $msg = $e->getMessage(); 
        } catch (\Stripe\Error\Base $e) {
          $msg = $e->getMessage(); 
        } catch (Exception $e) {
          $msg = $e->getMessage(); 
        }
        return response(['message'=>$msg, 'code'=>400], 400);
    }
    
    public function thankYou(Request $request){
        //$request->session()->forget('booking_date');
        $order = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('bookings.id', $request->id)
            ->first();
        $order->price_tot = $order->cost * $order->guests;
        
        if(isset($order->desserts_id) && $order->desserts_id != null){
          $menus_desserts = Menu::whereIn('id', @unserialize($order->desserts_id))->get();
        }else{
          $menus_desserts = array();
        }

        if(isset($order->appetizers_id) && $order->appetizers_id != null){
          $menus_appetizers = Menu::whereIn('id', @unserialize($order->appetizers_id))->get();
        }else{
          $menus_appetizers = array();
        }
        
        $menu = Menu::where('id', $order->menu_id)->first();
        
        return response(['message'=>'Data Get', "order" => $order, "appetizers" => $menus_appetizers, "desserts" => $menus_desserts, 'menu' => $menu, 'code'=>200], 200);
        
    }
    
    
    /**
     * Update the user profile.
     */
    public function getUserRequests()
    {
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('bookings.user_id', Auth::user()->id)
            ->select('menus.name','menus.ingredients','menus.description','menus.cost','menus.id as mid','bookings.*')
            ->orderBy('bookings.booking_date', 'desc')
            ->get();

        $past_requests = array();
        $upcoming_requests = array();
        $active_requests = array();
        $dec_requests = array();
        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if($booking->completed == "completed") {
              $review = DB::table('chef_reviews')->where("bid", "=", $bookings[$key]->id)->first();
              $rate = ($review) ? $review->rating : 0;
              $bookings[$key]->rating = $rate;
              $bookings[$key]->price = round($booking->cost * $booking->guests, 2);

              if($booking->desserts_id) {
                $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                $booking->desserts_cost = $desserts_cost;
              } else {
                $booking->desserts_cost = 0;
              }
              if($booking->appetizers_id) {
                $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                $bookings[$key]->appetizers_cost = $appetizers_cost;
              } else {
                $bookings[$key]->appetizers_cost = 0;
              }
                $bookings[$key]->location = str_replace("+", ", ", $booking->location);
                
              array_push($past_requests, $bookings[$key]);
            }
        }
       

        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if( $booking->completed == "confirm-pending" && strtotime($date_now) <= strtotime($dt1) ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                //$bookings[$key]->sales_tax = env('SALES_TAX');
                //$bookings[$key]->service_tax = env('SERVICE_TAX');
                
                if($booking->desserts_id) {
                  $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                  $booking->desserts_cost = $desserts_cost;
                } else {
                  $booking->desserts_cost = 0;
                }
                if($booking->appetizers_id) {
                  $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                  $bookings[$key]->appetizers_cost = $appetizers_cost;
                } else {
                  $bookings[$key]->appetizers_cost = 0;
                }
                
                $service_tax = round((($booking->price + $booking->desserts_cost + $booking->appetizers_cost) * env('SERVICE_TAX')) / 100, 2); 
            
                $sales_tax = round((($booking->price + $booking->desserts_cost + $booking->appetizers_cost) * env('SALES_TAX')) / 100, 2);
                
                $total_cost = round(($booking->price + $booking->desserts_cost + $booking->appetizers_cost + $service_tax + $sales_tax),2);
                
                $bookings[$key]->sales_tax = $sales_tax;
                $bookings[$key]->service_tax = $service_tax;
                $bookings[$key]->total_cost = $total_cost;
                
                
                $start = $booking->created_at;
                $scheduledate = $booking->booking_date;
                $scheduletime = $booking->booking_time;
                $combinedDT = date('Y-m-d H:i:s', strtotime("$scheduledate $scheduletime")); 
                $now = date('Y-m-d H:i:s');
                
                $hoursAdded = date('Y-m-d H:i:s',strtotime('+3 hour',strtotime($start)));
                     
                $bookings[$key]->now = strtotime($now);        
                $bookings[$key]->combinedDT = strtotime($combinedDT);        
                $bookings[$key]->location = str_replace("+", ", ", $booking->location);
                
                array_push($upcoming_requests, $bookings[$key]);
            }
        }
        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if(($booking->completed == "confirmed" || $booking->completed == "full-paid") &&  strtotime($date_now) <= strtotime($dt1) ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);

                if($booking->desserts_id) {
                  $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                  $booking->desserts_cost = $desserts_cost;
                } else {
                  $booking->desserts_cost = 0;
                }
                if($booking->appetizers_id) {
                  $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                  $bookings[$key]->appetizers_cost = $appetizers_cost;
                } else {
                  $bookings[$key]->appetizers_cost = 0;
                }
                
                $bookings[$key]->location = str_replace("+", ", ", $booking->location);
                
                
                array_push($active_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {     
            if($booking->completed == "declined" || $booking->completed == "canceled" ) {
                $bookings[$key]->price = round($booking->cost * $booking->guests, 2);

                if($booking->desserts_id) {
                  $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                  $booking->desserts_cost = $desserts_cost;
                } else {
                  $booking->desserts_cost = 0;
                }
                if($booking->appetizers_id) {
                  $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                  $bookings[$key]->appetizers_cost = $appetizers_cost;
                } else {
                  $bookings[$key]->appetizers_cost = 0;
                }
                
                $bookings[$key]->location = str_replace("+", ", ", $booking->location);
                array_push($dec_requests, $bookings[$key]);
            }
        }




        return response([
			"past_requests" => $past_requests, 
			"upcoming_requests" => $upcoming_requests, 
			"active_requests" => $active_requests, 
			"dec_requests" => $dec_requests,
			"code"=>200
		], 200);
    }
    
    
    public function checkCancelBooking(Request $request) {
    	$id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        if($booking) {

        	  $start = $booking->created_at;
            $scheduledate = $booking->booking_date;
            $scheduletime = $booking->booking_time;
            $combinedDT = date('Y-m-d H:i:s', strtotime("$scheduledate $scheduletime")); 
            $now   = date('Y-m-d H:i:s');
            $hoursAdded = date('Y-m-d H:i:s',strtotime('+3 hour',strtotime($start)));
            $hoursAddedten = date('Y-m-d H:i:s',strtotime('-10 hour',strtotime($combinedDT)));
            $hoursAddedthree = date('Y-m-d H:i:s',strtotime('-3 hour',strtotime($combinedDT)));

            $amount = 0;

            if(strtotime($hoursAdded) > strtotime($now)) {
             // echo "In ONe";
            	$amount = 0;
            }else if(strtotime($now) > strtotime($hoursAddedthree) && strtotime($combinedDT) > strtotime($now) ){

              // To Deduct Full Amount as booking is cancelled less than 3 hours of schedule
                $amount = $booking->price;

            }else if(strtotime($hoursAddedthree) > strtotime($now)  && strtotime($combinedDT) > strtotime($now)){

            	$amount = round($booking->price / 2, 2);
            } 
                
            return response()->json(['response' => "Booking is canceled!", "amount" => $amount, 'id'=>$id]);           
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }
    
    public function cancelBooking(Request $request)
    {
        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $chef = DB::table('bookings')
            ->select('users.*')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'menus.user_id')
            ->where('bookings.id', $id)
            ->first();
        $data = array();
        if($booking) {

            $start = $booking->created_at;
            $scheduledate = $booking->booking_date;
            $scheduletime = $booking->booking_time;
            $combinedDT = date('Y-m-d H:i:s', strtotime("$scheduledate $scheduletime")); 
            $now   = date('Y-m-d H:i:s');
            $hoursAdded = date('Y-m-d H:i:s',strtotime('+3 hour',strtotime($start)));
            $hoursAddedten = date('Y-m-d H:i:s',strtotime('-10 hour',strtotime($combinedDT)));
            $hoursAddedthree = date('Y-m-d H:i:s',strtotime('-3 hour',strtotime($combinedDT)));

            $amounttobecharged = ($booking->price) * 100;

            if(strtotime($hoursAdded) > strtotime($now)) {
             // echo "In ONe";
            }else if(strtotime($now) > strtotime($hoursAddedthree) && strtotime($combinedDT) > strtotime($now) ){

              // To Deduct Full Amount as booking is cancelled less than 3 hours of schedule
                try {
                    $charge = \Stripe\Charge::create([
                        'currency' => 'USD',
                        'customer' => $booking->customer,
                        'amount' =>  $amounttobecharged,
                        "transfer_group" => $booking->transfer_group,
                    ]);
                 } catch (\Stripe\Error\RateLimit $e) {
                    $error = $e->getMessage();                  
                } catch (\Stripe\Error\InvalidRequest $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\Authentication $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\ApiConnection $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\Base $e) {
                    $error = $e->getMessage();
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }

            }else if(strtotime($hoursAddedthree) > strtotime($now) && strtotime($combinedDT) > strtotime($now)){
              // To Deduct Half Amount as booking is cancelled  3 to 10 hours before the schedule time

               try {
                    $charge = \Stripe\Charge::create([
                        'currency' => 'USD',
                        'customer' => $booking->customer,
                        'amount' =>  $amounttobecharged / 2,
                        "transfer_group" => $booking->transfer_group,
                    ]);
                 } catch (\Stripe\Error\RateLimit $e) {
                    $error = $e->getMessage();                  
                } catch (\Stripe\Error\InvalidRequest $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\Authentication $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\ApiConnection $e) {
                    $error = $e->getMessage();
                } catch (\Stripe\Error\Base $e) {
                    $error = $e->getMessage();
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }else{
              //echo "Else";
            } 
 
            $data["completed"] = 'canceled';
            $data["confirm_date"] = date("Y-m-d H:i:s");
            Booking::where(['id' => $booking->id ])->update($data);

            // $user = User::where(['id' => $booking->user_id ])->first();
            //find chef data
            $chef = DB::table('bookings')
            ->select('users.*')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'menus.user_id')
            ->where('bookings.id', $id)
            ->first();

            //send mail to chef
            Mail::to($chef->email)
                ->send(new BookingCanceledChef(Auth::user(), $chef, $booking));

            // send push notification
			if($chef && $chef->device_token) {
				$this->sendPush($chef->device_token, "Your booking is canceled." , "book_cancel");
			}


            //send mail to user
            Mail::to(Auth::user()->email)
                ->send(new BookingCanceledUser(Auth::user(), $chef, $booking));
            // Mail::to(Auth::user()->email)
            //     ->send(new BookingAcceptChef($user));

            // Mail::to($user->email)
            //     ->send(new BookingAcceptUser($user));
                
            return response()->json(['response' => "Booking is canceled!", "status" => true]);           
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }
    
    
    
    public function requestDecline(Request $request)
    {

        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $data = array();
        if($booking) {

            $data["status"] = 'declined';
            $data["completed"] = 'declined';
            $data["confirm_date"] = date("Y-m-d H:i:s");

             $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking-confirm", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been declined."));
            $noti->save();


            Booking::where(['id' => $booking->id ])
                    ->update($data);

            $user = User::where(['id' => $booking->user_id ])->first();

            // send push notification
			if($user && $user->device_token) {
				$this->sendPush($user->device_token, "Your booking is declined by " . Auth::user()->first_name , "book_dec");
			}


            
            Mail::to($user->email)
                ->send(new BookingDeclinedUser($user));
            
            return response()->json(['response' => "Booking is declined!", "status" => true]);      
            
           
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }
    
    public function requestConfirm(Request $request)
    {
        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $data = array();
        if($booking) {
            $data["completed"] = 'confirmed';
            $data["confirm_date"] = date("Y-m-d H:i:s");
            Booking::where(['id' => $booking->id ])
                    ->update($data);

            $user = User::where(['id' => $booking->user_id ])->first();

            $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking-confirm", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been confirmed."));
            $noti->save();

            Mail::to(Auth::user()->email)
                ->send(new BookingAcceptChef(Auth::user()));

            // send push notification
			if($user && $user->device_token) {
				$this->sendPush($user->device_token, "Your booking is accepted by." . @Auth::user()->first_name , "book_accept");
			}


            Mail::to($user->email)
                ->send(new BookingAcceptUser($user));
                
            return response()->json(['response' => "Booking is confirmed!", "status" => true]);           
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }
    
    
    public function makePayment(Request $request)
    {
        $id = (int) $request->id;
        $tip = $request->tip;
        $booking = Booking::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        $meal = Menu::where(['id' => $booking->menu_id])->first();
        if($booking) {         
                
          $price = $booking->price;
          $customer_id = $booking->customer;
          $transfer_group = $booking->transfer_group;
          $error = "";

          if(isset($booking->dessert_ids) && !empty($booking->dessert_ids)) {
            $desserts_cost = Menu::whereIn('id' , @unserialize($booking->dessert_ids))->sum('cost');
          } else {
            $desserts_cost = 0;
          }
          if(isset($booking->appetizer_ids) && !empty($booking->appetizer_ids)) {
            $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizer_ids))->sum('cost');              
          } else {
            $appetizers_cost = 0;
          }
          
            if(isset($booking->side_ids) && !empty($booking->side_ids)) {
            $sides_cost = Menu::whereIn('id' , @unserialize($booking->side_ids))->sum('cost');              
          } else {
            $sides_cost = 0;
          }


          try {

              $charge = \Stripe\Charge::create([
                  'currency' => 'USD',
                  'customer' => $customer_id,
                  'amount' =>  ($price + $tip ) * 100,
                  "transfer_group" => $transfer_group,
              ]);

              Booking::where(['id' => $id, 'user_id' => Auth::user()->id ])
                  ->update([
                      "balance_transaction" => $charge->balance_transaction,
                      "currency"=>  $charge->currency,
                      "customer"=>  $charge->customer,
                      "status"=>  $charge->status,
                      "price"=>  $booking->price,
                      "transaction_id" => $charge->id,
                      "completed" => "completed",
                      "tip" => $tip
                  ]);
      
              $his = new PaymentHistory();
              $his->user_id = Auth::user()->id;
              $his->payment_data = serialize($charge->__toArray(true));
              $his->booking_id = $booking->id;
              $his->save();

              $menu = Menu::where(['id' => $booking->menu_id])->first();
              $chef = User::find($menu->user_id);
              
              Mail::to([Auth::user()->email])                 
                  ->send(new FullPaymentUser(Auth::user(), $chef, $booking));

              Mail::to([env('ADMIN_EMAIL')])                 
                  ->send(new FullPaymentAdmin(Auth::user(), $chef, $booking));

              $booking->price = round((($meal->cost * $booking->guests) * 90 / 100) + $tip + $appetizers_cost + $desserts_cost, 2);
              
              $chef_cost = $meal->cost * $booking->guests + $desserts_cost + $appetizers_cost + $sides_cost;              
              Mail::to([$chef->email])
                  ->send(new FullPayment(Auth::user(), $chef, $booking,$chef_cost,$tip));
              // send push notification
				if($chef && $chef->device_token) {
					$this->sendPush($chef->device_token, "You got paid $" . @$booking->price , "chef_paid");
				}


              $noti = new Notifications();
              $noti->to_user = $chef->id;
              $noti->from_user = Auth::user()->id;
              $noti->message = serialize(array("type" => "payment", "menu_id" => $booking->menu_id, "message" => "User has paid for you."));
              $noti->save();

              return response()->json(['response' => "Thanks for full payment!"]);

          } catch (\Stripe\Error\RateLimit $e) {
              $error = $e->getMessage();                  
          } catch (\Stripe\Error\InvalidRequest $e) {
              $error = $e->getMessage();
          } catch (\Stripe\Error\Authentication $e) {
              $error = $e->getMessage();
          } catch (\Stripe\Error\ApiConnection $e) {
              $error = $e->getMessage();
          } catch (\Stripe\Error\Base $e) {
              $error = $e->getMessage();
          } catch (Exception $e) {
              $error = $e->getMessage();
          }
          return response()->json(['response' => $error]);           

        }else{
            return response()->json(['response' => "Booking not found!"]);
        }
    }
	
	
	public function submitReview(Request $request)
    {
        $data = $request->all();
        
        $menu_id = $request->input("menu_id");
        $menu = Menu::where(['id' => $menu_id])->first();
        $chef = User::find($menu->user_id);

        $chef_id = $chef->id;
        

        $data['user_id'] = Auth::user()->id;
        $data['chef_id'] = $chef_id;
        $data['rating'] = $request->input("rating", 0);
        $data['bid'] = $request->input("bid", 0);
        $data['review'] = $request->input("review", "");

        $review = new ChefReview($data);
        $review->save();

        $noti = new Notifications();
        $noti->to_user = $chef_id;
        $noti->from_user = Auth::user()->id;
        $noti->message = serialize(array("type" => "review", "menu_id" => $menu_id, "rating" => $data['rating'], "message" => "You’ve got a new review!"));
        $noti->save();

        $menu = Menu::where(['id' => $menu_id])->first();
        $chef = User::find($chef_id);

        Mail::to($chef->email)->send(new AddReview($menu, $review, $chef));
        
        return response()->json(['response' => "Reivew added successfully!"], 200);
    }
    
    
    public function certificate(Request $request){
        
        $user = auth()->user();
        $message = 'Data Get';
        if($request->action=='edit'){
            $message = 'Certificate updated successfully';
        }
        if($request->action=='delete'){
            $message = 'Certificate deleted successfully';
        }
        if($request->action=='add'){
            $message = 'Certificate added successfully';
        }
		
		
		if(($request->action=='edit' || $request->action=='delete') && $user->certificate_data){
        	$profile = unserialize($user->certificate_data);
        	
        	$certificate_data_count = count($profile['names']);
        	
        	$cert = array();
        	$name = array();
        	$numbers = array();
        	
            for($i = 0; $i < $certificate_data_count; $i++){
                if($i==$request->editId){
                    if($request->action=='edit'){
                        array_push($name, $request->name);
                        array_push($numbers, $request->number);
                    }
                }
                else {
                    array_push($name, $profile['names'][$i]);
                    array_push($numbers, $profile['numbers'][$i]);
                }
            }
            
            $cert['names'] = $name;
            $cert['numbers'] = $numbers;
        	
        	$user->certificate_data = serialize($cert);
            $user->save();
        }
        
        if($request->action=='add'){
            $cert = array();
        	$name = array();
        	$numbers = array();
        	
            if($user->certificate_data){
                $profile = unserialize($user->certificate_data);
                $name = $profile['names'];
                $numbers = $profile['numbers'];
            }
            
            array_push($name, $request->name);
            array_push($numbers, $request->number);
            
            $cert['names'] = $name;
            $cert['numbers'] = $numbers;
            $user->certificate_data = serialize($cert);
            $user->save();
            
        }
        
        
        $user = auth()->user();
		if(@$user->available_dates){
			$datesarray = @unserialize($user->available_dates); 
			$available_dates = explode(',', $datesarray['available_dates']);
			/* $available_dates = array_filter($available_dates,function($date){
				return strtotime($date) >= strtotime('today');
			}); */
			
			$user['available_dates'] = array_values(array_filter($available_dates));
		}
		else {
			$user['available_dates'] = [];
		}
		
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
    		
		return response(['user'=>$user, 'message'=>$message, 'code'=>200], 200);
        
    }
    
    
     public function deleteMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            Menu::where(['user_id' => Auth::user()->id, 'id' =>  $request->menu_id])->delete();
            return response(['message'=>'Meal Removed', 'code'=>200], 200);
        }
    }

    /**
     * Update the user profile.
     */
    public function statusMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            $status = ($request->type == "disable") ? 1 : 0;
            Menu::where(['user_id' => Auth::user()->id, 'id' => $request->menu_id])
                    ->update([
                            'status' => $status
                        ]);
            
            return response(['message'=>"Meal ". $request->type."d", 'code'=>200], 200);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {

        if ($request->isMethod('post') && isset(Auth::user()->id) ) {
            
            $receiver = $request->input('user_id');
            $message = $request->input('message');
            $sender = Auth::user()->id;
            $msg = new Message();
            $msg->receiver = $receiver;
            $msg->sender = $sender;
            $msg->message = $message;
            $msg->save();

            $user = User::find($request->input('user_id'));
            // send push notification
			if($user && $user->device_token) {
				$this->sendPush($user->device_token, $message, "send_msg");
			}

            
            return response()->json(['response' => 'Message sent']);
        }
    }


    public function testt() {
    	$this->sendPush("dGZdZ7yQRa-pAYsByXnVFv:APA91bGgqvsxS0weLhVp7BL_fzxQVOVteQwiduv4auJhPNLczeh94kkCZJyAh9lV_Iaie3dTkTR6G8jFZIFvafnJPyRYXiJdrzOJSAti0S2WOPD5dqJL52m5krBX0TDQKjve-Tl5d6Eh", "You have new booking." , "chef_book");
    }

    public function sendPush($deviceToken, $message, $type) {


        try { 

            $API_ACCESS_KEY = 'AAAAd6MMXbM:APA91bFwbQw0mzanN1t0TQ1YMl0Df2abNb_UnIKTcS5KOkcZFoyPcRhwvOjr-gmRJUkmG3Y5TXKgvIIQSVSUNosw9yxAkASkDv9pgr6IpvlI1ltnYbHKWww5GNVg3NN33C51CUOLmBrB';
            $registrationIds = $deviceToken;
            #prep the bundle
            $msg = array(
                'body'  => $message,
                'title' => 'BestLocalChef',
                'icon'  => 'myicon',
                'sound' => 'mySound'
            );

            $fields = array(
                'to' => $registrationIds,
                'notification' => $msg,
                'data' => ["type" => $type]
            );

            $headers = array(
                'Authorization: key='.$API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            #Send Reponse To FireBase Server  
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result_log = curl_exec($ch );
            curl_close( $ch );


        }
        //catch exception
        catch(Exception $e) {
            return null;
        }
        
    }
    
}



















