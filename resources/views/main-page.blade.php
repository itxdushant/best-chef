@extends('layouts.home-layout')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection

@section('content')

<?php 
foreach($topchefs as $topchef)
{
	$tchefs[] = $topchef;
}

?>

<style type="text/css">

  .star-ratings {
    unicode-bidi: bidi-override;
    color: #c5c5c5;
    font-size: 34px;
    line-height: 1.2;
    width: 148px;
    margin: 0px;
    position: relative;
    padding: 0;
	text-align: center;
    display: inline-block;
    margin-top: 10px;
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
  
  .itemnext .star-ratings-top[style] {
    left:3px!important;
  }

  .card-title a{color:#fff;letter-spacing:1px;}
  
</style>

<section class="banner">     
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 text-center">				
				<div class="banner-title">
					Fine dining without leaving home
					<span>Personal Chefs. Cooking Classes. Special Occasions.</span>
				</div>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-md-12">
                <form class="banner-search" name="" method="get" action="{{route('menu-listing')}}" autocomplete="off">
                    <div class="row">
						<div class="col-md-4 pr-md-2">
							<input type="text" name="service_area" placeholder="Zip Code" class="search-box-zip" />
						</div>
						<div class="col-md-4 pr-md-2">
							<select class="custom-select prefrences" name="meal_prefrences" value="<?php if(isset($_GET['prefrences'])) echo $_GET['prefrences'] ?>" id="mealPref">
							  <option value="">Select Meal Preference</option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Meat") echo "selected";?> value="Meat"> Meat</option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegan") echo "selected";?> value="Vegan">Vegan</option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Vegetarian ") echo "selected";?> value="Vegetarian"> Vegetarian  </option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Athlete ") echo "selected";?> value="Athlete"> Athlete  </option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Plant_based ") echo "selected";?> value="Plant_based">  Plant-based</option>
							  <option <?php if(isset($_GET['meal_prefrences']) && $_GET['meal_prefrences'] == "Gluten_free") echo "selected";?> value="Gluten_free"> Gluten-free </option>
							</select>
						</div>
						<div class="col-md-4 pr-md-2">
							<input type="submit" value="Find Best Local Chef Near You" name=""  />
						</div>
					</div>          
                </form>
            </div>
		</div>
	</div>
</section>

<section class="search-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
				<p>On Vacation? Work trip? Special Occasion? Best Local Chef helps you find top-rated personal chefs in your area. Enjoy a fine dining experience without leaving the comfort of your AirBnb, HomeAway, Vrbo, OneFineStay, vacation rental or home.</p>
				<div class="bell-icon-box">
					<img alt="bell-icon" src="{{asset('img/bell-icon.png')}}" />
				</div>
			</div>			
        </div>
    </div>
</section>

<section class="home-about-section">
    <div class="container">
        <div class="row">
			<div class="col-md-8 offset-md-2 text-center novisible">
				<h4 class="section-title section-title-center">ABOUT BEST LOCAL CHEF</h2>
				<p class="mt-3">Enjoy great varieties of greatly prepared hand made meals, right in the convenience of your own home, by the best local chefs in the Austin, Texas area.</p>
			</div>
			
			<div class="col-md-4">
			  <div class="card mb-2">
				<img class="card-img-top" src="{{asset('img/img01.jpg')}}" alt="Card image cap">
				<div class="card-body">
				  <img class="" src="{{asset('img/home-icon.png')}}" alt="Card image cap">
				  <h4 class="card-title font-weight-bold"><a href="#">Short Term Rentals</a></h4>
				  <p>Fresh, custom meals prepared and served at your rental home.</p>
				  <div class="">
					<a class="outline-btn" href="{{route('menu-listing')}}">BOOK A CHEF</a>
				  </div>
				</div>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="card mb-2">
				<img class="card-img-top" src="{{asset('img/img02.jpg')}}" alt="Card image cap">
				<div class="card-body">
				  <img class="" src="{{asset('img/port-icon.png')}}" alt="Card image cap">
				  <h4 class="card-title font-weight-bold"><a href="#">Special Occasions</a></h4>
				  <p>Private chef services for intimate gatherings and special celebrations.</p>
				  <div class="">
					<a class="outline-btn" href="{{route('menu-listing')}}">BOOK A CHEF</a>
				  </div>
				</div>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="card mb-2">
				<img class="card-img-top" src="{{asset('img/img03.jpg')}}" alt="Card image cap">
				<div class="card-body">
				  <img class="" src="{{asset('img/box-icon.png')}}" alt="Card image cap">
				  <h4 class="card-title font-weight-bold"><a href="#">Cooking Classes</a></h4>
				  <p>Perfect for romantic dinners, bachelorette parties or family night at your rental home.</p>
				  <div class="">
					<a class="outline-btn" href="{{route('menu-listing')}}">BOOK A CHEF</a>
				  </div>
				</div>
			  </div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center my-4">
				<h5>Skip the restaurant crowds and the effort of cooking. Our chefs will plan the menu, shop for supplies, cook the food and clean the kitchen so you can relax and enjoy.</h5>
			</div>
		</div>
    </div>
</section>

