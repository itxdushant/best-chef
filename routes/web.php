<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/cache-clear', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     return "Cache is cleared";
// });	

Route::get('/php', function () {
	return view('php');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'howitworks'])->name('howitworks');
Route::get('/dev', [App\Http\Controllers\HomeController::class, 'mainPage']);
Route::get('/email/verify/{id}', [App\Http\Controllers\Auth\VerificationController::class, 'verifyUser']);
Route::get('/verify-email', [App\Http\Controllers\HomeController::class, 'VerifiyEmail']);
Route::get('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
Route::post('/sotre-media', [App\Http\Controllers\MediaController::class, 'store'])->name('sotre-media');


Auth::routes(['verify' => true]);

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function () {
	Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index']);

	Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'getUsers'])->name('admin-users');
	Route::get('/user/{id}', [App\Http\Controllers\Admin\AdminController::class, 'getUser']);
	Route::get('/chefs', [App\Http\Controllers\Admin\AdminController::class, 'getChefs'])->name('admin-chefs');
	Route::get('/chef/{id}', [App\Http\Controllers\Admin\AdminController::class, 'getChef']);
	Route::post('/active-user', [App\Http\Controllers\Admin\AdminController::class, 'setUserStatus'])->name('admin-active-user');
	Route::post('/feature-chef', [App\Http\Controllers\Admin\AdminController::class, 'setChefFeatured'])->name('admin-feature-chef');
	Route::post('/delete-user', [App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('admin-delete-user');
	Route::post('/delete-booking', [App\Http\Controllers\Admin\AdminController::class, 'deleteBooking'])->name('admin-delete-booking');


	Route::get('/trips', [App\Http\Controllers\Admin\AdminController::class, 'getTrips'])->name('admin-trips');
	Route::get('/bookings', [App\Http\Controllers\Admin\AdminController::class, 'getBookings'])->name('admin-bookings');
	Route::get('/booking/{id}', [App\Http\Controllers\Admin\AdminController::class, 'getBooking']);
	Route::get('/new-requests', [App\Http\Controllers\Admin\AdminController::class, 'getNewRequests'])->name('admin-new-requests');
	Route::get('/old-requests', [App\Http\Controllers\Admin\AdminController::class, 'getOldRequests'])->name('admin-old-requests');
	Route::get('/view/{id}', [App\Http\Controllers\Admin\AdminController::class, 'getRequestDetails'])->name('admin-view-request');
	Route::post('/confirm-payment', [App\Http\Controllers\Admin\AdminController::class, 'confirmPayment'])->name('admin-confirm-payment');
	Route::get('/coupons', [App\Http\Controllers\Admin\AdminController::class, 'getCoupons'])->name('admin-coupons');
	Route::post('/store-coupon', [App\Http\Controllers\Admin\AdminController::class, 'storeReferral'])->name('admin-store-referral');
	Route::post('/expire-coupon', [App\Http\Controllers\Admin\AdminController::class, 'setExpire'])->name('admin-expire-coupon');
	Route::post('/status-coupon', [App\Http\Controllers\Admin\AdminController::class, 'setActive'])->name('admin-active-coupon');
});

