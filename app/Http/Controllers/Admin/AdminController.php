<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use DB;
use App\User;
use App\Menu;
use App\Referral;
use App\PaymentRequests;
use App\PaymentDetails;
use App\Booking;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;


use App\Mail\ChefAccept;
use App\Mail\ChefDecline;
use App\Mail\PaymentAccept;
use App\Mail\PaymentAcceptAdmin;

class AdminController extends Controller
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
        return view('admin.index');
    } /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = User::where(['user_type' => "user"])->get();
        return view('admin.users')->with([ "users" => $users]);
    } /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChefs()
    {
        $users = User::where(['user_type' => "chef"])->get();
        return view('admin.chefs')->with([ "users" => $users]);
    }
       /**
     * Display a listing of the resource.
     */
    public function getUser($id)
    {
        $user = User::where(['id' => $id ])->first();
        return view('admin.user')->with([ "user" => $user]);
              
    }
     /**
     * Display a listing of the resource.
     */
    public function getChef($id)
    {
        $user = User::where(['id' => $id ])->first();
        return view('admin.chef')->with([ "user" => $user]);
              
    }

      /**
     * Display a listing of the resource.
     */
    public function setUserStatus(Request $request)
    {
        User::where(['id' => $request->id ])
                    ->update([
                        "admin_approved" => $request->type
                    ]);

        $ty = ($request->type == "1") ? "Enabled" : "Disabled";

        $user = User::where(['id' => $request->id ])->first();
        

        if($request->type == "1") {
            Mail::to($user->email)
                ->send(new ChefAccept());
        } else {
            Mail::to($user->email)
                ->send(new ChefDecline());
        }

        return response()->json(['response' => "User ". $ty]);
        
    }

        /**
     * Display a listing of the resource.
     */
    public function setChefFeatured(Request $request)
    {
        User::where(['id' => $request->id ])
                    ->update([
                        "featured" => $request->type
                    ]);

        $ty = ($request->type == "1") ? "Yes" : "No";

        return response()->json(['response' => "Chef featured ". $ty]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrips()
    {
        $trips = Trip::get();
        return view('admin.trips')->with([ "trips" => $trips]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookings()
    {
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'menus.user_id', '=', 'users.id')
            ->join('users as customer', 'bookings.user_id', '=', 'customer.id')
            ->select('users.first_name','users.last_name', 'menus.name','menus.cost', 'customer.first_name as customer_first_name', 'customer.last_name as customer_last_name', 'menus.user_id as chef_id' ,'bookings.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->get();
  		
        $past_bookings = array();
        $upcoming_bookings = array();

        foreach ($bookings as $key => $book) {             
            $dt1 = date("Y-m-d", strtotime($book->booking_date));
            $date_now = date("Y-m-d");        
            if(strtotime($date_now) > strtotime($dt1)) {
                array_push($past_bookings, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $book) {  
            $dt1 = date("Y-m-d", strtotime($book->booking_date));
            $date_now = date("Y-m-d");        
            if(strtotime($date_now) < strtotime($dt1)) {
                array_push($upcoming_bookings, $bookings[$key]);
            }
        }

        return view('admin.bookings')->with([ "past_bookings" => $past_bookings, "upcoming_bookings" => $upcoming_bookings]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooking($id)
    {
        $id = (int) $id;


        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'menus.user_id', '=', 'users.id')
            ->where('bookings.id', $id)
            ->select('users.first_name','users.last_name', 'menus.name','menus.ingredients','menus.description','menus.calories','menus.prep_time','menus.cost', 'menus.user_id as chef_id' ,'bookings.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->first();
        $menus_desserts = array();
        $menus_appetizers = array();
        $menus_sides = array();
        if(@unserialize($bookings->price_data)) $price_data = @unserialize($bookings->price_data);
         if(@unserialize($bookings->desserts_id)) $menus_desserts = Menu::whereIn('id', @unserialize($bookings->desserts_id))->get();
         if(@unserialize($bookings->appetizers_id)) $menus_appetizers = Menu::whereIn('id', @unserialize($bookings->appetizers_id))->get();
        if(@unserialize($bookings->sides_id))  $menus_sides = Menu::whereIn('id', @unserialize($bookings->sides_id))->get();
        return view('admin.booking')->with([ "booking" => $bookings, "price_data" => $price_data,"menu_desserts" =>$menus_desserts,"menu_appetizers" => $menus_appetizers, "menu_sides" => $menus_sides]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewRequests()
    {
        
        $reqs = DB::table('payment_requests')
            ->join('users', 'payment_requests.chef_id', '=', 'users.id')
            ->where(["payment_requests.status" => 'inprogress'])
            ->select('users.first_name', 'users.last_name','users.email','users.phone_number','payment_requests.*')
            ->orderBy('payment_requests.id', 'desc')
            ->get();

        return view('admin.new-requests')->with([ "reqs" => $reqs]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRequestDetails($id)
    {
        $id = (int) $id;
        $reqs = PaymentRequests::where(['id' => $id])->first();
        $bookings = array();
        if($reqs) {
            $bookings = DB::table('bookings')
                ->join('menus', 'bookings.menu_id', '=', 'menus.id')
                ->where('menus.user_id', $reqs->chef_id)
                ->whereIn('bookings.id', unserialize($reqs->booking_ids))
                ->select('menus.name', 'menus.cost', 'bookings.*')
                ->get();
            foreach($bookings as $key => $booking) {
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
                $bookings[$key]->desserts_cost = $desserts_cost;
                $bookings[$key]->appetizers_cost = $appetizers_cost;
            }
        }

        return view('admin.view-request')->with([ "reqs" => $reqs, "bookings" => $bookings]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOldRequests()
    {
        $reqs = DB::table('payment_requests')
            ->join('users', 'payment_requests.chef_id', '=', 'users.id')
            ->where(["payment_requests.status" => 'completed'])
            ->select('users.first_name', 'users.last_name','users.email','users.phone_number','payment_requests.*')
            ->orderBy('payment_requests.id', 'desc')
            ->get();

        return view('admin.old-requests')->with([ "reqs" => $reqs]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmPayment(Request $request)
    {
        $id = (int) $request->id;
        $pays = PaymentRequests::where(["id" => $id, "status" => "inprogress"])->first();
        if( $pays ) {

            $error = "";
            $pay_details = PaymentDetails::where(['user_id' => $pays->chef_id])->first();
            if($pay_details) {
                            
                $price = $pays->amount;
                $account = $pay_details->account;
                try {

                    $chef = User::find($pays->chef_id);
                    $charge =  \Stripe\Transfer::create([
                      "amount" => round(($price * 100), 2),
                      "currency" => "usd",
                      "destination" => $account,
                    ]);

                    PaymentRequests::where(['id' => $id])
                                    ->update(["status" => 'completed']);

                    Booking::whereIn('id', unserialize( $pays->booking_ids ))
                                    ->update(["payment_request" => 2]);

                    Mail::to($chef->email)->send(new PaymentAccept($chef,$price));
                    Mail::to(env('ADMIN_EMAIL'))->send(new PaymentAcceptAdmin($chef,$price));
                    
                    return response()->json(['response' => "Paid successfully!"]);

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


            } else{
                return response()->json(['response' => "Chef Payment details not found!"]);
            }
        }else{
            return response()->json(['response' => "No Request found!"]);
        }        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCoupons()
    {
        
        $referrals = DB::table('referrals')
                        ->leftJoin('users', 'referrals.chef_id', '=', 'users.id')
                        ->select('referrals.*', 'users.first_name')
                        ->orderBy('referrals.id' , 'desc')
                        ->get();
                        
        return view('admin.coupons')->with([ "referrals" => $referrals]);
    }

     /**
     * Display a listing of the resource.
     */
    public function storeReferral(Request $request)
    {
        $data = $request->all();
        
        $validatedData = $request->validate([
            'promo_code' => 'required|string|unique:referrals',
        ]);
       
        $date1 = date_create($data["expire_date"]);
        $date1 = date_format($date1, "Y-m-d");
        $data["expire_date"] = $date1;
        $referral = new Referral($data);
        $referral->save();        

        return redirect('/admin/coupons')->with('status', 'Coupon generated successfully!');
        
    }
    /**
     * Display a listing of the resource.
     */
    public function setExpire(Request $request)
    {
        
        Referral::where(['id' => $request->id ])
                    ->update([
                        "status" => "expired",
                        "expire_date" => date("Y-m-d"),
                    ]);

        return response()->json(['response' => "Coupon Expired!"]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function setActive(Request $request)
    {
        Referral::where(['id' => $request->id ])
                    ->update([
                        "active" => $request->type
                    ]);
        $ty = ($request->type == "yes") ? "Enabled" : "Disabled";

        return response()->json(['response' => "Coupon ". $ty]);
        
    }

    /**
     * Update the user profile.
     */
    public function deleteUser(Request $request)
    {
        if ($request->isMethod('post')) {
            User::where(['id' =>  $request->id])->delete();
            return response()->json(['response' => "Deleted successfully."]);
        }
    }

        /**
     * Update the user profile.
     */
    public function deleteBooking(Request $request)
    {
        if ($request->isMethod('post')) {
            Booking::where(['id' =>  $request->id])->delete();
            return response()->json(['response' => "Deleted successfully."]);
        }
    }
  

    

    

}
