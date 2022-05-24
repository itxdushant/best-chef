@extends('layouts.main')

@section('content')
<!-- banner -->
<div class="main-banner-section text-center" id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="banner-grid-box mx-auto">
                    <h6 class="sub-top-title">FOR THE ADVENTURER</h6>
                    <h3 class="text-wh">FIND, BOOK, ENJOY </h3>
                    <h5>LET US GUIDE YOU TO THE HOT SPOTS</h5>
                    <!-- search -->
                    <div class="banner-newsletter-grid mt-4">
                        <form action="#" method="post" class="d-flex">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <input class="search form-control" type="search" placeholder="Lake Tahoe" required="">
                            <button class="form-control btn" type="submit"><span class="fa fa-search"></span></button>
                        </form>
                    </div>
                    <!-- //search -->
                    <div class="banner-btn-grid">
                        <span class="banner-btn"><a href="#">Jump In</a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="banner-grid-box mx-auto">
                    <h6 class="sub-top-title">TRIPS FROM GUIDES</h6>
                    <h3 class="text-wh">GET STARTED</h3>
                    <h5>GUIDING YOUR NEXT ADVENTURER </h5>
                    <p>Guided trips to the best spots.</p>
                    <div class="banner-btn-grid">
                        <span class="banner-btn"><a href="#">Get Started</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //banner -->

<!--- How-Work-Section-->
<section class="about-section" id="about">
    <div class="container">
        <div class="row main-about-content">
            <div class="col-sm-6 col-md-6 about-content-grid">
                <h2 class="title-heading-large mb-4">HOW IT WORKS</h2>
                <div class="icon-with-text">
                    <div class="icon-with-text-inner">
                        <div class="icon-grid">
                            <img src="{{asset('public/images/hw-icon-01.png')}}" />
                        </div>
                        <div class="icon-with-text-disc">
                            <h4>SEARCH TRIPS, LOCATIONS & SPORT</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                        </div>
                    </div>
                </div>
                <div class="icon-with-text">
                    <div class="icon-with-text-inner">
                        <div class="icon-grid">
                            <img src="{{asset('public/images/hw-icon-02.png')}}" />
                        </div>
                        <div class="icon-with-text-disc">
                            <h4>BOOK YOUR TRIP FOR YOU & YOUR GUEST</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                        </div>
                    </div>
                </div>
                <div class="icon-with-text">
                    <div class="icon-with-text-inner">
                        <div class="icon-grid">
                            <img src="{{asset('public/images/hw-icon-03.png')}}" />
                        </div>
                        <div class="icon-with-text-disc">
                            <h4>GO & ENJOY YOUR TRIP</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                        </div>
                    </div>
                </div>
                <span class="hw-more-btn btn-block-grid"><a class="btn btn-default more-btn" href="#">BOOK YOUR TRIP TODAY</a></span>
            </div>
            <div class="col-sm-6 col-md-6 text-left">
                <div class="vc-element-grid">
                    <img src="{{asset('public/images/main-info.jpg')}}" alt="about" class="img-fluid" />
                    <span class="video-popup"><a href="#" data-toggle="modal" data-target="#video-popup"><img src="{{asset('public/images/video-play-icon.png')}}" alt="video-popup" class="img-fluid" /></a></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!-- //How-Work-Section-->

<!--- Booking-Section-->
<section class="booking-section">
    <div class="full-width-container">
        <div class="row main-booking-content flex-row-reverse">
            <div class="col-sm-7 col-md-8 padding-0 hidden-md hidden-lg">
                <div class="vc-element-grid map-grid ">
                    <img src="{{asset('public/images/map-100.jpg')}}" alt="map" class="img-fluid" />
                </div>
            </div>
            <div class="col-sm-5 col-md-4 booking-content-grid text-left">
                <h3 class="title-heading-large" style="color:#ffffff;">BOOK LIKE A CAPTAIN</h3>
                
                <form class="booking-form-grid" action="#" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Location</label>
                        <input type="text" class="form-control" placeholder="Lake Tahoe" name="Name" required="">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group pr-sm-1">
                            <label class="col-form-label">ARRIVE</label>
                            <div class="book_date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <input  id="datepicker" class="form-control" name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
                            </div>
                        </div>
                        <div class="col-sm-6 form-group pl-sm-1">
                            <label class="col-form-label">DEPART</label>
                            <div class="book_date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <input  id="datepicker1" class="form-control" name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">SPORT</label>
                        <select id="guests" onchange="change_sport(this.value)" class="frm-field required form-control">
                            <option value="" >Choose Your Sport</option>
                            <option value="AX">Swimming</option>
                            <option value="null">Basket Ball</option>
                            <option value="null">Football</option>
                            <option value="null">Golf</option>
                            <option value="AX">More</option>
                        </select>
                    </div>
                    <div class="form-group section_room">
                        <label class="col-form-label">NUMBER OF GUESTS</label>
                        <select id="guests" onchange="change_guest(this.value)" class="frm-field required form-control">
                            <option value="" >How Many Guests</option>
                            <option value="null">1 People</option>
                            <option value="null">2 People</option>
                            <option value="null">3 People</option>
                            <option value="AX">4 People</option>
                            <option value="AX">More</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default more-btn btn-block">Search Trips</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- //Booking-Section-->

<!----/Features Section--->
<section class="top-rate-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2 class="title-heading-large mb-4">TOP-RATED EXPERIENCES</h2>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="hover-box-with-text">
                    <div class="hover-box-inner">
                        <div class="hover-box-bg">
                            <div class="hover-box-bg-container" style="background-image:url('images/featured-01.jpg')">
                                <span class="rated-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                <h4 class="hover-box-title"><a href="#">Fishing Trip in New Hampshire for Four</a></h4>
                            </div>
                        </div>
                        <div class="hover-box-content">
                            <div class="hover-box-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                <span class="btn-block-grid"><a class="btn btn-default btn-block more-btn" href="#">Learn more</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="hover-box-with-text">
                    <div class="hover-box-inner">
                        <div class="hover-box-bg">
                            <div class="hover-box-bg-container" style="background-image:url('images/featured-02.jpg">
                                <span class="rated-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                <h4 class="hover-box-title"><a href="#">Guided Fly Fishing Trip in Montana </a></h4>
                            </div>
                        </div>
                        <div class="hover-box-content">
                            <div class="hover-box-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                <span class="btn-block-grid"><a class="btn btn-default btn-block more-btn" href="#">Learn more</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="hover-box-with-text">
                    <div class="hover-box-inner">
                        <div class="hover-box-bg">
                            <div class="hover-box-bg-container" style="background-image:url('images/featured-03.jpg">
                                <span class="rated-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                <h4 class="hover-box-title"><a href="#">Trip to Lake Tahoe for Four </a></h4>
                            </div>
                        </div>
                        <div class="hover-box-content">
                            <div class="hover-box-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                <span class="btn-block-grid"><a class="btn btn-default btn-block more-btn" href="#">Learn more</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!----//Features Section--->

<!--- Call action Section-->
<section class="call-action-section">
    <div class="container">
        <div class="row flex-xl-row-reverse">
            <div class="col-sm-6 col-md-6">
                <div class="text-element-grid text-center">
                    <h2 class="title-grid mb-4" style="color:#ffffff;">ARE YOU AN ADVENTURER <br/>LOOKING FOR MORE?</h2>
                    <span class="btn-block-grid"><a class="btn btn-default more-btn" href="#">BOOK YOUR NEXT FISHING TRIP TODAY</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //Call action Section-->
@endsection