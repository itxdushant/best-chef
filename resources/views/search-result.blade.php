@extends('layouts.main')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection

<style type="text/css">

/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

  /* Transparent Overlay */
  .loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);
  }

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

</style>
<?php
$user = Auth::user();
 ?>
@section('content')
<section class="inner-page-banner search-result-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
					<form class="banner-search pl-md-4" method="GET" action="" id="search-form" autocomplete="off">
                    <div class="row p-3">
						@csrf
						<!-- <input type="text" value="<?php if(isset($_GET['service_area'])) echo $_GET['service_area'] ?>" name="service_area" placeholder="City or Zip Code"  /> -->
						<div class="col-md-2 pr-md-0">
							<input type="text" value="<?php if(isset($_GET['available_dates'])) echo $_GET['available_dates'] ?>" name="available_dates" class="date" placeholder="Date"  />
						</div>
						<!-- <input type="text"  name="time" placeholder="Time"  /> -->
						<div class="col-md-2 pr-md-0">
							<select class="custom-select" name="time" value="<?php if(isset($_GET['time'])) echo $_GET['time'] ?>">
							  <option value="">Time</option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "12:00 AM") echo "selected";?> value="12:00 AM"> 12:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "01:00 AM") echo "selected";?> value="01:00 AM"> 01:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "02:00 AM") echo "selected";?> value="02:00 AM"> 02:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "03:00 AM") echo "selected";?> value="03:00 AM"> 03:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "04:00 AM") echo "selected";?> value="04:00 AM"> 04:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "05:00 AM") echo "selected";?> value="05:00 AM"> 05:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "06:00 AM") echo "selected";?> value="06:00 AM"> 06:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "07:00 AM") echo "selected";?> value="07:00 AM"> 07:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "08:00 AM") echo "selected";?> value="08:00 AM"> 08:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "09:00 AM") echo "selected";?> value="09:00 AM"> 09:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "10:00 AM") echo "selected";?> value="10:00 AM"> 10:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "11:00 AM") echo "selected";?> value="11:00 AM"> 11:00 AM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "12:00 PM") echo "selected";?> value="12:00 PM"> 12:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "01:00 PM") echo "selected";?> value="01:00 PM"> 01:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "02:00 PM") echo "selected";?> value="02:00 PM"> 02:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "03:00 PM") echo "selected";?> value="03:00 PM"> 03:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "04:00 PM") echo "selected";?> value="04:00 PM"> 04:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "05:00 PM") echo "selected";?> value="05:00 PM"> 05:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "06:00 PM") echo "selected";?> value="06:00 PM"> 06:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "07:00 PM") echo "selected";?> value="07:00 PM"> 07:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "08:00 PM") echo "selected";?> value="08:00 PM"> 08:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "09:00 PM") echo "selected";?> value="09:00 PM"> 09:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "10:00 PM") echo "selected";?> value="10:00 PM"> 10:00 PM </option>
							  <option <?php if(isset($_GET['time']) && $_GET['time'] == "11:00 PM") echo "selected";?> value="11:00 PM"> 11:00 PM </option>
							</select>
						</div>
						<div class="col-md-2 pr-md-0">
							<input type="text" value="<?php if(isset($_GET['service_area'])) echo $_GET['service_area'] ?>" name="service_area" class="search-box-zip" placeholder="Zip Code" />
						</div>
						<div class="col-md-3 pr-md-0">
							<select class="custom-select prefrences" name="meal_prefrences" value="<?php if(isset($_GET['prefrences'])) echo $_GET['prefrences'] ?>">
								<option value="">Select Meal Preferences</option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Meat") echo "selected";?> value="Meat"> Meat</option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegan") echo "selected";?> value="Vegan">Vegan</option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegetarian ") echo "selected";?> value="Vegetarian"> Vegetarian  </option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Athlete ") echo "selected";?> value="Athlete"> Athlete  </option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Plant_based ") echo "selected";?> value="Plant_based">  Plant-based</option>
								<option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Gluten_free") echo "selected";?> value="Gluten_free"> Gluten-free </option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Other") echo "selected";?> value="Other"> Other </option>
							</select>
						</div>
						<!--<div class="col-md-2 pr-md-0">
							<input type="text" value="<?php if(isset($_GET['meal_perference'])) echo $_GET['meal_perference'] ?>" name="meal_perference" class="search-box" placeholder="Meal Preference" />
						</div>-->
						<!-- <div class="col-md-2">
							<input type="text" value="" name="available_dates" class="date" placeholder="Date"  />
						</div>
						<div class="col-md-2">
							<input type="text" value="" name="available_dates" class="time" placeholder="Time"  />
						</div> -->
						<div class="col-md-3 pr-md-0">
							<input type="button" id="findChef" value="Find Best Local Chef Near You" />					
						</div>
					</div>
				</form>
							
			</div>
		</div>
    </div>
