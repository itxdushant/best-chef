<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>:. Best Local Chefs .:</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{asset('css/font-awesome.min.css')}}" type="text/css" rel="stylesheet" />
	<link href="{{asset('css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
	<link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet" />
	<link href="{{asset('css/sweetalert.css')}}" type="text/css" rel="stylesheet" />
	<link href="{{asset('css/main.css')}}" type="text/css" rel="stylesheet" />
	
	<link href="{{asset('css/owl.carousel.min.css')}}" type="text/css" rel="stylesheet" />
	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
	<style>
		body.home.mac-os .star-ratings {
		width: 152px !important;
		position: relative;
		}
		body.home.mac-os .star-ratings-bottom {
		width: 100% !important;
		}
	</style>
	
@yield('styles', '')
</head>

<body class="home home-page">
    <div id="top-chef-bar">
    <p data-toggle="modal" data-target="#topstrip">How we’re keeping you safe during COVID-19</p>
</div>	
<div class="header-section">
	<div class="header-top-grid hidden-lg hidden-md float-none">
		<!--<ul class="social-icon">
			<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
		</ul>-->
	
		@guest
			<ul class="profile-menu">                        
				<li><a href="#" class="login" data-toggle="modal" data-target="#login-modal">Login</a></li>
				<li><a href="#" class="" data-toggle="modal" data-target="#login-modal2" class="active">JOIN</a></li>
				<li><a href="{{url('/find-a-chef')}}" class="active">BOOK A CHEF</a>
				@if(Session::has('booking_date'))	
					<li><a href="{{ url('checkout') }}" class="">Checkout</a></li>
				@endif
			</ul>
		@else
			<ul class="profile-menu">                        
				<li><a href="{{ url(Auth::user()->user_type) }}" class="">{{ Auth::user()->first_name }}</a></li>
				<li>
					<a class="register-link-grid" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
				@if(Session::has('booking_date'))
					@if(Auth::user()->user_type == 'user')
						<li><a href="{{ url('checkout') }}" class="">Checkout</a></li>
					@endif					
				@endif
			</ul>
		@endguest 
	</div>	

	<div class="site-wrapper clearfix">
		<div class="site-overlay"></div>
		<div class="header-mobile clearfix" id="header-mobile">
			<div class="header-mobile__logo">
				<h1><a href="{{url('/')}}"><img alt="logo" src="{{asset('public/img/logo.png')}}" /></a></h1>
			</div>
			
			<div class="header-mobile__inner">
				<a id="header-mobile__toggle" class="burger-menu-icon">
					<span class="burger-menu-icon__line"></span>
				</a>
			</div>
		</div>
		
		<header class="header header-standard">                
			<div class="header__primary">
				<div class="container">
					<div class="header__primary-inner">
						<div class="header-logo">
							<a href="{{url('/')}}">
								<img alt="logo" src="{{asset('public/img/logo.png')}}" />
							</a>
						</div>
						<nav class="main-nav clearfix">
							<ul class="main-nav__list">
								<div class="header-back_btn">
									<span class="main-nav__back"></span>
								</div>
								<li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{url('/')}}">HOME</a></li>
								<li class="{{ request()->is('menu-listing') ? 'active' : '' }}"><a href="{{route('menu-listing')}}">FIND A CHEF</a></li>									
								
							</ul>
							<div class="header-right-grid hidden-sm hidden-xs">                                    
								@guest
									<ul class="profile-menu">                        
										<li><a href="#" class="login" data-toggle="modal" data-target="#login-modal">Login</a></li>
										<li><a href="#" class="" data-toggle="modal" data-target="#login-modal2" class="active">JOIN</a></li>
										<li><a href="{{url('/find-a-chef')}}" class="active">BOOK A CHEF</a>
										@if(Session::has('booking_date'))
											<li><a href="{{ url('checkout') }}" class="">Checkout</a></li>
										@endif
									</ul>
								@else
									<ul class="profile-menu">                        
										<li><a href="{{ url(Auth::user()->user_type) }}" class="">{{ Auth::user()->first_name }}</a></li>
										<li>
											<a class="register-link-grid" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</li>
									
									@if(Session::has('booking_date'))
										@if(Auth::user()->user_type == 'user')
											<li><a href="{{ url('checkout') }}" class="">Checkout</a></li>
										@endif					
									@endif
								</ul>
								@endguest
							</div>                              
							                                 
						</nav>
					</div>
				</div>
			</div>
		</header>
	</div>	
