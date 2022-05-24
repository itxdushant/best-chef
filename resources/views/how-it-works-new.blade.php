@extends('layouts.main1')
@section('styles')
<link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection
@section('content')
<?php
foreach ($topchefs as $topchef) {
  $tchefs[] = $topchef;
}


?>
<!-- another section -->
<div class="location_date_section">
  <div class="container d-flex justify-content-center">
    <form class="banner-search pl-md-4" method="GET" action="" id="search-form" autocomplete="off">
      @csrf
      <div class="form fields_form">
        <div class="location">
          <input type="text" name="type" value="home" />
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

<!-- another section -->

<div class="chef_demand_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ">
        <h3>Your Personal Chef. On-Demand.</h3>
        <a href="{{route('menu-listing')}}" class="btn_chef">Find a Chef</a>
      </div>
    </div>
  </div>
</div>

<!-- another section -->
<div class="best_chef_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ">
        <span>Welcome to</span>
        <h3>Best <br>
          Local Chef</h3>
        <a href="{{route('menu-listing')}}" class="btn_chef">Chef Near Me</a>
      </div>
    </div>
  </div>
</div>
<!-- another section -->
<!-- slider -->
<div class="chef_slider">
  <div class="container">
    <div class="slider_heading">
      <h3 class="h3_tittle">What’s Your Meal Preference?</h3>
      <a href="#">VIEW ALL MEAL PREFERENCES</a>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active ist_slide">
          <div class="row">

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_1">
                  <h3>Meat</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_2">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_3">
                  <h3>Vegetarian</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_4">
                  <h3>Athlete</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="carousel-item scnd_slide">
          <div class="row">

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_1">
                  <h3>Plant_based</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_2">
                  <h3>Gluten_free</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_3">
                  <h3>Others</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_4">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="carousel-item third_slide">
          <div class="row">

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_1">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_2">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_3">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card_meals">
                <img src="{{asset('images/card_meal1.jpg')}}">
                <div class="chef_content bg_cntent_4">
                  <h3>Vegan</h3>
                  <span>3 miles away</span>
                  <a href="">VIEW CHEFS <img src="{{asset('images/next_arrow.png')}}"></a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>
<!-- another section -->
<div class="chef_discover_section">
  <div class="container">
    <h3 class="h3_tittle">Discover Chef Experiences</h3>
    <div class="row">
      <div class="col-md-6">
        <div class="card_discover Services">
          <h4>Personal Chef Services </h4>
          <a href="{{route('chef-list')}}" class="btn_chef">Services</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card_discover chif_find">
          <h4>Special
            <br>Occations
          </h4>
          <a href="{{route('menu-listing')}}" class="btn_chef">Find a Chef</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- another section -->
<div class="questions_about">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>Questions about<br> meals?</h3>
        <a href="#" class="btn_chef">Ask a Chef</a>
      </div>
    </div>
  </div>