Route::group(['namespace' => 'Chef', 'prefix' => 'chef', 'middleware' => ['chef']], function () {
	Route::get('/', [App\Http\Controllers\Chef\ChefController::class, 'getProfile'])->name('chef.profile');
	Route::get('/profile', [App\Http\Controllers\Chef\ChefController::class, 'getProfile']);
	Route::get('/menus', [App\Http\Controllers\Chef\ChefController::class, 'getMenus'])->name('menus');
	Route::post('/change-password', [App\Http\Controllers\Chef\ChefController::class, 'changePassword']);
	Route::get('/payment-info', [App\Http\Controllers\Chef\ChefController::class, 'getPaymentInfo'])->name('payment-info');
	Route::get('/payment-edit', [App\Http\Controllers\Chef\ChefController::class, 'getPaymentEdit'])->name('payment-edit');
	Route::post('/save-payment-info', [App\Http\Controllers\Chef\ChefController::class, 'savePaymentInfo'])->name('save_payment_info');
	Route::post('/chef-payment-requests', [App\Http\Controllers\Chef\ChefController::class, 'sendRequest'])->name('chef-payment-requests');
	Route::post('/update-profile', [App\Http\Controllers\Chef\ChefController::class, 'updateProfile'])->name('chef-update-profile');
	Route::get('/add-menu', [App\Http\Controllers\Chef\ChefController::class, 'addMenuPage']);
	Route::get('/requests', [App\Http\Controllers\Chef\ChefController::class, 'getRequests'])->name('chef-requests');
	Route::post('/save-menu', [App\Http\Controllers\Chef\ChefController::class, 'saveMenu'])->name('save-menu');
	Route::post('/delete-menu', [App\Http\Controllers\Chef\ChefController::class, 'deleteMenu'])->name('chef-delete-menu');
	Route::match(['get', 'post'], '/edit-menu/{id}', [App\Http\Controllers\Chef\ChefController::class, 'editMenuPage']);
	Route::post('/req-confirm', [App\Http\Controllers\Chef\ChefController::class, 'requestConfirm']);
	Route::post('/req-decline', [App\Http\Controllers\Chef\ChefController::class, 'requestDecline']);
	Route::post('/req-completed', [App\Http\Controllers\Chef\ChefController::class, 'requestCompleted']);
	Route::get('/messages', [App\Http\Controllers\Chef\ChefController::class, 'getMessages'])->name('chef-messages');
	
	Route::match(['get', 'post'], '/set-dates', [App\Http\Controllers\Chef\ChefController::class, 'setDates'])->name('chef-dates');
	Route::post('/loadmsgs', [App\Http\Controllers\Chef\ChefController::class, 'loadMessages']);
	Route::post('/send-msg', [App\Http\Controllers\Chef\ChefController::class, 'sendMessage']);
	Route::post('/read-msg', [App\Http\Controllers\Chef\ChefController::class, 'readMsg']);
  
	Route::get('/notification', [App\Http\Controllers\Chef\ChefController::class, 'getNotification'])->name('chef-notification');
	Route::post('/update-dates', [App\Http\Controllers\Chef\ChefController::class, 'updateDates'])->name('chef-update-dates');
	Route::post('/get-booking', [App\Http\Controllers\Chef\ChefController::class, 'getBooking'])->name('chef-get-booking');

	Route::post('/status-menu', [App\Http\Controllers\Chef\ChefController::class, 'statusMenu'])->name('chef-status-menu');

	Route::get('/booking-history', [App\Http\Controllers\Chef\ChefController::class, 'bookingHistory'])->name('booking-history');
});

Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['user']], function () {
	Route::get('/', [App\Http\Controllers\User\UserController::class, 'getProfile']);
	Route::get('/profile',  [App\Http\Controllers\User\UserController::class, 'getProfile']);
	Route::post('/update-profile', [App\Http\Controllers\User\UserController::class, 'updateProfile'])->name('user-update-profile');
	Route::post('/change-password',  [App\Http\Controllers\User\UserController::class, 'changePassword']);
	Route::post('/add-to-fav',  [App\Http\Controllers\User\UserController::class, 'addToFav'])->name("add-to-fav");
	Route::post('/remove-to-fav', [App\Http\Controllers\User\UserController::class, 'removeToFav'])->name("remove-to-fav");
	Route::get('/favorites', [App\Http\Controllers\User\UserController::class, 'getFavs'])->name("user-favorites");
	Route::get('/messages', [App\Http\Controllers\User\UserController::class, 'getMessages'])->name('user-messages');
	Route::post('/loadmsgs', [App\Http\Controllers\User\UserController::class, 'loadMessages']);
	Route::post('/send-msg', [App\Http\Controllers\User\UserController::class, 'sendMessage']);
	Route::post('/read-msg ', [App\Http\Controllers\User\UserController::class, 'readMsg']);
	Route::post('/cancel-booking', [App\Http\Controllers\User\UserController::class, 'cancelBooking'])->name('user-cancel-booking');
	Route::post('/check-cancel-booking-amount', [App\Http\Controllers\User\UserController::class, 'checkCancelBooking'])->name('user-check-cancel-amount');
	Route::get('/requests', [App\Http\Controllers\User\UserController::class, 'getRequests'])->name('user-requests');
	Route::post('/payment', [App\Http\Controllers\User\UserController::class, 'makePayment'])->name('user-payment');
	Route::get('/add-review/{id}/{bid}', [App\Http\Controllers\User\UserController::class, 'addReview']);
	Route::post('/submit-review', [App\Http\Controllers\User\UserController::class, 'submitReview']);

	Route::get('/notification', [App\Http\Controllers\User\UserController::class, 'getNotification'])->name('user-notification');
	Route::post('/add-card', [App\Http\Controllers\User\UserController::class, 'addCard'])->name('user-add-card');
	Route::post('/user-delete-card', [App\Http\Controllers\User\UserController::class, 'deleteCard'])->name('user-delete-card');
	Route::post('/req-completed', [App\Http\Controllers\User\UserController::class, 'requestCompleted']);

	Route::get('/chef-profile/{id}', [App\Http\Controllers\User\UserController::class, 'chefProfileView'])->name('chef.profile.view');
});

