@extends('layouts.header')
@section('styles')
<link href="{{asset('css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/public/css/simpleLightbox.min.css')}}">

@endsection
@section('content')
<!-- chef header end here -->
<!-- another section -->

<?php

$max = 0;
$total_reviews = count($reviews);

if ($total_reviews != null) {
   foreach ($reviews as $count) {
      $max = $max + $count->rating;
   }
   $rate = round($max / $total_reviews, 1);
} else {
   $rate = 0;
}



?>
<div class="hollie_section">

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
   <div class="container">
      <div class="hollie_tittle">
         <div>
            <h3>{{$chef->first_name}} {{$chef->last_name}}</h3>
            @if ($total_reviews==0)
            <p>No Reviews
               @else
            <p><img src="{{asset('images/star.png')}}" alt="">{{$rate}}<span>({{$total_reviews}})</span>
               @endif
               {{$chef->city}}, {{$chef->state}} {{$chef->zip}}
            </p>
         </div>
         <!-- <div class="hello" style="display:none">hello iam navdeep</div> -->
         <div class="holie_links">
            <a><img src="{{asset('images/gift.png')}}" alt="">Gift</a>

            <a class="dropdown">
               <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{asset('images/share.png')}}" alt="">Share</a>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="fbtn share facebook dropdown-item" target="_blank" href="https://www.facebook.com/login.php/ "><i class="fa fa-facebook"></i></a></li>
               <li> <a class="fbtn share gplus dropdown-item" target="_blank" href="https://plus.google.com/share?url=url"><i class="fa fa-google-plus"></i></a> </li>
               <li> <a class="fbtn share twitter dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?text=title&amp;url=url&amp;via=creativedevs"><i class="fa fa-twitter"></i></a> </li>
               <li> <a class="fbtn share linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=url&amp;title=title&amp;source=url/"><i class="fa fa-linkedin"></i></a> </li>
               <li> <a class="fbtn share pinterest dropdown-item" target="_blank" href="https://pinterest.com/pin/create/button/?url=url&amp;description=data&amp;media=image"><i class="fa fa-pinterest"></i></a> </li>
            </ul>
            </a>
            <span id=heart><i class="fa fa-heart-o" aria-hidden="true"></i>
               @guest

               <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" data-id="{{$chef->id}}">Add Favorite</a>

               <!-- 
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Login
                     </button> -->

               @else

               @if ($wishlist==1)

               <a href="javascript:void(0)" class="fav_button remove-to-fav check_login fav_button" data-id="{{$chef->id}}">Remove Favorite</a>
               @else

               <a href="javascript:void(0)" class="fav_button add-to-fav " data-id="{{$chef->id}}">Add Favorite</a>
               @endif
               @endguest




               <!-- <a href="javascript:void(0)" class="add-to-fav" data-id="{{$chef->id}}"><img src="{{asset('images/heart.png')}}" alt="">Favorite</a> -->
         </div>
      </div>

      <div class="hollie_slider">
         <div class="wrapper">
            <div class="center-slider">

               <?php

               $meal_videos = explode('watch?v=', $chef->meal_videos);

