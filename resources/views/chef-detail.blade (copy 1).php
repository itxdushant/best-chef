@extends('layouts.main')

@section('title', 'Details')

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link href="{{asset('public/css/slider.css')}}" type="text/css" rel="stylesheet" />
@endsection

<style type="text/css">
    td.day.disabled {
        opacity: 0.2;
    }
    .highlight {
      background: #eee;
    }

  .star-ratings {
    unicode-bidi: bidi-override;
    color: #c5c5c5;
    font-size: 33px;
    line-height: 1.2;
    /* height: 50px; */
    width: 148px;
    margin: 0px;
    position: relative;
    padding: 0;
  }

  .star-ratings-top {
    color: gold;
    padding: 0;
    position: absolute;
    z-index: 1;
    display:block;
    left: 0px;
    overflow: hidden;
  }

  .star-ratings-bottom { 
    z-index: 0; 
  }
</style>


@section('content')
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1></h1>
			</div>
		</div>
    </div>
</section
<section class="body-data-box">
  <div class="container">
  <div class="row user-personal-detail">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2 user-profile-img">
            <img alt="" class="img-fluid" src="{{asset('/public/uploads/profiles')}}/{{$chef->profile_pic}}" />
          </div>
          <div class="col-md-10">       
            <h3 class="chef-name-title">{{$chef->first_name}} {{$chef->last_name}}</h3>
            <div class="chef-experince-detail">
              <b>Years of experience:</b> {{$chef->experience}} Years<br/>
              <b>Culinary school graduated from:</b> {{$chef->college }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container"> 
    <div class="row novisible">
		<div class="col-md-12 chef-profile-hire-btn text-right">
          <?php 
              $utype = "user";
              if(isset(Auth::user()->user_type)){
                $utype = Auth::user()->user_type;
              }
               
              $dts = @unserialize($chef->available_dates);  
          ?>
          @if(!$dts)
              <div class="alert alert-danger text-left">
                No available dates/times to hire this Chef.
              </div>
          @endif
          
          @if($utype == "user") 
            <a href="javascript:void(0)" class="common-link-btn" data-toggle="modal" data-target="#booking" class="active">BOOK THIS CHEF</a>
          @else
            <a href="javascript:void(0)" class="common-link-btn not-book">BOOK THIS CHEF</a>
          @endif
          
          @auth
            @if($wishlist)
              <a href="javascript:void(0)" class="common-link-btn black remove-to-fav" data-id="{{$chef->id}}">REMOVE FROM FAVORITE</a>
            @else
              @if($utype == "user") 
                <a href="javascript:void(0)" class="common-link-btn black add-to-fav" data-id="{{$chef->id}}">FAVORITE THIS CHEF</a>
              @else
                <a href="javascript:void(0)" class="common-link-btn black not-fav">FAVORITE THIS CHEF</a>
              @endif
            @endif
          @else
            <a href="javascript:void(0)" class="common-link-btn black check_login">FAVORITE THIS CHEF</a>
          @endauth

        </div>
	</div>
	<div class="row">     
      <div class="col-md-7">
        <div class="border-box-frame">          
          <div class="box-section-title">Menu</div>
  
          @if(count($menus))
            <?php 
              $first_arr = array_slice($menus->toArray(), 0, 1);
              $scd_arr = array_slice($menus->toArray(), 1);
            ?>
            @foreach ($first_arr as $key=>$meal)
              <div class="user-frofile">
                <div class="user-frofile-discription-title"><b>{{$meal->name}}</b></div>
                <div class="user-frofile-discription-subtitle">MEAL DESCRIPTION:</div>
                <p>{{$meal->description}}</p>
                <div class="row">     
                  <div class="col-md-5">
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">MEAL INGREDIENTS:</div>
                      {{$meal->ingredients}}
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">PREP TIME:</div>
                      <p>{{$meal->prep_time}}  Minutes</p>
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">MEAL CALORIES:</div>
                      <p>{{$meal->calories}} Calories</p>                 
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">APPROXIMATE MEAL COST:</div>
                      <p>${{$meal->cost}} per person</p>                  
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="meals-quality profile-diss">                      
                      <div id="carouselExampleControls{{$key}}" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                      <?php
                      if( $meal->images) {
                        $imgs =  explode(",", $meal->images);
                        $imgs = array_filter($imgs);
                        if(count($imgs)) {
                          foreach ($imgs as $ke2y => $value) { 
                            $lcs = ($ke2y == 0 ) ? "active" : "";?>
                             <div class="carousel-item {{$lcs}}">
                              <img alt="" src="{{asset('public/uploads/menu-images')}}/{{$value}}" />
                            </div>
                        <?php }  
                          }
                      }
                      ?>
                      </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls{{$key}}" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls{{$key}}" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            @endforeach
            
            @if(count($scd_arr))
            <div id="more-collapse" style="display:none">
              @foreach ($scd_arr as $key=>$meal)
              <div class="user-frofile">
                <div class="user-frofile-discription-title"><b>{{$meal->name}}</b></div>
                <div class="user-frofile-discription-subtitle">MEAL DESCRIPTION:</div>
                <p>{{$meal->description}}</p>
                <div class="row">     
                  <div class="col-md-5">
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">MEAL INGREDIENTS:</div>
                      {{$meal->ingredients}}
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">PREP TIME:</div>
                      <p>{{$meal->prep_time}} Minutes</p>
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">MEAL CALORIES:</div>
                      <p>{{$meal->calories}} Calories</p>                 
                    </div>
                    <div class="meals-quality">
                      <div class="user-frofile-discription-subtitle">APPROXIMATE MEAL COST:</div>
                      <p>${{$meal->cost}} per person</p>                 
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="meals-quality profile-diss">                      
                      <div id="carouselExampleControls2{{$key}}" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                      <?php
                      if( $meal->images) {
                        $imgs =  explode(",", $meal->images);
                        $imgs = array_filter($imgs);
                        if(count($imgs)) {
                          foreach ($imgs as $ke2y => $value) { 
                            $lcs = ($ke2y == 0 ) ? "active" : "";?>
                             <div class="carousel-item {{$lcs}}">
                              <img alt="" src="{{asset('public/uploads/menu-images')}}/{{$value}}" />
                            </div>
                        <?php }  
                        }
                      }
                      ?>
                      </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls2{{$key}}" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls2{{$key}}" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            @endforeach
            </div>
              <div class="more-link text-center">
                <a href="javascript:void(0)" class="morelink">VIEW MORE</a>
              </div>
            @endif


          @endif 

          
        </div>
        <div class="border-box-frame">          
          <div class="box-section-title">Bio</div>
          <div class="user-frofile chef-profile-bio">
            <p>{{$chef->bio}}</p>
          </div>
        </div>        
      </div>
      <div class="col-md-5">
        <div class="border-box-frame">          
          <div class="box-section-title">Areas Serviced</div>
          <div class="user-frofile text-center area-servis">
            <!-- <img alt="" src="{{asset('/public/img/areas-servis.jpg')}}" /> -->
            <div class="mapouter amenities-video-cover embed-responsive embed-responsive-16by9"><div class="gmap_canvas"><iframe width="670" height="335" id="gmap_canvas" src="https://maps.google.com/maps?q={{$chef->service_area}}&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
          </div>
        </div>
        <div class="border-box-frame">          
          <div class="box-section-title">Ratings & Reviews</div>
          <div class="user-frofile">

            @if(count($reviews))
              <?php
                $max = 0;
                $n = count($reviews); 
                foreach ($reviews as $count) { 
                  $max = $max+$count->rating;
                }
                $rate = $max / $n;
              
              ?>
              <div class="star-ratings">
                    <div class="star-ratings-top" style="width: {{$rate * 20}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    <div class="star-ratings-bottom"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                  </div>
              <!-- <img alt="" src="{{asset('/public/img/rating-img.png')}}" /> -->
              <div class="ratting-title">WHT CHEFS CUSTOMERS ARE SAYING:</div>
              <?php 
                $first_arr = array_slice($reviews->toArray(), 0, 3);
                $scd_arr = array_slice($reviews->toArray(), 3);
              ?>
              @foreach ($first_arr as $review)

                <div class="ratting-data">
                  <p>" {{$review['review']}}" </p>
                  <div class="author">
                    <b>- {{$review['first_name']}} {{$review['last_name']}}</b>
                  </div>
               </div>

              @endforeach

              @if(count($scd_arr))
                <div id="more2-collapse" style="display:none">
                  @foreach ($scd_arr as $review)

                   <div class="ratting-data">
                  <p>" {{$review['review']}}" </p>
                  <div class="author">
                    <b>- {{$review['first_name']}} {{$review['last_name']}}</b>
                  </div>
               </div>

                  @endforeach
                </div>
               @endif
            

           
           
          <div class="more-link text-center">
            <a href="javascript:void(0)" class="morelink2">VIEW MORE</a>
          </div> 
          @else
          No Rating and Reviews found  
           @endif       
        </div>
		</div>
        <div class="border-box-frame">
          <div class="chef-profile-video amenities-video-cover embed-responsive embed-responsive-16by9">
            <?php 
            $vid = explode("v=", $chef->video_url);
            if(count($vid) > 1) { ?>
                 <iframe width="670" height="335" src="https://www.youtube.com/embed/{{$vid['1']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php } ?>
            <!-- <img alt="" src="{{asset('/public/img/chef-profile-video.jpg')}}" /> -->
          </div>
        </div>
      </div>      
    </div>
  </div>
</section>  

<section class="bottom-strip">
	<div class="container">
		<div class="row">			
			<?php 
				  $utype = "user";
				  if(isset(Auth::user()->user_type)){
					$utype = Auth::user()->user_type;
				  }
				   
				  $dts = @unserialize($chef->available_dates);  
			  ?>
			<div class="col-md-12 chef-profile-hire-btn">
				@if(!$dts)
				  <div class="alert alert-danger text-md-right">
					No available dates/times to hire this Chef.
				  </div>
				@endif
			</div>			
			<div class="col-md-6 chef-profile-hire-btn text-left">			  
			  @auth
				@if($wishlist)
				  <a href="javascript:void(0)" class="common-link-btn black remove-to-fav" data-id="{{$chef->id}}">REMOVE FROM FAVORITE</a>
				@else
				  @if($utype == "user") 
					<a href="javascript:void(0)" class="common-link-btn black add-to-fav" data-id="{{$chef->id}}">FAVORITE THIS CHEF</a>
				  @else
					<a href="javascript:void(0)" class="common-link-btn black not-fav">FAVORITE THIS CHEF</a>
				  @endif
				@endif
			  @else
				<a href="javascript:void(0)" class="common-link-btn black check_login">FAVORITE THIS CHEF</a>
			  @endauth
			</div>
			<div class="col-md-6 chef-profile-hire-btn text-md-right">			  
			  
			  @if($utype == "user") 
				<a href="javascript:void(0)" class="common-link-btn" data-toggle="modal" data-target="#booking" class="active">BOOK THIS CHEF</a>
			  @else
				<a href="javascript:void(0)" class="common-link-btn not-book">BOOK THIS CHEF</a>
			  @endif
			</div> 
			<div class="clearfix"></div>
			</div>		
		</div>
	</div>
</section> 

<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered chef-booking-modal" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login px-4 mx-auto mw-100">
                    <div class="row">
					<div class="col-md-12 chef-img">
						<img alt="" src="{{asset('public/uploads/profiles')}}/{{$chef->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/img/default-user.png')}}';"  />
					</div>
					<div class="col-md-12 text-center">
                      {{$chef->first_name}} {{$chef->last_name}}
                    
                    </div>
                    <div class="col-md-12 text-center">
                    
                      {{$chef->service_area}}
                    </div>
    					<div class="col-md-12">
    						<h3 class="text-center mb-4">Book this chef</h3>
    					</div>                    
                    <div class="col-md-12">
                        <form action="{{route('checkout')}}" method="POST" autocomplete="off">
                          @csrf
                          <div class="row chef-booking-form">
							<div class="form-group col-sm-6 pr-sm-1">
								<input type="text" name="booking_date" id="booking_date" placeholder="Select Date" required>
								<input type="hidden" name="chef_id" value="{{$chef->id}}">
							</div>
							<div class="form-group col-sm-6 pr-sm-1">
								<select name="booking_time" placeholder="Select Time" required id="booking_time">
									<option value="">Select Time</option>
								</select>
							</div>
						<!-- 	<div class="form-group col-sm-12 pr-sm-1">
								<input type="text" name="location" placeholder="Address" required>
							</div> -->
							<div class="form-group col-sm-6 pr-sm-1">
								<select name="meal" style="display: block !important;" required id="bmeal">
									<option>Select a Meal</option>
									@if(count($menus))
										@foreach ($menus as $meal)
										  <option data-cost="{{$meal->cost}}" value="{{$meal->id}}">{{$meal->name}}</option>
										@endforeach
									@endif
								</select>
								<span class="cost"></span>
							</div>
							<div class="form-group col-sm-6 pr-sm-1">
								<input type="number" name="guests" id="guests" placeholder="Number of Guests" min="1" max="1000" required> 
							</div>
              <div class="row col-md-12"> 
                  <div class="form-group col-sm-6 pr-sm-1">
                      <label>Address</label>
                      <input type="text" name="b_address" placeholder="4876 S. Redwood Street"  required />
                  </div>
                  <div class="form-group col-sm-6 pr-sm-1">
                      <label>City</label>
                      <input type="text" name="b_city" placeholder="San Antonio" required/>
                  </div>
                  <div class="form-group col-sm-6 pr-sm-1">
                      <label>State</label>
                      <input type="text" name="b_state" placeholder="Texas" required/>
                  </div>
                  <div class="form-group col-sm-6 pr-sm-1">
                      <label>Zip</label>
                      <input type="text" name="b_zip" placeholder="79865" required/>
                  </div>
              </div>
							<div class="form-group col-sm-12 pr-sm-1 text-center">
								<input class="singup-btn" type="submit" name="submit" value="SUBMIT REQUEST">
							</div>
						  </div>
                        </form>
                    </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('public/js/slider.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

      $(".check_login").on("click", function() {           
          $("#login-modal").modal("show");
          loginURL = "/chef/{{$chef->id}}";
      });

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $(document).on('click', '.not-book', function() {
           swal("You can’t book a chef with a chef account")
      });

      $(document).on('click', '.not-fav', function() {
           swal("You can’t favorite a chef with a chef account")
      });

      $(document).on('click', '.add-to-fav', function() {
          let chef_id = $(this).attr("data-id");
          let that = $(this);
          $.ajax({
              type:'POST',
              url:'{{route("add-to-fav")}}',
              data: { 'chef_id': chef_id},
              success:function(data) {
                  if(data.status) {
                      that.text("REMOVE FROM FAVORITE");
                      that.addClass("remove-to-fav").removeClass("add-to-fav");
                      swal("Done!", data.response, "success")
                  }else{
                      swal("Info!", data.response, "info")

                  }
              },
              error: function(err) {
                swal("Error!", "Please try again", "error");
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
                        that.text("FAVORITE THIS CHEF");
                        that.addClass("add-to-fav").removeClass("remove-to-fav");
                        swal("Done!", data.response, "success")                        
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        }); 

      let ava_dates = "{{$off_dates}}";
      let datesArr = ava_dates.split(",");
      let dateArray = [];
      if(datesArr.length) {
          for (var i = 0; i < datesArr.length; i++) {
              let startDate = datesArr[i];
              var currentDate = moment(startDate);
              dateArray.push( moment(currentDate).format('YYYY-M-D') )   
          }
      }

      console.log("dateArray", dateArray)

      $('#booking_date').datepicker({
          startDate: '+1d',
          daysOfWeekDisabled: "{{$offweeks}}",
          autoclose: true,        
          beforeShowDay: function (date) {
              var allDates = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
              if(dateArray.indexOf(allDates) != -1) {
                return false;
              } else {
                return true;                
              }
          }
      });

      $('#booking_date').on('changeDate', function() {
          let date = $('#booking_date').datepicker('getFormattedDate');
          
          $.ajax({
                type:'POST',
                url:'{{route("check-time")}}',
                data: {date: date, chef_id: "{{$chef->id}}"},
                success:function(data) {
                  
                  let options = "<option value=''>Select Time</option>";
                  if(data.times.length) {
                    for(let key in data.times) {
                      options += "<option value="+data.times[key]+">"+data.times[key]+"</option>";
                    }
                  }
                  $("#booking_time").html(options);
                },
                error: function(err) {
                  swal("Error!", "Please try again", "error");
                }
            });
      });

      $("#bmeal").on('change', function() {
        let cost = $(this).find(':selected').data('cost');
        let gust = $("#guests").val();
        cost = gust ? gust * cost : cost;
        if(cost) {
          $(".cost").show().html('<strong>Cost $'+cost+'</strong>');
        }else{
          $(".cost").hide()
        }        
      });

      $("#guests").on('keyup', function() {
        let gust = $(this).val();
        let cost = $("#bmeal").find(':selected').data('cost');
        if(cost) {
          $(".cost").show().html('<strong>Cost $'+(cost * gust)+'</strong>');
        }else{
          $(".cost").hide()
        }        
      });
      $("#guests").on('change', function() {
        let gust = $(this).val();
        let cost = $("#bmeal").find(':selected').data('cost');
        if(cost) {
          $(".cost").show().html('<strong>Cost $'+(cost * gust)+'</strong>');
        }else{
          $(".cost").hide()
        }        
      });
    
    

      var moretext = "VIEW MORE";
      var lesstext = "VIEW LESS";
      $(".morelink").click(function() {
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $("#more-collapse").toggle();
      });


      var moretext2 = "VIEW MORE";
      var lesstext2 = "VIEW LESS";
      $(".morelink2").click(function() {
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext2);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext2);
          }
          $("#more2-collapse").toggle();
      });
      
    });
</script>  
@endsection
@endsection 