Route::post('/photo-upload', [App\Http\Controllers\HomeController::class, 'photoUpload']);

Route::get('/auto-list', [App\Http\Controllers\HomeController::class, 'autoComplete']);
Route::get('/auto-list-zip', [App\Http\Controllers\HomeController::class, 'autoListZip']);
Route::get('/message', [ChatController::class, 'index']);
Route::post('/chef-conversations', [ChatController::class, 'getUserMessages'])->name('chef-conversation');
Route::post('/send-message', [ChatController::class, 'send']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/terms-of-use', [App\Http\Controllers\HomeController::class, 'termsConditions'])->name('terms-of-use');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact-us');
Route::get('/support', [App\Http\Controllers\HomeController::class, 'support'])->name('support');
Route::Post('/support-store', [App\Http\Controllers\HomeController::class, 'supportStore'])->name('support.store');
Route::get('/partner', [App\Http\Controllers\HomeController::class, 'partner'])->name('partner');
Route::post('/contactus-store', [App\Http\Controllers\HomeController::class, 'contactUsStore'])->name('contactus.store');

Route::post('/partner-contactus-store', [App\Http\Controllers\HomeController::class, 'partnercontactUsStore'])->name('partnercontactus.partner');


Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'policies'])->name('privacy-policy');


Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/chef-how-to-forum', [App\Http\Controllers\HomeController::class, 'howtoforum'])->name('chef-how-to-forum');
Route::get('/chefs', [App\Http\Controllers\HomeController::class, 'chefList'])->name('chef-list');
Route::get('/chefs/{type}', [App\Http\Controllers\HomeController::class, 'topChefsList'])->name('chefs-all');

// Route::get('/how-it-works', 'HomeController@howitworks')->name('how-it-works');

Route::get('/find-a-chef', [App\Http\Controllers\HomeController::class, 'searchResult'])->name("menu-listing");
Route::post('/search-data', [App\Http\Controllers\HomeController::class, 'searchData'])->name("search-data");

Route::get('/chef/{id}/{name}', [App\Http\Controllers\HomeController::class, 'chefDetails'])->name("chef-detail");

Route::get('/user-register', [App\Http\Controllers\HomeController::class, 'userRegisterPage'])->name('user-register');
Route::get('/chef-register', [App\Http\Controllers\HomeController::class, 'chefRegisterPage'])->name('chef-register');
Route::post('/check-time', [App\Http\Controllers\HomeController::class, 'checkTime'])->name('check-time');

// OAuth Routes
Route::get('auth/{provider}', [App\Http\Controllers\Auth\AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback']);

Route::match(['get', 'post'], '/checkout', [App\Http\Controllers\HomeController::class, 'checkoutPage'])->name('checkout');
Route::post('/pay', [App\Http\Controllers\HomeController::class, 'payChef']);

Route::get('/thank-you', [App\Http\Controllers\HomeController::class, 'paymentMade'])->name('thank-you');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

// send message to chef
Route::post('/sendMessage', [App\Http\Controllers\HomeController::class, 'sendMessage'])->name('sendMessage');

Route::get('/bank-info', [App\Http\Controllers\HomeController::class, 'bankInfo'])->name('bank-info');
// banking information

// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     return "Cache is cleared";
// });
Auth::routes();
