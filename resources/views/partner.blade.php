@extends('layouts.main')
@section('styles')
@endsection

@section('title', 'About Us')

@section('content')

<!-- banner -->
<section class="inner-page-banner" style="background-image:url('{{asset('/public/img/partner-page-banner.jpg')}}')">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Become a Best Local Chef Partner</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<div class="content-wrap">
<section class="pb-lg-3">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 offset-md-1 offset-lg-2">
			    <h2 class="section-main-title text-center">
					Do you own a short term rental?
				</h2>
			   <p class="text-center my-3 my-md-5">Stand out from competitors and increase the value of your short term rental by offering personal, in-home chef services. Complete the form below and one of our representatives will be in contact with you soon for approval</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-10 offset-md-1 offset-lg-2">
				<!-- Single post section -->
				  @if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				@if (session('warning'))
					<div class="alert alert-warning">
						{{ session('warning') }}
					</div>
				@endif			
				<form class="partner edit-profile-form-box chef-account" method="post" action="{{ route('partnercontactus.partner') }}" onsubmit="return submitUserForm();">
				  {{ csrf_field() }}				
				   <div class="row">
						<div class="col-md-6 col-lg-6">							
							<div class="form-group">
								<input type="text" name="f_name" class="form-control" placeholder="First name *"  required />
								@if ($errors->has('f_name'))
											<span class="help-block">
												<strong>{{ $errors->first('f_name') }}</strong>
											</span>
					 @endif
								
							</div>
						</div>	
						<div class="col-md-6 col-lg-6">							
							<div class="form-group">
								<input type="text" name="l_name" class="form-control" placeholder="Last name *"  required />@if ($errors->has('l_name'))
											<span class="help-block">
												<strong>{{ $errors->first('l_name') }}</strong>
											</span>
								@endif							
							</div>
						</div>
						<div class="col-md-6 col-lg-6">								
							<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								<input type="email" name="email" class="form-control" placeholder="Email *"  required />	 @if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
								 @endif							 
							</div>
						</div>
						<div class="col-md-6 col-lg-6">								
							<div class="form-group">
								<input type="tel" name="phone" class="form-control" placeholder="Phone number *"  required />	 @if($errors->has('phone'))
											<span class="help-block">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
								 @endif								 
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<input type="text" name="location" class="form-control" placeholder="City/State *"  required />		@if($errors->has('location'))
											<span class="help-block">
												<strong>{{ $errors->first('location') }}</strong>
											</span>
								 @endif							 
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
								<select name="shortrental"  class="form-control custom-select dark"  required>   
									<option value="">Select your short term rental</option>
									<option value="AirBnB">AirBnB</option>
									<option value="Personal Rental">Personal Rental</option>
									<option value="HomeAway">HomeAway</option>
									<option value="OneFine Stay">OneFine Stay</option>
									<option value="Other">Other</option>									
								</select>	
									@if($errors->has('type'))
											<span class="help-block">
												<strong>{{ $errors->first('type') }}</strong>
											</span>
								 @endif									
							</div>
						</div>		
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="6LcpOqkUAAAAAEEY_dKuyUsDjHgTzqyBkTs3PMm5"  data-callback="verifyCaptcha"></div>
								<div id="g-recaptcha-error"></div>
							</div>
						</div>			
						<div class="col-md-12 col-lg-12">						
							<div class="form-group">
								<input type="submit" name="btnSubmit" class="btn btn-primary btn-round btn-md contact-submit-btn" value="SUBMIT" />
							</div>
						</div>
					</div>
				</form>
			</div>			
			<div class="clearfix"></div>
		</div>
	</div>
</section>    
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function submitUserForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
 
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>
@section('scripts')

@endsection
@endsection