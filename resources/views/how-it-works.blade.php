@extends('layouts.main')
@section('styles')
  <link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection

@section('title', 'Customized meals delivered to your door')

@section('content')
<?php 
foreach($topchefs as $topchef)
{
	$tchefs[] = $topchef;
}


?>
<!-- banner -->
<section class="work-page-banner">
    <div class="container">
		<div class="how-works-wrapper">
			<div class="how_works-it-inner">
				<div class="works-title-wrap">
					<h1>BEST LOCAL CHEF</h1>
					<h4>Skip the stores. Skip the cleanup.</h4>
					<p>Customized meals delivered to your door</p>	
				</div>
				<div class="banner-buttonS-sec">
                    <!-- <a class="for-customers" href="#">For Customers</a>
					<a class="for-chefs" href="#">For Chefs</a> -->
          <form class="banner-search" name="" method="get" action="{{route('menu-listing')}}" autocomplete="off">
                    <div class="row">
            <div class="col-md-6 pr-md-6">
              <input type="text" name="service_area" placeholder="Zip Code" class="search-box-zip" />
            </div>
            <!-- <div class="col-md-4 pr-md-2">
              <select class="custom-select prefrences" name="meal_prefrences" value="<?php if(isset($_GET['prefrences'])) echo $_GET['prefrences'] ?>" id="mealPref">
                <option value="">Select Meal Preference</option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Meat") echo "selected";?> value="Meat"> Meat</option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegan") echo "selected";?> value="Vegan">Vegan</option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegetarian ") echo "selected";?> value="Vegetarian"> Vegetarian  </option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Athlete ") echo "selected";?> value="Athlete"> Athlete  </option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Plant_based ") echo "selected";?> value="Plant_based">  Plant-based</option>
                <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Gluten_free") echo "selected";?> value="Gluten_free"> Gluten-free </option>
              </select>
            </div> -->
            <div class="col-md-6 pr-md-6">
              <input type="submit" value="Find Best Local Chef Near You" name=""  />
            </div>
          </div>          
                </form>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<div class="content-wrap no-top-padd">
<section class="works-page-video">
	<div class="container">
		 <div class="work-video-icon">
            <!-- <span><a href="#" data-toggle="modal" data-target="#myModal1"><img src="https://bestlocalchef.com/public/img/play-icon.png"></a></span> -->
		 </div>
	</div>
</section>  
<section class="chef_serched-section">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
 <div class="chef_serching_mage">
    <img src="https://bestlocalchef.com/img/iphone-findchef.png">
 </div>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-self-center">
  <div class="how-it-works-text">
     <h2>Search top-rated chefs in your area</h2>
	 <p>Want a break from cooking? Tired of restaurant food? Have something to celebrate? Browse local personal chefs and get customized meals delivered fresh to your doorstep.</p>
	 <p><a class="solid-btn-blk-h-y mt-4" href="https://bestlocalchef.com/find-a-chef">Book a Chef</a></p>
  </div>
