@extends('layouts.main')

@section('title', 'Payment Info')

@section('content')

<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Chef's Payment Information</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->
<style>
.alert.alert-success {
    color:#0c0;
}
</style>
<section class="body-data-box">  
    <div class="container-fluid">
            <!-- register  -->
            <div class="row">
                @include('layouts.slic.chef_sidebar')
                <div class="col-lg-9 col-md-8 pl-lg-4 content">
                    <!--<div class="vc-element-grid text-left">
                        <h3 class="title-heading-small">Account</h3>
                    </div>-->
                <div class="">
                <div class="page-inner-section-main">                  
                    <!--<div class="box-section-title">Account</div>-->						
						<form class="edit-profile-form-box" action="{{ route('save_payment_info') }}" method="post">
							<div class="my-3">
								@if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@endif
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul class="m-0">
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
							</div>
							@csrf
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>First name</label>
										<input type="text" name="first_name" value="{{@$details['first_name']}}" class="form-control" placeholder="First name" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Last name</label>
										<input type="text" name="last_name" value="{{@$details['last_name']}}" class="form-control" placeholder="Last name" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>DOB</label>
										<input type="date" name="dob" value="{{@$details['dob']}}" class="form-control" placeholder="DOB" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Routing Number</label>
										<input type="text" name="routing_number" value="{{@$details['routing_number']}}" class="form-control" placeholder="Routing Number" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Account Number</label>
										<input type="text" name="account_number" value="{{@$details['account_number']}}" class="form-control" placeholder="Account Number" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Address</label>
										<input type="text" name="address1" value="{{@$details['address1']}}" class="form-control" placeholder="Address" required>
									</div>
								</div>								
								<div class="col-lg-4">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" name="phone" value="{{@$details['phone']}}" class="form-control" placeholder="Phone" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>City</label>
										<input type="text" name="city" value="{{@$details['city']}}" class="form-control" placeholder="City" required>
									</div>
								</div>
								
							</div>
							<div class="row">								
								<div class="col-lg-4">
									<div class="form-group">
										<label>State</label>
										<select value="" class="form-control" name="state" id="state" value="{{@$details['state']}}" required style="padding: 6px 8px!important;"><option value="">State</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Country</label>
										<select name="country" value="{{@$details['country']}}" class="form-control" required style="padding: 6px 8px!important;">
											<option value="">Select Country</option>
											<option value="US">Unites States</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Zip</label>
										<input type="text" name="zip" value="{{@$details['zip']}}" class="form-control" placeholder="Zip" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Industry</label>
										<select name="mcc" value="{{@$details['mcc']}}" class="form-control" required="">
											<option value="" selected="selected">Select Industry</option>
											<option value="1520">General Contractors-Residential and Commercial</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Website</label>
										<input type="text" name="website" value="{{@$details['website']}}" class="form-control" placeholder="Website" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>SSN LAST 4</label>
										<input type="text" name="ssn_last_4" value="{{@$details['ssn_last_4']}}" class="form-control" placeholder="SSN LAST 4" required>
									</div>
								</div>
							</div>
							<div class="row">
							<input type="hidden" name="account_type" value="custom">
							<!-- 
							<div class="col-md-6">
								<label class="col-form-label">Business Type</label>
								<select name="business_type" class="custom-select dark"  required style="display: block !important;">
									<option value="">Select</option>
									<option value="business_type" <?php if($details['business_type'] == "business_type") echo "selected"; ?> >Business Type</option>
									<option value="individual" <?php if($details['business_type'] == "individual") echo "selected"; ?>>Individual</option>
								</select>
								
							</div>
							<div class="col-md-6">
								<label class="col-form-label">Country</label>
								<select name="country" class="custom-select dark" required style="display: block !important;">
									<option value="">Select</option>
									<option value="US" <?php if($details['country'] == "US") echo "selected"; ?> >US</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="col-form-label">Currency</label>
								<select name="currency" class="custom-select dark" required style="display: block !important;">
									<option value="">Select</option>
									<option value="usd" <?php if($details['currency'] == "usd") echo "selected"; ?> >USD</option>
								</select>
							</div>
						    -->
						   <!-- <div class="col-md-6">
								<label class="col-form-label">Name</label>
								<input type="text" class="" name="name" value="{{$details['name']}}" required="">
							</div>
							
							<div class="col-md-6">
								<label class="col-form-label">Routing Number</label>
								<input type="text" class="" name="routing_number" value="{{$details['routing_number']}}" required="">
							</div>
							<div class="col-md-6">
								<label class="col-form-label">Account Number</label>
								<input type="text" class="" name="account_number" value="{{$details['account_number']}}" required="">
							</div>    -->                                 
							<div class="col-md-12 text-center mt-4">
								<input type="submit" name="submit" value="Submit">
							</div>
						</form>
					</div>
					</div>
					</div>
				</div>
            </div>
            <!-- //register -->
        
    </div>
</section>
@endsection
