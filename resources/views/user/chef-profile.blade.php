@extends('layouts.header')
@section('content')
<div class="hollie_section">
  <div class="container">
    <div class="hollie_tittle">
      <div>
        <h3>{{$chef->first_name}} {{$chef->last_name}}</h3>
        <p><img src="{{asset('images/star.png')}}" alt="">5<span>(34)</span>{{$chef->city}}, {{$chef->state}} {{$chef->zip}}</p>
      </div>
      <div class="holie_links">
        <a href="#"><img src="{{asset('images/gift.png')}}" alt="">Gift</a>
        <!-- <a href="#"><img src="{{asset('images/share.png')}}" alt=""> Share</a> -->
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('images/share.png')}}" alt=""> Share
          </button>
          @php
          $baseUrl="http://127.0.0.1:8000/user/chef-profile/"
          @endphp
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $baseUrl . $chef->id; ?>"><img src="{{asset('images/fb.png')}}">Facebook</a></li>
            <li><a class="dropdown-item" target="_blank" href="http://twitter.com/share?text=Visit the link &url=<?php echo $baseUrl . $chef->id; ?>"><img src="{{asset('images/twitter.png')}}">Twitter</a></li>
            <li><a class="dropdown-item" target="_blank" href="http://instagram.com/share?text=Visit the link &url=<?php echo $baseUrl . $chef->id; ?>"><img src="{{asset('images/insta.png')}}">Instagram</a></li>
          </ul>
        </div>
        @php
        $fav_class = "add-to-fav";
        $fav_txt = "Add Fav";
        if(in_array($chef->id,$favorite_chefs))
        {
        $fav_class = "remove-to-fav";
        $fav_txt = "Remove Fav";
        }
        @endphp
        @auth
        @if($user->user_type != "chef" && !empty($user))
        <label>dhfj
          <input type="checkbox" name="add" class=" fav_button {{$fav_class}}" {{ in_array($chef->id,$favorite_chefs) ? 'checked' : ''}} data-id="{{$chef->id}}" value="{{$fav_txt}}" />
        </label>
        @elseif($user->user_type == "chef" && !empty($user))
        @else
        <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
        @endif
        @else
        <input type="checkbox" name="add" class="check_login fav_button" value="Add Fav" />
        @endauth
      </div>
    </div>


    <div class="hollie_slider">
      <div class="wrapper">
        <div class="center-slider">
          @php
          $meal_images= explode(',',$chef->meal_images);

          @endphp
          <div class="slides_2">
            <iframe width="100%" height="100%" src="{{$chef->video_url}}">
            </iframe>
            <div class="btn_video_popup">
              <button class="" data-url="{{$chef->video_url}}" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <img src="{{asset('images/btn_play.png')}}">
              </button>
            </div>
          </div>

          @foreach($meal_images as $meal_image)
          <div class="slides_1 slides">
            <img class="img-fluid" src="{{asset('uploads/meal-images')}}/{{$meal_image}}" />

          </div>
          @endforeach

        </div>
      </div>

      <!-- video slider popup -->
      <div class="chef_popup">
        <!-- first -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <iframe width="100%" height="100%" src="{{$chef->video_url}}">
                </iframe>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- another section -->
      <div class="professional-meal-section">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="professional_left">
                <div class="first_div">
                  <h4>Professional meal prepared by {{$chef->first_name}}</h4>
                  <span>Average preparation - {{$chef->avg_time}}</span>
                  <img src="{{asset('uploads/profiles')}}/{{$chef->profile_pic}}" />
                </div>

                <div class="scnd_div">
                  <h4 class="h4_text">What to expect</h4>
                  <p class="p_grey">{{$chef->bio}}
                  </p>

                </div>

                @php
                $meal_specalities=explode(',',$chef->meal_speciality)

                @endphp
                <div class="thrd_div">
                  <h4 class="h4_text">Meal specialities</h4>
                  <div>
                    @foreach($meal_specalities as $meal_specality)
                    <a href="#">{{$meal_specality}}</a>

                    @endforeach
                  </div>
                </div>

                <div class="frth_div">
                  <h4 class="h4_text">Certifications</h4>
                  <a href="#">{{$chef->certificate_data}}</a>
                </div>

                <div class="fifth_div">
                  <div class="content_profile">
                    <img src="images/professional_hollie.png" alt="">
                    <h4>Meet your chef, {{$chef->first_name}}</h4>
                    <span>Chef on Best Local Chef since {{ $chef->created_at->format('Y') }}</span>
                  </div>
                  <h5>College: {{$chef->college}} <span>|</span> Years of experience: {{$chef->experience}}</h5>
                  <p class="p_grey">{{$chef->bio}}</p>
                  <a href="#">Contact Chef</a>
                </div>

              </div>
            </div>
            <div class="col-md-4">
              <div class="professional_right">
                <div class="contact_login_professional">
                  <h4 class="h4_text">Login or Sign up to contact the chef</h4>
                  <input type="text" placeholder="Name">
                  <textarea name="" id="" cols="30" rows="4" placeholder="Message"></textarea>
                  <a href="#" class="btn_c">Contact Chef</a>
                </div>
              </div>
            </div>
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
            <div class="col-md-6 ">
              <div class="left_div_reviews">
                <h4 class="reviews_star"><img src="images/star.png" alt="">5.0 (34 reviews)</h4>
                <div class="review_text">
                  <div class="card_reviews">
                    <img src="images/reviews_1.png" alt="">
                    <h5>Millie Sanders</h5>
                    <span>October 2020</span>
                  </div>
                  <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                  <a href="#" class="btn_c btn_reviews">Show all 34 reviews</a>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="right_div_reviews">
                <div class="review_text">
                  <div class="card_reviews">
                    <img src="images/reviews_2.png" alt="">
                    <h5>Millie Sanders</h5>
                    <span>October 2020</span>
                  </div>
                  <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                </div>
              </div>
            </div>
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
        $(document).ready(function() {
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
        });

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