</div>
</div>
</div>
</section>
<section class="chef-testimonial">
   <div class="chef_testimonial-inner">
      <div class="container-fluid no-padd">
         <div class="row no-margin">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 no-padd">
                <div class="chef-testimonial-left-box">
                  <div class="chef-testimonial-left-cntnt">  
                   <h2>We cater to your preferences</h2>
                   <p>No need to spend time researching restaurants that fit your diet or taste. Best Local Chef facilitates unique culinary experiences for a wide range of dietary preferences.</p>
                </div>
            </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 no-padd">
              <div class="chef-testimonial-right-box">
                 <div class="chef-testimonial-slider">                     
                    <div id="chef-slider" class="carousel slide" data-ride="carousel">
                       <div class="slider-prev-icon">                      
                        <a class="carousel-control-prev" href="#chef-slider" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                      </a>
                      <a class="carousel-control-next" href="#chef-slider" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                      </a>
                  </div> 
                      <div class="carousel-inner">
					  <?php 
					$i=0;
					if(isset($tchefs) && count($tchefs)) {
						
					foreach($tchefs as $topchef)
					{
					?>
                        <div class="carousel-item <?php if($i==0) { echo "active"; } ?>">
                          <div class="chef_profile-slide-wrapper">  
                            <div class="chef_profile-slide">
                               <h2>CHEF PROFILE</h2>
                               <h1 class="chef_name"><?php echo $topchef->first_name." ".$topchef->last_name; ?></h1>
                               <p>AREAS SERVICED: <span class="chef_locaTion">{{$topchef->service_area}}</span></p>
                               <div class="chef_rating">
                                  <div class="star-ratings-cheF">
                                  <div class="rating">
											<div class="star-ratings">
												<div class="star-ratings-top" style="width: {{$topchef->max_rate * 20}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
												<div class="star-ratings-bottom"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
											</div>
										</div>
                                </div>
                                <div class="cheF-favorite">
                                   <span>FAVORITE CHEF</span>
                                </div>
                               </div>
                            </div>
                            <div class="chef_slide-image">
                               <img class="" src="{{asset('/uploads/profiles/')}}/<?php echo $topchef->profile_pic; ?>" alt="">
                            </div>
                        </div>
                        </div>
                       
                        <?php 
					$i++;
					}
					}
					?>
                      </div>
                    </div>
                 </div>
                 <div class="testimonial_dicorative-image">
                    <span class="chicken"><img src="https://bestlocalchef.com/img/Chicken.png"><span class="name">Chicken</span></span>
                    <span class="red-meat"><img src="https://bestlocalchef.com/img/Red-Meat.png"><span class="name">Red Meat</span></span>
                    <span class="vrgan"><img src="https://bestlocalchef.com/img/Vegan.png"><span class="name">Vegan</span></span>
                 </div>
              </div>
            </div>
         </div>
     </div>
   </div>
</section>
<section class="meal_desert_sectiuon">
   <div class="meanl_desert-list">
      <ul class="list-unstyled">
         <li><span>Meals</span></li>
         <li><span>Dessert</span></li>
         <li><span>Appetizers</span></li>
      </ul>
   </div>
</section>
<section class="chef_personal-section chef_section-mobile">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
 <div class="chef_serching_mage">
    <img src="https://bestlocalchef.com/img/iphone-personalchef.png">
 </div>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-self-center">
  <div class="how-it-works-text">
     <h2>Personal chef services on demand</h2>
	 <p>Skip the grocery stores and kitchen cleanup. Search by zipcode to find the best professional chefs in your area and sort by specialty or meal type.</p>
	 <p><a class="solid-btn-blk-h-y mt-4" href="https://bestlocalchef.com/find-a-chef">Best Chef Near You</a></p>
  </div>
</div>
</div>
</div>
</section>
<section class="anywhere-section">
   <div class="container">
       <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-self-center">
            <div class="anywhere-sec-text">
               <h2>Special Occasions </h2>
				<p>Planning a romantic dinner, family night, or special celebration at home? Our chefs will plan the menu, shop for supplies, cook the food, and deliver to your doorstep so you can sit back, relax, and enjoy. </p>
				<p><a class="solid-btn-blk mt-4" href="https://bestlocalchef.com/find-a-chef">Book a Chef Today</a></p>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			 <div class="chef_serching_mage special_occasion">
				<img src="https://bestlocalchef.com/img/special-occasions.jpg">
			 </div>
		  </div>
       </div>
       <div class="row" style="display:none">
			<div class="google_pay-app-store">
				<img src="https://bestlocalchef.com/img/google-img-icon.png" class="app-icon" alt="" width="200" height="60">
				<img src="https://bestlocalchef.com/img/app-store-icon.png" class="app-icon" alt="" width="200" height="60">
			</div>
       </div>
   </div>
</section>
</div>
	<div class="modal fade course-modal-wrap" id="myModal1" tabindex="-1" role="dialog">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button> 
		<div class="modal-dialog modal-dialog-centered">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<div class="amenities-video-cover embed-responsive embed-responsive-16by9">
						  <iframe width="560" height="315" id="bannervideo" src="https://www.youtube.com/embed/IbfxHAhQlC0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
					</div>
				</div>	
			</div>
		</div>

	</div>
@section('scripts')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
<script src="{{ asset('js/jquery-ui.min.js')}}"></script> 
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script> 
<script src="{{ asset('js/moment.min.js')}}"></script>

<script>
  $(document).ready(function() {

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


   $("#myModal1").on('hidden.bs.modal', function (e) {
        $("#myModal1 iframe").attr("src", $("#myModal1 iframe").attr("src"));
    });
</script>

@endsection
@endsection