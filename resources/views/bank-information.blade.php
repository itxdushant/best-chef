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
                    <h3 class="h3_profile">Banking Information</h3>
                    <div class="banking_information_form mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" placeholder="Name on account">
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="Account number">
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="Routing number">
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="Address">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="City">
                            </div>
                            <div class="col-md-6">
                                <select name="" id="">
                                    <option value="">State</option>
                                    <option value="">State</option>
                                    <option value="">State</option>
                                    <option value="">State</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Zip code">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Phone">
                            </div>

                            <div class="mt-3">
                                <a href="#" class="btn_c btn_chef">UPDATE</a>
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