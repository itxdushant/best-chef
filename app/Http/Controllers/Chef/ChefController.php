<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Stripe\Stripe;
use Intervention\Image\Facades\Image;
use Mail;
use DB;
use App\User;
use App\Menu;
use App\Booking;
use App\PaymentDetails;
use App\PaymentRequests;
use App\Message;
use App\Notifications;
use App\Mail\BookingAcceptUser;
use App\Mail\BookingAcceptChef;
use App\Mail\BookingDeclinedUser;
use App\Mail\PaymentRequestAdmin;
use App\Mail\PaymentRequest;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class ChefController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
    public function addMenuPage()
    {
        return view('chef.add-menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMenuPage($id, Request $request)
    {
        $id = (int) $id;

        if ($request->isMethod('post')) {
            // converting an array to comma seperated string
            $modified_meal_pref = implode(',', $request->meal_prefrences);
            $request->merge([
                'meal_prefrences' => $modified_meal_pref
            ]);
            $data = $request->all();


            $images = array();

            if ($request->has('images')) {
                $files = $request->file('images');
                $path = public_path('uploads/menu-images/');

                foreach ($files as $key => $file) {
                    $fileType = $file->getMimeType();
                    $fileName = $file->getClientOriginalName();
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = time() . '-' . str_random(3) . '.' . $fileExtension;
                    $check = $file->move($path, $fileName);

                    $img = Image::make($path . $fileName);
                    $img->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . $fileName);

                    if ($check) {

                        Image::make($path . $fileName)
                            ->fit(300, 200)
                            ->orientate()
                            ->save($path . 'thumb-' . $fileName, 80);

                        array_push($images, $fileName);
                    }
                }
            }

            if ($request->has('oldpics')) {
                $images = array_merge($data['oldpics'], $images);
            }
            $data['images'] = implode(',', $images);
            unset($data['oldpics']);
            unset($data['_token']);
            Menu::where(['id' => $id])
                ->update($data);

            return redirect('/chef/menus')->with('status', 'Meal updated successfully!');
        }

        $menu = Menu::where(['id' => $id])->first();
        $string_meal_pref = $menu->meal_prefrences;
        $meal_pref_arr = explode(",", $string_meal_pref);
        return view('chef.edit-menu')->with(["menu" => $menu, "meal_prefrences" => $meal_pref_arr]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {

        $profile = User::where(['id' => Auth::user()->id])->first();
        // if($profile->certificate_data && $profile->certificate_data != null) {
        //     $profile->certificate_data = unserialize($profile->certificate_data);
        // }
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('menus.user_id', Auth::user()->id)
            ->whereIn('bookings.completed', ['confirm-pending', 'confirmed', 'full-paid'])
            ->select('bookings.booking_date')
            ->orderBy('bookings.booking_date', 'desc')
            ->get();

        $dates = [];
        if (count($bookings)) {
            foreach ($bookings as $key => $booking) {
                array_push($dates, $booking->booking_date);
            }
        }

        $menus = Menu::where(['user_id' => Auth::user()->id, 'status' => 0])->count();
        return view('chef.profile')->with(["profile" => $profile, "dates" => implode(',', $dates), "menus" => $menus]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenus()
    {
        $menus = Menu::where(['user_id' => Auth::user()->id])->get();
        return view('chef.menus')->with(["menus" => $menus]);
    }

    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request)
    {
        //   dd($request->all());
        $validatedData = $request->validate([
            'avg_cost' => 'required',
            'avg_time' => 'required',
            'customer_expect' => 'required',
            
            'meal_speciality' => 'required',
            'cooking_class' => 'required',
            'experience' => 'required',
            'bio' => 'required',
            'service_area' => 'required',
            'area_range' => 'required',
            'certificate_data' => 'required',
            'available_dates' => 'required',

            // 'monday_time_from' => 'required',
            // 'monday_time_to' => 'required',

            // 'tuesday_time_from' => 'required',
            // 'tuesday_time_to' => 'required',

            // 'wednesday_time_from' => 'required',
            // 'wednesday_time_to' => 'required',

            // 'thursday_time_from' => 'required',
            // 'thursday_time_to' => 'required',

            // 'friday_time_from' => 'required',
            // 'friday_time_to' => 'required',

            // 'saturday_time_from' => 'required',
            // 'saturday_time_to' => 'required',

            // 'sunday_time_from' => 'required',
            // 'sunday_time_to' => 'required',
           
        ],
        
        //custom message
        [
            'avg_cost.required' => 'Meal cost is required',
            'avg_time' => 'Average prep time is required',

            // 'monday_time_from.required' => 'monday from',
            // 'monday_time_to.required' => 'monday to',

            // 'tuesday_time_from.required'=> 'tuesday from',
            // 'tuesday_time_to.required' => 'tuesday to',

            // 'wednesday_time_from.required' => 'wednesday from',
            // 'wednesday_time_to.required' => 'wednesday to',

            // 'thursday_time_from.required' => 'thursday from',
            // 'thursday_time_to.required' => 'thursday to',

            // 'friday_time_from.required'=> 'friday from',
            // 'friday_time_to.required' => 'friday to',
            

            // 'saturday_time_from.required'=> 'saturday from',
            // 'saturday_time_to.required'=> 'saturday to',

            // 'sunday_time_from.required'=> 'sunday from',
            // 'sunday_time_to.required' => 'sunday to',
           
        ]);


        $timings = serialize(array(
            'monday_time_from' => $request->monday_time_from,
            'monday_time_to' => $request->monday_time_to,
            'tuesday_time_from' => $request->tuesday_time_from,
            'tuesday_time_to' => $request->tuesday_time_to,
            'wednesday_time_from' => $request->wednesday_time_from,
            'wednesday_time_to' => $request->wednesday_time_to,
            'thursday_time_from' => $request->thursday_time_from,
            'thursday_time_to' => $request->thursday_time_to,
            'friday_time_from' => $request->friday_time_from,
            'friday_time_to' => $request->friday_time_to,
            'saturday_time_from' => $request->saturday_time_from,
            'saturday_time_to' => $request->saturday_time_to,
            'sunday_time_from' => $request->sunday_time_from,
            'sunday_time_to' => $request->sunday_time_to,
        ));

        if ($request->has('images')) {
            $files = $request->file('images');
            $path = public_path('uploads/meal-images/');
            $images = array();
            foreach ($files as $key => $file) {
                $fileType = $file->getMimeType();
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();

                $fileName = time() . '-' . Str::random(3) . '.' . $fileExtension;
                $check = $file->move($path, $fileName);

                $img = Image::make($path . $fileName);
                $img->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . $fileName);

                if ($check) {
                    Image::make($path . $fileName)
                        ->fit(300, 200)
                        ->orientate()
                        ->save($path . 'thumb-' . $fileName, 80);

                    array_push($images, $fileName);
                }
            }
            $meal_images = implode(',', $images);
            User::where(['id' => Auth::user()->id])
                ->update(['meal_images' => $meal_images]);
        }



        User::where(['id' => Auth::user()->id])
            ->update([
                'avg_cost' => $request->avg_cost,
                'avg_time' => $request->avg_time,
                'customer_expect' => $request->customer_expect,
                'meal_speciality' => implode(',', $request->meal_speciality),
                'cooking_class' =>  implode(',', $request->cooking_class),
                'college' => $request->college,
                'experience' => $request->experience,
                'service_area' => $request->service_area,
                'area_range' => $request->area_range,
                'bio' => $request->bio,
                // 'latitude' => @$map[0],
                // 'longitude' => @$map[1],
                // 'certificate_data' => $request->certification,explode(" ", $pizza);
                // 'certificate_data' =>implode(",",$request->certificate_data),
                'certificate_data' => serialize($request->certificate_data),
                'available_dates' => serialize($request->available_dates),
                'timings' => $timings,
                'video_url' => implode(',', $request->videos),

            ]);

            return back()->with('status', 'Profile updated successfully!');
    }

    public function get_lat_long($address)
    {

        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyCbQhq3ry_ZkH73LzIeZP0Y9mVO_kvoasY");
        $json = json_decode($json);
        $lat = "";
        $long = "";
        if (count($json->results)) {
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        }
        return $lat . ',' . $long;
    }

    /**
     * Update the user profile.
     */
    public function updateDates(Request $request)
    {
        $input = $request->all();
        User::where(['id' => Auth::user()->id])
            ->update([
                'available_dates' => serialize($input)
            ]);

        return response()->json(['response' => "Dates updated successfully!"]);
        // $input = $request->all();
        // $input = explode(',', $input['available_dates']);
        // $available_dates = serialize($input);
        // User::where(['id' => Auth::user()->id])
        //     ->update([
        //             'available_dates' => $available_dates
        //         ]);
        // return response()->json(['response' => "Dates updated successfully!", 'status' => 'success']);
    }

    /**
     * Update the user profile.
     */
    public function saveMenu(Request $request)
    {

        //    return $request->all();
        $validatedData = $request->validate([
            'name' => 'required',
            // 'ingredients' => 'required',
            'cost' => 'required',
            'meal_prefrences' => 'required'
        ]);
        // converting an array to comma seperated string
        $modified_meal_pref = implode(',', $request->meal_prefrences);
        $request->merge([
            'meal_prefrences' => $modified_meal_pref
        ]);
        $data = $request->all();
        if ($request->has('images')) {
            $files = $request->file('images');
            $path = public_path('uploads/menu-images/');
            $images = array();
            foreach ($files as $key => $file) {
                $fileType = $file->getMimeType();
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();

                $fileName = time() . '-' . str_random(3) . '.' . $fileExtension;
                $check = $file->move($path, $fileName);

                $img = Image::make($path . $fileName);
                $img->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . $fileName);

                if ($check) {
                    Image::make($path . $fileName)
                        ->fit(300, 200)
                        ->orientate()
                        ->save($path . 'thumb-' . $fileName, 80);

                    array_push($images, $fileName);
                }
            }
            $data['images'] = implode(',', $images);
        }

        $data['user_id'] = Auth::user()->id;
        $menu = new Menu($data);
        $menu->save();

        return redirect('/chef/menus')->with('status', 'New meal is added!');
    }

    /**
     * Update the user profile.
     */
    public function deleteMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            Menu::where(['user_id' => Auth::user()->id, 'id' =>  $request->menu_id])->delete();
            return response()->json(['response' => "Meal Removed."]);
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

            return response()->json(['response' => "Meal " . $request->type . "d"]);
        }
    }


    /**
     * Update the user profile.
     */
    public function getRequests()
    {
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('menus.user_id', Auth::user()->id)
            ->select('menus.name', 'menus.ingredients', 'menus.description', 'menus.cost', 'bookings.*')
            ->orderBy('bookings.booking_date', 'asc')
            ->get();

        $past_requests = array();
        $upcoming_requests = array();
        $active_requests = array();
        $dec_requests = array();

        foreach ($bookings as $key => $booking) {
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");
            if ($booking->completed == "completed") {
                $bookings[$key]->price_data = @unserialize($booking->price_data);
                // code started to get desserts, appetizer & sides names
                if (@unserialize($booking->desserts_id)) $bookings[$key]->menus_desserts = Menu::whereIn('id', @unserialize($booking->desserts_id))->get();
                if (@unserialize($booking->appetizers_id)) $bookings[$key]->menus_appetizers = Menu::whereIn('id', @unserialize($booking->appetizers_id))->get();
                if (@unserialize($booking->sides_id))  $bookings[$key]->menus_sides = Menu::whereIn('id', @unserialize($booking->sides_id))->get();
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // if($booking->desserts_id) {
                //     $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //     $booking->desserts_cost = $desserts_cost;
                //   } else {
                //     $booking->desserts_cost = 0;
                //   }
                //   if($booking->appetizers_id) {
                //     $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //     $bookings[$key]->appetizers_cost = $appetizers_cost;
                //   } else {
                //     $bookings[$key]->appetizers_cost = 0;
                //   }
                array_push($past_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {
            $dt1 = date("Y-m-d", strtotime($booking->booking_date));
            $date_now = date("Y-m-d");
            if ($booking->completed == "confirm-pending" && strtotime($date_now) <= strtotime($dt1)) {
                $bookings[$key]->price_data = @unserialize($booking->price_data);
                // code started to get desserts & appetizer names
                if (@unserialize($booking->desserts_id)) $bookings[$key]->menus_desserts = Menu::whereIn('id', @unserialize($booking->desserts_id))->get();
                if (@unserialize($booking->appetizers_id)) $bookings[$key]->menus_appetizers = Menu::whereIn('id', @unserialize($booking->appetizers_id))->get();
                if (@unserialize($booking->sides_id))  $bookings[$key]->menus_sides = Menu::whereIn('id', @unserialize($booking->sides_id))->get();
                //   $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                //   if($booking->desserts_id) {
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
            if (($booking->completed == "confirmed" || $booking->completed == "full-paid") && strtotime($date_now) <= strtotime($dt1)) {
                $bookings[$key]->price_data = @unserialize($booking->price_data);
                // code started to get desserts & appetizer names
                if (@unserialize($booking->desserts_id)) $bookings[$key]->menus_desserts = Menu::whereIn('id', @unserialize($booking->desserts_id))->get();
                if (@unserialize($booking->appetizers_id)) $bookings[$key]->menus_appetizers = Menu::whereIn('id', @unserialize($booking->appetizers_id))->get();
                if (@unserialize($booking->sides_id))  $bookings[$key]->menus_sides = Menu::whereIn('id', @unserialize($booking->sides_id))->get();
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // if($booking->desserts_id) {
                //     $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //     $booking->desserts_cost = $desserts_cost;
                //   } else {
                //     $booking->desserts_cost = 0;
                //   }
                //   if($booking->appetizers_id) {
                //     $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //     $bookings[$key]->appetizers_cost = $appetizers_cost;
                //   } else {
                //     $bookings[$key]->appetizers_cost = 0;
                //   }
                array_push($active_requests, $bookings[$key]);
            }
        }

        foreach ($bookings as $key => $booking) {
            if ($booking->completed == "declined") {
                $bookings[$key]->price_data = @unserialize($booking->price_data);
                // code started to get desserts & appetizer names
                if (@unserialize($booking->desserts_id)) $bookings[$key]->menus_desserts = Menu::whereIn('id', @unserialize($booking->desserts_id))->get();
                if (@unserialize($booking->appetizers_id)) $bookings[$key]->menus_appetizers = Menu::whereIn('id', @unserialize($booking->appetizers_id))->get();
                if (@unserialize($booking->sides_id))  $bookings[$key]->menus_sides = Menu::whereIn('id', @unserialize($booking->sides_id))->get();
                // $bookings[$key]->price = round($booking->cost * $booking->guests, 2);
                // if($booking->desserts_id) {
                //     $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
                //     $booking->desserts_cost = $desserts_cost;
                //   } else {
                //     $booking->desserts_cost = 0;
                //   }
                //   if($booking->appetizers_id) {
                //     $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
                //     $bookings[$key]->appetizers_cost = $appetizers_cost;
                //   } else {
                //     $bookings[$key]->appetizers_cost = 0;
                //   }
                array_push($dec_requests, $bookings[$key]);
            }
        }


        return view('chef.requests')->with(["past_requests" => $past_requests, "upcoming_requests" => $upcoming_requests, "active_requests" => $active_requests, "dec_requests" => $dec_requests]);
    }

    /**
     * Display a listing of the resource.
     */
    public function requestConfirm(Request $request)
    {
        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $data = array();
        if ($booking) {
            $data["completed"] = 'confirmed';
            $data["confirm_date"] = date("Y-m-d H:i:s");
            Booking::where(['id' => $booking->id])
                ->update($data);

            $user = User::where(['id' => $booking->user_id])->first();


            $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking-confirm", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been confirmed."));
            $noti->save();

            Mail::to(Auth::user()->email)
                ->send(new BookingAcceptChef(Auth::user()));

            Mail::to($user->email)
                ->send(new BookingAcceptUser($user));

            return response()->json(['response' => "Booking is confirmed!", "status" => true]);
        } else {
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function requestDecline(Request $request)
    {

        $id = (int) $request->id;
        $booking = DB::table('bookings')
            ->where('bookings.id', $id)
            ->first();

        $data = array();
        if ($booking) {

            $data["status"] = 'declined';
            $data["completed"] = 'declined';
            $data["confirm_date"] = date("Y-m-d H:i:s");

            $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking-confirm", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been declined."));
            $noti->save();


            Booking::where(['id' => $booking->id])
                ->update($data);

            $user = User::where(['id' => $booking->user_id])->first();

            Mail::to($user->email)
                ->send(new BookingDeclinedUser($user));

            return response()->json(['response' => "Booking is declined!", "status" => true]);
        } else {
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
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
        if ($booking) {

            $data["status"] = 'completed';
            $data["completed"] = 'completed';
            $data["confirm_date"] = date("Y-m-d H:i:s");

            Booking::where(['id' => $booking->id])
                ->update($data);

            $noti = new Notifications();
            $noti->to_user = $booking->user_id;
            $noti->from_user = Auth::user()->id;
            $noti->message = serialize(array("type" => "booking", "booking_id" => $id, "menu_id" => $booking->menu_id, "message" => "Your request has been completed. Please give review"));
            $noti->save();
            return response()->json(['response' => "Booking is completed!", "status" => true]);
        } else {
            return response()->json(['response' => "Booking not found!", "status" => false]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getPaymentEdit()
    {
        $details = PaymentDetails::where(['user_id' => Auth::user()->id])->first();
        return view('chef.payment-edit')->with(["details" => $details]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getPaymentInfo()
    {
        $details = PaymentDetails::where(['user_id' => Auth::user()->id])->first();
        // $bookings = array();
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where('menus.user_id', Auth::user()->id)
            ->whereIn('bookings.completed', ['completed', 'full-paid'])
            ->select('menus.name', 'menus.ingredients', 'menus.cost', 'bookings.*')
            ->orderBy('bookings.id', 'desc')
            ->get();

        foreach ($bookings as $key => $booking) {
            $bookings[$key]->price_data = @unserialize($booking->price_data);
            //     if($booking->appetizers_id) {
            //       $appetizers_cost = Menu::whereIn('id' , @unserialize($booking->appetizers_id))->sum('cost');
            //       $bookings[$key]->appetizers_cost = $appetizers_cost;
            //     } else {
            //       $bookings[$key]->appetizers_cost = 0;
            //     }
            //     if($booking->desserts_id) {
            //       $desserts_cost = Menu::whereIn('id' , @unserialize($booking->desserts_id))->sum('cost');
            //       $booking->desserts_cost = $desserts_cost;
            //     } else {
            //       $booking->desserts_cost = 0;
            //     }
        }

        return view('chef.payment-info')->with(["details" => $details, "bookings" => $bookings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePaymentInfo(Request $request)
    {
        $msg = "";
        $data = $request->all();
        $details = PaymentDetails::where(['user_id' => Auth::user()->id])->first();
        $dob = date("d-m-Y", strtotime($data['dob']));
        $date = @explode('-', $dob);

        if ($details) {

            if ($details->account_number != $data['account_number']) {
                $validatedData = $request->validate([
                    'account_number' => 'required|string|unique:payment_details',
                ]);
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
                            'account_holder_name' => Auth::user()->first_name,
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

                return redirect('/chef/payment-info')->with('status', 'Payment Information updated successfully!');
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
            return redirect('/chef/payment-edit')->with('status', $msg);
        } else {

            $validatedData = $request->validate([
                'account_number' => 'required|string|unique:payment_details',
            ]);

            try {

                $account = \Stripe\Account::create([
                    'country' => 'US',
                    'type' => 'custom',
                    'requested_capabilities' => ["transfers"],
                    'business_type' => 'individual',
                    'external_account' => [
                        'object' => 'bank_account',
                        'country' => 'US',
                        'currency' => 'usd',
                        'routing_number' => @$data['routing_number'],
                        'account_number' => @$data['account_number'],
                        'account_holder_name' => Auth::user()->first_name,
                    ],
                    'individual' => [
                        'first_name' =>  @$data['first_name'],
                        'last_name' =>  @$data['last_name'],
                        'email' =>  Auth::user()->email,
                        'phone' =>  @$data['phone'],
                        'dob' => [
                            'day' =>  @$date[0],
                            'month' => @$date[1],
                            'year' => @$date[2],
                        ],
                        'ssn_last_4' => $data['ssn_last_4'],
                        'address' => [
                            "line1" => @$data['address1'],
                            "city" => @$data['city'],
                            "state" => @$data['state'],
                            "postal_code" => @$data['zip'],
                        ]
                    ],
                    'business_profile' => [
                        'mcc' => @$data['mcc'],
                        'url' => @$data['website'],
                    ],
                    'tos_acceptance' => [
                        'date' => time(),
                        'ip' => @$_SERVER['REMOTE_ADDR']
                    ]
                ]);

                // $account = \Stripe\Account::create([
                //     'country' => 'US',
                //     'type' => $data['account_type'],
                //     'requested_capabilities' => ["transfers"],
                //     'external_account'=> [
                //         'object' => 'bank_account',
                //         'country' => 'US',
                //         'currency' => 'usd',
                //         'routing_number' => $data['routing_number'],
                //         'account_number' => $data['account_number'],
                //         'account_holder_name' => Auth::user()->name,
                //     ]
                // ]);

                $data['user_id'] = Auth::user()->id;
                $data['account_id'] = $account->external_accounts->data[0]->id;
                $data['account'] = $account->external_accounts->data[0]->account;
                $data['bank_name'] = $account->external_accounts->data[0]->bank_name;
                $data['last4'] = $account->external_accounts->data[0]->last4;

                $details = new PaymentDetails($data);
                $details->save();
                return redirect('/chef/payment-info')->with('status', 'Payment Information saved successfully!');
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
            return redirect('/chef/payment-edit')->with('status', $msg);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function getMessages()
    {
        $current_id = auth()->user()->id;
        $users = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->where('menus.user_id', $current_id)
            //->where('menus.user_id', 225)
            ->select('menus.user_id', 'bookings.user_id', 'users.*')
            ->orderBy('bookings.booking_date', 'desc')
            ->groupBy('users.id')
            ->get();
        return view('chef.messages')->with(["users" => $users]);
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

            $messgaes = Message::where([['sender', '=', $sender], ['receiver', '=', $receiver]])
                ->orWhere([['sender', '=', $receiver], ['receiver', '=', $sender]])
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

        if ($request->isMethod('post') && isset(Auth::user()->id)) {

            $receiver = $request->input('user_id');
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


    public function readMsg(Request $request)
    {

        $sta = Message::where(['receiver' => $request->uid])
            ->update([
                "is_read" => '1'
            ]);

        return response()->json(["status" => $sta]);
    }





    /**
     * Display a listing of the resource.
     */
    public function sendRequest(Request $request)
    {
        if ($request->has("book_ids")) {
            $ids = explode(',', $request->book_ids);
            $bookings = DB::table('bookings')
                ->join('menus', 'bookings.menu_id', '=', 'menus.id')
                ->where(['menus.user_id' => Auth::user()->id, 'bookings.payment_request' => 0])
                ->whereIn('bookings.id', $ids)
                ->select('menus.name', 'menus.cost', 'bookings.*')
                ->get();

            $booking_data = $bookings;
            if (count($bookings)) {
                $payment = 0;
                $pids = array();
                foreach ($bookings as $key => $book) {
                    $price_data = @unserialize($book->price_data);
                    $chef_share = ($price_data && @$price_data['chef_share']) ? $price_data['chef_share'] : 0;
                    // $payment = ($payment + ((($book->cost * $book->guests) + $desserts_cost + $appetizers_cost) * 90 / 100)) + $book->tip;
                    $payment = ($payment + $chef_share) + $book->tip;
                    array_push($pids, $book->id);
                }

                if ($payment) {
                    $req = new PaymentRequests();
                    $req->chef_id = Auth::user()->id;
                    $req->amount = round($payment, 2);
                    $req->booking_ids = serialize($pids);
                    $req->status = "inprogress";
                    $req->save();
                    Booking::whereIn('id', $pids)
                        ->update(["payment_request" => 1]);

                    Mail::to(Auth::user()->email)->send(new PaymentRequest(Auth::user(), $req->amount));
                    Mail::to(env('ADMIN_EMAIL'))->send(new PaymentRequestAdmin(Auth::user(), $req->amount));
                }

                return response()->json(['response' => "Request sent successfully!", "status" => true]);
            } else {
                return response()->json(['response' => "No New Bookings found!", "status" => false]);
            }
        }
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
            Notifications::where(['id' => $notification->id])
                ->update(["is_read" => 1]);
        }
        return view('chef.notifications')->with(["notifications" => $notifications]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setDates()
    {
        return view('chef.dates')->with([]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooking(Request $request)
    {
        $bookings = DB::table('bookings')
            ->join('menus', 'bookings.menu_id', '=', 'menus.id')
            ->where(['menus.user_id' => Auth::user()->id, 'bookings.booking_date' =>  $request->date])
            ->select('menus.name', 'bookings.*')
            ->get();

        return response()->json(['bookings' => $bookings]);
    }
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        if ($request->get('new-password_confirmation') !=  $request->get('new-password')) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Confirm Password to be same as your new password.");
        }
        $validatedData = $request->validate([
            'password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("status", "Password changed successfully!");
    }

    public function bookingHistory()
    {
        return view('chef.booking-history');

    }
}
