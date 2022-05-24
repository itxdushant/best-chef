<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Favorite;
use App\Message;
use App\Booking;
use App\PaymentHistory;
use App\Notifications;
use App\ChefReview;
use App\SavedCards;
use App\Menu;
use Mail;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Mail\AddReview;
use App\Mail\BookingCompleted;
use App\Mail\BookingCompletedChef;
use App\Mail\FullPayment;
use App\Mail\FullPaymentUser;
use App\Mail\FullPaymentAdmin;
use App\Mail\BookingCanceledChef;
use App\Mail\BookingCanceledUser;


use Stripe\Stripe;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        Stripe::setApiKey(env('STRIPE_SECRET'));  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        $profile = User::where(['id' => Auth::user()->id])->first();
        $details = SavedCards::where(['user_id' => Auth::user()->id])->get();
       

        return view('user.profile')->with([ "profile" => $profile, "details" => $details]);
    }

    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request)
    {
      if(Auth::user()->email != $request->email) {
          $validatedData = $request->validate([
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          ]);
      }
      
      User::where(['id' => Auth::user()->id])
                  ->update(['first_name' => $request->first_name, 
                      'last_name' => $request->last_name,
                      'phone_number' => $request->phone_number,
                      'email' => $request->email,
                      'address' => $request->address,
                      'city' => $request->city,
                      'state' => $request->state,
                      'zip' => $request->zip
                  ]);

        return redirect('/user/profile')->with('status', 'Profile updated successfully!');       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCard(Request $request)
    {
        $data = $request->all();
        $card = new SavedCards();
        $card->card_name = $data["cardname"];
        $card->user_id = Auth::user()->id;
        $card->card_number = $data["cardNumber"];
        $card->card_month = $data["expityMonth"];
        $card->card_year = $data["expityYear"];
        $card->save();
        return redirect('/user/profile')->with('status', 'Payment Information updated successfully!');

    }

    /**
     * Display a listing of the resource.
     */
    public function deleteCard(Request $request)
    {
        if ($request->isMethod('post')) {
            $pid = $request->input('pid');
            SavedCards::where(['user_id' => Auth::user()->id, 'id' => $pid])->delete();
            return response()->json(['response' => "Card removed."]);
        }
    }
        public function chefProfileView($id)
        {
            $chef=User::find($id);
            $user=Auth::user();
            $favorite_chefs=[];
            $favorites=Favorite::where('user_id',$user->id)->get();
            foreach($favorites as $favorite)
            {
                array_push($favorite_chefs,$favorite->chef_id);
            }
            
            return view('user.chef-profile',compact('chef','user','favorite_chefs'));
        }
    /**
     * update user's password.
     */
    public function changePassword(Request $request) {

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if($request->get('new-password_confirmation') !=  $request->get('new-password')) {
            //Current password and new password are same
            return redirect()->back()->with("error","Confirm Password to be same as your new password.");
        }
        $validatedData = $request->validate([
            'password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("status","Password changed successfully!");
    }

    /**
     * Display a listing of the resource.
     */
    public function addToFav(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $chef_id = $request->input('chef_id');
            $is_already = Favorite::where(['user_id' => Auth::user()->id, 'chef_id' => $chef_id])->exists();
            if($is_already) {
                return response()->json(['response' => "Chef already in your Favorite List.", "status" => false ]);
            }else {
                $data = [];
                $data['user_id'] = Auth::user()->id;
                $data['chef_id'] = $chef_id;
                $fav = new Favorite($data);
                $fav->save();
                return response()->json(['response' => "Chef added in your Favorite List." , "status" => true]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function removeToFav(Request $request)
    {
        if ($request->isMethod('post')) {
            $chef_id = $request->input('chef_id');
            Favorite::where(['user_id' => Auth::user()->id, 'chef_id' => $chef_id])->delete();
            return response()->json(['response' => "Chef removed from your Favorite List."]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getFavs()
    {
        $favs = DB::table('favorites')
            ->join('users', 'favorites.chef_id', '=', 'users.id')
            ->where('favorites.user_id', Auth::user()->id)
            ->get();
    
        return view('user.favorites-new')->with([ "favs" => $favs]);   
    }


    /**
     * Display a listing of the resource.
     */
    public function getMessages()
    {
        
        $users = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'menus.user_id', '=', 'users.id')
            ->where('bookings.user_id', Auth::user()->id)
            ->select('bookings.user_id', 'users.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->groupBy('users.id')
            ->get();
       
        return view('user.messages')->with([ "users" => $users]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadMessages(Request $request)
    {
        if ($request->isMethod('post')) {
            $receiver = $request->input('uid');
            $sender = Auth::user()->id;
          
            $messgaes = Message::where([['sender','=', $sender], ['receiver','=',$receiver]])
                                ->orWhere([['sender','=',$receiver], ['receiver','=',$sender]])
                                ->orderBy('id')
                                ->get();
            return response()->json(['response' => $messgaes]);
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
            $receiver = $request->input('uid');
            $message = $request->input('message');
            $sender = Auth::user()->id;
            $msg = new Message();
            $msg->receiver = $receiver;
            $msg->sender = $sender;
            $msg->message = $message;
            $msg->save();
            
            return response()->json(['response' => 'Message sent']);
        }
    }


    public function readMsg(Request $request) {

        $sta = Message::where(['receiver' => $request->uid ])
                        ->update([
                            "is_read" => '1'
                        ]);
        return response()->json(["status" => $sta]); 
    }


    /**
     * Update the user profile.
     */
    public function getRequests()
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
              $bookings[$key]->price_data = @unserialize($booking->price_data);
              // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
              // $bookings[$key]->sales_tax = env('SALES_TAX');
              // $bookings[$key]->service_tax = env('SERVICE_TAX');
              // if($booking->desserts_id) {
              //   $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
              //   $booking->desserts_cost = $desserts_cost;
              // } else {
              //   $booking->desserts_cost = 0;
              // }
              // if($booking->appetizers_id) {
              //   $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
              //   $bookings[$key]->appetizers_cost = $appetizers_cost;
              // } else {
              //   $bookings[$key]->appetizers_cost = 0;
              // }

              array_push($past_requests, $bookings[$key]);
            }
        }
       

        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if( $booking->completed == "confirm-pending" && strtotime($date_now) <= strtotime($dt1) ) {
              $bookings[$key]->price_data = @unserialize($booking->price_data);
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // $bookings[$key]->sales_tax = env('SALES_TAX');
                // $bookings[$key]->service_tax = env('SERVICE_TAX');
                // if($booking->desserts_id) {
                //   $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //   $booking->desserts_cost = $desserts_cost;
                // } else {
                //   $booking->desserts_cost = 0;
                // }
                // if($booking->appetizers_id) {
                //   $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //   $bookings[$key]->appetizers_cost = $appetizers_cost;
                // } else {
                //   $bookings[$key]->appetizers_cost = 0;
                // }
                array_push($upcoming_requests, $bookings[$key]);
            }
        }
        
        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if(($booking->completed == "confirmed" || $booking->completed == "full-paid") &&  strtotime($date_now) <= strtotime($dt1) ) {
              $bookings[$key]->price_data = @unserialize($booking->price_data);
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // $bookings[$key]->sales_tax = env('SALES_TAX');
                // $bookings[$key]->service_tax = env('SERVICE_TAX');
                // if($booking->desserts_id) {
                //   $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //   $booking->desserts_cost = $desserts_cost;
                // } else {
                //   $booking->desserts_cost = 0;
                // }
                // if($booking->appetizers_id) {
                //   $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //   $bookings[$key]->appetizers_cost = $appetizers_cost;
                // } else {
                //   $bookings[$key]->appetizers_cost = 0;
                // }
                array_push($active_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {     
            if($booking->completed == "declined" || $booking->completed == "canceled" ) {
              $bookings[$key]->price_data = @unserialize($booking->price_data);
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // $bookings[$key]->sales_tax = env('SALES_TAX');
                // $bookings[$key]->service_tax = env('SERVICE_TAX');
                // if($booking->desserts_id) {
                //   $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //   $booking->desserts_cost = $desserts_cost;
                // } else {
                //   $booking->desserts_cost = 0;
                // }
                // if($booking->appetizers_id) {
                //   $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //   $bookings[$key]->appetizers_cost = $appetizers_cost;
                // } else {
                //   $bookings[$key]->appetizers_cost = 0;
                // }
                array_push($dec_requests, $bookings[$key]);
            }
        }

    
        return view('user.requests')->with([ "past_requests" => $past_requests, "upcoming_requests" => $upcoming_requests, "active_requests" => $active_requests, "dec_requests" => $dec_requests]);
    }

    /**
     * Display a listing of the resource.
     */
    public function requestCompleted(Request $request)
    {

        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $data = array();
        if($booking) {

            $data["status"] = 'completed';
            $data["completed"] = 'completed';
            $data["confirm_date"] = date("Y-m-d H:i:s");

            Booking::where(['id' => $booking->id ])
                    ->update($data);

            $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been completed. Please give review"));
            $noti->save();

            $menu = Menu::where(['id' => $booking->menu_id])->first();
            $chef = User::find($menu->user_id);

            Mail::to(Auth::user()->email)
                ->send(new BookingCompleted(Auth::user(), $menu));

            Mail::to($chef->email)
                ->send(new BookingCompletedChef(Auth::user(), $menu, $chef));
                 
            return response()->json(['response' => "Booking is completed!", "status" => true]);    
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
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
            	 $amount = round($booking->price / 2, 2);
            }else if(strtotime($now) > strtotime($hoursAddedthree) && strtotime($combinedDT) > strtotime($now) ){

              // To Deduct Full Amount as booking is cancelled less than 1 hours of schedule
                $amount = $booking->price;

            }else if(strtotime($hoursAddedthree) > strtotime($now)  && strtotime($combinedDT) > strtotime($now)){

            	$amount = round($booking->price / 2, 2);
            } 
                
            return response()->json(['response' => "Booking is canceled!", "amount" => $amount]);           
        } else{
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }

    /**
     * Display a listing of the resource.
     */
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
            $hoursAdded = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($start)));
            $hoursAddedten = date('Y-m-d H:i:s',strtotime('-10 hour',strtotime($combinedDT)));
            $hoursAddedthree = date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($combinedDT)));

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

    /**
     * Display a listing of the resource.
     */
    public function makePayment(Request $request)
    {
        $id = (int) $request->id;
        $tip = ($request->tip)??0;
        $booking = Booking::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        $meal = Menu::where(['id' => $booking->menu_id])->first();
        if($booking) {         
                
          $price = $booking->price;
          $customer_id = $booking->customer;
          $transfer_group = $booking->transfer_group;
          $error = "";

          if(isset($booking->desserts_id) && !empty($booking->desserts_id)) {
            $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
          } else {
            $desserts_cost = 0;
          }
          if(isset($booking->appetizers_id) && !empty($booking->appetizers_id)) {
            $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');              
          } else {
            $appetizers_cost = 0;
          }
          
           if(isset($booking->sides_id) && !empty($booking->sides_id)) {
            $sides_cost = Menu::whereIn('id' , @unserialize($booking->sides_id))->sum('cost');              
          } else {
            $sides_cost = 0;
          }
          $menus_desserts = array();
          $menus_appetizers = array();
          $menus_sides = array();
        if(@unserialize($booking->desserts_id)) $menus_desserts = Menu::whereIn('id', @unserialize($booking->desserts_id))->get();
        if(@unserialize($booking->appetizers_id)) $menus_appetizers = Menu::whereIn('id', @unserialize($booking->appetizers_id))->get();
        if(@unserialize($booking->sides_id))  $menus_sides = Menu::whereIn('id', @unserialize($booking->sides_id))->get();
        $price_data = @unserialize($booking->price_data);
        
        
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
                  ->send(new FullPaymentUser(Auth::user(),$chef, $booking,$tip,$menus_desserts,$menus_appetizers,$menus_sides,$price_data));

              Mail::to([env('ADMIN_EMAIL')])                 
                  ->send(new FullPaymentAdmin(Auth::user(), $chef, $booking,$tip,$menus_desserts,$menus_appetizers,$menus_sides,$price_data));

             $booking->price = round((($meal->cost * $booking->guests) * 90 / 100) + $tip + $appetizers_cost + $desserts_cost + $sides_cost, 2);
             $chef_cost = ($meal->cost * $booking->guests) + ($desserts_cost * $booking->dessert_guests) + ($appetizers_cost * $booking->appetizer_guests) + ($sides_cost * $booking->side_guests);
              Mail::to([$chef->email])
                  ->send(new FullPayment(Auth::user(), $chef, $booking,$chef_cost,$tip,$menus_desserts,$menus_appetizers,$menus_sides,$price_data));
                  
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


    /**
     * Display a listing of the resource.
     */
    public function addReview($id, $bid) 
    {
        $id = (int) $id; 
        if(isset($_GET['n'])) {
            Notifications::where(['id' => $_GET['n']])
                    ->update(['is_read' => 1]);
        }  
        $menu = Menu::where(['id' => $id])->first();
        $chef = User::find($menu->user_id);
        return view('user.add-review')->with([ "chef" => $chef, "id" => $id, "bid" => $bid]);
    }

    /**
     * Display a listing of the resource.
     */
    public function submitReview(Request $request)
    {
        $data = $request->all();

        // $allowed_image_extension = array(
        //     "image/jpeg",
        //     "image/gif",
        //     "image/jpg",
        //     "image/png"
        // );

        // if($request->has('files')) {

        //     $files = $request->file('files');
        //     $path = public_path('uploads/review_photos/');

        //     $photos = array();
        //     foreach ($files as $key => $file) {
        //         $fileType = $file->getMimeType();
        //         $fileName = $file->getClientOriginalName();
        //         $fileExtension = $file->getClientOriginalExtension();
        //         $fileSize = $file->getSize();
        //         if (in_array($fileType, $allowed_image_extension)) {  
        //             $fileName = Auth::user()->id .'-'. str_random(10) . str_replace(' ', '', strtolower($fileName));
        //             array_push($photos, $fileName);
        //             $file->move($path, $fileName);
        //         }
        //     }
        //     $data['photos'] = implode(',', $photos);
        // }

        $chef_id = $request->input("chef_id");
        $menu_id = $request->input("menu_id");

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

        return redirect('user/requests')->with('status', 'Reivew added successfully!');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotification()
    {
        $notifications = Notifications::where(['to_user' => Auth::user()->id, 'is_read' => 0])->get();          
        foreach ($notifications as $key => $notification) {
          $msg = @unserialize($notification->message); 

          if($msg && $msg["type"] == "booking-confirm") {
            Notifications::where(['id' => $notification->id ])
                    ->update(["is_read" => 1]);
          }
          if($msg && $msg["type"] == "booking") {
            $review = ChefReview::where(['bid' => $msg['booking_id']])->first();
            if($review) {
              Notifications::where(['id' => $notification->id ])
                    ->update(["is_read" => 1]);
              unset($notifications[$key]);
            }
          }
        }

        return view('user.notifications')->with([ "notifications" => $notifications]);
    }


}