</div>

	@yield('content')

<footer class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid footer-logo" alt="logo" src="{{asset('img/logo.png')}}" />                
                <ul class="social-icon">
                    <li><a href="https://www.facebook.com/bestlocalchef" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.instagram.com/bestlocalchef/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </div>
			<div class="col-md-9">			   
               <ul class="footer-menu">                    
                    <li><a href="{{route('home')}}">Home</a></li>
					<li><a href="{{route('menu-listing')}}">Find A Chef</a></li> 
                    <li><a href="{{route('chef-how-to-forum')}}">How-To Forum</a></li>
					<li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
					<li><a href="{{route('terms-of-use')}}">Terms of Use</a></li>
                    <li><a href="{{route('contact-us)}}">Contact</a></li>					
                </ul>
			</div>
        </div>
		<div class="row">
            <div class="col-md-12">
				<p class="copyright">Copyright © 2020 Best Local Chef. All Rights Reserved.</p>
			</div>
		</div>
    </div>
</footer>


<!--/Login-modal-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
						
						<div class="row forgot-grid">
							<div class="col-md-6 col-6 text-left">
								<a href="{{url('password/reset')}}">Forgot my password</a>
							</div>
							<div class="col-md-6 col-6 text-right">
								<a href="#" data-toggle="modal" id="signuppopup" data-target="#login-modal2">Don’t have an account?</a>
							</div>
							<div class="clearfix"></div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//Login-->

<!---/Sing-Up-->
<div class="modal fade" id="login-modal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered join-model" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				<h1 class="modal-title text-center">JOIN TODAY</h1>
            </div>
			
            <div class="modal-body">
                <div class="login text-center">
                    <div class="row mb-md-5 mb-4">
                        <div class="col-md-6 col-6 text-center" style="border-right:1px solid #ccc">
                            <h3 class="roll-title">CUSTOMER</h3>
                            <a class="singup-btn" href="{{route('user-register')}}">JOIN</a>
                        </div>
                        <div class="col-md-6 col-6 text-center">
                            <h3 class="roll-title">CHEF</h3>
                            <a class="singup-btn" href="{{route('chef-register')}}">JOIN</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
			
        </div>
    </div>
</div>
<!--//Sing Up-->
<!---/Topstrip-Up-->
<div class="modal fade" id="topstrip" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				<h1 class="modal-title text-center">How we’re keeping you safe during COVID-19</h1>
            </div>
            <div class="modal-body">
                <div class="topstrip-text-block">
                  <p>We’re happy you’re using our meal service platform and want to share a few ways we’re adapting to the COVID-19 pandemic and keeping you safe.</p>
                <ul class="list-numbered">
                  <li><strong>No more in-home service.</strong> For now, we are asking our chefs to prepare their meals off-site and deliver to their clients’ homes, for their safety and yours.</li> 
                  <li><strong>No contact delivery.</strong> Our chefs will leave meals on your doorstep and maintain a 6-foot distance when delivering items. </li>
                  <li><strong>Food preparation standards.</strong> As always, our chefs adhere to Health Department food preparation regulations and are certified by the U.S. National Restaurant Association.</li> 
               </ul>
               <p>We have also asked our chefs to follow COVID-specific <a href="https://www.fda.gov/food/food-safety-during-emergencies/best-practices-retail-food-stores-restaurants-and-food-pick-updelivery-services-during-covid-19">FDA protocol</a> for food preparation and delivery to limit the spread of disease. </p>
                </div>
            </div>
			
        </div>
    </div>
</div>

<!--//Topstrip Up-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/core.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/init.js')}}"></script>
<script src="{{asset('js/owl.carousel.js')}}"></script>
@yield('scripts', '') 

<script type="text/jscript">
$('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<4;i++) {
    next=next.next();
    if (!next.length) {
      next=$(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  }
});
</script>
<!-- sticky nav bar-->

