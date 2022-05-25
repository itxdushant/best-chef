<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use Mail;

use App\User;

use App\Menu;

use App\Favorite;

use App\Booking;

use App\SavedCards;

use App\Notifications;

use App\ChefReview;

use Stripe\Stripe;

use App\Mail\PartnerContact;

use App\Mail\PartnerContactUser;

use App\Mail\ContactUs;

use App\Mail\BookingUser;

use App\Mail\BookingChef;

use App\Mail\BookingAdmin;
use App\Mail\SendMessageToChef;
use App\Mail\Support;




class HomeController extends Controller

{

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function __construct()

  {
    // $this->middleware(['auth','verified']);
    Stripe::setApiKey(env('STRIPE_SECRET'));
  }

  public function VerifiyEmail()
  {
    return view('auth.verify');
  }


  /**

   * Show the application dashboard.

   *

   * @return \Illuminate\Contracts\Support\Renderable

   */

  public function index()

  {
    $chefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(['users.featured' => '1', "users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->get();



    $randchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->inRandomOrder()

      ->limit(4)

      ->get();



    $topchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->orderBy('max_rate', 'desc')

      ->limit(4)

      ->get();



    return view('how-it-works-new')->with(["chefs" => $chefs, "randchefs" => $randchefs, "topchefs" => $topchefs]);
    // return view('home');

  }
  public function chefList()
  {

   


    $randchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*,Count(chef_id) as reviews, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->inRandomOrder()

      ->limit(4)

      ->get();

    //  dd($randchefs);


    $topchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')
       
      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*,Count(chef_id) as reviews, ROUND(AVG(rating),1) as max_rate'))

      // ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->orderBy('max_rate', 'desc')

      ->limit(4)

      ->get();


    $user = Auth::user();
    $favorite_chefs = [];
    $favorites = Favorite::where('user_id', Auth::user()->id)->get();
    foreach ($favorites as $favorite) {
      array_push($favorite_chefs, $favorite->chef_id);
    }

    return view('chef-list')->with(["user" => $user, "randchefs" => $randchefs, "topchefs" => $topchefs, 'favorite_chefs' => $favorite_chefs]);
    // return view('home');
  }
  public function topChefsList($type)
  {
    //  return ($type);

    $favorite_chefs = [];
    $favorites = Favorite::where('user_id', Auth::user()->id)->get();
    foreach ($favorites as $favorite) {
      array_push($favorite_chefs, $favorite->chef_id);
    }

    if ($type == 'top-chefs') {

      $topchefs = DB::table('users')

        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

        ->join('menus', 'users.id', '=', 'menus.user_id')

        ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

        ->whereNotNull('users.available_dates')

        ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

        ->groupBy('id')

        ->orderBy('max_rate', 'desc')

        ->limit(4)

        ->get();

      return view('chef-list-all')->with(["user" => Auth::user(), "chefs" => $topchefs, "favorite_chefs" => $favorite_chefs]);
    }

    if ($type == 'rand-chefs') {
      $randchefs = DB::table('users')

        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

        ->join('menus', 'users.id', '=', 'menus.user_id')

        ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

        ->whereNotNull('users.available_dates')

        ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

        ->groupBy('id')

        ->inRandomOrder()

        ->limit(4)

        ->get();

      return view('chef-list-all')->with(["user" => Auth::user(), "chefs" => $randchefs, "favorite_chefs" => $favorite_chefs]);
    }
  }


  public function howtoforum()

  {

    return view('how-to-forum');
  }

  public function test()

  {

    echo '<pre>';



    dd(env('MAIL_FROM_NAME'));

    die();
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

      ->where(['users.featured' => '1', "users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->get();



    $randchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->inRandomOrder()

      ->limit(4)

      ->get();



    $topchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->orderBy('max_rate', 'desc')

      ->limit(4)

      ->get();



    return view('main-page')->with(["chefs" => $chefs, "randchefs" => $randchefs, "topchefs" => $topchefs]);
  }





  public function howitworks()

  {

    $chefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(['users.featured' => '1', "users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->get();



    $randchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->inRandomOrder()

      ->limit(4)

      ->get();



    $topchefs = DB::table('users')

      ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id')

      ->join('menus', 'users.id', '=', 'menus.user_id')

      ->where(["users.status" => 1, "users.admin_approved" => 1, 'users.user_type' => 'chef'])

      ->whereNotNull('users.available_dates')

      ->select(DB::raw('users.*, ROUND(AVG(rating),1) as max_rate'))

      ->groupBy('id')

      ->orderBy('max_rate', 'desc')

      ->limit(4)

      ->get();

    $user = Auth::user();

    return view('how-it-works-new')->with(["chefs" => $chefs, 'user' => $user, "randchefs" => $randchefs, "topchefs" => $topchefs]);

    // return view('coming-soon');



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

    if (Auth::check()) {

      return redirect('/');
    }

    return view('user.register');
  }

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function chefRegisterPage()

  {

    if (Auth::check()) {

      return redirect('/');
    }

    return view('chef.register');
  }





  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function termsConditions()

  {

    return view('terms-of-use');
  }
  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function contactUs()

  {

    return view('contact-us');
  }
  public function support()

  {

    return view('support');
  }

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function partner()

  {

    return view('partner');
  }



  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function policies()

  {

    return view('privacy-policy');
  }
  /**

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

    $user = Auth::user();

    return view('find-a-chef', compact('user'));
  }



  /**

   * Create a new controller instance.

   *

   * @return void

   */


  function getLnt($zip){
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&key=AIzaSyAQKT-baFr1GJfDvhCjhN2HLMxmyNbTcys";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    if(isset($result['results'][0]['geometry']['location']) ){
      return $result['results'][0]['geometry']['location'];
    }else{
      return [];
    }
  }

  public function searchData(Request $request)
  {
    $user = auth()->user();
    $location = $this->getLnt($user->service_area);
    
    if ($request->isMethod('post')) {

      $nearbyusers = array();

      // $user_zip = isset($_COOKIE['bczip']) ? $_COOKIE['bczip'] : '';

      // $user_zip_google = '';

      // $latLng = json_decode($user_zip, true);


      $nearchefs = [];



      // Near by chefs



      if (isset($location['lat']) && !empty($location['lat'])) {

        $nearquery = DB::table('users')

          ->join('menus', 'users.id', '=', 'menus.user_id')

          ->where('users.user_type', '=', 'chef');



        $nearquery->select(DB::raw("users.*, menus.name,menus.meal_prefrences, menus.ingredients, menus.description,  111.045 * DEGREES(ACOS(COS(RADIANS(" . @$location['lat'] . ")) * COS(RADIANS(users.latitude))  * COS(RADIANS(users.longitude) - RADIANS(" . @$location['lng'] . "))  + SIN(RADIANS(" . @$location['lat'] . ")) * SIN(RADIANS(users.latitude)))) AS distance"))

          ->groupBy('id')

          ->having('distance', '<', 30)

          ->having('distance', '>=', 0);

        $nearquery->where('users.status', '=', 1);

        $nearquery->where('users.admin_approved', '=', 1);

        $nearquery->where('menus.status', '=', 0);

        $nearquery->whereNotNull('available_dates');

        if ($request->filled('meal_prefrences')) {
          $qr = str_replace("+", " ", $request->meal_prefrences);
          $nearquery->where('menus.meal_prefrences', 'LIKE', "%{$qr}%");
        }



        $nearquery->groupBy('id');

       



        if ($request->filled('available_dates')) {

          $filter_date = date('Y-m-d', strtotime($request->available_dates));

          foreach ($nearchefs as $key => $value) {

            $dts = @unserialize($value->available_dates);

            if ($dts && isset($dts['available_dates'])) {

              $avai_dates = explode(',', $dts['available_dates']);

              if (!in_array($filter_date, $avai_dates)) {

                unset($nearchefs[$key]);
              }
            }
          }
        }
        if ($request->filled('service_area') ){
          $nearquery->where('users.service_area', $request->service_area);
        }
        $nearchefs = $nearquery->get();
      }



      $ids = [];

      // if ($request->filled('service_area') && !$request->filled('available_dates') && !$request->filled('meal_prefrences') && !$request->filled('meal_prefrences')) {
      //   $nearchefs = User::where([['service_area', $request->service_area], ['status', 1], ['admin_approved', 1]])->get();
      // }


      if (!empty($nearchefs)) {
        foreach ($nearchefs as $key => $value) {

          array_push($ids, $value->id);
        }
      }
      // All chefs
      $query = DB::table('users')

        ->join('menus', 'users.id', '=', 'menus.user_id')
        ->leftJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id');
        
      //->where('users.user_type', '=', 'chef');

      if ($request->filled('service_area')) {



        $latlong = $this->get_lat_long($request->service_area);

        if ($latlong == 0) {
          die(":FDfd");
          return response()->json(['chefs' => array(), 'favs' => array()]);
        } else {



          $map = explode(',', $latlong);

          $query->select(DB::raw("users.*, menus.name, menus.ingredients, menus.description,  111.045 * DEGREES(ACOS(COS(RADIANS(" . @$map[0] . ")) * COS(RADIANS(users.latitude))  * COS(RADIANS(users.longitude) - RADIANS(" . @$map[1] . "))  + SIN(RADIANS(" . @$map[0] . ")) * SIN(RADIANS(users.latitude)))) AS distance"))

            ->groupBy('id')

            ->having('distance', '<', 20)

            ->having('distance', '>=', 0);
        }
      } else {
        //DB::statement('SELECT count(chef_reviews.id) as chef_reviews, users.id FROM users LEFT JOIN chef_reviews ON users.id = chef_reviews.chef_id WHERE users.id != ""  GROUP BY users.id ');

        $query->select('users.id', 'users.user_type', 'users.first_name', 'users.last_name', 'users.status', 'users.admin_approved', 'users.profile_pic', 'users.address', 'users.available_dates', 'users.miles_away', 'users.service_area', 'users.city', 'users.state', 'menus.name', 'menus.ingredients', 'menus.description', 'menus.meal_prefrences', 'menus.cost');
        $query->selectRaw('count(chef_reviews.id) as chef_reviews');
      }

      $query->where('users.status', '=', 1);
      $query->where('users.id', '!=', '');

      $query->where('users.admin_approved', '=', 1);

      $query->where('menus.status', '=', 0);

      $query->whereNotIn('users.id', $ids);
      


      $query->whereNotNull('available_dates');

      if ($request->filled('meal_prefrences')) {
        $query->whereRaw('find_in_set("'.$request->meal_prefrences.'", users.meal_speciality)');
      }




      //       SELECT  users.id, count(chef_reviews.id) as chef_reviews
      // FROM users
      // LEFT JOIN chef_reviews
      // ON users.id = chef_reviews.chef_id 
      // WHERE users.id != ''
      // GROUP BY users.id


      $query->groupBy('users.id');
      $chefs = $query->get();

      $userIDs = [];
      // echo "<pre>";
      // print_r($chefs2);die;


      // if ($request->filled('available_dates')) {



      $filter_date = date('Y-m-d', strtotime($request->available_dates));
      
      foreach ($chefs as $key => $value) {
        $userIDs[] = $value->id;
        if ($request->filled('available_dates')) {
          $dts = @unserialize($value->available_dates);
          if ($dts && isset($dts['available_dates'])) {

            $avai_dates = explode(',', $dts['available_dates']);
            
            if (!in_array($filter_date, $avai_dates)) {
              unset($chefs[$key]);
            }
          }else{
            if (!in_array($filter_date, $dts)) {
              unset($chefs[$key]);
            }
          }
        }
        // }
      }

      $query2 = DB::table('users')
        //->leftJoin('menus', 'users.id', '=', 'menus.user_id')
        ->rightJoin('chef_reviews', 'users.id', '=', 'chef_reviews.chef_id');
      $query2->selectRaw('count(chef_reviews.id) as chef_reviews, users.id');
      $query2->selectRaw('ROUND( AVG(rating),1 ) as rating');
      //AVG(rating) as AVGRATE
      $query2->whereIn('users.id', $userIDs);
      $query2->groupBy('users.id');
      $chefs2 = $query2->get();

    
      

      $favs = array();

      if (Auth::check()) {

        $wishlistdata = Favorite::select('chef_id')->where('user_id', '=', Auth::user()->id)->get()->toArray();

        foreach ($wishlistdata as $array) {

          foreach ($array as $val) {

            array_push($favs, $val);
          }
        }
      }
      // if($request->type=="home") {

      //   return view('find-a-chef',compact('chefs'))->render();
      // }
      $pinLocations = [];
      if(!empty($nearchefs) ){
        // echo "<pre>";
        // print_r($nearchefs);die;
        $i = 1;
        foreach($nearchefs as $val){
          $address = '';
          if($val->address ){
            $address = $val->address;
          }

         $pinLocations[] = [$address, $val->latitude, $val->longitude, $i];
         $i++;
        }
      }


      return response()->json(['chefs' => $chefs, 'chefs_near' => $nearchefs, 'favs' => $favs, 'chefs2' => $chefs2, 'pinLocations' => $pinLocations]);
    }
  }



  public function get_lat_long($address)
  {



    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyCbQhq3ry_ZkH73LzIeZP0Y9mVO_kvoasY");

    $json = json_decode($json);

    if (isset($json->results) && !empty($json->results)) {

      $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};

      $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

      return $lat . ',' . $long;
    } else {

      return 0;
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



    $banned = array("Whore", "Hoe", "Slut", "Bitch", "Retarded", "Prostitut", "Wetback", "Nigga", "Nigger", "Niger", "Nigg", "Blackface", "Coon", "Fuk", "Fuck", "Democrat", "Republican", "Pussy", "Dick", "Vagina", "Penis", "Lesbian", "Gay", "Sex", "Gender", "Dumb", "Stupid");



    $validatedData = $request->validate([

      'first_name' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],
      'last_name' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

      'reason' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

      'email' => 'required|string',

      'message' => ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

    ]);

    // info@captainexperiences.com

    // Mail::to(['help@captainexperiences.com'])->send(new ContactEmail($data));		

    //Mail::send('emails.partnerEmail', $data, function($message) use($data) {

    //$message->to('info@bestlocalchef.com');

    //$message->subject('Contact Us');

    //});

    $sent = Mail::to('info@bestlocalchef.com')->send(new ContactUs($data));

    return redirect('contact-us')->with('status', 'Message Sent successfully.');
  }
  public function supportStore(Request $request)

  {

    $data = $request->all();



    $banned = array("Whore", "Hoe", "Slut", "Bitch", "Retarded", "Prostitut", "Wetback", "Nigga", "Nigger", "Niger", "Nigg", "Blackface", "Coon", "Fuk", "Fuck", "Democrat", "Republican", "Pussy", "Dick", "Vagina", "Penis", "Lesbian", "Gay", "Sex", "Gender", "Dumb", "Stupid");



    $validatedData = $request->validate([

      'first_name' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],
      'last_name' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

      'reason' =>  ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

      'email' => 'required|string',

      'message' => ['required', 'string', 'not_regex:/(' . implode("|", $banned) . ')/i'],

    ]);

    // info@captainexperiences.com

    // Mail::to(['help@captainexperiences.com'])->send(new ContactEmail($data));		

    //Mail::send('emails.partnerEmail', $data, function($message) use($data) {

    //$message->to('info@bestlocalchef.com');

    //$message->subject('Contact Us');

    //});

    $sent = Mail::to('info@bestlocalchef.com')->send(new Support($data));

    return redirect('support')->with('status', 'Message Sent successfully.');
  }



  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function partnercontactUsStore(Request $request)

  {



    $data = $request->all();



    $validatedData = $request->validate([

      'f_name' => 'required|string',

      'l_name' => 'required|string',

      'email' => 'required|string',

      'phone' => 'required|string'

    ]);



    $maildata = [

      'email'     => $data['email'],

      'status'    => 'subscribed',

      'firstname' => $data['f_name'],

      'lastname'  => $data['l_name'],

      'phone'  => $data['phone']

    ];



    $this->syncMailchimp($maildata, "810958076b");





    Mail::to('info@bestlocalchef.com')->send(new PartnerContact($data));

    Mail::to($data['email'])->send(new PartnerContactUser($data));



    return redirect('partner')->with('status', 'Message Sent successfully.');
  }



  public function syncMailchimp($data, $list_id)
  {



    $apiKey = '91f97911728daa1de8a8011718966db9-us4';

    $listId =  $list_id;



    $memberId = md5(strtolower($data['email']));

    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);

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



  /**

   * Show the application dashboard.

   *

   * @return \Illuminate\Http\Response

   */

  public function photoUpload(Request $request)

  {

    if (Auth::user()) {

      $data = $request->image;


      list($type, $data) = explode(';', $data);

      list(, $data)      = explode(',', $data);



      $data = base64_decode($data);

      $image_name = time() . '.png';

      $path = public_path() . "/uploads/profiles/" . $image_name;



      file_put_contents($path, $data);



      User::where(['id' => Auth::user()->id])

        ->update([

          'profile_pic' => $image_name

        ]);
    }



    return response()->json(['success' => 'done']);
  }





  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function chefDetails($id)

  {

    $id = (int) $id;



    if (isset($_GET['n'])) {

      Notifications::where(['id' => $_GET['n']])

        ->update(['is_read' => 1]);
    }

    $chef = User::findOrFail($id);



    $menus_meals = DB::table('menus')

      ->where(['user_id' => $id, 'status' => 0, 'category' => 'Entree'])

      ->get();



    $menus_sides = DB::table('menus')

      ->where(['user_id' => $id, 'status' => 0, 'category' => 'Sides'])

      ->get();



    $menus_desserts = DB::table('menus')

      ->where(['user_id' => $id, 'status' => 0, 'category' => 'Dessert'])

      ->get();



    $menus_appetizers = DB::table('menus')

      ->where(['user_id' => $id, 'status' => 0, 'category' => 'Appetizer'])

      ->get();



    $reviews = ChefReview::join('users', 'chef_reviews.user_id', '=', 'users.id')->where(['chef_id' => $id])

      ->select('chef_reviews.*', 'users.first_name', 'users.last_name', 'users.profile_pic')

      ->get();



    $wishlist = 0;

    if (Auth::check()) {

      $wishlistdata = Favorite::select('chef_id')->where(['user_id' => Auth::user()->id, "chef_id" => $id])->first();

      if ($wishlistdata) {

        $wishlist = 1;
      }
    }



    if ($chef->certificate_data && $chef->certificate_data != null) {

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

    if ($ava_dates) {

      if (isset($calendar_dates)) {

        $inx = 0;

        foreach (array($calendar_dates) as $key => $value) {

          if (isset($value['close'])) {

            array_push($offweeksArr, $inx);

            array_push($offweekstimeArr, $value);
          }

          $inx++;
        }

        $offweeks = implode(',', $offweeksArr);

        $offweekstime = serialize($offweekstimeArr);
      }





      if (isset($ava_dates["spl_dates"])) {

        foreach ($ava_dates["spl_dates"] as $key => $value) {

          if (isset($value['close'])) {

            array_push($off_dates, $value['date']);

            array_push($off_datestime, $value);
          } else {

            array_push($on_dates, $value['date']);

            array_push($on_datestime, $value);
          }
        }
      }
    }

    return view('chef-detail')->with(["user" => Auth::user(), "chef" => $chef, "menus_meals" => $menus_meals, "menus_sides" => $menus_sides, "menus_desserts" => $menus_desserts, "menus_appetizers" => $menus_appetizers, "reviews" => $reviews, "wishlist" => $wishlist, "offweeks" => $offweeks, "offweekstime" => $offweekstime, "off_dates" => implode(',', $off_dates), "off_datestime" => serialize($off_datestime), "on_dates" => implode(',', $on_dates), "on_datestime" => serialize($on_datestime)]);
  }





  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function checkTime(Request $request)

  {



    if ($request->has('date') && $request->has('chef_id')) {



      $times = [];

      $date = $request->date;

      $chef = User::find($request->chef_id);

      $ava_dates = @unserialize($chef->available_dates);



      $start = "";

      $end = "";



      if ($ava_dates) {

        if (isset($ava_dates["dates"])) {

          $week = date('l', strtotime($date));

          foreach ($ava_dates["dates"] as $key => $value) {

            if ($key === strtolower($week)) {

              $start = $value["start"];

              $end = $value["end"];
            }
          }
        }



        if (isset($ava_dates["spl_dates"])) {

          foreach ($ava_dates["spl_dates"] as $key => $value) {

            if ($value['date'] == $date) {

              $start = $value["start"];

              $end = $value["end"];
            }
          }
        }


        $tStart = strtotime($start);

        $tEnd = strtotime($end);

        $tNow = $tStart;

        while ($tNow <= $tEnd) {

          array_push($times, date("h:i A", $tNow));

          $tNow = strtotime('+60 minutes', $tNow);
        }
      }


      return response()->json(['times' => $times]);
    }
  }

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function checkoutPage(Request $request)
  {
    if ($request->isMethod('post')) {

      $chef_id = $request->chef_id;

      $guests = $request->guests;

      $booking_date = $request->booking_date;

      $booking_time = $request->booking_time;

      $meal = $request->meal;

      $b_address = $request->b_address;

      $b_city = $request->b_city;

      $b_state = $request->b_state;

      $b_zip = $request->b_zip;

      $dessert_id = $request->desserts;

      $appetizers_id = $request->appetizers;

      $sides_id = $request->sides;

      $appetizer_guests = $request->appetizer_guests;

      $dessert_guests = $request->dessert_guests;

      $side_guests = $request->side_guests;

      $hidden_cost = $request->hidden_cost;

      $notes = $request->notes;
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

      $dessert_id = $request->session()->get('desserts');

      $appetizers_id = $request->session()->get('appetizers');

      $sides_id = $request->session()->get('sides');

      $appetizer_guests = $request->session()->get('appetizer_guests');

      $dessert_guests = $request->session()->get('dessert_guests');

      $side_guests = $request->session()->get('side_guests');

      $hidden_cost = $request->session()->get('hidden_cost');

      $notes = $request->session()->get('notes');
    }



    if (!isset($hidden_cost)) {

      $hidden_cost = 0;
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

    $request->session()->put('desserts', $dessert_id);

    $request->session()->put('appetizers', $appetizers_id);

    $request->session()->put('sides', $sides_id);

    $request->session()->put('appetizer_guests', $appetizer_guests);

    $request->session()->put('dessert_guests', $dessert_guests);

    $request->session()->put('side_guests', $side_guests);

    $request->session()->put('hidden_cost', $hidden_cost);

    $request->session()->put('notes', $notes);



    $menu = Menu::where(['id' => $meal])->first();

    if (isset($dessert_id)) {

      $menu_desserts = Menu::whereIn('id', $dessert_id)->get();
    } else {

      $dessert_id = '';

      $menu_desserts = array();
    }

    if (isset($appetizers_id)) {

      $menus_appetizers = Menu::whereIn('id', $appetizers_id)->get();
    } else {

      $appetizers_id = '';

      $menus_appetizers = array();
    }


    if (isset($sides_id)) {

      $menus_sides = Menu::whereIn('id', $sides_id)->get();
    } else {

      $sides_id = '';

      $menus_sides = array();
    }



    $chef = User::find($chef_id);



    if (!$menu) {

      return redirect('/');
    }

    $price =  $menu->cost;



    return view('checkout-page')->with([

      'menu' => $menu,

      'dessert' => $menu_desserts,

      'appetizer' => $menus_appetizers,

      'side' => $menus_sides,

      'chef' => $chef,

      'booking_date' =>  $booking_date,

      'booking_time' =>  $booking_time,

      'guests' =>  $guests,

      'details' =>  $card_details,

      'profile' =>  $profile,

      'b_address' =>  $b_address,

      'b_city' =>  $b_city,

      'b_state' =>  $b_state,

      'b_zip' =>  $b_zip,

      'hidden_cost' => $hidden_cost,

      'dessert_ids' => $dessert_id,

      'appetizer_ids' => $appetizers_id,

      'side_ids' => $sides_id,

      'appetizer_guests' => $appetizer_guests,

      'dessert_guests' => $dessert_guests,

      'side_guests' => $side_guests,

      'notes' => $notes

    ]);
  }

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function payChef(Request $request)

  {

    if (!Auth::check()) {
      $validatedData = $request->validate([

        'first_name' => ['required', 'string', 'max:255'],

        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        'password' => ['required', 'string', 'min:6', 'confirmed'],

        'phone_number' => ['required'],

        'term_condition' => ['required'],

      ]);
    }

    $data = $request->all();

    try {
      $guests = $request->session()->get('guests');
      $menu = Menu::where(['id' => $request->menu])->first();

      if (isset($data['dessert_ids']) && !empty($data['dessert_ids'])) {

        $desserts_cost = Menu::whereIn('id', @unserialize($data['dessert_ids']))->sum('cost') *  $data['dessert_guests'];
      } else {

        $desserts_cost = 0;
      }

      if (isset($data['appetizer_ids']) && !empty($data['appetizer_ids'])) {

        $appetizers_cost = Menu::whereIn('id', @unserialize($data['appetizer_ids']))->sum('cost') * $data['appetizer_guests'];
      } else {

        $appetizers_cost = 0;
      }

      if (isset($data['side_ids']) && !empty($data['side_ids'])) {

        $sides_cost = Menu::whereIn('id', @unserialize($data['side_ids']))->sum('cost') * $data['side_guests'];
      } else {

        $sides_cost = 0;
      }



      $price_data = [

        "desserts_cost" => $desserts_cost,

        "appetizers_cost" => $appetizers_cost,

        "sides_cost" => $sides_cost,

      ];



      if (!$menu) {

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



      if (Auth::check()) {



        $user = User::find(Auth::user()->id);
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



      if ($user->customer_id) {

        $customer_id = $user->customer_id;

        $stripe_cust_id =  \Stripe\Customer::retrieve($customer_id);
      }

      if (isset($stripe_cust_id) && ($stripe_cust_id->id != '' ||  $stripe_cust_id['id'] = '')) {
      } else {

        $customer = \Stripe\Customer::create(

          [

            'source' => $token['id'],

            'email' =>  $data['email'],

            'description' => 'My name is ' . $data["first_name"] . '',

          ]

        );

        $customer_id = $customer['id'];
      }





      User::where(['id' => $user->id])

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

      $transfer_group = 'ORDER-' . $menu->id . '-' . $user->id . '-' . $rn;

      $price = $menu->cost;



      $order = new Booking();

      $order->menu_id = $menu->id;

      $order->desserts_id = isset($data['dessert_ids']) ? $data['dessert_ids'] : '';

      $order->appetizers_id = isset($data['appetizer_ids']) ? $data['appetizer_ids'] : '';

      $order->sides_id = isset($data['side_ids']) ? $data['side_ids'] : '';

      $order->appetizer_guests = $data['appetizer_guests'];

      $order->dessert_guests = $data['dessert_guests'];

      $order->side_guests = $data['side_guests'];

      $order->user_id = $user->id;

      $order->booking_date = date('Y-m-d', strtotime($request->booking_date));

      $order->booking_time = $request->booking_time;

      $order->transfer_group = $transfer_group;

      $order->customer = $customer_id;

      $location = $request->session()->get('location');

      $order->completed = "confirm-pending";

      $order->notes = $request->notes;


      $meal_cost = $menu->cost * $guests;

      $sales_tax = round(((($meal_cost + $appetizers_cost + $desserts_cost + $sides_cost) * env('SALES_TAX')) / 100), 2);

      $service_tax = number_format((float) (($meal_cost + $appetizers_cost + $desserts_cost + $sides_cost) * env('SERVICE_TAX') / 100), 2, '.', '');

      $order->price = round(($meal_cost + $appetizers_cost + $desserts_cost + $sides_cost + $service_tax + $sales_tax), 2);

      $meal_total_cost = $meal_cost + $appetizers_cost + $desserts_cost + $sides_cost;

      $price_data['menu_cost'] = $price;

      $price_data['chef_share'] = round($meal_total_cost - ($meal_total_cost * env('ADMIN_SHARE') / 100), 2);

      $price_data['menu_name'] = $menu->name;

      $price_data['sales_tax'] = round($sales_tax, 2);

      $price_data['service_tax'] = round($service_tax, 2);



      $location = $request->input("b_address", "") . "+" . $request->input("b_city", "") . "+" . $request->input("b_state", "") . "+" . $request->input("b_zip", "");



      $order->guests = $guests;

      $order->location = $location;

      $order->price_data = @serialize($price_data);

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



      $request->session()->forget('booking_date');



      $chef = User::find($menu->user_id);



      $noti = new Notifications();

      $noti->to_user = $chef->id;

      if (Auth::check()) {

        $noti->from_user = Auth::user()->id;
      } else {

        $noti->from_user = $user->id;
      }

      $noti->message = serialize(array("type" => "chef-book", "menu_id" => $menu->id, "booking_date" => $request->booking_date, "booking_time" => $request->booking_time, "message" => "You have new booking."));

      $noti->save();



      if (Auth::check()) {

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



      return redirect()->route('thank-you', ['id' => $order->id]);
    } catch (\Stripe\Error\RateLimit $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    } catch (\Stripe\Error\InvalidRequest $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    } catch (\Stripe\Error\Authentication $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    } catch (\Stripe\Error\ApiConnection $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    } catch (\Stripe\Error\Base $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    } catch (Exception $e) {

      return redirect('/checkout')->with('status', $e->getMessage())->withInput();
    }
  }


  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function paymentMade(Request $request)

  {

    $request->session()->forget('booking_date');

    $order = DB::table('bookings')

      ->join('menus', 'bookings.menu_id', '=', 'menus.id')

      ->where('bookings.id', $request->id)

      ->first();



    if (isset($order->desserts_id) && $order->desserts_id != null) {

      $menus_desserts = Menu::whereIn('id', @unserialize($order->desserts_id))->get();
    } else {

      $menus_desserts = array();
    }



    if (isset($order->appetizers_id) && $order->appetizers_id != null) {

      $menus_appetizers = Menu::whereIn('id', @unserialize($order->appetizers_id))->get();
    } else {

      $menus_appetizers = array();
    }

    if (isset($order->sides_id) && $order->sides_id != null) {

      $menus_sides = Menu::whereIn('id', @unserialize($order->sides_id))->get();
    } else {

      $menus_sides = array();
    }

    return view('thank-you')->with(["order" => $order, "appetizers" => $menus_appetizers, "desserts" => $menus_desserts, "sides" => $menus_sides]);
  }





  public function autoComplete(Request $request)
  {



    $query = $request->get('term', '');

    $menus = Menu::where([

      ['Meal_prefrences ', 'LIKE', '%' . $query . '%'],

    ])

      ->get();

    $data = array();

    foreach ($menus as $menu) {

      $data[] = array('value' => $menu->name, 'id' => $menu->id);
    }

    if (count($data))

      return $data;

    else

      return ['value' => 'No Result Found', 'id' => ''];
  }



  public function autoListZip(Request $request)
  {



    $query = $request->get('term', '');

    $users = User::where([

      ['service_area', 'LIKE', '%' . $query . '%'],

    ])

      ->get();



    $data = array();

    foreach ($users as $user) {

      $data[] = array('value' => $user->service_area, 'id' => $user->id);
    }

    if (count($data))

      return $data;

    else

      return ['value' => 'No Result Found', 'id' => ''];
  }




  public function sendMessage(Request $request)
  {

    //  return $request->all(); die();
    $validatedData = $request->validate([
      'user_name' => 'required',
      'message' => 'required',

    ], [
      'user_name.required' => 'Name is required',
      'message.required' => 'Message is required'
    ]);

    Auth::check();
    $user = Auth::user();
    $user_email = $user->email;
    $chef = User::find($request->chef_id);


    $data = array(
      'name' => $request->user_name,
      'message' => $request->message,
      'user_email' => $user->email,
      'user_name' => $user->first_name . ' ' . $user->last_name,
      'chef_email' => $chef->email,
      'chef_name' => $chef->first_name . ' ' . $chef->last_name,
    );

    // Mail::to('navdeepkumar123@yopmail.com')
    Mail::to($chef->email)

      ->send(new SendMessageToChef($user_email, $data));


    return response()->json(['response' => "Message send successfully!", 'status' => "success"]);
  }

  /**
   * Join as a Chef
   */
    public function JoinAsChef()
    {
      return view('chef.join');
    }
}
