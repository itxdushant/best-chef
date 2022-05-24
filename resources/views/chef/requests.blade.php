@extends('layouts.main')

@section('styles')
 
@endsection

@section('title', 'Profile')

@section('content')

<!-- banner -->
<section class="inner-page-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title-wrap text-center">
          <h1 class="page-title-heading">Request</h1>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- //banner -->
<section class="body-data-box">
  <div class="container-fluid">
    <div class="row">
      @include('layouts.slic.chef_sidebar')
      <div class="col-lg-9 col-md-8 p-md-5 p-4 content">
        <div class="page-inner-section-main">
          <div class="tab-main mx-auto">
            <!--<div class="tab-main-box">-->
            
            <input id="tab1" type="radio" name="tabs" checked="">
            <label for="tab1" class="tab-label">New Request ({{count($upcoming_requests)}})</label>
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2" class="tab-label">Active Requests</label>
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" class="tab-label">Completed Requests</label>
            <input id="tab4" type="radio" name="tabs">
            <label for="tab4" class="tab-label">Declined Requests</label>
            
            <!--</div>-->
            @if(count($upcoming_requests)==0)
            <!-- <br> -->
            <!-- <h3 class="res_not_found">No bookings found!!</h3> -->
            @endif
            
            <section id="content1">
              <div class="request-box">
                @if(count($upcoming_requests))
                <div class="row">
				@foreach ($upcoming_requests as $req)
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                        $dessert_cost = isset($req->price_data['desserts_cost'])?$req->price_data['desserts_cost']:0;
                        $appetizer_cost = isset($req->price_data['appetizers_cost'])?$req->price_data['appetizers_cost']:0;
                        $side_cost = isset($req->price_data['sides_cost'])?$req->price_data['sides_cost']:0;
                        $meal_cost = $req->price_data['menu_cost'] * $req->guests;
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      @if(@$req->price_data['desserts_cost'])
                       @foreach($req->menus_desserts as $key => $dessert)
                        <p class="request-title"><b>Dessert Requested:</b> {{@$dessert->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->dessert_guests}}</p>
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      
                      @if(@$req->price_data['appetizers_cost'])
                       @foreach($req->menus_appetizers as $key => $appetizer)
                       <p class="request-title"><b>Appetizer Requested:</b> {{@$appetizer->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->appetizer_guests}}</p>
                        <p class="request-title"><b>Appetizer Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                      
                       @if(@$req->price_data['sides_cost'])
                       @foreach($req->menus_sides as $key => $side)
                       <p class="request-title"><b>Side Requested:</b> {{@$side->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->side_guests}}</p>
                        <p class="request-title"><b>Side Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif

                      <!--   <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>-->
                      <!--<p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>-->
                      <p class="request-title"><b>Total Cost:</b>${{$dessert_cost+$appetizer_cost+$meal_cost+$side_cost}}</p>
                      @if(!empty($req->notes))  
            					 <p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                      @else
            						<p class="request-title"><b>Notes:</b> N/A</p>
            					@endif
                      <div class="req-btn">
                        @if($req->completed == 'confirmed')
                        <a href="javascript:void(0)" class="accept">Accepted</a>
                        @elseif($req->completed == 'declined')
                        <a href="javascript:void(0)" class="decline">Declined</a>
                        @else
                        <a href="javascript:void(0)" data-id="{{$req->id}}" class="accept confirm-book">Accept</a>
                        <a href="javascript:void(0)" data-id="{{$req->id}}" class="decline decline-book">Decline</a>
                        @endif
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have any upcoming requests.
                </div>
                @endif
              </div>
            </section>
            
            <section id="content2">
              <div class="request-box">
                @if(count($active_requests))
                <div class="row">
				@foreach ($active_requests as $req)
                
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                         $dessert_cost = isset($req->price_data['desserts_cost'])?$req->price_data['desserts_cost']:0;
                        $appetizer_cost = isset($req->price_data['appetizers_cost'])?$req->price_data['appetizers_cost']:0;
                        $side_cost = isset($req->price_data['sides_cost'])?$req->price_data['sides_cost']:0;
                        $meal_cost = $req->price_data['menu_cost'] * $req->guests;
                          $date2 = date_create($req->booking_date);
                          $calDate = date_format($date2, "Ymd");
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <!-- M d, Y -->
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>             
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      
                      @if(@$req->price_data['desserts_cost'])
                       @foreach($req->menus_desserts as $key => $dessert)
                        <p class="request-title"><b>Dessert Requested:</b> {{@$dessert->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->dessert_guests}}</p>
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      
                      @if(@$req->price_data['appetizers_cost'])
                       @foreach($req->menus_appetizers as $key => $appetizer)
                       <p class="request-title"><b>Appetizer Requested:</b> {{@$appetizer->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->appetizer_guests}}</p>
                        <p class="request-title"><b>Appetizer Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                         @if(@$req->price_data['sides_cost'])
                       @foreach($req->menus_sides as $key => $side)
                       <p class="request-title"><b>Side Requested:</b> {{@$side->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->side_guests}}</p>
                        <p class="request-title"><b>Side Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                      <!--  <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>-->
                      <!--<p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>-->
                      <p class="request-title"><b>Total Cost:</b>${{$dessert_cost+$appetizer_cost+$meal_cost+$side_cost}}</p>
                      @if(!empty($req->notes))  
            					 <p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                                 @else
            						 <p class="request-title"><b>Notes:</b> N/A</p>
            					 @endif
                      <p class="request-title">
                        <b>Add to Google Calendar:</b>
                        <a target="_blank" href="https://calendar.google.com/calendar/r/eventedit?dates={{$calDate}}/{{$calDate}}&text={{$req->name}}&sf=true"><i class="fa fa-calendar"> </i></a>
                      </p>
                      <p class="request-title">
                        <b>Add to Outlook Calendar:</b>
                        <a target="_blank" href="https://outlook.live.com/calendar/0/view/month"><i class="fa fa-calendar"> </i></a>
                      </p>
                      <div class="request-btn">

                        @if($req->completed == 'full-paid')
                          <p class="request-title"><b>Payment status:</b> Paid</p>
                          <p class="request-title"><b>Status:</b> In Progress</p>
                          <!-- <a href="javascript:void(0)" class="accept completed" data-id="{{$req->id}}">Complete</a> -->
                        @else
                          <p class="request-title"><b>Payment status:</b> Pending</p>
                        
                        @endif

                        <a href="javascript:void(0)" data-id="{{$req->id}}" class="decline decline-book">Decline</a>

                      </div>
                       
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
              You don't have any active requests.
                </div>
                @endif
              </div>
            </section>
            
            <section id="content3">
              <div class="request-box">
                @if(count($past_requests))
                <div class="row">
				@foreach ($past_requests as $req)
                
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                         $dessert_cost = isset($req->price_data['desserts_cost'])?$req->price_data['desserts_cost']:0;
                        $appetizer_cost = isset($req->price_data['appetizers_cost'])?$req->price_data['appetizers_cost']:0;
                        $side_cost = isset($req->price_data['sides_cost'])?$req->price_data['sides_cost']:0;
                        $meal_cost = $req->price_data['menu_cost'] * $req->guests;
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                       @if(@$req->price_data['desserts_cost'])
                       @foreach($req->menus_desserts as $key => $dessert)
                        <p class="request-title"><b>Dessert Requested:</b> {{@$dessert->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->dessert_guests}}</p>
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      
                      @if(@$req->price_data['appetizers_cost'])
                       @foreach($req->menus_appetizers as $key => $appetizer)
                       <p class="request-title"><b>Appetizer Requested:</b> {{@$appetizer->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->appetizer_guests}}</p>
                        <p class="request-title"><b>Appetizer Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
					    @if(@$req->price_data['sides_cost'])
                       @foreach($req->menus_sides as $key => $side)
                       <p class="request-title"><b>Side Requested:</b> {{@$side->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->side_guests}}</p>
                        <p class="request-title"><b>Side Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                      <!--  <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>-->
                      <!--<p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>-->
                     <p class="request-title"><b>Sub Total Cost:</b>${{$dessert_cost+$appetizer_cost+$meal_cost+$side_cost}}</p>
                       @if($req->tip && $req->tip != '')
                      <p class="request-title"><b>Tip:</b> ${{$req->tip}}</p>
                      @else
                      <p class="request-title"><b>Tip:</b> $0</p>
                      @endif
                      <p class="request-title"><b>Total Cost:</b>${{$dessert_cost+$appetizer_cost+$meal_cost+$side_cost+$req->tip}}</p>
                     
                     @if(!empty($req->notes))  
					<p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                     @else
						 <p class="request-title"><b>Notes:</b> N/A</p>
					 @endif
                      <div class="request-btn">
                        
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have any completed jobs.
                </div>
                @endif
                
              </div>
            </section>
            <section id="content4">
              <div class="request-box">
                @if(count($dec_requests))
                 <div class="row">
				@foreach ($dec_requests as $req)
               
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                         $dessert_cost = isset($req->price_data['desserts_cost'])?$req->price_data['desserts_cost']:0;
                        $appetizer_cost = isset($req->price_data['appetizers_cost'])?$req->price_data['appetizers_cost']:0;
                        $side_cost = isset($req->price_data['sides_cost'])?$req->price_data['sides_cost']:0;
                        $meal_cost = $req->price_data['menu_cost'] * $req->guests;
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                     @if(@$req->price_data['desserts_cost'])
                       @foreach($req->menus_desserts as $key => $dessert)
                        <p class="request-title"><b>Dessert Requested:</b> {{@$dessert->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->dessert_guests}}</p>
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      
                      @if(@$req->price_data['appetizers_cost'])
                       @foreach($req->menus_appetizers as $key => $appetizer)
                       <p class="request-title"><b>Appetizer Requested:</b> {{@$appetizer->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->appetizer_guests}}</p>
                        <p class="request-title"><b>Appetizer Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
					    @if(@$req->price_data['sides_cost'])
                       @foreach($req->menus_sides as $key => $side)
                       <p class="request-title"><b>Side Requested:</b> {{@$side->name}}</p>
                        @endforeach
                        <p class="request-title"><b>Number Of Guest:</b>{{$req->side_guests}}</p>
                        <p class="request-title"><b>Side Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                    <!--<p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>-->
                    <!--<p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>-->
                      <p class="request-title"><b>Total Cost:</b>${{$dessert_cost+$appetizer_cost+$meal_cost+$side_cost}}</p>
                       @if(!empty($req->notes))  
					<p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                     @else
						 <p class="request-title"><b>Notes:</b> N/A</p>
					 @endif
                      <div class="request-btn">
                        
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don’t have any declined requests.
                </div>
                @endif
              </div>
              
            </section>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".completed").on('click', function(e){
          e.preventDefault();
          let that = $(this);
          let id = $(this).attr('data-id');

          swal({
              title: "Are you sure?",
              text: "Do you want to accept the booking.",
              /*type: "warning",*/
              showCancelButton: true,
              confirmButtonClass: "btn btn-default green-btn",
              confirmButtonText: "Yes, accept it",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{url("chef/req-completed")}}',
                    data: { 'id': id},
                    success:function(data) {
                        if(data.status) {
                            that.text("Completed");
                        }
                        swal(data.response)
                        setTimeout(function() {
                            location.reload();
                        }, 900)
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }

                });
            });          
        });

        $(".confirm-book").on('click', function(e){

          e.preventDefault();
          let that = $(this);
          let id = $(this).attr('data-id');

          swal({
              title: "Are you sure?",
              text: "Do you want to accept booking?",
              /*type: "warning",*/
              showCancelButton: true,
              confirmButtonClass: "btn btn-default green-btn",
              confirmButtonText: "Accept",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function() {
               $.ajax({
                    type:'POST',
                    url:'{{url("chef/req-confirm")}}',
                    data: { 'id': id },
                    success:function(data) {
                        if(data.status) {
                            that.text("Accepted");
                            that.next(".decline-book").remove();
                        }
                        swal(data.response)
                        setTimeout(function() {
                            location.reload();
                        }, 900)
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });          
        });

        $(".decline-book").on('click', function(e){

          e.preventDefault();
          let that = $(this);
          let id = $(this).attr('data-id');

          swal({
              title: "Are you sure?",
              text: "You want to decline this booking?",
              /*type: "warning",*/
              showCancelButton: true,
              confirmButtonClass: "btn btn-default btn-danger",
              confirmButtonText: "Yes, decline it",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function() {
               $.ajax({
                    type:'POST',
                    url:'{{url("chef/req-decline")}}',
                    data: { 'id': id },
                    success:function(data) {
                        if(data.status) {
                            that.text("declined");                            
                            that.prev(".confirm-book").remove();
                        }
                        swal(data.response)
                        setTimeout(function() {
                            location.reload();
                        }, 900)
                    },
                    error: function(err) {
                      //swal("Error!", "Please try again", "error");
                    }
                });
            });          
        });
      
    })
</script>
@endsection
@endsection
