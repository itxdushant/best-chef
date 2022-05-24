@extends('layouts.header')

@section('title', 'Login')

@section('content')

<div class="login_section ">
    <div class="container">
      <div class="login_sign_up">
      <h3>Login</h3>
      </div>

      <div class="input_fields">
              <h4>Welcome back to Best Local Chef</h4>
              <div>
			  <form class="login-form-grid"  method="POST" action="{{ route('login') }}">
						@csrf
					<div class="form-group">
						<label class="col-form-label">Email</label>
						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
						@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-form-label">Password</label>
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
						@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					<a class="btn_c btn_chef"><button type="submit" class="btn btn-default more-btn btn-block">Continue</button></a>
			    </form>
				</div>
      </div>

      <div class="social_links">
        <span>or</span>
        <a class="btn_c btn_chef" href="# "><img src="images/facebook (1).png">Continue with Facebook</a>
        <a class="btn_c btn_chef" href="# "><img src="images/google.png">Continue with Google</a>
      </div>
    </div>
    </div>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
@endsection