@extends('layouts.chef-header')

@section('title', 'Messages')

@section('content')

<div class="profile_section ">
    <div class=" container">
        <div class="profile_path">
            <a href="#">Booking Requests > </a>
            <a href="#"> Personal Info</a>
        </div>
        <div class="booking_section row">
            <div class="col-md-7 col_left">
                <div class="contetn_left_div">
                    <h3 class="h3_profile">Booking Requests</h3>
                    <div class="booking_tabs">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn_request" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Requests</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn_upcoming" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Upcoming</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn_completed" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Completed</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="request_tab">
                                    <div class="calender_upcoming mb-4">
                                        <img src="images/calender_upcoming.jpg" alt="" class="img-fluid">
                                    </div>
                                    <h3 class="h3_profile">Upcoming</h3>

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                             
                                                    <img src="{{asset('images/booking_pr.png')}}" alt="">
                                                    <h4>Hollie M.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="bottom_request">
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/guest.png"><b>8</b>/guests</h5>
                                                    <a href="#">Contact Customer</a>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                    <a href="#">Confirm Booking</a>
                                                </div>
                                                <div class="decline_booking">
                                                    <a href="#">Decline Booking</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                                    <img src="images/booking_pr.png" alt="">
                                                    <h4>Hollie M.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="bottom_request">
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/guest.png"><b>8</b>/guests</h5>
                                                    <a href="#">Contact Customer</a>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                    <a href="#">Confirm Booking</a>
                                                </div>
                                                <div class="decline_booking">
                                                    <a href="#">Decline Booking</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="upcoming_tab">
                                    <div class="calender_upcoming mb-4">
                                        <img src="images/calender_upcoming.jpg" alt="" class="img-fluid">
                                    </div>
                                    <h3 class="h3_profile">Upcoming</h3>

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                                    <img src="images/booking_pr.png" alt="">
                                                    <h4>Hollie M.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="bottom_part">
                                            <div class="cost_div">
                                                <h5><img class="me-3" src="images/guest.png"><b>8</b>/guests</h5>
                                                <a href="#">Contact Customer</a>
                                            </div>
                                            <div class="guest_div">
                                                <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                <a href="#">Reschedule Booking</a>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                                    <img src="{{asset('/public/images/booking_pr.jpg')}}" alt="">
                                                    <h4>Alvin H.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="bottom_part">
                                            <div class="cost_div">
                                                <h5><img class="me-3" src="images/guest.png"><b>8</b>/guests</h5>
                                                <a href="#">Contact Customer</a>
                                            </div>
                                            <div class="guest_div">
                                                <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                <a href="#">Reschedule Booking</a>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div clas="completed_tab">
                                    <div class="calender_upcoming mb-4">
                                        <img src="images/calender_upcoming.jpg" alt="" class="img-fluid">
                                    </div>
                                    <h3 class="h3_profile">Completed</h3>

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                                    <img src="images/booking_pr.png" alt="">
                                                    <h4>Hollie M.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </div>
                                        </div>

                                        <div class="bottom_completed">
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/guest.png"><b>3</b>/guests</h5>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                </div>
                                            </div>
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/money.png"><b>$25</b>/tips</h5>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/credit_card.png"><b>$145</b>/total payments</h5>
                                                </div>
                                            </div>
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/$.png"><b>$130.50</b>/chef share</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                    <div class="booking_card">
                                        <div class="upr_part">
                                            <div class="left_u">
                                                <div class="name_div">
                                                    <img src="images/booking_pr.png" alt="">
                                                    <h4>Hollie M.</h4>
                                                    <span>Austin, Texas 78585</span>
                                                    <a href="#">Vegan</a>
                                                    <a href="#">Family</a>
                                                </div>
                                                <div class="booking_timing">
                                                    <div class="start_t">
                                                        <h5>Start Time</h5>
                                                        <span>Jan 25, 2022, 5:30 pm</span>
                                                    </div>
                                                    <div class="end_t">
                                                        <h5> <img src="images/booking_clock.png" class="me-2"> End Time</h5>
                                                        <span>Jan. 25, 2022 7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <di class="right_img">
                                                <img src="images/booking_map.jpg" alt="">
                                            </di                                          </div>
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/$.png"><b>$130.50</b>/chef share</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-right">
                <div class="content_right_div">
                    <div class="content_detail_text">
                        <img src="images/lock.png" alt="">
                        <h4>Which details can be edited?</h4>
                        <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                    </div>
                    <div class="content_detail_text">
                        <img src="images/busines_card.png" alt="">
                        <h4>What info is shared with others?</h4>
                        <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>v>
                                        </div>

                                        <div class="bottom_completed">
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/guest.png"><b>3</b>/guests</h5>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/tray.png"><b>$120</b>/meal cost</h5>
                                                </div>
                                            </div>
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/money.png"><b>$25</b>/tips</h5>
                                                </div>
                                                <div class="guest_div">
                                                    <h5><img class="me-3" src="images/credit_card.png"><b>$145</b>/total payments</h5>
                                                </div>
                                            </div>
                                            <div class="bottom_part ">
                                                <div class="cost_div">
                                                    <h5><img class="me-3" src="images/$.png"><b>$130.50</b>/chef share</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- booking card div -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-right">
                <div class="content_right_div">
                    <div class="content_detail_text">
                        <img src="images/lock.png" alt="">
                        <h4>Which details can be edited?</h4>
                        <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                    </div>
                    <div class="content_detail_text">
                        <img src="images/busines_card.png" alt="">
                        <h4>What info is shared with others?</h4>
                        <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')

@endsection

@endsection