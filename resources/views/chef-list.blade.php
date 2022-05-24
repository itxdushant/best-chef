@extends('layouts.header')
@section('content')
<!-- chef header end here -->
<!-- another section -->
<div class="location_date_section location_d_s_2">
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


<!-- another section -->
<div class="listin_weak_section">
  <div class="container">
    <h3>New This Week</h3>
    <div class="inner_listing_div">
      <h4>Personal Chef Services </h4>
      <a href="#" class="btn_c">Show All</a>
    </div>
  </div>
</div>
<!-- another section -->
<div class="top_chef_section">
  <div class="container">
    <div class="top_text">
      <h4 class="chef_h4">Top chefs near you</h4>
      <a href="{{url('/chefs/top-chefs')}}">VIEW MORE</a>
    </div>

    <?php
    // echo "<pre>";
    // echo $topchefs;
    // echo "</pre>";

    ?>

    <div class="row pt-3">
      @php

      $totalcount=count($topchefs);

      if($totalcount>=4)
      {
      $totalcount=3;

      }


      @endphp
      @for($i=0 ;$i<=$totalcount;$i++) @php $fav_class="add-to-fav" ; $fav_txt="Add Fav" ; if(in_array($topchefs[$i]->id,$favorite_chefs))
        {
        $fav_class = "remove-to-fav";
        $fav_txt = "Remove Fav";
        }

        @endphp
        <div class="col-md-3">
          <div class="chef_card">
            <div class="like_img">
              <img src="{{asset('uploads/profiles')}}/{{$topchefs[$i]->profile_pic}}" class="img-fluid">
              @auth
              @if($user->user_type != "chef" && !empty($user))

              <input type="checkbox" name="add" class=" fav_button {{$fav_class}}" {{ in_array($topchefs[$i]->id,$favorite_chefs) ? 'checked' : ''}} data-id="{{$topchefs[$i]->id}}" value="{{$fav_txt}}" />

              @elseif($user->user_type == "chef" && !empty($user))
              @else
              <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
              @endif
              @else
              <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
              @endauth
            </div>

            <div class="card_text">
              <!-- <p><img src="images/g_star.png" alt="">5<span>(34)</span><span>Austin</span></p> -->
              <p><img src="images/g_star.png" alt="">@if($topchefs[$i]->max_rate){{$topchefs[$i]->max_rate}}@else No rating @endif<span>({{$topchefs[$i]->reviews}})</span><span>{{$randchefs[$i]->city}}</span></p>
              <h3><a href="chef/{{$topchefs[$i]->id}}/{{$topchefs[$i]->first_name}}{{$topchefs[$i]->last_name}}">{{$topchefs[$i]->first_name}} {{$topchefs[$i]->last_name}}</a></h3>
              <p>From ${{$topchefs[$i]->avg_cost}}<span>/meal</span></p>
            </div>
          </div>
        </div>
        @endfor

    </div>
    <!-- another section -->
    <div class="book_chef_section">
      <div class="container">
        <div class="top_text">
          <h4 class="chef_h4">Book a chef that available today</h4>
          <a href="#">VIEW MORE</a>
        </div>
        <div class="row pt-3">
          <div class="col-md-4">
            <div class="book_chef_card">
              <div class="left_div">
                <img src="images/book_chef_1.png" class="img-fluid">
              </div>
              <div class="rigth_div">
                <div class="like_input">
                  <input type="checkbox">
                </div>
                <div class="star_div">
                  <p><img src="images/g_star.png">5<span>(34)</span></p>
                  <span>Austin</span>
                </div>
                <h3>Hollie McCartney</h3>
                <h5>From $35<span>/meal</span></h5>
                <a href="#" class="btn_c">Message Chef</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="book_chef_card">
              <div class="left_div">
                <img src="images/book_chef_1.png" class="img-fluid">
              </div>
              <div class="rigth_div">
                <div class="like_input">
                  <input type="checkbox">
                </div>
                <div class="star_div">
                  <p><img src="images/g_star.png">5<span>(34)</span></p>
                  <span>Austin</span>
                </div>
                <h3>Hollie McCartney</h3>
                <h5>From $35<span>/meal</span></h5>
                <a href="#" class="btn_c">Message Chef</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="book_chef_card">
              <div class="left_div">
                <img src="images/book_chef_1.png" class="img-fluid">
              </div>
              <div class="rigth_div">
                <div class="like_input">
                  <input type="checkbox">
                </div>
                <div class="star_div">
                  <p><img src="images/g_star.png">5<span>(34)</span></p>
                  <span>Austin</span>
                </div>
                <h3>Hollie McCartney</h3>
                <h5>From $35<span>/meal</span></h5>
                <a href="#" class="btn_c">Message Chef</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>



    <!-- another section -->
    <div class="book_events_section top_chef_section">
      <div class="container">
        <div class="top_text">
          <h4 class="chef_h4">Book a chef for your entertainment or events</h4>
          <a href="{{url('/chefs/rand-chefs')}}">VIEW MORE</a>
        </div>

        <div class="row pt-3">
          @php

          $totalcount=count($randchefs);

          if($totalcount>=4)
          {
          $totalcount=3;

          }
          @endphp

          @for($i=0 ;$i<=$totalcount;$i++) @php $fav_class="add-to-fav" ; $fav_txt="Add Fav" ; if(in_array($randchefs[$i]->id,$favorite_chefs))
            {
            $fav_class = "remove-to-fav";
            $fav_txt = "Remove Fav";
            }

            @endphp
            <div class="col-md-3">
              <div class="chef_card">
                <div class="like_img">
                  <img src="{{asset('uploads/profiles')}}/{{$randchefs[$i]->profile_pic}}" class="img-fluid">
                  @auth
                  @if($user->user_type != "chef" && !empty($user))

                  <input type="checkbox" name="add" class=" fav_button {{$fav_class}}" {{ in_array($randchefs[$i]->id,$favorite_chefs) ? 'checked' : ''}} data-id="{{$randchefs[$i]->id}}" value="{{$fav_txt}}" />

                  @elseif($user->user_type == "chef" && !empty($user))
                  @else
                  <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
                  @endif
                  @else
                  <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
                  @endauth
                </div>
                <div class="card_text">
                  <p><img src="images/g_star.png" alt="">5<span>(34)</span><span>{{$randchefs[$i]->city}}</span></p>
                  <h3><a href="chef/{{$randchefs[$i]->id}}/{{$randchefs[$i]->first_name}}{{$randchefs[$i]->last_name}}">{{$randchefs[$i]->first_name}} {{$randchefs[$i]->last_name}}</a></h3>
                  <p>From ${{$randchefs[$i]->avg_cost}}<span>/meal</span></p>
                </div>
              </div>
            </div>
            @endfor

        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slick/slick.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>
    <script>
      $(document).on('click', '.add-to-fav', function() {
        let chef_id = $(this).attr("data-id");
        let that = $(this);
        $.ajax({

          type: 'POST',
          url: '{{route("add-to-fav")}}',
          data: {
            "_token": "{{ csrf_token() }}",
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
        console.log('dhjdfgjh');
        let chef_id = $(this).attr("data-id");
        let that = $(this);
        console.log(that);
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
                "_token": "{{ csrf_token() }}",
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
    </script>
    @endsection