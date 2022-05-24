@extends('layouts.main')
@section('styles')
@endsection

@section('title', 'Chef How-To Forum')

@section('content')

<style>
.cont {
    border-top: 1px solid #eee;
    padding: 30px 0px;
    margin-top: 0px;
}
div#cont {
    border: none;
    padding-top: 0px;
}
.cont strong {
    display: block;
    margin-bottom: 10px;
    font-weight: 900;
    color: #000;
    font-size: 20px;
}
.cont b {
    display: block;
    margin-bottom: 10px;
    font-weight: 900;
    color: #000;
    font-size: 20px;
}
.cont p {
    color: #666;
    line-height: 30px;
}
hr.top-hr {
    border-width: 3px;
    border-color: #000;
    margin-bottom: 50px;
}
.right-content h4 strong {
    font-weight: 900 !important;
    font-size: 40px;
    margin: 20px 0px;
    display: block;
    color: #000;
}
.cont ol li {
    margin-left: 30px;
    margin-bottom: 0;
    margin-top: 0px;
    line-height: normal;
    color: #d3ab55;
}
.cont ul li {
    padding: 0px 0px;
    margin-left: 20px;
    font-weight: normal;
    line-height: 35px;
    list-style: disc;
}	
</style>

<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Chef How-To Forum</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<div class="content-wrap">
    <section class="mt-4 py-lg-3">
        <div class="container">
            <div class="row">				
				<div class="col-md-12">	
					<div id="accordion">
						<div class="card">
							<div class="card-header">
							  <a class="card-link" data-toggle="collapse" href="#collapse1">
								Complete your profile
							  </a>
							</div>
							<div id="collapse1" class="collapse show" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>After you’ve joined Best Local Chef visit the profile tab of your account.</li>
									<li>Fill in all required fields</li>
									<li>Videos of your work and certifications can help increase your chances of getting booked</li>
									<li>Click the ADD MORE button to add more certifications</li>
									<li>Click Update Profile to update your profile details</li>
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse2">
								Update your calendar
							  </a>
							</div>
							<div id="collapse2" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>Go to the profile tab in your account</li>
									<li>Scroll down to Available Dates</li>
									<li>By default all dates are not selected.</li>
									<li>To add an available date, select the date(s) you are available and click SUBMIT</li>
									<li>If you’d like to make yourself available for the entire month click Select All, and SUBMIT</li>
									<li>To make yourself completely unavailable click Clear All, and SUBMIT</li>
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
								Upload a meal
							  </a>
							</div>
							<div id="collapse3" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>Go to the Meals tab on your account </li>
									<li>Choose ADD NEW MEAL</li>
									<li>Select Meal, Dessert, or Appetizer from the dropdown </li>
									<li>Complete all necessary fields</li>
									<li>Click Submit Meal</li>
									<li>After a meal is upload you have the ability to edit, disable, or delete that meal</li>
									<li>To view your meal on your profile select VIEW PROFILE</li>
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
								Accept a booking request
							  </a>
							</div>
							<div id="collapse4" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>When a customer sends a booking request for an item(s) on your menu you’ll receive a notification in your notifications tab</li>
									<li>You can also go to the Requests tab on your account</li>
									<li>Go to New Request where you’ll see request details</li>
									<li>Choose to Accept or Decline the request</li>
									<li>NOTE: If a customer books a date and time that has a conflict with your schedule but you’d still like to accept the request, message the customer to figure out a time they’ll work for you and the customer</li>
									<li>If you receive a booking request that has conflict with your schedule and you cannot fulfill it, select Decline</li>
									<li>If a customer declines a request within 1 hour of delivery, you still receive a partial payment</li>   
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
								Completed bookings
							  </a>
							</div>
							<div id="collapse5" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>All past booking requests that have been completed are shown here</li>    
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
								Messaging customers
							  </a>
							</div>
							<div id="collapse6" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>When a customer sends you a booking requests to you can message them directly</li>    
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse7">
								Decline a booking request
							  </a>
							</div>
							<div id="collapse7" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>All declined booking requests will show here</li>    
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse8">
								Active requests
							  </a>
							</div>
							<div id="collapse8" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>All bookings you’ve accepted but have not been completed will show here</li>
									<li>If you need to cancel your booking select Cancel </li>									
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse9">
								How to get paid
							  </a>
							</div>
							<div id="collapse9" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>Go to the Payment tab on your account</li>
									<li>Enter you banking information to receive weekly payments for bookings completed</li>
									<li>Review completed Payments List</li>
									<li>To ensure you receive weekly payouts for completed jobs select REQUEST PAYMENT for all completed bookings on the Payment List</li>    
								</ul>
								<b>NOTE:</b>
								<ul>
									<li>Payouts are processed directly to your bank account, that’s set on your account, Tuesday morning of every week.</li>
									<li>After a customer has submitted payment and gave a tip you’ll receive a notification to view the amount you received</li>    
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse10">
								How payments work
							  </a>
							</div>
							<div id="collapse10" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>Best Local Chef receives 20% of all completed bookings</li>
									<li>Chefs receive 80% of all completed bookings</li>
									<li>Chefs keep 100% of all tips from customers</li>
								</ul>
							  </div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
							  <a class="collapsed card-link" data-toggle="collapse" href="#collapse11">
								Support and Customer Service 
							  </a>
							</div>
							<div id="collapse11" class="collapse" data-parent="#accordion">
							  <div class="accordion-data">
								<ul>
									<li>If you have any questions or issues you can contact one of our team members at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com</a></li>    
								</ul>
							  </div>
							</div>
						</div>
					</div> 
				</div>
			</div>
        </div>
    </section>    
</div>

@section('scripts')

@endsection
@endsection