//            echo "<pre>";
// print_r( $meal_videos );
// echo "</pre>";


               ?>



               @if($meal_videos!=null)
               @foreach ($meal_videos as $lists_videos )
               <div class=" slides">
                  <div class="btn_video_popup">
                     <iframe width="100%" height="424" src="https://www.youtube.com/embed/{{$lists_videos}}">
                     </iframe>
                  </div>
               </div>
               @endforeach
               @else
               <h4>No videos</h4>
               @endif


            </div>
         </div>

      </div>
   </div>

   <!-- video slider popup -->
   <!-- <div class="chef_popup">
     
      <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                  </iframe>
               </div>
            </div>
         </div>
      </div>
   </div> -->

   <!-- another section -->
   <div class="professional-meal-section">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="professional_left">
                  <div class="first_div">
                     <h4>Professional meal prepared by {{$chef->first_name}} </h4>
                     <span>Average preparation - {{$chef->avg_time}}minutes</span>
                     <img src="{{asset('/uploads/profiles')}}/{{$chef->profile_pic}}" />
                  </div>

                  <div class="scnd_div">
                     <h4 class="h4_text">What to expect</h4>
                     <p class="p_grey">{{$chef->customer_expect}}
                     </p>

                  </div>

                  <div class="thrd_div">
                     <h4 class="h4_text">Meal specialities</h4>
                     <div>
                        <?php
                        $meals_speciality = explode(',', $chef->meal_speciality);

                        ?>
                        @if ( $chef->meal_speciality !=null)
                        @foreach ( $meals_speciality as $meals)
                        <a>{{$meals}}</a>
                        @endforeach
                        @else

                        <h2>Meal specialities found.</h2>

                        @endif




                     </div>
                  </div>

                  <div class="frth_div">

                     <?php
                     // echo "<pre>";  
                     // print_r($chef->certificate_data);
                     // echo "</pre>";

                     $m = $chef->certificate_data;

                     ?>
                     <h4 class="h4_text">Certifications</h4>
                     @if($chef->certificate_data != null)
                     @foreach( $m['names'] as $namesKey => $namesValue)
                     <div>
                        <span>Certificate Name:</span><span><strong>{{$namesValue}}</strong></span> <br />
                        <span>Certificate Number: </span><span><strong>{{$m['numbers'][$namesKey]}}</strong></span>

                     </div>
                     @endforeach

                     @else
                     <h4 class="h4_text">No Certification.</h4 @endif </div>

                     <div class="fifth_div">
                        <div class="content_profile">
                           <img src="{{asset('/uploads/profiles')}}/{{$chef->profile_pic}}" />
                           <h4>Meet your chef, {{$chef->first_name}} </h4>
                           <span>Chef on Best Local Chef since {{date("F Y", strtotime($chef->created_at))}}</span>
                        </div>
                        <h5>College: {{$chef->college}} <span>|</span> Years of experience: {{$chef->experience}}</h5>
                        <p class="p_grey">{{$chef->bio}}</p>
                        <!-- <a href="#">Contact Chef</a> -->
                     </div>

                  </div>
               </div>


               @guest
               <div class="col-md-4">
                  <div class="professional_right">
                     <div class="contact_login_professional">
                        <h4 class="h4_text">Login or Sign up to contact the chef</h4>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                           Login
                        </button>
                     </div>
                  </div>
               </div>
               @else
               <div class="col-md-4">
                  <div class="professional_right">

                     <form action="POST" action="/sendMessage" id="sendMessageForm">
                        @csrf
                        <div class="contact_login_professional">
                           <h4 class="h4_text">Login or Sign up to contact the chef</h4>
                           <input type="hidden" name="chef_id" value="<?php echo $chef->id ?>">
                           <input type="text" name="user_name" placeholder="Name">
                           <span class="text-danger" id="name-error"></span>
                           <textarea name="message" cols="30" rows="4" placeholder="Message"></textarea>
                           <span class="text-danger" id="message-error"></span>
                           <div>
                              <button type="submit" class="btn_c" id="sendMessage">Contact Chef</button>
                           </div>

                        </div>
                     </form>
                  </div>
               </div>
               @endguest


            </div>
         </div>
      </div>

      <!-- another section -->
      <div class="best_local_chef_section">
         <div class="container">
            <div class="best_local_chef_text">
               <h4 class="h4_text">Best Local Chef Experiences</h4>
               <h5>Customer safety</h5>
               <p class="p_grey">All chefs are go through a screening and background check before listed.</p>
               <h5>COVID-19 Response</h5>
               <p class="p_grey">All chefs that prepare meals in home or deliver are required to wear a mask at all times. </p>
            </div>
         </div>
      </div>
      <!-- another section -->
      <div class="reviews_section">
         <div class="container">
            <div class="row">

               @foreach ( $reviews as $review)
               <div class="col-md-6 nextContent">
                  <div class="right_div_reviews">
                     <div class="review_text">
                        <div class="card_reviews">
                           <img src="{{asset('/uploads/profiles')}}/{{$chef->profile_pic}}" />
                           <h5>Millie Sanders</h5>
                           <span>{{date("F Y", strtotime($review->updated_at))}}</span>
                        </div>
                        <p class="p_grey">{{$review->review}}</p>
                     </div>
                  </div>
               </div>

               @endforeach


            </div>
            @if ($total_reviews ==0)
            <a class="btn_c btn_reviews">No reviews</a>
            @else
            <a class="btn_c btn_reviews" id="loadMore">Show all {{$total_reviews}} reviews</a>
            <a class="btn_c btn_reviews" id="backtoup" style="display: none;">Back</a>
            @endif


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
                                 <input type="hidden" name="chef_id" value="{{$chef->id}}">
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


   <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/slick/slick.js')}}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
      $(document).ready(function() {


         //for slider
         $('.center-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            arrows: true,
            dots: false,
            speed: 300,
            centerPadding: '0px',
            infinite: true,
            autoplaySpeed: 5000,
            responsive: [

               {
                  breakpoint: 600,
                  settings: {
                     slidesToShow: 1,
                  }
               },

            ],
            autoplay: false
         });


         $(function() {
            var count = '<?php echo count($reviews); ?>'
            $(".nextContent").slice(0, 2).show();
            $("#loadMore").on('click', function(e) {
               e.preventDefault();

               $(".nextContent:hidden").slice(0, count).slideDown();
               $("#load").fadeOut('slow');
               $("#loadMore").hide();
               $("#backtoup").show();
            });

            $("#backtoup").on('click', function(e) {
               e.preventDefault();

               var prev = count - 2;

               $(".nextContent").slice(0, prev).slideUp()
               $("#load").fadeOut('slow');
               $("#loadMore").show();
               $("#backtoup").hide();
            });
         });

         // loginform

         $(".submit_log").click(function(e) {
            e.preventDefault();

            ajax_login();
         });

         function ajax_login() {
            var chefId = '<?php echo $chef->id ?>';
            var chefName = '<?php echo $chef->first_name . '' . $chef->last_name ?>';
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
                        if (data.user.user_type == "chef") {

                           $('#myModal').hide();
                           window.location.href = '{{url("/chef/")}}' + '/' + chefId + '/' + chefName;
                        } else {
                           $('#myModal').hide();
                           window.location.href = '{{url("/chef/")}}' + '/' + chefId + '/' + chefName;
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



         //send mail to chef
         $("#sendMessage").on('click', function(e) {

            e.preventDefault();

            var sendMessageForm = $("#sendMessageForm");
            var messageformData = sendMessageForm.serialize();

            $.ajax({
               url: '/sendMessage',
               type: 'POST',
               data: messageformData,

               success: function(data) {

                  swal('Done', data.response, 'success');

               },
               error: function(response) {
                  if (response.responseJSON.errors) {
                     $('#name-error').text(response.responseJSON.errors.user_name);

                     $('#message-error').text(response.responseJSON.errors.message);
                  }

                  console.log(response)
               }
            });

         });


         //add to fav
         $(document).on('click', '.add-to-fav', function() {
            let chef_id = $(this).attr("data-id");
            let that = $(this);
            // debugger
            $.ajax({
               type: 'POST',
               url: '{{route("add-to-fav")}}',
               data: {
                  'chef_id': chef_id,
                  _token: "{{ csrf_token() }}"
               },
               success: function(data) {
                  if (data.status) {

                     that.text("Remove favorite");
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

            // debugger
            let chef_id = $(this).attr("data-id");
            let that = $(this);

            $.ajax({
               type: 'POST',
               url: '{{route("remove-to-fav")}}',
               data: {
                  'chef_id': chef_id,
                  _token: "{{ csrf_token() }}"
               },
               success: function(data) {
                  that.text("Add Favorite");
                  that.addClass("add-to-fav").removeClass("remove-to-fav");
                  swal("Done!", data.response, "success")
               },
               error: function(err) {
                  swal("Error!", "Please try again", "error");
               }
            });

         });
         //custom button for homepage
         $(".share-btn").click(function(e) {
            $('.networks-5').not($(this).next(".networks-5")).each(function() {
               $(this).removeClass("active");
            });

            $(this).next(".networks-5").toggleClass("active");
         });



      });
   </script>

   @endsection