<script>
    $(() => {
        //On Scroll Functionality
        $(window).scroll(() => {
            var windowTop = $(window).scrollTop();
            windowTop > 20 ? $('.header-standard').addClass('header-sticky') : $('.header-standard').removeClass('header-sticky');
            windowTop > 100 ? $('ul.nav-honey').css('top', '50px') : $('ul.nav-honey').css('top', '100px');
        });

        //Click Logo To Scroll To Top
        $('#logo').on('click', () => {
            $('html,body').animate({
                scrollTop: 0
            }, 500);
        });


        //Toggle Menu
        $('#menu-toggle').on('click', () => {
            $('#menu-toggle').toggleClass('closeMenu');
            $('ul').toggleClass('showMenu');

            $('li').on('click', () => {
                $('ul').removeClass('showMenu');
                $('#menu-toggle').removeClass('closeMenu');
            });
        });

    });

    $(document).ready(function() {
        
        $(".submit_log").click(function(e) {
            e.preventDefault();
            ajax_login();
        });

        $("#signuppopup").click(function(e) {
            e.preventDefault();
            $("#login-modal").modal("hide");
            $(".modal-backdrop").remove();
        });

        currUrl = "{{request()->route()->getName()}}";
        console.log("url ", currUrl )
        if(currUrl == "chef-detail" || currUrl == "menu-listing" || currUrl == "checkout") {
            loginURL = "{{url('/')}}/" + currUrl
        }

        $('#password').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                ajax_login();
            }
        });

        function ajax_login() {
                var loginForm = $("#loginForm");
                var formData = loginForm.serialize();
                var formurl = loginForm.attr('action');
                $(".invalid-feedback").hide();
                $.ajax({
                    url: formurl,
                    type:'POST',
                    data:formData,
                    success:function(data) {    
                        
                        if(data && data.auth) {       
                            if(typeof(loginURL) != 'undefined' && loginURL != "") {
                               window.location.href = window.location.href;
                            } else{
                                if (data.user.user_type == "admin") {
                                    window.location.href = "{{url('/admin')}}";
                                } else if (data.user.user_type == "chef") {
                                    window.location.href = "{{url('/chef/profile')}}";
                                } else {
                                    window.location.href = "{{url('/user/profile')}}";
                                }                            

                            }

                        }
                    },
                    error: function (data) {
                        $(".invalid-feedback").show();
                        console.log("error",data);
                    }
                });
            }

    })
</script>

<script>
	$(document).ready(function() {
	if(navigator.userAgent.indexOf('Mac') > 0)
	$('body').addClass('mac-os');
	});
</script>
<script>
$(document).ready(function() {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  	});
  var owl = $('.owl-carousel');
  owl.owlCarousel({
	margin: 25,
	nav: true,
	loop: true,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 1
	  },
	  1000: {
		items: 1
	  }
	}
  })

  	var bczip = getCookie('bczip');
  	if(!bczip) {
  		navigator.geolocation.getCurrentPosition(function(position) {
			// Get the coordinates of the current position.
		    var lat = position.coords.latitude;
		    var lng = position.coords.longitude;
		    var expire = new Date();
			expire.setDate(expire.getDate() + 30);
		    document.cookie = "bczip="+ JSON.stringify({lat: lat, lng: lng}) +"; expires="+ expire +"; path=/";
			window.location.href = window.location.href;
		    // Create a new map and place a marker at the device location.
			// $.ajax({
			// 	url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ lat +','+ lng +'&key=AIzaSyBPlxYBIjisvG84Q8mQo8RHWZqXJBUibKk',
			// 	type: 'GET',
			// 	dataType: 'JSON',
			// 	success: function(response) {
			// 		if(response && response.status === 'OK') {
			// 			if(response.results && response.results[2] && response.results[2].address_components && response.results[2].address_components.length) {
			// 				response.results[2].address_components.map(c => {
			// 					if(c.types && c.types[0] && c.types[0] === 'postal_code') {								
			// 						var zip = c.long_name;
			// 						var expire = new Date();
			// 						expire.setDate(expire.getDate() + 30);
			// 						//set cookie and reload page.
			// 						document.cookie = "bczip="+ zip +"; expires="+ expire +"; path=/";
			// 						window.location.href = window.location.href;
			// 					}
			// 				});
			// 			}

			// 		}
			// 	},
			// 	error: function(error) {
			// 		console.log('===> error ', error);
			// 	}
			// })
		});	
  	}
	
})
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
</script>


<!-- //sticky nav bar -->
</body>
</html>
