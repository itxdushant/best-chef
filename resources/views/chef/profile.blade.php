@extends('layouts.chef-header')

@section('title', 'Profile')

@section('content')
<!-- another section -->
<div class="professional-meal-section">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="professional_left">
                <div class="first_div">
                    <h4>Professional meal prepared by Hollie</h4>
                    <span>Average preparation - 45 minutes</span>
                    <img src="/uploads/profiles/{{$user->profile_pic}}" />
                </div>

                <div class="scnd_div">
                    <h4 class="h4_text">What to expect</h4>
                    <p class="p_grey">{{$user->customer_expect}}</p>
                </div>

                <div class="thrd_div">
                    <h4 class="h4_text">Meal specialities</h4>
                    <div>
                        @if( !empty($user->meal_speciality) )
                            @foreach($user->meal_speciality as $meal_speciality)
                                <a href="#">{{$meal_speciality}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="frth_div">
                    <h4 class="h4_text">Certifications</h4>
                    <a href="#">
                        @if( !empty($user->meal_speciality) && isset($user->certificate_data['names']) )
                            @foreach($user->certificate_data['names'] as $certificate_data)
                                {{$certificate_data}},
                            @endforeach
                        @endif
                    </a>
                </div>

                <div class="fifth_div">
                    <div class="content_profile">
                        <img src="images/professional_hollie.png" alt="">
                        <h4>Meet your chef, Hollie</h4>
                        <span>Chef on Best Local Chef since 2020</span>
                    </div>
                    <!-- <h5>College: {{$user->college}}</h5> -->
                    <h5>College: {{$user->college}}    <span>|</span>   Years of experience: {{$user->experience}}</h5>
                    <p class="p_grey">{{$user->bio}}</a>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <form id="contact-chef">
                <div class="professional_right">
                    <div class="contact_login_professional">
                        <h4 class="h4_text">Login or Sign up to contact the chef</h4>
                        <input type="text" placeholder="Name" >
                        <input type="email" placeholder="email" >
                        <textarea name="" id="" cols="30" rows="4" placeholder="Message"></textarea>
                        <a href="#" class="btn_c">Contact Chef</a>
                    </div>
                </div>
            </form>
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
                   <h4 class="reviews_star"><img src="images/star.png" alt="">{{$user->rating}} ({{count($user->Reviews)}} reviews)</h4>
                    @if(isset($user->Reviews) && !empty($user->Reviews))
                        
                        @foreach($user->Reviews as $key => $Reviews )
                            @if($key < 2 )
                                <div class="col-md-6">
                                    <div class="right_div_reviews">
                                        <div class="review_text">
                                            <div class="card_reviews">
                                                <img src="/uploads/profiles/{{($Reviews->user)? $Reviews->user[0]->profile_pic : '' }}" alt="">
                                                <h5>{{($Reviews->user)? $Reviews->user[0]->first_name : '' }}</h5>
                                                <span>{{$Reviews->created_at}}</span>
                                            </div>
                                            <p class="p_grey">{{$Reviews->review}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
        </div>
    </div>
</div>
@endsection