</section>


<section class="body-data-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-section-title"> <span class="records_near"></span> Nearby Chefs</div>
                <div class="chef-data-list">
                    <div class="loading loading-div">Loading&#8230;</div> 
                    <div class="row" id="chefs-list-near">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="inner-section-title"> <span class="records"></span> Local Chefs</div>
                <div class="chef-data-list">
                    <div class="loading loading-div">Loading&#8230;</div> 
                    <div class="row" id="chefs-list">
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>

@section('scripts')
<script src="{{ asset('js/jquery-ui.min.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.date').datepicker({
            startDate: moment().format('mm/dd/yyyy'),
            format: 'mm/dd/yyyy',
            autoclose: true
        })

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
                    if(Object.keys(data.chefs).length) {
                        let chefs = data.chefs;
                        let favs = data.favs;              
                        renderHtml(chefs, favs); 
                        renderHtmlNearBy(chefs_near, favs); 
                        if(!Object.keys(chefs_near).length) {
                          $("#chefs-list-near").html("");  
                        }
                    }else{
                        $("#chefs-list").html("");
                        $(".no-result").show();
                    }            
                },
                error: function (data) {
                    $(".loading-div").hide()  
                    console.log("error",data);
                }
            }); // ajax end
        }, 500);


        $("#findChef").on("click", function() {
            callAjax(); 
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
                    if(Object.keys(data.chefs).length) {
                        let chefs = data.chefs;            
                        let favs = data.favs;           
                        renderHtml(chefs, favs); 
                        renderHtmlNearBy(data.chefs_near, favs); 
                        if(!Object.keys(data.chefs_near).length) {
                          $("#chefs-list-near").html("");
                          $(".records_near").text('0'); 
                        }
                    }else{
                        $("#chefs-list").html("");
                        $(".no-result").show();
                    }            
                },
                error: function (data) {
                    $(".loading-div").hide()  
                    console.log("error",data);
                }
            }); // ajax end

        }

        function renderHtml(chefs, favs) {
            let html = "";
            $("#chefs-list").html(html);
            for(key in chefs) {

                let fav_class = "add-to-fav";
                let fav_txt = "Add Fav";
                if(favs.includes(chefs[key].id)) {
                    fav_class = "remove-to-fav";
                    fav_txt = "Remove Fav";
                }
                if(chefs[key].profile_pic=="")
                {
                  var imgage = "l60Hf.png";
                }
                else
                {
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
                                      @if($user->user_type != "chef" && !empty($user))
                                          <input type="button" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif($user->user_type == "chef" && !empty($user))
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
            for(key in chefs) {

                let fav_class = "add-to-fav";
                let fav_txt = "Add Fav";
                if(favs.includes(chefs[key].id)) {
                    fav_class = "remove-to-fav";
                    fav_txt = "Remove Fav";
                }
                if(chefs[key].profile_pic=="")
                {
                  var imgage = "l60Hf.png";
                }
                else
                {
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
                                      @if($user->user_type != "chef" && !empty($user))
                                          <input type="button" name="add" class="fav_button ${fav_class}" data-id="${chefs[key].id}" value="${fav_txt}" />
                                      @elseif($user->user_type == "chef" && !empty($user))
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

        $(document).on("click", ".check_login", function(){
            $("#login-modal").modal("show");
        })

         $(document).on('click', '.add-to-fav', function() {
            let chef_id = $(this).attr("data-id");
            let that = $(this);
            $.ajax({
                type:'POST',
                url:'{{route("add-to-fav")}}',
                data: { 'chef_id': chef_id},
                success:function(data) {
                    if(data.status) {
                        that.val("Remove Fav");
                        that.addClass("remove-to-fav").removeClass("add-to-fav");
                        swal("Done!", data.response, "success")
                    }else{
                        swal("Info!", data.response, "info")

                    }
                },
                error: function(err) {
                  if(err && err.responseJSON) {
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
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{route("remove-to-fav")}}',
                    data: { 'chef_id': chef_id},
                    success:function(data) {
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
                      term : request.term
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
                    term : request.term
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
@endsection