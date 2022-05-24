<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@mainPage');	


Auth::routes();

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function () {
	Route::get('/', 'AdminController@index');
	Route::get('/users', 'AdminController@getUsers')->name('admin-users');
	Route::get('/user/{id}', 'AdminController@getUser');
	Route::get('/chefs', 'AdminController@getChefs')->name('admin-chefs');
	Route::get('/chef/{id}', 'AdminController@getChef');
	Route::post('/active-user', 'AdminController@setUserStatus')->name('admin-active-user');
	Route::post('/feature-chef', 'AdminController@setChefFeatured')->name('admin-feature-chef');

	
	Route::get('/trips', 'AdminController@getTrips')->name('admin-trips');
	Route::get('/bookings', 'AdminController@getBookings')->name('admin-bookings');
	Route::get('/booking/{id}', 'AdminController@getBooking');
	Route::get('/new-requests', 'AdminController@getNewRequests')->name('admin-new-requests');
	Route::get('/old-requests', 'AdminController@getOldRequests')->name('admin-old-requests');
	Route::get('/view/{id}', 'AdminController@getRequestDetails')->name('admin-view-request');
	Route::post('/confirm-payment', 'AdminController@confirmPayment')->name('admin-confirm-payment');
	Route::get('/coupons', 'AdminController@getCoupons')->name('admin-coupons');
	Route::post('/store-coupon', 'AdminController@storeReferral')->name('admin-store-referral');
	Route::post('/expire-coupon', 'AdminController@setExpire')->name('admin-expire-coupon');
	Route::post('/status-coupon', 'AdminController@setActive')->name('admin-active-coupon');
	Route::post('/delete-trip', 'AdminController@deleteTrip')->name('admin-delete-trip');
	
});

Route::group(['namespace' => 'Chef', 'prefix' => 'chef', 'middleware' => ['chef']], function () {
	Route::get('/', 'ChefController@getProfile');	
	Route::get('/profile', 'ChefController@getProfile');
	Route::get('/menus', 'ChefController@getMenus')->name('menus');
	Route::post('/change-password', 'ChefController@changePassword');	
	Route::get('/payment-info', 'ChefController@getPaymentInfo')->name('payment-info');
	Route::get('/payment-edit', 'ChefController@getPaymentEdit')->name('payment-edit');
	Route::post('/save-payment-info', 'ChefController@savePaymentInfo')->name('save_payment_info');
	Route::post('/chef-payment-requests', 'ChefController@sendRequest')->name('chef-payment-requests');	
	Route::post('/update-profile', 'ChefController@updateProfile')->name('chef-update-profile');
	Route::get('/add-menu', 'ChefController@addMenuPage');
	Route::get('/requests', 'ChefController@getRequests')->name('chef-requests');
	Route::post('/save-menu', 'ChefController@saveMenu')->name('save-menu');
	Route::post('/delete-menu', 'ChefController@deleteMenu')->name('chef-delete-menu');
	Route::match(['get', 'post'], '/edit-menu/{id}', 'ChefController@editMenuPage');
	Route::post('/req-confirm', 'ChefController@requestConfirm');	
	Route::post('/req-decline', 'ChefController@requestDecline');
	Route::post('/req-completed', 'ChefController@requestCompleted');
	Route::get('/messages', 'ChefController@getMessages')->name('chef-messages');
	Route::match(['get', 'post'], '/set-dates', 'ChefController@setDates')->name('chef-dates');
	Route::post('/loadmsgs', 'ChefController@loadMessages');
	Route::post('/send-msg', 'ChefController@sendMessage');
	Route::post('/read-msg', 'ChefController@readMsg');
	
	Route::get('/notification', 'ChefController@getNotification')->name('chef-notification');
	Route::post('/update-dates', 'ChefController@updateDates')->name('chef-update-dates');
	Route::post('/get-booking', 'ChefController@getBooking')->name('chef-get-booking');

});

Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['user']], function () {
	Route::get('/', 'UserController@getProfile');
	Route::get('/profile', 'UserController@getProfile');
	Route::post('/update-profile', 'UserController@updateProfile')->name('user-update-profile');
	Route::post('/change-password', 'UserController@changePassword');	
	Route::post('/add-to-fav', 'UserController@addToFav')->name("add-to-fav");
	Route::post('/remove-to-fav', 'UserController@removeToFav')->name("remove-to-fav");
	Route::get('/favorites', 'UserController@getFavs')->name("user-favorites");
	Route::get('/messages', 'UserController@getMessages')->name('user-messages');
	Route::post('/loadmsgs', 'UserController@loadMessages');
	Route::post('/send-msg', 'UserController@sendMessage');
	Route::post('/read-msg ', 'UserController@readMsg');
	Route::post('/cancel-booking', 'UserController@cancelBooking')->name('user-cancel-booking');
	Route::get('/requests', 'UserController@getRequests')->name('user-requests');
	Route::post('/payment', 'UserController@makePayment')->name('user-payment');
	Route::get('/add-review/{id}', 'UserController@addReview');
	Route::post('/submit-review', 'UserController@submitReview');

	Route::get('/notification', 'UserController@getNotification')->name('user-notification');
	Route::post('/add-card', 'UserController@addCard')->name('user-add-card');
	Route::post('/user-delete-card', 'UserController@deleteCard')->name('user-delete-card');

	
});

Route::post('/photo-upload', 'HomeController@photoUpload');

Route::get('/auto-list', 'HomeController@autoComplete');
Route::get('/auto-list-zip', 'HomeController@autoListZip');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/terms-and-conditions', 'HomeController@termsConditions')->name('terms-and-conditions');
Route::get('/contact-us', 'HomeController@contactUs')->name('contact-us');
Route::post('/contactus-store', 'HomeController@contactUsStore')->name('contactus.store');
Route::get('/policies', 'HomeController@policies')->name('policies');
Route::get('/about-us', 'HomeController@aboutUs')->name('about-us');

Route::get('/menu-listing', 'HomeController@searchResult')->name("menu-listing");
Route::post('/search-data', 'HomeController@searchData')->name("search-data");

Route::get('/chef/{id}', 'HomeController@chefDetails')->name("chef-detail");

Route::get('/user-register', 'HomeController@userRegisterPage')->name('user-register');
Route::get('/chef-register', 'HomeController@chefRegisterPage')->name('chef-register');
Route::post('/check-time', 'HomeController@checkTime')->name('check-time');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::match(['get', 'post'], '/checkout', 'HomeController@checkoutPage')->name('checkout');
Route::post('/pay', 'HomeController@payChef');

Route::get('/thank-you', 'HomeController@paymentMade')->name('thank-you');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});