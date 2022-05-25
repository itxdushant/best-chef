@extends('layouts.header')

@section('title', 'Join As A Chef')

@section('content')
<!-- chef header -->
<div class="location_date_section location_d_s_2">
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
    <div class="container d-flex justify-content-center">
        <form class="banner-search pl-md-4" method="GET" action="" id="search-form" autocomplete="off">
        @csrf
        <div class="form fields_form">
            <div class="location">
            <input type="text" name="type" value="search" />
            <label for="">Location</label>
            <input type="text" value="<?php if (isset($_GET['service_area'])) echo $_GET['service_area'] ?>" name="service_area" class="search-box-zip" placeholder="What's your Zip Code" />
            </div>
            <div class="date">
            <label for="">Date</label>
            <input type="date" value="<?php if (isset($_GET['available_dates'])) echo $_GET['available_dates'] ?>" name="available_dates" class="date" placeholder="Add Dates" />
            </div>
            <div class="time">
            <label for="">Time</label>
            <select class="custom-select" name="time" value="<?php if (isset($_GET['time'])) echo $_GET['time'] ?>">
                <option value="">Add Times</option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "12:00 AM") echo "selected"; ?> value="12:00 AM"> 12:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "01:00 AM") echo "selected"; ?> value="01:00 AM"> 01:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "02:00 AM") echo "selected"; ?> value="02:00 AM"> 02:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "03:00 AM") echo "selected"; ?> value="03:00 AM"> 03:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "04:00 AM") echo "selected"; ?> value="04:00 AM"> 04:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "05:00 AM") echo "selected"; ?> value="05:00 AM"> 05:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "06:00 AM") echo "selected"; ?> value="06:00 AM"> 06:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "07:00 AM") echo "selected"; ?> value="07:00 AM"> 07:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "08:00 AM") echo "selected"; ?> value="08:00 AM"> 08:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "09:00 AM") echo "selected"; ?> value="09:00 AM"> 09:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "10:00 AM") echo "selected"; ?> value="10:00 AM"> 10:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "11:00 AM") echo "selected"; ?> value="11:00 AM"> 11:00 AM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "12:00 PM") echo "selected"; ?> value="12:00 PM"> 12:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "01:00 PM") echo "selected"; ?> value="01:00 PM"> 01:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "02:00 PM") echo "selected"; ?> value="02:00 PM"> 02:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "03:00 PM") echo "selected"; ?> value="03:00 PM"> 03:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "04:00 PM") echo "selected"; ?> value="04:00 PM"> 04:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "05:00 PM") echo "selected"; ?> value="05:00 PM"> 05:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "06:00 PM") echo "selected"; ?> value="06:00 PM"> 06:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "07:00 PM") echo "selected"; ?> value="07:00 PM"> 07:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "08:00 PM") echo "selected"; ?> value="08:00 PM"> 08:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "09:00 PM") echo "selected"; ?> value="09:00 PM"> 09:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "10:00 PM") echo "selected"; ?> value="10:00 PM"> 10:00 PM </option>
                <option <?php if (isset($_GET['time']) && $_GET['time'] == "11:00 PM") echo "selected"; ?> value="11:00 PM"> 11:00 PM </option>
            </select>
            </div>
            <div class="Search">
            <label for="">Preference</label>
            <select class="custom-select prefrences" name="meal_prefrences" value="<?php if (isset($_GET['prefrences'])) echo $_GET['prefrences'] ?>">
                <option value="">Meal Type</option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Meat") echo "selected"; ?> value="Meat"> Meat</option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegan") echo "selected"; ?> value="Vegan">Vegan</option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegetarian ") echo "selected"; ?> value="Vegetarian"> Vegetarian </option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Athlete ") echo "selected"; ?> value="Athlete"> Athlete </option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Plant_based ") echo "selected"; ?> value="Plant_based"> Plant-based</option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Gluten_free") echo "selected"; ?> value="Gluten_free"> Gluten-free </option>
                <option <?php if (isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Other") echo "selected"; ?> value="Other"> Other </option>
            </select>
            </div>
            <div>
            <button type="button" id="findChef"><img src="{{asset('images/search.png')}}"></button>
            </div>
        </div>
        </form>
    </div>

    </div>
    <div class="best_chef_join_as_section">
       <div class="row">
        <div class="col-lg-6 col-md-12 left_div">
          <h3>Best local chefs, near you</h3>
          <a href="#" class="btn_c">Join</a>
        </div>
        <div class="col-lg-6 col-md-12 right_div">
           <h3>Charlie</h3>
           <p>Chef of Best Local Chef</p>
        </div>
       </div>
    </div>
    <!-- another section -->
     <div class="cook_serve_section">
       <div class="container">
          <h2>Cook & serve, deliver, or a cooking class</h2>
          <div class="row">
          <div class="col-md-4">
            <img src="images/cook_1.jpg" class="img-fluid">
          </div>
          <div class="col-md-4">
            <img src="images/cook_2.jpg" class="img-fluid">
          </div>
          <div class="col-md-4">
            <img src="images/cook_3.jpg" class="img-fluid">
          </div>
          </div>

          <div class="cook_slider">
            <div id="cook_sliders" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="content_slider">
                       <p>Hosting my home allowed me to become an entrepreneur and laid down a path to financial freedom.</p>
                       <div class="">
                          <h4>Darrel</h4>
                          <span>Chef of Best Local Chef</span>
                       </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="content_slider">
                        <p>Hosting my home allowed me to become an entrepreneur and laid down a path to financial freedom.</p>
                        <div class="">
                           <h4>Darrel</h4>
                           <span>Chef of Best Local Chef</span>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                    <div class="content_slider">
                        <p>Hosting my home allowed me to become an entrepreneur and laid down a path to financial freedom.</p>
                        <div class="">
                           <h4>Darrel</h4>
                           <span>Chef of Best Local Chef</span>
                        </div>
                     </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#cook_sliders" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#cook_sliders" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
          </div>

       </div>
     </div>

    <!-- another section -->
     <div class="chef_cover_section">
      <div class="container">
      <div class="checf_cover_text">
         <h3>Chef<span>Cover</span></h3>
         <p>Top-to-bottom protection. 
            Free for Chefs. Only on 
            Best Local Chef.</p>
         <a href="#" class="btn_c btn_chef">Join Today</a>
      </div> 
      </div>
     </div>
@endsection