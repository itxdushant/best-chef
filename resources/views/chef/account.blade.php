@extends('layouts.chef-header')
@section('styles')

<link rel="stylesheet" href="{{asset('css/croppie.css')}}">
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">


<style type="text/css">
    td.day.disabled {
        opacity: 0.2;
    }

    .highlight a {
        background-color: #29f274 !important;
        color: #ffffff !important;
    }


    .chef-edit-photo input#upload {
        width: 1px;
    }

    .invalid-feedback {
        display: block !important;
    }

    .sweet-alert.showSweetAlert.visible h2 {
        padding: 10px !important;
    }

    .choose-file-btn {
        background: #50555a !important;
        border-color: #50555a !important;
        display: block;
        text-align: center;
        margin: auto !important;
    }

    /* .croppie-container {
        padding: 10px;
    } */

    .vanilla-rotate {
        display: none;
    }

    #certificate_data_more {
        margin-left: -18px;
    }
</style>
@endsection
@section('title', 'Profile')
@section('content')



<div class="profile_section">
    <div class="container">
        <div class="profile_path">
            <a href="#">Profile > </a>
            <a href="#"> Personal Info</a>
        </div>
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


        <!-- validation error
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif -->
        <form action="{{ url('chef/update-profile') }}" method="post" enctype="multipart/form-data" class="edit-profile-form-box chef-account">
            @csrf

            <div class="row">
                <div class="col-md-7 col_left">
                    <div class="contetn_left_div">
                        <h3 class="h3_profile">Profile</h3>
                        <div class="prfl_img">
                            <a href="#" class="profile-img" data-toggle="modal" data-target="#edit-photo" class="active"><img class="pr_img" alt="user avtar" src="{{asset('uploads/profiles')}}/{{$profile->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('img/default-user.png')}}';" /></a><br />

                            <div>
                                <a href="#" class="" data-toggle="modal" data-target="#edit-photo" class="active"><img src="{{asset('images/pencil_edit.png')}}"></a>

                            </div>
                        </div>

                        <!-- testing -->


                        <div class="upload_doc">
                            <label class="upload-file">Upload meal images</label>
                            <div class=" upload-file-btn-main ">


                                <label class="upload-file-btn"> UPLOAD
                                    <input type="file" name="images[]" class="image" accept="image/*">
                                </label>

                                <img class="add_more" id="add_more_images" src="{{asset('images/more.png')}}">

                            </div>
                        </div>
                        <div id="upload_images">

                        </div>

                        <div class="upload_doc">

                            <label class="upload-file">Meal video</label>

                            <div class=" upload-file-btn-main" id="upload_videos">
                                <?php
                                $videos_url = explode(',', $profile->video_url);
                                $total_video_count = count($videos_url);
                                ?>

                                @if($profile->video_url !=null)

                                <img class="add_more_videos" id="add_more_videos" src="{{asset('images/more.png')}}">
                                @for($i=0;$i<$total_video_count;$i++) <div class="remove-videodata-{{$i}}" data-id="{{$i}}"><input type="text" class="remove-videodata-{{$i}}" data-id="{{$i}}{count }$" name="videos[]" value="{{$videos_url[$i]}}" placeholder="Video Link">
                                    <img class="remove-video remove-videodata-{{$i}}" data-id="{{$i}}" class="remove-video" src="{{asset('images/minus-32.png')}}">
                            </div>
                            @endfor
                            @else
                            <input type="text" name="videos[]" value="{{$profile->video_url}}" placeholder="Video Link">
                            <img class="add_more_videos" id="add_more_videos" src="{{asset('images/more.png')}}">
                            @endif

                        </div>
                    </div>

                    <div id="upload_more_videos">

                    </div>

                    <div class="form_section">
                        <div class=" row">
                            <div class="col-md-6">
                                <input type="text" name="avg_cost" value="{{$profile->avg_cost}}" placeholder="Average meal cost">
                                @if ($errors->has('avg_cost'))
                                <span class="text-danger">{{ $errors->first('avg_cost') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="avg_time" value="{{$profile->avg_time}}" placeholder="Average prep time">
                                @if ($errors->has('avg_time'))
                                <span class="text-danger">{{ $errors->first('avg_time') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <textarea name="customer_expect" id="" cols="30" rows="5" placeholder="What can customers expect?"> {{$profile->customer_expect}}</textarea>
                                @if ($errors->has('customer_expect'))
                                <span class="text-danger">{{ $errors->first('customer_expect') }}</span>
                                @endif
                            </div>
                        </div>
                        @php
                        $meal_speciality=explode(',', $profile->meal_speciality);

                        @endphp

                        <div class="meals_s_l">
                            <h4>Meal specialities</h4>
                            <div class="checkbox-group">
                                <label for="Vegan">
                                    <input type="checkbox" value="Vegan" name="meal_speciality[]" {{in_array("Vegan", $meal_speciality) ?'checked':''}}>
                                    Vegan
                                </label>

                                <label for="Vegetarian">
                                    <input type="checkbox" value="Vegetarian" name="meal_speciality[]" {{in_array("Vegetarian", $meal_speciality) ?'checked':''}}>
                                    Vegetarian
                                </label>

                                <label for="Family">
                                    <input type="checkbox" value="Family" name="meal_speciality[]" {{in_array("Family", $meal_speciality) ?'checked':''}}>
                                    Family
                                </label>

                                <label for="Breakfast">
                                    <input type="checkbox" value="Breakfast" name="meal_speciality[]" {{in_array("Breakfast", $meal_speciality) ?'checked':''}}>
                                    Breakfast
                                </label>

                                <label for="Meal Prep">
                                    <input type="checkbox" value="Meal Prep" name="meal_speciality[]" {{in_array("Meal Prep", $meal_speciality) ?'checked':''}}>
                                    Meal Prep
                                </label>

                            </div>
                        </div>

                        @php
                        $cooking_class=explode(',', $profile->cooking_class);

                        @endphp
                        <div class="meals_s_l">
                            <h4>Cooking class</h4>
                            <div>
                                <label for="Virtual">
                                    <input type="checkbox" name="cooking_class[]" value="virtual" {{in_array("Virtual", $cooking_class) ?'checked':''}}>
                                    Virtual
                                </label>

                                <label for="In-person">
                                    <input type="checkbox" name="cooking_class[]" value="In-person" {{in_array("In-person", $cooking_class) ?'checked':''}}>
                                    In-person
                                </label>

                                <label for="No Applicable">
                                    <input type="checkbox" name="cooking_class[]" value="Not Applicable" {{in_array("Not Applicable", $cooking_class) ?'checked':''}}>
                                    Not Applicable
                                </label>

                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-md-6">
                                <input type="text" name="college" value="{{$profile->college}}" placeholder="College attended">
                            </div>
                            <div class="col-md-6">
                                <select name="experience" id="">
                                    <option value="">Years of experience</option>
                                    <option value="1-5" {{$profile->experience=="1-5" ? 'selected' :''}}>1-5</option>
                                    <option value="5-10" {{$profile->experience=="5-10" ? 'selected' :''}}>5-10</option>
                                    <option value="10+" {{$profile->experience=="10+" ? 'selected' :''}}>10+</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <textarea name="bio" id="" cols="30" rows="5" placeholder="Professional bio">{{$profile->bio}}</textarea>
                                @if ($errors->has('bio'))
                                <span class="text-danger">{{ $errors->first('bio') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="service_area" value="{{$profile->service_area}}" placeholder="Service area by zip code">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <select name="area_range" id="">
                                    <option value="">Service area range</option>
                                    <option value="1Km" {{$profile->area_range=="1Km" ? 'selected' :''}}>1Km</option>
                                    <option value="2Km" {{$profile->area_range=="2Km" ? 'selected' :''}}>2Km</option>
                                    <option value="3Km" {{$profile->area_range=="3Km" ? 'selected' :''}}>3Km</option>
                                </select>
                                @if ($errors->has('area_range'))
                                <span class="text-danger">{{ $errors->first('area_range') }}</span>
                                @endif
                            </div>

                            <!-- <div class="col-md-12">
                                    <textarea name="certification" id="" cols="30" rows="5" placeholder="Certification name and/or number">{{$profile->certificate_data}}</textarea>
                                </div> -->


                            <div class="col-md-12 chef-account-data-row" id="certificate_data">
                                @if($profile->certificate_data && $profile->certificate_data != null)
                                <?php
                                $m = unserialize($profile->certificate_data);
                                $certificate_data_count = count($m['names']); ?>
                                @foreach( $m['names'] as $namesKey => $namesValue)
                                <div class="remove-certdata-{{$namesKey}}"> <a href="javascript:void(0);" class="remove-cert" data-id="{{$namesKey}}">(X)</a>
                                    <input type="text" name="certificate_data[names][]" value="{{$namesValue}}" placeholder="Certification name" class="form-control remove-certdata-{{$namesKey}}" />

                                    <input type="text" name="certificate_data[numbers][]" value="{{$m['numbers'][$namesKey]}}" placeholder="Certification number" class="form-control remove-certdata-{{$namesKey}}" /> <br />
                                </div>
                                @endforeach
                                @else
                                <input type="text" name="certificate_data[names][]" value="" class="form-control" placeholder="Certification name" />

                                <input type="text" name="certificate_data[numbers][]" value="" class="form-control" placeholder="Certification number" />
                                @endif
                                <div class="btn btn-primary" id="add_more_certificate">Add More Certificate</div>
                            </div>
                        </div>
                        <div id="add_more_data">

                        </div>
                        <div class="meals_s_l">
                            <h4>Availability</h4>
                            <a class="select_date_link" id="selectAllDates">Select all dates available</a>
                            <?php


                            if ($profile->available_dates != null) {
                                @$datesarray = unserialize(@$profile->available_dates);
                                //print_r($datesarray);
                                @$datesarrayval = implode(',', $datesarray);
                            }

                            ?>

                            @if ($profile->available_dates !=null)
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="available_dates-sec p-md-4" id="dates-form-out">
                                        <form class="" action="#" method="post" id="dates-form">
                                            @csrf
                                            <div class="ava-datepicker1"></div>
                                            <input type="hidden" name="available_dates[]" id="available_dates" value="<?php echo $datesarrayval; ?>">

                                            <div class="avail-ble_submit-details submit-Profile-frm next_tab">
                                                <a href="javascript:void(0)" class="btn btn-success" id="add_dates">SUBMIT</a>
                                                <!-- <input type="submit" class="btn btn-success" name="EDIT" id="add_dates" value="SUBMIT" /> -->
                                                <button class="btn btn-success" type="button" id="selectAllDates">Select All</button>
                                                <button class="btn btn-success" type="button" id="clearAllDates">Clear All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @else
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="available_dates-sec p-md-4" id="dates-form-out">
                                        <form class="" action="#" method="post" id="dates-form">
                                            @csrf
                                            <div class="ava-datepicker1"></div>
                                            <input type="hidden" name="available_dates[]" id="available_dates" value="">

                                            <div class="avail-ble_submit-details submit-Profile-frm next_tab">
                                                <a href="javascript:void(0)" class="btn btn-success" id="add_dates">SUBMIT</a>
                                                <!-- <input type="submit" class="btn btn-success" name="EDIT" id="add_dates" value="SUBMIT" /> -->
                                                <button class="btn btn-success" type="button" id="selectAllDates">Select All</button>
                                                <button class="btn btn-success" type="button" id="clearAllDates">Clear All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                    </div>


                    @php
                    $timings=unserialize($profile->timings);
                    @endphp
                    @if ($profile->timings !=null)
                    <div class="time_section">
                        <div class="timings">
                            <div>
                                <span>Monday</span>
                                <input type="time" id="" name="monday_time_from" value="{{$timings['monday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" value="{{$timings['monday_time_to']}}" name="monday_time_to" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Tuesday</span>
                                <input type="time" id="" name="tuesday_time_from" value="{{$timings['tuesday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" value="{{$timings['tuesday_time_to']}}" name="tuesday_time_to" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Wednesday</span>
                                <input type="time" id="" name="wednesday_time_from" value="{{$timings['wednesday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" value="{{$timings['wednesday_time_to']}}" name="wednesday_time_to" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Thursday</span>
                                <input type="time" id="" name="thursday_time_from" value="{{$timings['thursday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" value="{{$timings['thursday_time_to']}}" name="thursday_time_to" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Friday</span>
                                <input type="time" id="" name="friday_time_from" value="{{$timings['friday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" name="friday_time_to" value="{{$timings['friday_time_to']}}" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Saturday</span>
                                <input type="time" id="" name="saturday_time_from" value="{{$timings['saturday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" name="saturday_time_to" value="{{$timings['saturday_time_to']}}" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Sunday</span>
                                <input type="time" id="" name="sunday_time_from" value="{{$timings['sunday_time_from']}}" placeholder="" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                                - <input type="time" id="" name="sunday_time_to" value="{{$timings['sunday_time_to']}}" min="09:00" max="18:00">
                                @if ($errors->has('service_area'))
                                <span class="text-danger">{{ $errors->first('service_area') }}</span>
                                @endif
                            </div>
                        </div>

                        @else

                        <div class="timings">
                            <div>
                                <span>Monday</span>
                                <input type="time" id="" name="monday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('monday_time_from'))
                                <span class="text-danger">{{ $errors->first('monday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" value="" name="monday_time_to" min="09:00" max="18:00">
                                <!-- @if ($errors->has('monday_time_to'))
                                <span class="text-danger">{{ $errors->first('monday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Tuesday</span>
                                <input type="time" id="" name="tuesday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('tuesday_time_from'))
                                <span class="text-danger">{{ $errors->first('tuesday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" value="" name="tuesday_time_to" min="09:00" max="18:00">
                                <!-- @if ($errors->has('tuesday_time_to'))
                                <span class="text-danger">{{ $errors->first('tuesday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Wednesday</span>
                                <input type="time" id="" name="wednesday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('wednesday_time_from'))
                                <span class="text-danger">{{ $errors->first('wednesday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" value="" name="wednesday_time_to" min="09:00" max="18:00">
                                <!-- @if ($errors->has('wednesday_time_to'))
                                <span class="text-danger">{{ $errors->first('wednesday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Thursday</span>
                                <input type="time" id="" name="thursday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('thursday_time_from'))
                                <span class="text-danger">{{ $errors->first('thursday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" value="" name="thursday_time_to" min="09:00" max="18:00">
                                <!-- @if ($errors->has('thursday_time_to'))
                                <span class="text-danger">{{ $errors->first('thursday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Friday</span>
                                <input type="time" id="" name="friday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('friday_time_from'))
                                <span class="text-danger">{{ $errors->first('friday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" name="friday_time_to" value="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('friday_time_to'))
                                <span class="text-danger">{{ $errors->first('friday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Saturday</span>
                                <input type="time" id="" name="saturday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('saturday_time_from'))
                                <span class="text-danger">{{ $errors->first('saturday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" name="saturday_time_to" value="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('saturday_time_to'))
                                <span class="text-danger">{{ $errors->first('saturday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>
                        <div class="timings">
                            <div>
                                <span>Sunday</span>
                                <input type="time" id="" name="sunday_time_from" value="" placeholder="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('sunday_time_from'))
                                <span class="text-danger">{{ $errors->first('sunday_time_from') }}</span>
                                @endif -->
                                - <input type="time" id="" name="sunday_time_to" value="" min="09:00" max="18:00">
                                <!-- @if ($errors->has('sunday_time_to'))
                                <span class="text-danger">{{ $errors->first('sunday_time_to') }}</span>
                                @endif -->
                            </div>
                        </div>

                        @endif
                    </div>
                    <div class="py-4">
                        <a href="#" class="btn_c btn_chef"><button type="submit" id="checkBtn">UPDATE PROFILE</button></a>
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
        </form>
    </div>
</div>

<div class="modal fade chef-edit-photo" id="edit-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title text-center">Edit Photo</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center ">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div id="upload-demo" style="width:300px;">

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 marg-15">
                                <button class="vanilla-rotate btn btn-success" data-deg="-90">Rotate Left</button>
                                <button class="vanilla-rotate btn btn-success" data-deg="90">Rotate Right</button>
                            </div>
                            <button type="button" class="choose-file-btn" style="display: inline-block;">Change Image</button>
                            <input type="file" id="upload" style="visibility:hidden;" accept="image/*" />
                            <button type="button" class="btn btn-success upload-result" style="background-color: green!important; display: none;">Choose Image</button>
                            <div class="err"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src=" https://cdn.tutorialjinni.com/croppie/2.6.5/croppie.min.js"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript">
        jQuery(document).ready(function($){
            $(".choose-file-btn").click(function() { 
                $("#upload").trigger('click');
            });
        });
    </script>	

<script type="text/javascript">
    var today = new Date();
    var monthdate = today.getMonth();
    var monthdatetest = today.getMonth();
    var flag = false;
    $('#checkBtn').click(function() {

        var meal_speciality = $('input[name="meal_speciality[]"]:checked').length;
        var cooking_class = $('input[name="cooking_class[]"]:checked').length;
        if (!meal_speciality) {
            alert("You must check at least one Meal Speciality");
            return false;
        }

        if (!cooking_class) {
            alert("You must check at least one cooking class type");
            return false;
        }

    });


    $(document).ready(function() {

        Array.prototype.unique = function() {
            ////console.log('here');
            return this.filter(function(value, index, self) {
                return self.indexOf(value) === index;
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var count = "{{ isset($profile->certificate_data['names']) ?  sizeof($profile->certificate_data['names']) : 0}}";

        $('#add_more_certificate').click(function() {
           



            var innerHTML = `<div class="remove-certdata-${count}"> <a href="javascript:void(0);" class="remove-cert"  data-id="${count}">(X)</a>
            <input type="text" name="certificate_data[names][]" value="" placeholder="Certification name" class="form-control remove-certdata-${count}" /><div class="remove-certdata-${count}">
            </div>
            <input type="text" name="certificate_data[numbers][]" value="" class="form-control remove-certdata-${count}"  placeholder="Certification number"/>`;
             $('#add_more_data').append(innerHTML);
            count++;
        });

        $(document).on('click', '.remove-cert', function() {
            // alert("hello");
            // $('.remove-cert').on('click', function() {
            var dataId = $(this).data('id');
            $('.remove-certdata-'+dataId).remove();
        });

        $('#add_more_videos').click(function() {
            // console.log('dfdfd');
            var innerHTML = `<div class="remove-videodata-${count }" data-id="${count }" ><input type="text" class="remove-videodata-${count }" data-id="${count }" name="videos[]"  value="" placeholder="Video Link">
             <img class="remove-video remove-videodata-${count }" data-id="${count }" class="remove-video" src="{{asset('images/minus-32.png')}}"></div> `;
            $('#upload_more_videos').append(innerHTML);
            count++;
        });
        $(document).on('click', '.remove-video', function() {
            // $('.remove-cert').on('click', function() {
            var dataId = $(this).data('id');
            $('.remove-videodata-' + dataId).remove();
        });

        $('#add_more_images').click(function() {
            // console.log('dfdfd');

            var innerHTML = `<label class="upload-file-btn remove-imgdata-${count }"> UPLOAD<input type="file" name="images[]" class="image" size="60"  ></label> <a href="javascript:void(0);" class="remove-img remove-imgdata-${count }" data-id="${count }">
            <img class=".remove-img" src="{{asset('images/minus-32.png')}}"></a><div class="img-preview"></div>`;

            $('#upload_images').append(innerHTML);
            count++;
        });

        $(document).on('click', '.remove-img', function() {
            // $('.remove-cert').on('click', function() {
            var dataId = $(this).data('id');
            $('.remove-imgdata-' + dataId).remove();
        });

        let ava_dates = "{{$dates}}";
        let datesArr = ava_dates.split(",");
        let dateArray = [];
        if (datesArr.length) {
            for (var i = 0; i < datesArr.length; i++) {
                let startDate = datesArr[i];
                var currentDate = moment(startDate);
                dateArray.push(moment(currentDate).format('YYYY-M-D'))
            }
        }

        $('.ava-datepicker1').datepicker({
            startDate: '1d',
            format: "yyyy-mm-dd",
            todayHighlight: true,
            multidate: true,
        }).on('changeDate', function(e) {
            if (e.date) {
                monthdate = e.date.getMonth();
            }
            var the_date = $('.ava-datepicker1').datepicker('getDates');
            the_date = the_date.map(function(item, index, array) {
                return moment(item).format("YYYY-MM-DD")
            });

            $('.datepicker-days tbody tr td').each(function() {
                var TimeStamp = $(this).attr('data-date');
                var thid = $(this);
                if (the_date.length > 0) {
                    $.each(the_date, function(index, value) {
                        var selectedTime = new Date(value).getTime();
                        if (selectedTime == TimeStamp) {
                            var TimeStamp2 = thid.addClass('selected');
                        }
                    });
                }
            });
            //console.log(the_date, "testing------>");
            $('#available_dates').val(the_date);
        });
        setTimeout(function() {
            var my_dates = $('#available_dates').val().split(",");
            var currentmonth = monthdatetest + 1;
            my_dates.map(function(item, index, array) {
                var loopdate = new Date(item);
                if (loopdate.getMonth() + 1 == currentmonth) {
                    var myDate2 = my_dates[index];
                    my_dates.splice(index, 1);
                    my_dates = [myDate2].concat(my_dates)
                }
            });
            var my_dates_reverse = my_dates.reverse()
            $('.ava-datepicker1').datepicker('setDates', my_dates_reverse)
        }, 1000)

        $(".next").on('click', function() {
            // alert("dataeeeee");
            var TimeStampData = $('#available_dates').val().split(",");
            //  alert(TimeStampData );
            var arr = [];
            $.each(TimeStampData, function(index, value) {
                var selectedTime = new Date(value).getTime();
                arr.push(selectedTime);
                // console.log(selectedTime ,"jjjjjjjjjjjjjjjjjjjj");
            });

            console.log(arr, "heloooooo")
            var count = 1;
            $('.datepicker-days tbody tr td').each(function() {
                var TimeStamp = $(this).attr('data-date');
                var thid = $(this);
                //if(TimeStamp.includes(selectedTime) ){
                if (arr.length > 0) {
                    if (arr.includes(parseInt(TimeStamp))) {
                        console.log("this is testing");
                        $(this).addClass('selected');
                    }
                }
                count++;
            });

        });

        function SeletDate() {
            var my_dates = $('#available_dates').val().split(",");
            var currentmonth = monthdatetest + 1;
            my_dates.map(function(item, index, array) {
                var loopdate = new Date(item);
                if (loopdate.getMonth() + 1 == currentmonth) {
                    var myDate2 = my_dates[index];
                    my_dates.splice(index, 1);
                    my_dates = [myDate2].concat(my_dates)
                }
            });
            var my_dates_reverse = my_dates.reverse()
            $('.ava-datepicker1').datepicker('setDates', my_dates_reverse)
        }



        $('#selectAllDates').click(function() {
            flag = true;
            var monthDates = [];
            var today = new Date(); // current date
            var end = new Date(today.getFullYear(), monthdate + 1, 0).getDate(); // end date of month
            var all_days = [];
            var addedDates = $('#available_dates').val().split(",");
            for (let i = 1; i <= end; i++) {
                var month = (monthdate < 10 ? '0' + parseInt(monthdate + 1) : parseInt(monthdate + 1));
                all_days.push(today.getFullYear() + '-' + month + '-' + (i < 10 ? '0' + i : i))
            }
            var allfinaldays = addedDates.concat(all_days);
            allfinaldays = allfinaldays.unique();;
            $('.ava-datepicker1').datepicker('setDates', allfinaldays)

            var my_dates = allfinaldays;
            var currentmonth = monthdatetest + 1;
            my_dates.map(function(item, index, array) {
                var loopdate = new Date(item);
                if (loopdate.getMonth() + 1 == currentmonth) {
                    var myDate2 = my_dates[index];
                    my_dates.splice(index, 1);
                    my_dates = [myDate2].concat(my_dates)
                }
            });
            var my_dates_reverse = my_dates.reverse()
            setTimeout(function() {

                $('#available_dates').val(my_dates_reverse.toString());
            }, 1000);

        });

        $(document).on('click', '.del-fld', function(e) {
            e.preventDefault();
            $(this).parents('div.week').remove();
        })


        $('.date').on('changeDate', function() {
            $(".bookings-list").html("");
            $('#available_dates').val(
                $('.date').datepicker('getFormattedDate')
            );
        });
        $('.datepicker').on('click', '.table-condensed .highlight', function() {
            let dt = moment($(this).data('date')).format("MM/DD/YYYY");
            $.ajax({
                url: "{{route('chef-get-booking')}}",
                type: "POST",
                data: {
                    "date": dt
                },
                success: function(data) {
                    let ulList = `<tr>
                                        <th>Meal Name</th>
                                        <th>Booking Date</th>
                                        <th>Booking Time</th>
                                        <th>Guests</th>
                                        <th>Location</th>
                                    </tr>`;
                    if (data.bookings.length) {
                        let bookings = data.bookings;
                        ////console.log("bookings", bookings)
                        for (let ky in bookings) {
                            ulList += `<tr>
                                        <td>${bookings[ky].name}</td>
                                        <td>${bookings[ky].booking_date}</td>
                                        <td>${bookings[ky].booking_time}</td>
                                        <td>${bookings[ky].guests}</td>
                                        <td>${bookings[ky].location}</td>
                                    </tr>`;
                        }
                    }
                    $(".bookings-list").html(ulList);
                },
                error: function(err) {
                    //console.log("err", err)
                }
            });

        })
        $(document).on('click', '#add_dates', function() {

            var formData = $("#available_dates").val();

            $.ajax({
                type: 'POST',
                url: '{{route("chef-update-dates")}}',
                data: {
                    'available_dates': formData
                },
                success: function(data) {
                    swal('Done', data.response, 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1800);
                },
                error: function(err) {
                    swal("Error!", "Please try again", "error");
                }

            });
        })

        $(document).on('click', '#clearAllDates', function() {
            $('#available_dates').val('');
            $('.ava-datepicker1').datepicker('setDates', []);
        })



        var $uploadCrop = "";
        $('#upload').on('change', function() {

            var value = $(this).val(),
                file = value.toLowerCase(),
                extension = file.substring(file.lastIndexOf('.') + 1);

            $(".err").html("")
            let allowedExtensions = ['jpg', 'jpeg', 'png']
            if ($.inArray(extension, allowedExtensions) == -1) {
                $(".err").html("<p style='color:red;'>Please select only: jpg, jpeg, png format.</p>");
                return false;
            }

            $('#upload-demo').croppie('destroy');
            $('.upload-result').show();

            $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
                enableOrientation: true,
                viewport: {
                    width: 200,
                    height: 200
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    $('.vanilla-rotate').show();
                    ////console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.vanilla-rotate').on('click', function(ev) {
            $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
        });
        $('.upload-result').on('click', function(ev) {
            $(".upload-result").text("Please wait...");
            //console.log($uploadCrop, "this is crop image");
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $.ajax({
                    url: "{{url('/photo-upload')}}",
                    type: "POST",
                    data: {
                        "image": resp
                    },
                    success: function(data) {
                        $("#edit-photo").modal("hide");
                        $(".profile-img img").attr('src', resp)
                        $('#upload-demo').croppie('destroy');
                        $('.upload-result').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 500)
                    },
                    error: function(err) {
                        $(".upload-result").text("Update Image")
                        swal("Error!", "Please try again", "error");
                    }
                });
            });
        });
    });
</script>

@endsection