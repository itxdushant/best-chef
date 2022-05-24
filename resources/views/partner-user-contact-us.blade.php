@extends('layouts.main')
@section('styles')
@endsection

@section('title', 'Contact us')

@section('content')

<!-- banner -->
<section class="inner-page-banner contact-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Contact us</h1>
					<p class="page-sub-title">For your Next Fine Dining Experience<br/> No Matter Where You Are</p>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<div class="content-wrap">
    <section class="pt-lg-3">
        <div class="container">
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
		
				<form method="post" action="{{ route('contactus.store') }}">
					{{ csrf_field() }}
					
				   <div class="row">
						<div class="col-md-12 col-lg-12">
							<!--<h3 class="mb-md-4">Contact Us</h3>-->
							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<input type="text" name="name" class="form-control" placeholder="Your Name *"  required />
					 @if ($errors->has('name'))
											<span class="help-block">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
					 @endif
							</div>
							<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								<input type="email" name="email" class="form-control" placeholder="Your Email *"  required />
								 @if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
								 @endif
							</div>
							<div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
								<input type="text" name="location" class="form-control" placeholder="Your Location *"  required />	 @if ($errors->has('location'))
											<span class="help-block">
												<strong>{{ $errors->first('location') }}</strong>
											</span>
							@endif							 
							</div>							
							<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
								<select name="type" class="form-control custom-select dark" required>   
									<option value="Chef">Who am I?</option>
									<option value="Chef">Chef</option>
									<option value="Customer">Customer </option>
									
								</select>
								@if ($errors->has('type'))
										<span class="help-block">
											<strong>{{ $errors->first('type') }}</strong>
										</span>
								 @endif
							</div>
							
							<div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
										<textarea name="message" class="form-control" placeholder="Message" style="width: 100%; height: 150px;" required></textarea>
							 @if ($errors->has('message'))
							<span class="help-block">
							<strong>{{ $errors->first('message') }}</strong>
							</span>
							@endif
							</div>
							<div class="form-group">
								<input type="submit" name="btnSubmit" class="btn btn-primary btn-round btn-md contact-submit-btn" value="Send Message" />
							</div>
							</div>

						</div>
				</form>
				</div>
				<!--<div class="col-md-6">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d440899.73490213486!2d-98.03359109115286!3d30.30746242142474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8644b599a0cc032f%3A0x5d9b464bd469d57a!2sAustin%2C+TX%2C+USA!5e0!3m2!1sen!2sin!4v1562311049709!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>-->
				<div class="clearfix"></div>
			</div>
        </div>
    </section>    
</div>

@section('scripts')

@endsection
@endsection