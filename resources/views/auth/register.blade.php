@extends('layouts.header')

@section('title', 'Register')

@section('content')

<div class="login_section ">
  <div class="container">
    <div class="login_sign_up">
      <h3>Sign up</h3>
    </div>

    <div class="input_fields">
      <h4>Welcome to Best Local Chef</h4>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">

          <div class="col-md-6">
            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>
            @if ($errors->has('first_name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('first_name') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-md-6">
            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus>
            @if ($errors->has('last_name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('last_name') }}</strong>
            </span>
            @endif

          </div>
          <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-md-6">
            <input type="text" name="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" placeholder="Phone Number" value="{{ old('phone') }}" required>
            @if ($errors->has('phone_number'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-md-6 form-group">
            <select name="user-type" id="form-select-user" class="form-select{{ $errors->has('user-type') ? ' is-invalid' : '' }}">
              <option value="" selected>Chef or Customer</option>
              <option value="chef" {{old('user-type')=='chef' ? 'selected':''}}>Chef</option>
              <option value="user" {{old('user-type')=='user' ? 'selected':''}}>Customer</option>

            </select>
            @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('user-type') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-md-6">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="confirm_msg col-md-12">
            <span>We’ll call or text you to confirm your number. Standard message and data rates apply.<a href="#">Privacy Policy.</a> </span>
          </div>
          <div class="col-md-12">
            <a class="btn_c btn_chef"><button type="submit" class="btn btn-default more-btn btn-block">Continue </button></a>
          </div>

        </div>
    </div>
    </form>
    <div class="social_links">
      <span>or</span>
      <a class="btn_c btn_chef" href="# "><img src="images/facebook (1).png">Continue with Facebook</a>
      <a class="btn_c btn_chef" href="# "><img src="images/google.png">Continue with Google</a>
    </div>
  </div>
</div>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
@endsection