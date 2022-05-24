@extends('layouts.chef-header')

@section('title', 'Profile')

@section('content')


<div class="profile_section ">
  <div class=" container">
    <div class="profile_path">
      <a href="#">Account > </a>
      <a href="#"> Personal Info </a>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="booking_section row">
      <div class="col-md-7 col_left">
        <div class="contetn_left_div">
          <h3 class="h3_profile">Account</h3>
          <div class="banking_information_form mt-4">
            <form action="{{ url('user/update-profile') }}" method="post" class="edit-profile-form-box">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="first_name" placeholder="First name" value="{{$profile->first_name}}" />
                </div>
                <div class="col-md-12">
                  <input type="text" name="last_name" placeholder="Doe" value="{{$profile->last_name}}" placeholder="Last name" />
                </div>
                <div class="col-md-12">
                  <input type="text" name="email" value="{{$profile->email}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" />
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-12">
                  <input type="text" placeholder="Address" name="address" value="{{$profile->address}}" />
                </div>
                <div class="col-md-6">
                  <input type="text" placeholder="City" name="city" value="{{$profile->city}}" />
                </div>
                <div class="col-md-6">
                  <input type="text" name="state" placeholder="State" value="{{$profile->state}}" />
                </div>
                <div class="col-md-6">
                  <input type="text" placeholder="Zip Code" name="zip" value="{{$profile->zip}}" />
                </div>
                <div class="col-md-6">
                  <input type="tel" name="phone_number" placeholder="Phone Number" value="{{$profile->phone_number}}">
                </div>
                <div class="mt-3">
                  <!-- <input type="submit"  class="btn_c btn_chef" name="UPDATE" value="UPDATE PROFILE" /> -->
                  <a class="btn_c btn_chef"><button type="submit"> UPDATE PROFILE</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-5 col-right">
        <div class="content_right_div">
          <div class="content_detail_text">
            <img src="images/lock.png" alt="">
            <h4>Which details can be edited?</h4>
            <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
          </div>
          <div class="content_detail_text">
            <img src="images/busines_card.png" alt="">
            <h4>What info is shared with others?</h4>
            <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
@endsection