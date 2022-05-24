<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;
use App\User;
use App\Menu;
use App\Favorite;
use App\Booking;
use App\SavedCards;
use App\Notifications;
use App\ChefReview;
use Stripe\Stripe;

use App\Mail\BookingUser;
use App\Mail\BookingChef;
use App\Mail\BookingAdmin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mainPage()
    {

        $chefs = DB::table('users')
                        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where(['users.featured'=> '1', "users.status" => 1, 'users.user_type' => 'chef'])
                        ->whereNotNull('users.available_dates')
                        ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))
                        ->groupBy('id')
                        ->get();
       
        $randchefs = DB::table('users')
                        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where(["users.status" => 1, 'users.user_type' => 'chef'])
                        ->whereNotNull('users.available_dates')
                        ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))
                        ->groupBy('id')
                        ->inRandomOrder()
                        ->limit(4)
                        ->get(); 

        $topchefs = DB::table('users')
                        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where(["users.status" => 1, 'users.user_type' => 'chef'])
                        ->whereNotNull('users.available_dates')
                        ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))
                        ->groupBy('id')
                        ->orderBy('max_rate','desc') 
                        ->limit(4)
                        ->get();
                        
        return view('main-page')->with([ "chefs" => $chefs, "randchefs" => $randchefs, "topchefs" =>$topchefs]);

    }

    // do login Auth
    public function loginUser(Request $request)
    {
        $email         = $request->email;
        $password      = $request->password;
        $rememberToken = $request->remember;
        // now we use the Auth to Authenticate the users Credentials
        // Attempt Login for members
        if (Auth::guard('member')->attempt(['email' => $email, 'password' => $password], $rememberToken)) {

            $msg = array(
                'status'  => 'success',
                'type'  => Auth::user()->user_type,
                'message' => 'Login Successful'
            );
            return response()->json($msg);

        } else {
            $msg = array(
                'status'  => 'error',
                'message' => 'Login Fail !'
            );
            return response()->json($msg);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function userRegisterPage()
    {
        return view('user.register');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function chefRegisterPage()
    {
        return view('chef.register');
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function termsConditions()
    {
        return view('terms-and-conditions');
    }/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function contactUs()
    {
        return view('contact-us');
    }/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function policies()
    {
        return view('policies');
    }/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function aboutUs()
    {
        return view('about-us');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function searchResult()
    {
        return view('search-result');
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function searchData(Request $request)
    {
        if($request->isMethod('post')) {

            $query = DB::table('users')
                        ->join('menus', 'users.id', '=', 'menus.user_id')
                        ->where('users.user_type', '=', 'chef')
                        ->select('users.id', 'users.user_type', 'users.first_name', 'users.last_name', 'users.status', 'users.profile_pic', 'users.address', 'users.available_dates', 'users.miles_away', 'users.service_area', 'menus.name', 'menus.ingredients', 'menus.description');                       

            $query->where('users.status', '=', 1);
            $query->whereNotNull('available_dates');

            if($request->filled('service_area')) {
                $query->where('users.service_area', 'LIKE', "%{$request->service_area}%");                
            }
      
            if($request->filled('meal_perference')) {
              $qr = str_replace("+", " ", $request->meal_perference);
              $query->where('menus.name', 'LIKE', "%{$qr}%");                
            }
           
            $query->groupBy('id');
            $chefs = $query->get();

            if($request->filled('available_dates')) {              
              
              $edate = explode('/', $request->available_dates);
              $ndate = date($edate[2].'-'.$edate[1].'-'.$edate[0]);
              $new_date = strtolower(date('l', strtotime($ndate)));

              foreach ($chefs as $key => $value) {
                $dts = @unserialize($value->available_dates);
                if($dts) {

                  if(isset($dts["dates"][$new_date]["close"])) {
                    unset($chefs[$key]);
                  }
                  // check for special dates off
                  if(isset($dts["spl_dates"])) {
                    foreach ($dts["spl_dates"] as $val) {
                      if(strtotime($request->available_dates) == $val["date"]) {
                        unset($chefs[$key]);
                      }
                    }                  
                  }

                }
              }
            }
           
            $favs = array();
            if(Auth::check()) {
                $wishlistdata = Favorite::select('chef_id')->where('user_id','=', Auth::user()->id)->get()->toArray();
                foreach($wishlistdata as $array)
                {
                    foreach($array as $val)
                    {
                        array_push($favs, $val);
                    }    
                }               
            }

            return response()->json(['chefs' => $chefs, 'favs' => $favs]);        

        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function contactUsStore(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string'
        ]);
        // info@captainexperiences.com
        // Mail::to(['help@captainexperiences.com'])->send(new ContactEmail($data));

        return redirect('contact-us')->with('status', 'Message Sent successfully!');

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function photoUpload(Request $request)
    {
        if(Auth::user()) {

            $data = $request->image;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name = time().'.png';
            $path = public_path() . "/uploads/profiles/" . $image_name;

            file_put_contents($path, $data);

            User::where(['id' => Auth::user()->id])
                        ->update([
                            'profile_pic' => $image_name
                        ]);

        }

        return response()->json(['success'=>'done']);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function chefDetails($id)
    {
        $id = (int) $id;   

        if(isset($_GET['n'])) {
          Notifications::where(['id' => $_GET['n']])
                  ->update(['is_read' => 1]);
        }  
        $chef = User::find($id);
        $menus = DB::table('menus')
                        ->where('user_id', '=', $id)
                        ->get();     
        
        $reviews = ChefReview::join('users', 'chef_reviews.user_id','=', 'users.id')->where(['chef_id' => $id])
                      ->select('chef_reviews.*', 'users.first_name', 'users.last_name')
                      ->get();        

        $wishlist = 0;
        if(Auth::check()) {
            $wishlistdata = Favorite::select('chef_id')->where(['user_id' => Auth::user()->id, "chef_id" => $id])->first();
            if($wishlistdata) {
                $wishlist = 1;
            }
        }

        $ava_dates = @unserialize($chef->available_dates);
        $offweeksArr = [];
        $off_dates = [];

        $offweeks = "";
        if($ava_dates) {
          if(isset($ava_dates["dates"])) {
            $inx = 0;            
            foreach ($ava_dates["dates"] as $key => $value) {
              if(isset($value['close'])) {
                array_push($offweeksArr, $inx);
              }
              $inx++;
            }            
            $offweeks = implode(',', $offweeksArr);
          }


          if(isset($ava_dates["spl_dates"])) {
            foreach ($ava_dates["spl_dates"] as $key => $value) {
              if(isset($value['close'])) {
                array_push($off_dates, $value['date']);
              }             
            }

          }

        }      

        return view('chef-detail')->with([ "chef" => $chef, "menus" => $menus, "reviews" => $reviews, "wishlist" => $wishlist, "offweeks" => $offweeks, "off_dates" => implode(',', $off_dates) ]);

    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function checkTime(Request $request)
    {

      if($request->has('date') && $request->has('chef_id')) {
        
        $times = [];      
        $date = $request->date;
        $chef = User::find($request->chef_id);
        $ava_dates = @unserialize($chef->available_dates);

        $start = "";
        $end = "";
        
        if($ava_dates) {
          if(isset($ava_dates["dates"])) {
            $week = date('l', strtotime($date));
            foreach ($ava_dates["dates"] as $key => $value) {
              if($key === strtolower($week)) {
                $start = $value["start"];
                $end = $value["end"];
              }             
            }
          }

          if(isset($ava_dates["spl_dates"])) {
            foreach ($ava_dates["spl_dates"] as $key => $value) {
              if($value['date'] == $date) {
                $start = $value["start"];
                $end = $value["end"];
              }             
            }
          }

          $tStart = strtotime($start);
          $tEnd = strtotime($end);
          $tNow = $tStart;
          while($tNow <= $tEnd){
            array_push($times, date("h:i:s A",$tNow));
            $tNow = strtotime('+60 minutes',$tNow);
          }

          
        }

        return response()->json(['times'=> $times]);
      }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function checkoutPage(Request $request)
    {        
        if($request->isMethod('post')) {
            $chef_id = $request->chef_id;
            $guests = $request->guests;
            $booking_date = $request->booking_date; 
            $booking_time = $request->booking_time;             
            $meal = $request->meal; 
            $b_address = $request->b_address; 
            $b_city = $request->b_city; 
            $b_state = $request->b_state; 
            $b_zip = $request->b_zip; 
        } else {
            $chef_id = $request->session()->get('chef_id');
            $guests = $request->session()->get('guests');
            $booking_date = $request->session()->get('booking_date'); 
            $booking_time = $request->session()->get('booking_time'); 
            $meal = $request->session()->get('meal'); 
            $b_address = $request->session()->get('b_address'); 
            $b_city = $request->session()->get('b_city'); 
            $b_state = $request->session()->get('b_state'); 
            $b_zip = $request->session()->get('b_zip'); 
        }

        $profile = new User();
        $card_details = array();

        if (Auth::check()) {
            $profile = User::where(['id' => Auth::user()->id])->first();    
            $card_details = SavedCards::where(['user_id' => Auth::user()->id])->get();
        }

        $request->session()->put('chef_id', $chef_id);
        $request->session()->put('guests', $guests);
        $request->session()->put('booking_date', $booking_date);
        $request->session()->put('booking_time', $booking_time);
        $request->session()->put('meal', $meal);
        $request->session()->put('b_address', $b_address);
        $request->session()->put('b_city', $b_city);
        $request->session()->put('b_state', $b_state);
        $request->session()->put('b_zip', $b_zip);

        $menu = Menu::where(['id' => $meal])->first();
        $chef = User::find($chef_id);

        if(!$menu) {
            return redirect('/');
        }

        $price =  $menu->cost;

        return view('checkout-page')->with([
          'menu' => $menu,
          'chef' => $chef,
          'booking_date' =>  $booking_date,
          'booking_time' =>  $booking_time,
          'guests' =>  $guests,
          'details' =>  $card_details,
          'profile' =>  $profile,
          'b_address' =>  $b_address,
          'b_city' =>  $b_city,
          'b_state' =>  $b_state,
          'b_zip' =>  $b_zip
        ]);
    }


         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function payChef(Request $request)
    {
        
        if(Auth::check()) {
            $user = User::find(Auth::user()->id);
        } else{

            $validatedData = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'phone_number' => ['required'],
            ]);

            $data = $request->all();

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
                'status' => 1,
                'password' => Hash::make($data['password']),
            ]);
        }

        try {
            
            $menu = Menu::where(['id' => $request->menu])->first();
          
            if(!$menu) {
                return redirect('/');
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

            if($user->customer_id) {
                $customer_id = $user->customer_id;
            } else {
                $customer = \Stripe\Customer::create(
                    [
                        'source' => $token['id'],
                        'email' =>  $user->email,
                        'description' => 'My name is '. $user->first_name. '',
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
                        ]);

            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rn = substr(str_shuffle(str_repeat($pool, 5)), 0, 10);
            $transfer_group = 'ORDER-'.$menu->id . '-' . $user->id . '-'.$rn;
            $price = $menu->cost;

            $order = new Booking();
            $order->menu_id = $menu->id;
            $order->user_id = $user->id;
            $order->booking_date = date('Y-m-d', strtotime( $request->booking_date));
            $order->booking_time = $request->booking_time;
            $order->transfer_group = $transfer_group;
            $order->customer = $customer_id;
            $guests = $request->session()->get('guests');
            $location = $request->session()->get('location'); 

            $order->completed = "confirm-pending";
            $order->price = $price * $guests;

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

            $chef = User::find($menu->user_id);

            $noti = new Notifications();
            $noti->to_user = $chef->id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "chef-book", "menu_id" => $menu->id, "booking_date" => $request->booking_date, "booking_time" => $request->booking_time  ,"message" => "You have new booking."));
            $noti->save();

            Mail::to(Auth::user()->email)
                ->send(new BookingUser($menu, $chef));
            
            Mail::to($chef->email)
                ->send(new BookingChef($menu, $user));
        
            Mail::to(env('ADMIN_EMAIL'))
                ->send(new BookingAdmin($menu, $chef));

            return redirect()->route('thank-you',['id' => $order->id]);

        } catch (\Stripe\Error\RateLimit $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        } catch (\Stripe\Error\Authentication $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        } catch (\Stripe\Error\ApiConnection $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        } catch (\Stripe\Error\Base $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        } catch (Exception $e) {
          return redirect('/checkout')->with('status', $e->getMessage());
        }
        
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function paymentMade(Request $request)
    {
        $order = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('bookings.id', $request->id)
            ->first();
      
        return view('thank-you')->with([ "order" => $order]);
    }


    public function autoComplete(Request $request) {

        $query = $request->get('term','');
        $menus = Menu::where([
                        ['name', 'LIKE', '%'.$query.'%'],
                ])
                ->get();
        
        $data = array();
        foreach ($menus as $menu) {
            $data[]=array('value'=>$menu->name,'id'=>$menu->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

    public function autoListZip(Request $request) {

        $query = $request->get('term','');
        $users = User::where([
                        ['service_area', 'LIKE', '%'.$query.'%'],
                ])
                ->get();
        
        $data = array();
        foreach ($users as $user) {
            $data[]=array('value'=>$user->service_area,'id'=>$user->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }



}
