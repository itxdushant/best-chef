@extends('layouts.main')

@section('title', 'Register')

@section('styles')
  <link rel="stylesheet" href="{{asset('css/croppie.css')}}">
@endsection

@section('content')

<!-- banner -->
<section class="inner-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">JOIN</h1>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //banner -->

<div class="content-wrap">
	
	<div class="register-main-section">
		<div class="container">
			<!-- register  -->
			<div class="row">
				<div class="col-md-10 col-lg-8 offset-lg-2 offset-md-1">
					<div class="row flex-md-row-reverse">
						<div class="col-md-8">
							<div class="vc-element-grid text-md-right mb-2 novisible">
								<span class="hidden-signupwith" style="font-size:13px;">or Sign up with</span>
								<!--Facebook-->
								<a href="{{ url('/auth/google') }}" class="btn btn-gplus mb-2"><i class="fa fa-google"></i> Google +</a>
								<!--Google +-->
								<a href="{{ url('/auth/facebook') }}" class="btn btn-fb mb-2"><i class="fa fa-facebook"></i> Facebook</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="vc-element-grid text-left">
								<h3 class="title-heading-medium"><!--<span class="hidden-lg">or</span> -->Join Now</h3>
							</div>
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif
						</div>
					</div>
					<form class="register-form-grid" id="reg" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="user_type" value="user">
						
						<div class="row">
							<div class="form-group col-sm-6 pr-sm-1">
								<label class="col-form-label">First Name</label>
								<input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
								@if ($errors->has('first_name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('first_name') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group col-sm-6 pl-sm-1">
								<label class="col-form-label">Last Name</label>
								<input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
								@if ($errors->has('last_name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('last_name') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						<?php /* ?><div class="form-group">
							<!-- <input id="profile_pic" type="file" name="profile_pic">                        -->
							<div class="row">
								<div class="col-md-6">
									<div class="text-center">
										<div id="upload-demo" style="width:300px;"></div>
									</div>
									<label class="col-form-label">Profile Pic</label><br>
									<!-- <strong>Select Image:</strong> -->
									<br/>
									<input type="file" id="upload">
									<input type="hidden" id="picdata" name="picdata" value="{{ old('picdata') }}" >
									<br/>
									<button type="button" class="btn btn-success upload-result mt-3" style="display: none;">Set Image</button>
								</div>
							</div>
						</div><?php */?>
						<div class="row">
							<div class="form-group col-sm-6 pr-sm-1">
								<label class="col-form-label">Email</label>
								<input id="remail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
								@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group col-sm-6 pl-sm-1">
								<label class="col-form-label">Phone Number</label>
								<input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>
								@if ($errors->has('phone_number'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('phone_number') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6 pr-sm-1">
								<label class="col-form-label">Password</label>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
								@if ($errors->has('password'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group col-sm-6 pl-sm-1">
								<label class="col-form-label">Confirm Password</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div>
						
						<div class="my-1">
							<input type="checkbox" id="brand1" value="yes" required="">
							<label for="brand1">
								<span></span> I accept to the <a href="{{route('terms-of-use')}}" style="font-size:1rem;" target="_blank">Terms of Use</a> and <a href="{{route('privacy-policy')}}" style="font-size:1rem;" target="_blank">Privacy Policy</a>.</label>
						</div>
							<div class="my-1">
						   		<div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
						   </div>
						    @if ($errors->has('g-recaptcha-response'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
		                        </span>
		                    @endif
							
							<button type="submit" class="btn btn-default more-btn btn-block regg">Join</button>
							
						</form>
					</div>
				</div>
				<!-- //register -->
			</div>
		</div>
	</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?
onload=onloadCallback
&render=explicit
' async defer>
</script>
<script src="{{asset('js/croppie.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
	
    var $uploadCrop = "";
    $('#upload').on('change', function () { 
        $('#upload-demo').croppie('destroy');
        $('.upload-result').show();
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });


    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
        	$("#picdata").val(resp);
            $('#upload-demo').croppie('destroy');
            $('.upload-result').hide();
        });
    });
});
</script>

@endsection
@endsection