</div>
<!-- another section -->
<div class="qa_section">
  <div class="container">
    <div class="qa_div">
      <h4>Discover what Best Local Chef is about</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>

    <div class="qa_div">
      <h4>Here’s what makes a chef experience perfect for you</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    0
    // $('.date').datepicker({
    //     startDate: moment().format('mm/dd/yyyy'),
    //     format: 'mm/dd/yyyy',
    //     autoclose: true
    // })

    setTimeout(function() {
      $(".loading-div").show()
      let formData = $("#search-form").serialize();

      $.ajax({
        type: "POST",
        url: "{{ url('/search-data?serachfalse')}}",
        data: formData,
        success: function(data) {
          $(".loading-div").hide()
          let chefs_near = data.chefs_near || [];
          $(".records").text(Object.keys(data.chefs).length)
          $(".records_near").text(Object.keys(chefs_near).length)
          if (Object.keys(data.chefs).length) {
            let chefs = data.chefs;
            let favs = data.favs;
            renderHtml(chefs, favs);
            renderHtmlNearBy(chefs_near, favs);
            if (!Object.keys(chefs_near).length) {
              $("#chefs-list-near").html("");
            }
          } else {
            $("#chefs-list").html("");
            $(".no-result").show();
          }
        },
        error: function(data) {
          $(".loading-div").hide()
          console.log("error", data);
        }
      }); // ajax end
    }, 500);


    $("#findChef").on("click", function() {
      var searchForm = $("#search-form").serialize();
      window.location.href = "/find-a-chef?"+searchForm;
      //callAjax();
    });

    function callAjax() {
      $(".loading-div").show()
      var formData = $("#search-form").serialize();
      $.ajax({
        type: "POST",
        url: "{{ url('/search-data')}}",
        data: formData,
        success: function(data) {
          $(".loading-div").hide()
          $(".records").text(Object.keys(data.chefs).length)
          $(".records_near").text(Object.keys(data.chefs_near).length)
          if (Object.keys(data.chefs).length) {
            let chefs = data.chefs;
            let favs = data.favs;
            renderHtml(chefs, favs);
            renderHtmlNearBy(data.chefs_near, favs);
            if (!Object.keys(data.chefs_near).length) {
              $("#chefs-list-near").html("");
              $(".records_near").text('0');
            }
          } else {
            $("#chefs-list").html("");
            $(".no-result").show();
          }
        },
        error: function(data) {
          $(".loading-div").hide()
          console.log("error", data);
        }
      }); // ajax end

    }

    function renderHtml(chefs, favs) {
      let html = "";
      $("#chefs-list").html(html);
      for (key in chefs) {

        let fav_class = "add-to-fav";
        let fav_txt = "Add Fav";
        if (favs.includes(chefs[key].id)) {
          fav_class = "remove-to-fav";
          fav_txt = "Remove Fav";
        }
        if (chefs[key].profile_pic == "") {
          var imgage = "l60Hf.png";
        } else {
          var imgage = chefs[key].profile_pic;
        }
        html += `<div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-4 px-md-2 px-lg-3">
                            <div class="chef-list">
                                <a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" class="" >
                                <img alt="" src="{{asset('/uploads/profiles')}}/${imgage}" />
                                </a>
                                <h4><a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}">${chefs[key].first_name} ${chefs[key].last_name} </a><!--<span>${chefs[key].address}</span>--></h4>
                               
                            </div>
							<div class="row chef-list-btn">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12 btn-profile">
                                    <a name="profile" href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" target="_blank">View Profile</a>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-12 btn-profile">
                                    @auth
                                      @if(@$user->user_type != "chef" && !empty(@$user))
                                          <input type="button" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif(@$user->user_type == "chef" && !empty(@$user))
                                      @else
                                          <input type="button" name="add" class="check_login fav_button" value="Add Fav" />
                                      @endif
                                    @else
                                      <input type="button" name="add" class="check_login fav_button" value="Add Fav" />
                                    @endauth
                                </div>
							</div>
                        </div>`;
      }
      $("#chefs-list").html(html);
    }

    function renderHtmlNearBy(chefs, favs) {
      let html = "";
      $("#chefs-list-near").html(html);
      for (key in chefs) {

        let fav_class = "add-to-fav";
        let fav_txt = "Add Fav";
        if (favs.includes(chefs[key].id)) {
          fav_class = "remove-to-fav";
          fav_txt = "Remove Fav";
        }
        if (chefs[key].profile_pic == "") {
          var imgage = "l60Hf.png";
        } else {
          var imgage = chefs[key].profile_pic;
        }
        html += `<div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-4 px-md-2 px-lg-3">
                            <div class="chef-list">
                                <a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" class="" >
                                <img alt="" src="{{asset('uploads/profiles')}}/${imgage}" />
                                </a>
                                <h4><a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}">${chefs[key].first_name} ${chefs[key].last_name} </a><!--<span>${chefs[key].address}</span>--></h4>
                               
                            </div>
              <div class="row chef-list-btn">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 btn-profile">
                                    <a name="profile" href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" target="_blank">View Profile</a>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 btn-profile">
                                    @auth
                                      @if(@$user->user_type != "chef" && !empty(@$user))
                                          <input type="button" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif(@$user->user_type == "chef" && !empty(@$user))
                                      @else
                                          <input type="button" name="add" class="check_login fav_button" value="Add Fav" />
                                      @endif
                                    @else
                                      <input type="button" name="add" class="check_login fav_button" value="Add Fav" />
                                    @endauth
                                </div>
              </div>
                        </div>`;
      }
      $("#chefs-list-near").html(html);
    }

    $(document).on("click", ".check_login", function() {
      $("#login-modal").modal("show");
    })

    $(document).on('click', '.add-to-fav', function() {
      let chef_id = $(this).attr("data-id");
      let that = $(this);
      $.ajax({
        type: 'POST',
        url: '{{route("add-to-fav")}}',
        data: {
          'chef_id': chef_id
        },
        success: function(data) {
          if (data.status) {
            that.val("Remove Fav");
            that.addClass("remove-to-fav").removeClass("add-to-fav");
            swal("Done!", data.response, "success")
          } else {
            swal("Info!", data.response, "info")

          }
        },
        error: function(err) {
          if (err && err.responseJSON) {
            swal("Error!", err.responseJSON.message, "error");
          } else {
            swal("Error!", "Please try again!", "error");
          }
        }
      });
    });

    $(document).on('click', '.remove-to-fav', function() {
      let chef_id = $(this).attr("data-id");
      let that = $(this);

      swal({
          title: "Are you sure?",
          text: "You want to remove from Favorite.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, remove it!",
          closeOnConfirm: true
        },
        function() {
          $.ajax({
            type: 'POST',
            url: '{{route("remove-to-fav")}}',
            data: {
              'chef_id': chef_id
            },
            success: function(data) {
              that.val("Add Fav");
              that.addClass("add-to-fav").removeClass("remove-to-fav");
              swal("Done!", data.response, "success")
            },
            error: function(err) {
              swal("Error!", "Please try again", "error");
            }
          });
        });
    });


    $(".search-box").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "{{url('auto-list')}}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
            response(data);
          }
        });
      },
      minLength: 3,
    });


    $(".search-box-zip").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "{{url('auto-list-zip')}}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
            response(data);
          }
        });
      },
      minLength: 2,
    });


  });

</script>
@endsection