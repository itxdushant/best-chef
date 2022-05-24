@extends('layouts.header')
@section('styles')
<link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">

@endsection
@section('content')
<!-- another section -->
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

<!-- another section -->
<div class="chef_location_section">
  <div class="container">
    <!-- <div class="filter">
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images/filter.png" alt="">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
    
     </div> -->
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <h4 class="location_tittle"><span id="total_chefs">0</span> chefs available in your area </h4>

        <div class="content_location_slider_div row left_div" id="chefs-list">
        </div>



        <div class="right_div">
          <div class="location_map ">
            <!-- <img src="images/map_1.jpg" class="img-fluid"> -->
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">
            <div class="login px-md-4 text-center">
               <h3 class="mb-4">LOG INTO YOUR ACCOUNT</h5>
                  <span class="invalid-feedback" role="alert">
                     <strong>You have entered an invalid Email or password.</strong>
                  </span>
                  <form method="POST" action="{{ route('login') }}" id="loginForm">
                     @csrf
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                             <div class="loginform">

                             </div>
                            
                              <!--<label class="mb-2">Email</label>-->
                              <input type="email" placeholder="Email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="" required="">
                           </div>
                           <div class="form-group">
                              <!--<label class="mb-2">Password</label>-->
                              <input type="password" placeholder="Password" class="form-control" id="password" name="password" placeholder="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row text-left mb-2">
                        <div class="col-md-12">
                           <input type="checkbox" name="remember" /><span class="remember">Remember me</span>
                        </div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-md-12">
                           <div class="form-group text-center">
                              <button type="button" class="login-btn login-submit-btn submit_log" name="log-in">LOGIN</button>
                           </div>
                        </div>
                     </div>


                  </form>
            </div>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
         </div>

      </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // $(document).ready(function () {
    //     $('.date').datepicker({
    //         format: "mm/dd/yyyy",
    //         autoclose: false
    //     });

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
          $("#total_chefs").text(Object.keys(data.chefs).length);
          $(".records_near").text(Object.keys(chefs_near).length)
          if (Object.keys(data.chefs).length) {
            let chefs = data.chefs;
            let favs = data.favs;
            let html = `<div class="gmap_canvas" style=""><iframe width="670" height="335" id="gmap_canvas" src="https://maps.google.com/maps?q=${chefs.service_area}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>`;
            let htmlLogin=`  <input type="hidden" name="chef_id" value="${chefs.id}">`;
            $(".location_map").append(html);
              $(".loginForm").append(htmlLogin);
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
      callAjax();
    });

      // loginform

      $(".submit_log").click(function(e) {
         e.preventDefault();

         ajax_login();
      });

      function ajax_login() {
         
         var loginForm = $("#loginForm");
         var formData = loginForm.serialize();
         var formurl = loginForm.attr('action');
         $(".invalid-feedback").hide();
         $.ajax({
            url: formurl,
            type: 'POST',
            data: formData,
            success: function(data) {

               if (data && data.auth) {
                  if (typeof(loginURL) != 'undefined' && loginURL != "") {
                     window.location.href = window.location.href;
                  } else {
                     if (data.user.user_type == "user") {

                        $('#myModal').hide();
                        window.location.href = '{{url("/find-a-chef/")}}';
                     } 

                  }

               }
            },
            error: function(data) {
               $(".invalid-feedback").show();
               console.log("error", data);
            }
         });
      }

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
          $("#total_chefs").text(Object.keys(data.chefs).length);
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
          // console.log(imgage);
        }

        html += `  
              <div class="slider_1 col-md-6">
                <a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" class="" >
                  <img alt="" src="{{asset('/uploads/profiles')}}/${imgage}" />
                </a>
             </div>
           <div class="col-md-6" >
              <div class="slider_right_text">
               <div class="like_text">
                <span>${chefs[key].city}, ${chefs[key].state} ${chefs[key].service_area}</span>
 
                @auth
                                      @if($user->user_type != "chef" && !empty($user))
                                          <input type="checkbox" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif($user->user_type == "chef" && !empty($user))
                                      @else
                                          <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
                                      @endif
                                    @else
                                      <input type="checkbox" name="add" data-bs-toggle="modal" data-bs-target="#myModal" class=" fav_button" value="Add Fav" />
                                     
                      
                     </button>
                                      @endauth
             </div>
             <a href="{{url('chef')}}/${chefs[key].id}/${chefs[key].first_name.toLowerCase()}${chefs[key].last_name.toLowerCase()}" class="" >
              <h3>${chefs[key].first_name} ${chefs[key].last_name}</h3>
              </a>
             <div class="list_items">`;
        var str_array = chefs[key].meal_prefrences.split(',');
        for (var i = 0; i < str_array.length; i++) {
          html += ` <a href="#">${str_array[i]}</a>`;
        }
        html += ` </div>
 
              <div class="bottom_stars">
               <p><img src="images/g_star.png">5 <span>(3 reviews)</span></p>
               <div>
                   <h5>$${chefs[key].cost}/meal</h5>
                   <span>Average Cost</span>
               </div>
              </div>
 
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
          // console.log(chefs[key],'helooooooooo');
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
                                      @if($user->user_type != "chef" && !empty($user))
                                          <input type="checkbox" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif($user->user_type == "chef" && !empty($user))
                                      @else
                                          <input type="button" name="add" class="check_login fav_button" value="Add Fav" />
                                      @endif
                                    @else
                                    <input type="checkbox" name="add" data-bs-toggle="modal" data-bs-target="#myModal" class=" fav_button" value="Add Fav" />
                                    @endauth
                                </div>
              </div>
                        </div>`;
      }
      $("#chefs-list-near").html(html);
    }

    $(document).on("click", ".check_login", function() {
      window.location.href = "{{URL::to('login')}}";
    })

    $(document).on('click', '.add-to-fav', function() {
      // alert("add favorite");
      let chef_id = $(this).attr("data-id");
      let that = $(this);
      $.ajax({
        type: 'POST',
        url: '{{route("add-to-fav")}}',
        data: {
          'chef_id': chef_id,
          _token: "{{ csrf_token() }}"
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
      // alert("remove favorite");
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
              'chef_id': chef_id,
              _token: "{{ csrf_token() }}"
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