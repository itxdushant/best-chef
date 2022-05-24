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
        $this->middleware('auth');
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
    
        return view('user.favorites')->with([ "favs" => $favs]);   
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
            ->select('menus.name','menus.ingredients','menus.description','menus.cost','bookings.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->get();

        $past_requests = array();
        $upcoming_requests = array();
        $active_requests = array();
        $dec_requests = array();

        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if($booking->completed == "completed") {
                array_push($past_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if( $booking->completed == "confirm-pending" && strtotime($date_now) <= strtotime($dt1) ) {
                array_push($upcoming_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {           
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");        
            if(($booking->completed == "confirmed" || $booking->completed == "full-paid") &&  strtotime($date_now) <= strtotime($dt1) ) {
                array_push($active_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {     
            if($booking->completed == "declined" || $booking->completed == "canceled" ) {
                array_push($dec_requests, $bookings[$key]);
            }
        }

    
        return view('user.requests')->with([ "past_requests" => $past_requests, "upcoming_requests" => $upcoming_requests, "active_requests" => $active_requests, "dec_requests" => $dec_requests]);
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

        $data = array();
        if($booking) {
            $data["completed"] = 'canceled';
            $data["confirm_date"] = date("Y-m-d H:i:s");
            Booking::where(['id' => $booking->id ])
                    ->update($data);

            // $user = User::where(['id' => $booking->user_id ])->first();

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
        $booking = Booking::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if($booking) {         
                
          $price = $booking->price;
          $customer_id = $booking->customer;
          $transfer_group = $booking->transfer_group;
          $error = "";
          try {

              $charge = \Stripe\Charge::create([
                  'currency' => 'USD',
                  'customer' => $customer_id,
                  'amount' =>  $price * 100,
                  "transfer_group" => $transfer_group,
              ]);

              Booking::where(['id' => $id, 'user_id' => Auth::user()->id ])
                  ->update([
                      "balance_transaction" => $charge->balance_transaction,
                      "currency"=>  $charge->currency,
                      "customer"=>  $charge->customer,
                      "status"=>  $charge->status,
                      "price"=>  $booking->price + $price,
                      "transaction_id" => $charge->id,
                      "completed" => "full-paid"
                  ]);
      
              $his = new PaymentHistory();
              $his->user_id = Auth::user()->id;
              $his->payment_data = serialize($charge->__toArray(true));
              $his->booking_id = $booking->id;
              $his->save();

              // $trip = Trip::where(['id' => $booking->trip_id])->first();
              
              // $guide = User::find($trip->guide_id);
              // Mail::to([Auth::user()->email])
              //     ->cc($guide->email)
              //     ->send(new TripFullPayment($trip, $price));

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
    public function addReview($id) 
    {
        $id = (int) $id; 
        if(isset($_GET['n'])) {
            Notifications::where(['id' => $_GET['n']])
                    ->update(['is_read' => 1]);
        }  
        $menu = Menu::where(['id' => $id])->first();
        $chef = User::find($menu->user_id);
        return view('user.add-review')->with([ "chef" => $chef, "id" => $id]);
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
        $data['review'] = $request->input("review", "");

        $review = new ChefReview($data);
        $review->save();

        $noti = new Notifications();
        $noti->to_user = $chef_id;
        $noti->from_user = Auth::user()->id;
        $noti->message = serialize(array("type" => "review", "menu_id" => $menu_id, "rating" => $data['rating'], "message" => "Your new got review."));
        $noti->save();

        // $trip = Trip::where(['id' => $trip_id])->first();
        // $guide = User::find($trip->guide_id);

        // Mail::to($guide->email)->send(new AddReview($trip, $review));

        return redirect('user/add-review/'. $menu_id )->with('status', 'Reivew added successfully!');
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
        }

        return view('user.notifications')->with([ "notifications" => $notifications]);
    }


}