<section class="gallery-section">
    <div class="container">
        <div class="row">		    
			<div class="col-md-6">
				<div class="py-4 px-md-5 px-3 best-chef-box">
					<h3>Choose from top-rated chefs in your area.</h3>
					<p>Search by zipcode to find professional chefs in your area and sort by specialty or meal type. </p>
					
					<form name="" action="{{route('menu-listing')}}" method="get" class="find-local-chef" autocomplete="off">
						<input type="text" name="service_area" placeholder="Enter Zip Code" />
						<input type="submit" value="View Top Rated Chefs" />
					</form>
				</div>
			</div>
			
			<div class="col-md-6">	
				<div class="owl-carousel owl-theme">
					<?php 
					$i=0;
					if(isset($tchefs) && count($tchefs)) {
					foreach($tchefs as $topchef)
					{
					?>
					<div class="item <?php if($i>0) { echo "itemnext"; } ?>">
							<div class="chef-profile-data">
								<div class="row d-flex flex-row-reverse">
									<div class="col-md-6 profile-data-img">
										<img class="" src="{{asset('uploads/profiles/')}}/<?php echo $topchef->profile_pic; ?>" alt="" onerror="this.onerror=null;this.src='{{asset('uploads/profiles/l60Hf.png')}}';">
									</div>
									<div class="col-md-6 profile-data mt-md-4 mb-md-5 mb-2">
										<h2><?php echo $topchef->first_name." ".$topchef->last_name; ?></h2>
										<div class="rating">
											<div class="star-ratings">
												<div class="star-ratings-top" style="width: {{$topchef->max_rate * 20}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
												<div class="star-ratings-bottom"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
											</div>
										</div>
										<div class="mt-4">
											<a href="{{url('chef')}}/<?php echo $topchef->id; ?>/<?php echo strtolower($topchef->first_name).strtolower($topchef->last_name); ?>" class="outline-btn-blk">View Profile</a>
										</div>
									</div>								
									<div class="clearfix"></div>
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
			<div class="clearfix"></div>			     
        </div> 
    </div>
</section>

<!-- Initialize Swiper -->

<section class="py-lg-5 py-4">
	<div class="container">
        <div class="row">
		    <div class="col-md-6 about-icon-box text-center">
				<div class="row">
					<div class="col-md-6 col-6">
						<img alt="Red Meat" src="{{asset('img/Red-Meat.png')}}" />
						<p class="my-3 mb-md-5">Meat</p>
					</div>					
					<div class="col-md-6 col-6">
						<img alt="Vegan" src="{{asset('img/Vegan.png')}}" />
						<p class="my-3 mb-md-5">Vegan</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-6 col-6">
						<img alt="Vegetarian" src="{{asset('img/Vegetarian.png')}}" />
						<p class="my-3 mb-md-5">Vegetarian</p>
					</div>
					<div class="col-md-6 col-6">
						<img alt="Athletes" src="{{asset('img/Athletes.png')}}" />
						<p class="my-3 mb-md-5">Athletes</p>
					</div>										
					<div class="clearfix"></div>
				</div>
				
				<div class="row">
					<div class="col-md-6 col-6">
						<img alt="Fresh" src="{{asset('img/Fresh.png')}}" />
						<p class="my-3 mb-md-5">Plant-based</p>
					</div>
					<div class="col-md-6 col-6">
						<img alt="Chicken" src="{{asset('img/gluten-free.png')}}" />
						<p class="my-3 mb-md-5">Gluten-Free</p>
					</div>					
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="col-md-6">
				<h2 class="section-main-title text-center">
					We cater to your preferences
				</h2>
				<div class="specialize-data text-center py-lg-4">
					No need to spend time researching restaurants that fit your diet or taste. Best Local Chef facilitates unique culinary experiences for a wide range of dietary preferences.
				</div>
				<div class="text-center mt-md-5 mt-3">
					<a href="{{route('menu-listing')}}" class="solid-btn-blk-h-y">Book a Chef</a>
				</div>
			</div>        
			<div class="clearfix"></div>
		</div> 
		
    </div>
</section>


<section class="about-section py-3 mt-4">
    <div class="container">
        <div class="row">		    
			<div class="col-md-6">
				<div class="py-4 px-md-5 px-3 about-data text-center">
					<h3>
						 Do you own a short term rental?
					</h3>
					<p>Stand out from competitors and increase the value of your short term rental by offering personal, in-home chef services.</p>
					<div class="mt-3">
						<a href="/partner" class="solid-btn-blk">Become a Best Local Chef Partner.</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 about-img-box">	
				<div class="text-md-right text-center about-img-box-inner">
					<img class="img-fluid" alt="AirBNB" src="{{asset('img/about-img.jpg')}}" />
				</div>
			</div>
			<div class="clearfix"></div>			     
        </div> 
    </div>
</section>



@section('scripts')
<script src="{{ asset('js/jquery-ui.min.js')}}"></script> 
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script> 
<script src="{{ asset('js/moment.min.js')}}"></script> 

<script type="text/javascript">
    $(document).ready(function() {

      $('.date').datepicker({
          startDate: moment().format('dd/mm/yyyy'),
          format: 'dd/mm/yyyy',
          autoclose: true
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

     $('#mealPref').on('change', function() {
		 
		   var Meal_prefrences=this.value;
			$.ajax({
                  url: "{{url('auto-list')}}",
                  dataType: "json",
                   data: Meal_prefrences,
                  success: function(data) {
                      response(data);
                  }
              });
      });

    });
</script>
@endsection
@endsection