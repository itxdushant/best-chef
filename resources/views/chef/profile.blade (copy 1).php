@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('public/css/croppie.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-datepicker.min.css')}}">
    <style type="text/css">
        td.day.disabled {
            opacity: 0.2;
        }
        .highlight {
          background: #d3ab53 !important;
          color: #fff;
        }
        .week {
            float: left;
            width: 100%;
        }

    </style>
@endsection

@section('title', 'Profile')

@section('content')

<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>DASHBOARD</h1>
			</div>
		</div>
    </div>
</section>
<section class="body-data-box">
    <div class="container">
        <div class="row">
            @include('layouts.slic.chef_sidebar')
                <div class="col-md-9">
                    <div class="alert alert-info">
                        Please complete your profile and add at least one menu to get hired.
                    </div>

                <div class="border-box-frame">                  
                    <div class="box-section-title">Profile</div>
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
                    
                    
                    <form  action="{{ url('chef/update-profile') }}" method="post" class="edit-profile-form-box chef-account">
                        @csrf
                        <div class="container">
                            <div class="row">                           
                                <div class="col-md-12 chef-account-data-row">
                                    <div class="row">
                                        <div class="col-md-4 text-left account-profile-img">
                                            <a href="" class="profile-img"><img alt="" src="{{asset('public/uploads/profiles')}}/{{$profile->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/img/default-user.png')}}';"  /></a><br/>
                                            <a href="#" class="" data-toggle="modal" data-target="#edit-photo" class="active">Edit Photo</a> 
                                            <!-- <div class="row"> -->
                                            <!-- </div>  -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-12 chef-account-data-row">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" placeholder="John" value="{{$profile->first_name}}" />
                                                </div>
                                                <div class="col-md-12 chef-account-data-row">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" placeholder="Doe" value="{{$profile->last_name}}" />
                                                </div>
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>                              
                                <div class="col-md-12 chef-account-data-row">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="myemail@gmail.com" disabled value="{{$profile->email}}" />
                                </div>
                                <div class="col-md-12 chef-account-data-row">
                                    <label>Phone</label>
                                   <input type="tel" name="phone_number" value="{{$profile->phone_number}}" />
                                </div>
                                <div class="col-md-12 chef-account-data-row">
                                    <label>College</label>
                                    <input type="text" name="college" placeholder="" value="{{$profile->college}}" />
                                </div>                              
                                <div class="col-md-12 chef-account-data-row">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <label class="qualification-label">Completion Year</label>
                                            <input class="qualification" type="number" min="0" name="graduate_year" max="9999" placeholder="" value="{{$profile->graduate_year}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="qualification-label middle-label">Years Experience</label>
                                            <input class="qualification" type="number" min="0" name="experience" max="99" placeholder="" value="{{$profile->experience}}" />
                                        </div>
                                    </div>                                  
                                </div>                              
                               <!--  <div class="col-md-12 chef-account-data-row">
                                    <label>Location</label>
                                    <input type="text" name="address" placeholder="4876 S. Redwood Street"  value="{{$profile->address}}"  />
                                </div> -->
                                <div class="col-md-12 chef-account-data-row">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <label class="qualification-label">Service Area by Zip</label>
                                            <input class="qualification" type="text" name="service_area" placeholder="" value="{{$profile->service_area}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="qualification-label middle-label">Service Area Range
												<a class="search-tooltip"> <i class="fas fa-info-circle"></i><span class="tooltiptext">How many miles outside of this zip code do you want to travel?</span></a>
											</label>
                                            <!-- <input class="qualification" type="text" name="miles_away" placeholder="" value="{{$profile->miles_away}}" /> -->
                                            <select class="qualification" name="miles_away" placeholder="" value="{{$profile->miles_away}}" required>
                                                <option value="">Select</option>                                               
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>                                  
                                </div>
                             <!--    <div class="col-md-12 chef-account-data-row">
                                    <label>Available Dates/Times</label>
                                    <input type="text" name="available_dates" class="date" value="{{$profile->available_dates}}"/>
                                </div> -->
                                 <div class="col-md-12 chef-account-data-row">
                                    <label>Bio</label>
                                    <textarea name="bio" class="form-control">{{$profile->bio}}</textarea>
                                </div>
                                <div class="col-md-12 chef-account-data-row">
                                    <label>Video Url</label>
                                    <input type="url" name="video_url" value="{{$profile->video_url}}" class="form-control">
                                    
                                </div>
                                <div class="col-md-12 text-center">                                 
                                    <input type="submit" name="EDIT" value="SUBMIT PROFILE" /> 
                                    <!-- <a href="{{route('chef-dates')}}">Set Available Dates</a> -->
                                </div>                              
                            </div>
                        </form>
                    </div>

                    </div>
                    <div class="border-box-frame">                  
                        <div class="box-section-title">Available Dates</div>
                        <br>
                        <br>
                        <?php
                        $start = ["12:00 AM","01:00 AM","02:00 AM","03:00 AM","04:00 AM","05:00 AM","06:00 AM","07:00 AM","08:00 AM","09:00 AM","10:00 AM","11:00 AM","12:00 PM","01:00 PM","02:00 PM","03:00 PM","04:00 PM","05:00 PM","06:00 PM","07:00 PM","08:00 PM","09:00 PM","10:00 PM","11:00 PM"];
                        $end = ["12:00 AM","01:00 AM","02:00 AM","03:00 AM","04:00 AM","05:00 AM","06:00 AM","07:00 AM","08:00 AM","09:00 AM","10:00 AM","11:00 AM","12:00 PM","01:00 PM","02:00 PM","03:00 PM","04:00 PM","05:00 PM","06:00 PM","07:00 PM","08:00 PM","09:00 PM","10:00 PM","11:00 PM"];
                        ?>
                        <div class="container">
                            <div class="row col-md-12 chef-account-data-row">
                            <h4>Daily</h4>
                            <div class="week">
                                <span>Monday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Tuesday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Wednesday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Thrusday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Friday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Saturday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div><div class="week">
                                <span>Sunday</span>  
                                <select>
                                    @foreach($start as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach                               
                                </select>
                                <span> - </span>
                                <select>
                                    @foreach($end as $val)
                                        <option value="{{$val}}">{{$val}}</option>   
                                    @endforeach
                                </select>
                                <input type="checkbox" name=""> Closed
                            </div>
                            
                            <div class="row col-md-12"><br/><br/><h4>Special Days</h4></div>
                            <div class="spcl">
                                <div class="cont">
                                    
                                </div>
                                <button type="button" id="add-more">Add Days</button>
                            </div>

                            </div>
                        </div>
                        </div>
                        
                        <div class="row col-md-12 chef-account-data-row">
                            <div class="col-md-4">
                                <div class="date" data-date="{{$profile->available_dates}}"></div>
                                <input type="hidden" name="available_dates" id="available_dates" value="{{$profile->available_dates}}"/>
                                <input type="button" class="btn btn-success" name="EDIT" id="add_dates" value="SUBMIT" /> 
                            </div>
                            <div class="col-md-6">
                                 <table class="bookings-list table"></table> 
                            </div>
                        </div>  
                        <div class="col-md-12 chef-account-data-row">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="meetup_address">Available Times</label>
                                <?php
                                  $available_time = array();
                                  if(!empty($profile->available_time)) {
                                    $available_time = explode(',', $profile->available_time);
                                  }
                                  ?>
                                <br>
                                  <input type="checkbox" @if(in_array('12:00 AM', $available_time)) checked @endif name="available_time[]" value="12:00 AM"><span>12:00 AM</span>
                                  <input type="checkbox" @if(in_array('01:00 AM', $available_time)) checked @endif name="available_time[]" value="01:00 AM"><span>01:00 AM</span>
                                  <input type="checkbox" @if(in_array('02:00 AM', $available_time)) checked @endif name="available_time[]" value="02:00 AM"><span>02:00 AM</span>
                                  <input type="checkbox" @if(in_array('03:00 AM', $available_time)) checked @endif name="available_time[]" value="03:00 AM"><span>03:00 AM</span>
                                  <input type="checkbox" @if(in_array('04:00 AM', $available_time)) checked @endif name="available_time[]" value="04:00 AM"><span>04:00 AM</span>
                                  <input type="checkbox" @if(in_array('05:00 AM', $available_time)) checked @endif name="available_time[]" value="05:00 AM"><span>05:00 AM</span>
                                  <input type="checkbox" @if(in_array('06:00 AM', $available_time)) checked @endif name="available_time[]" value="06:00 AM"><span>06:00 AM</span>
                                  <input type="checkbox" @if(in_array('07:00 AM', $available_time)) checked @endif name="available_time[]" value="07:00 AM"><span>07:00 AM</span>
                                  <input type="checkbox" @if(in_array('08:00 AM', $available_time)) checked @endif name="available_time[]" value="08:00 AM"><span>08:00 AM</span>
                                  <input type="checkbox" @if(in_array('09:00 AM', $available_time)) checked @endif name="available_time[]" value="09:00 AM"><span>09:00 AM</span>
                                  <input type="checkbox" @if(in_array('10:00 AM', $available_time)) checked @endif name="available_time[]" value="10:00 AM"><span>10:00 AM</span>
                                  <input type="checkbox" @if(in_array('11:00 AM', $available_time)) checked @endif name="available_time[]" value="11:00 AM"><span>11:00 AM</span>
                                  <br>
                                  <input type="checkbox" @if(in_array('12:00 PM', $available_time)) checked @endif name="available_time[]" value="12:00 PM"><span>12:00 PM</span>
                                  <input type="checkbox" @if(in_array('01:00 PM', $available_time)) checked @endif name="available_time[]" value="01:00 PM"><span>01:00 PM</span>
                                  <input type="checkbox" @if(in_array('02:00 PM', $available_time)) checked @endif name="available_time[]" value="02:00 PM"><span>02:00 PM</span>
                                  <input type="checkbox" @if(in_array('03:00 PM', $available_time)) checked @endif name="available_time[]" value="03:00 PM"><span>03:00 PM</span>
                                  <input type="checkbox" @if(in_array('04:00 PM', $available_time)) checked @endif name="available_time[]" value="04:00 PM"><span>04:00 PM</span>
                                  <input type="checkbox" @if(in_array('05:00 PM', $available_time)) checked @endif name="available_time[]" value="05:00 PM"><span>05:00 PM</span>
                                  <input type="checkbox" @if(in_array('06:00 PM', $available_time)) checked @endif name="available_time[]" value="06:00 PM"><span>06:00 PM</span>
                                  <input type="checkbox" @if(in_array('07:00 PM', $available_time)) checked @endif name="available_time[]" value="07:00 PM"><span>07:00 PM</span>
                                  <input type="checkbox" @if(in_array('08:00 PM', $available_time)) checked @endif name="available_time[]" value="08:00 PM"><span>08:00 PM</span>
                                  <input type="checkbox" @if(in_array('09:00 PM', $available_time)) checked @endif name="available_time[]" value="09:00 PM"><span>09:00 PM</span>
                                  <input type="checkbox" @if(in_array('10:00 PM', $available_time)) checked @endif name="available_time[]" value="10:00 PM"><span>10:00 PM</span>
                                  <input type="checkbox" @if(in_array('11:00 PM', $available_time)) checked @endif name="available_time[]" value="11:00 PM"><span>11:00 PM</span>
                            </div>
                        </div>
                    </div>                                                 
                    </div>

                   
                </div>                            
                </div>
            </div>
        </div>
    </div>
</section> 

<div class="modal fade" id="edit-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login px-4 mx-auto mw-100">
                    <h3 class="text-center mb-4">Edit Photo</h3>
                    <div class="col-md-6">
                        <div class="text-center">
                            <div id="upload-demo" style="width:300px;"></div>
                        </div>
                        <strong>Select Image:</strong>
                        <br/>
                        <input type="file" id="upload">
                        <br/>
                        <button type="button" class="btn btn-success upload-result mt-3" style="display: none;">Upload Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset('public/js/croppie.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  

        let ava_dates = "{{$dates}}";
        let datesArr = ava_dates.split(",");
        let dateArray = [];
        if(datesArr.length) {
          for (var i = 0; i < datesArr.length; i++) {
              let startDate = datesArr[i];
              var currentDate = moment(startDate);
              dateArray.push( moment(currentDate).format('YYYY-M-D') )   
          }
        }

      
        
        $(document).on('click', '#add-more', function() {
            let html = `<div class="week">
                            <input type="text" name="" class="datepicker">
                            <select>
                                @foreach($start as $val)
                                    <option value="{{$val}}">{{$val}}</option>   
                                @endforeach                               
                            </select>
                            <span> - </span>
                            <select>
                                @foreach($end as $val)
                                    <option value="{{$val}}">{{$val}}</option>   
                                @endforeach
                            </select>
                            <input type="checkbox" name=""> Closed
                            <span><a href="#" class="del-fld">Delete</a></span>
                        </div>`;
            $(".spcl .cont").append(html);

            $('.datepicker').datepicker({
                startDate: '1d',           
                format: 'mm/dd/yyyy',
                autoclose: true
            });


        });

        $(document).on('click', '.del-fld', function(e) {
            e.preventDefault();
            $(this).parents('div.week').remove();
        })
    
        $('.date').datepicker({
            startDate: '+1d',
            multidate: true,
            format: 'mm/dd/yyyy',         
            beforeShowDay: function (date) {
                var allDates = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                if(dateArray.indexOf(allDates) != -1) {
                    return { classes: 'highlight', 'tooltip': 'Title'};                
                } else {
                    return true;
                }
            }
        });

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
                    data: { "date" : dt},
                    success: function (data) {
                        let ulList =  `<tr>
                                    <th>Meal Name</th>
                                    <th>Booking Date</th>
                                    <th>Booking Time</th>
                                    <th>Guests</th>
                                    <th>Location</th>
                                </tr>`;
                        if(data.bookings.length) {
                            let bookings = data.bookings;
                            console.log("bookings", bookings)
                            for(let ky in bookings) {
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
                        console.log("err", err)
                    }
                });
            
        })


        $(document).on('click', '#add_dates', function() {
            $(".bookings-list").html("");
            $.ajax({
                type:'POST',
                url:'{{route("chef-update-dates")}}',
                data: { 'dates': $("#available_dates").val()},
                success:function(data) {
                    swal('Done', data.response, 'success');                        
                },
                error: function(err) {
                  swal("Error!", "Please try again", "error");
                }
            });
        })
     
        $(document).on('click', '.delete-menu', function() {       
            let menu_id = $(this).attr("data-id");
            let that = $(this);            
            swal({
              title: "Are you sure?",
              text: "You want to delete this menu.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    type:'POST',
                    url:'{{route("chef-delete-menu")}}',
                    data: { 'menu_id': menu_id},
                    success:function(data) {
                        $(".card-"+menu_id).remove();
                        swal(data.response)                        
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });

        var $uploadCrop = "";

        $('#upload').on('change', function () {
            $('#upload-demo').croppie('destroy');
            $('.upload-result').show();
            $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
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
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: "{{url('/photo-upload')}}",
                    type: "POST",
                    data: {"image":resp},
                    success: function (data) {
                        $("#edit-photo").modal("hide");
                        $(".profile-img img").attr('src', resp)
                        $('#upload-demo').croppie('destroy');
                        $('.upload-result').hide();
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });

    });


</script>
@endsection
@endsection
