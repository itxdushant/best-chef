@extends('layouts.main')

@section('styles')
 <style type="text/css">
     .star-ratings {
    unicode-bidi: bidi-override;
    color: #c5c5c5;
    font-size: 34px;
    line-height: 1.2;
    width: 148px;
    margin: 0px;
    position: relative;
    padding: 0;
  text-align: center;
    display: inline-block;
    margin-top: 10px;
  }
  .star-ratings-top {
    color: gold;
    padding: 0;
    position: absolute;
    z-index: 1;
    display:block;
    left: 0px;
    overflow: hidden;
  }

  .star-ratings-bottom { 
    z-index: 0; 
  }
  .star-ratings span 
{
  margin: 0px;
}  
  .star-ratings-top[style] {
    left: 0px !important;
  }
  .btn-success.green {
    background: green!important;
    border: green;
    margin-top: 12px;
}
 </style>
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
      @include('layouts.slic.user_sidebar')
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
            
            <section id="content1">
              <div class="request-box">
                @if(count($upcoming_requests))
                <div class="row">
				@foreach ($upcoming_requests as $req)
                  <?php 
                    // $service_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SERVICE_TAX')) / 100, 2); 
                    // $sales_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SALES_TAX')) / 100, 2);
                    // $total_cost = round(($req->price + $req->desserts_cost + $req->appetizers_cost + $service_tax + $sales_tax),2); 
                  ?>
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      @if(@$req->price_data['desserts_cost'])
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      @if(@$req->price_data['appetizers_cost'])
                        <p class="request-title"><b>Appetizers Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                      @if(@$req->price_data['sides_cost'])
                        <p class="request-title"><b>Sides Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                  <p class="request-title"><b>Sub Total Cost:</b>${{$req->price-($req->price_data['sales_tax'] + $req->price_data['service_tax'])}}</p>
                      <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>
                      <p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>
                      <p class="request-title"><b>Total Cost:</b>${{$req->price}}</p>
                    @if(!empty($req->notes))  
                        <p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                         @else
                        <p class="request-title"><b>Notes:</b> N/A</p>
                    @endif
                      <div class="request-btn">
                        <?php
                        //add three hours to booking created date
                        $start = $req->created_at;
                        $scheduledate = $req->booking_date;
                        $scheduletime = $req->booking_time;
                        $combinedDT = date('Y-m-d H:i:s', strtotime("$scheduledate $scheduletime")); 
                        $now = date('Y-m-d H:i:s');
                        $hoursAdded = date('Y-m-d H:i:s',strtotime('+3 hour',strtotime($start))); ?>
                        @if($req->completed == "confirm-pending" &&  strtotime($combinedDT) > strtotime($now) )
                        <a href="javascript:void(0)" class="view-btn cancel-booking" data-id="{{$req->id}}">Cancel Booking</a>
                        @elseif($req->completed == "canceled")
                        <button disabled class="">Canceled</button>
                        @endif
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have upcoming requests.
                </div>
                @endif
                
              </div>
            </section>
            <section id="content2">
              <div class="request-box">
                
                @if(count($active_requests))
                <div class="row">
				@foreach ($active_requests as $req)
                  <?php 
                    // $service_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SERVICE_TAX')) / 100, 2); 
                    // $sales_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SALES_TAX')) / 100, 2);
                    // $total_cost = round(($req->price + $req->desserts_cost + $req->appetizers_cost + $service_tax + $sales_tax),2); 
                  ?>
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          $calDate = date_format($date2, "Ymd");
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      @if(@$req->price_data['desserts_cost'])
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      @if(@$req->price_data['appetizers_cost'])
                        <p class="request-title"><b>Appetizers Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                       @if(@$req->price_data['sides_cost'])
                        <p class="request-title"><b>Sides Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                    <p class="request-title"><b>Sub Total Cost:</b>${{$req->price-($req->price_data['sales_tax'] + $req->price_data['service_tax'])}}</p>
                      <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>
                      <p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>
                      <p class="request-title"><b>Total Cost:</b>${{$req->price}}</p>
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
                          <a href="javascript:void(0)" class="view-btn">Paid</a>
                          <a href="javascript:void(0)" class="accept completed" data-mid="{{$req->mid}}" data-id="{{$req->id}}">Complete</a>
                        @else
                          <a href="javascript:void(0)" class="accept make-payment" data-mid="{{$req->mid}}" data-id="{{$req->id}}" data-amount="{{$req->price}}">Pay</a>
                          <a href="javascript:void(0)" class="view-btn cancel-booking" data-id="{{$req->id}}">Cancel Booking</a>
                        @endif
                      </div>

                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have active requests.
                </div>
                @endif
                
              </div>
            </section>
            
            <section id="content3">
              <div class="request-box">
                @if(count($past_requests))
                <div class="row">
				@foreach ($past_requests as $req)
                  <?php 
                    // $service_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SERVICE_TAX')) / 100, 2); 
                    // $sales_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SALES_TAX')) / 100, 2);

                  ?>
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      @if(@$req->price_data['desserts_cost'])
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      @if(@$req->price_data['appetizers_cost'])
                        <p class="request-title"><b>Appetizers Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                       @if(@$req->price_data['sides_cost'])
                        <p class="request-title"><b>Sides Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                       @if($req->tip && $req->tip != '')
                      <p class="request-title"><b>Tip:</b> ${{$req->tip}}</p>
                      @else
                      <p class="request-title"><b>Tip:</b> $0</p>
                      @endif
                      <p class="request-title"><b>Sub Total Cost:</b>${{$req->tip+$req->price-($req->price_data['sales_tax'] + $req->price_data['service_tax'])}}</p>
                      <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>
                      <p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>
                      <p class="request-title"><b>Total Cost:</b>${{$req->price}}</p>
                     
                        @if(!empty($req->notes))  
							<p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
	                    @else
							<p class="request-title"><b>Notes:</b> N/A</p>
						@endif
                      <div class="request-btn">
                        <!-- <p>Review</p> -->
                        @if(!$req->rating)
                          <a href="{{url('user/add-review')}}/{{$req->menu_id}}/{{$req->id}}" class="view-btn">Add Reivew</a>
                        @else
                          <!--<div class="star-ratings">
                              <div class="star-ratings-top" style="width: {{$req->rating * 20}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                              <div class="star-ratings-bottom"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                          </div>-->
                        @endif
                        <!-- <img alt="" src="{{asset('public/img/rating-img.png')}}" /> -->
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have past requests.
                </div>
                @endif
                
              </div>
            </section>
            <section id="content4">
              <div class="request-box">
                
                @if(count($dec_requests))
                <div class="row">
				@foreach ($dec_requests as $req)
                  <?php 
                    // $service_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SERVICE_TAX')) / 100, 2); 
                    // $sales_tax = round((($req->price + $req->desserts_cost + $req->appetizers_cost) * env('SALES_TAX')) / 100, 2);
                    // $total_cost = round(($req->price + $req->desserts_cost + $req->appetizers_cost + $service_tax + $sales_tax),2); 
                  ?>
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "m/d/y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{@$req->price_data['menu_name']}}</p>
                      <p class="request-title"><b>Number Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Meal Cost:</b> ${{ @$req->price_data['menu_cost'] * $req->guests }}</p>
                      @if(@$req->price_data['desserts_cost'])
                        <p class="request-title"><b>Dessert Cost:</b> ${{@$req->price_data['desserts_cost']}}</p>
                      @endif
                      @if(@$req->price_data['appetizers_cost'])
                        <p class="request-title"><b>Appetizers Cost:</b> ${{@$req->price_data['appetizers_cost']}}</p>
                      @endif
                       @if(@$req->price_data['sides_cost'])
                        <p class="request-title"><b>Sides Cost:</b> ${{@$req->price_data['sides_cost']}}</p>
                      @endif
                       @if($req->tip && $req->tip != '')
                      <p class="request-title"><b>Tip:</b> ${{$req->tip}}</p>
                      @else
                      <p class="request-title"><b>Tip:</b> $0</p>
                      @endif
                    <p class="request-title"><b>Sub Total Cost:</b>${{$req->tip+$req->price-($req->price_data['sales_tax'] + $req->price_data['service_tax'])}}</p>
                      <p class="request-title"><b>Sales Tax:</b> ${{@$req->price_data['sales_tax']}}</p>
                      <p class="request-title"><b>Service Tax:</b> ${{@$req->price_data['service_tax']}}</p>
                      <p class="request-title"><b>Total Cost:</b>${{$req->price}}</p>
          					  @if(!empty($req->notes))  
          					    <p class="request-title"><b>Notes:</b> {{$req->notes}}</p>
                      @else
          						 <p class="request-title"><b>Notes:</b> N/A</p>
          					  @endif
                      <div class="request-btn">
                        <!-- <p>Review</p> -->
                        <!-- <img alt="" src="img/rating-img.png" /> -->
                      </div>
                    </div>
                  </div>
                
                @endforeach
				</div>
                @else
                <div class="alert alert-info" role="alert">
                  You don't have past requests.
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
          let mid = $(this).attr('data-mid');

          swal({
              title: "Are you sure?",
              text: "You want to mark this booking completed.",
              /*type: "warning",*/
              showCancelButton: true,
              confirmButtonClass: "btn btn-default green-btn",
              confirmButtonText: "Yes, complete it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){

               $.ajax({
                    type:'POST',
                    url:'{{url("user/req-completed")}}',
                    data: { 'id': id},
                    success:function(data) {
                        if(data.status) {
                          that.text("Completed");
                        }
                        swal({
                          title: "Review",
                          text: "Please give this chef a review",
                          showCancelButton: true,
                          confirmButtonClass: "btn-success",
                          confirmButtonText: "Review",
                          closeOnConfirm: false,
                          showLoaderOnConfirm: false
                        },
                        function(){
                          window.location.href = "{{url('user/add-review')}}/"+mid+"/"+id;
                        });
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
              text: "You want to confirm this booking?",
              showCancelButton: true,
              confirmButtonClass: "btn btn-default green-btn",
              confirmButtonText: "Yes, complete it!",
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
                            that.text("accepted");
                            that.next(".decline-book").remove();
                        }
                        swal(data.response)
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });          
        });

        $(".decline-book").on('click', function(e) {

          e.preventDefault();
          let that = $(this);
          let id = $(this).attr('data-id');

          swal({
              title: "Are you sure?",
              text: "You want to decline this booking?",
              showCancelButton: true,
              confirmButtonClass: "btn btn-default btn-danger",
              confirmButtonText: "Yes, decline it!",
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
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });          
        });

        $(document).on('click', '.cancel-booking', function() {
            let bid = $(this).attr("data-id");
            let that = $(this);
            that.text('Please wait..');
             $.ajax({
                    type:'POST',
                    url:'{{route("user-check-cancel-amount")}}',
                    data: { 'id': bid,},
                    success:function(data) {
                      console.log(data);
                      that.text('Cancel Booking');
                        // that.text("Booking Cancelled");
                        // that.removeClass("cancel-booking");
                        // swal(data.response)  
                        swal({
                          title: "Are you sure?",
                          text: "You want to cancel this booking, you will be charged <b>$" + data.amount + "</b>?",
                          
                          showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Yes, cancel",
                          cancelButtonText: "No, don’t cancel",
                          closeOnConfirm: false,
                          showLoaderOnConfirm: true,
                          html: true,
                        },
                        function(){
                           $.ajax({
                                type:'POST',
                                url:'{{route("user-cancel-booking")}}',
                                data: { 'id': bid,},
                                success:function(data) {
                                    that.text("Booking Cancelled");
                                    that.removeClass("cancel-booking");
                                    swal(data.response)                        
                                },
                                error: function(err) {
                                  swal("Error!", "Please try again", "error");
                                }
                            });
                        });                      
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            // swal({
            //   title: "Are you sure?",
            //   text: "You want to cancel this booking?",
            //   type: "warning",
            //   showCancelButton: true,
            //   confirmButtonClass: "btn-danger",
            //   confirmButtonText: "Yes, cancel",
            //   cancelButtonText: "No, don’t cancel",
            //   closeOnConfirm: false,
            //   showLoaderOnConfirm: true
            // },
            // function(){
            //    $.ajax({
            //         type:'POST',
            //         url:'{{route("user-cancel-booking")}}',
            //         data: { 'id': bid,},
            //         success:function(data) {
            //             that.text("Booking Cancelled");
            //             that.removeClass("cancel-booking");
            //             swal(data.response)                        
            //         },
            //         error: function(err) {
            //           swal("Error!", "Please try again", "error");
            //         }
            //     });
            // });
        });


         $(document).on('click', '.make-payment', function() {
            let bid = $(this).attr("data-id");
            let that = $(this);
          	let mid = $(this).attr('data-mid');
            let amount = $(this).attr('data-amount');
            
            swal({
              title: "Are you sure?",
              text: "You will be charged $" + amount,
              type: "input",
              showCancelButton: true,
              confirmButtonClass: "btn-default btn-success green",
              confirmButtonText: "Yes, pay",
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
              inputPlaceholder: "Add a tip?"
            },
            function(inputValue){
               $.ajax({
                    type:'POST',
                    url:'{{route("user-payment")}}',
                    data: { 'id': bid, 'tip': inputValue},
                    success:function(data) {
                        that.text("Paid");
                        swal({
                          title: "Review",
                          text: "Please give this chef a review",
                          showCancelButton: true,
                          confirmButtonClass: "btn-default green-btn btn-success",
                          confirmButtonText: "Review",
                          closeOnConfirm: false,
                          showLoaderOnConfirm: false
                        },
                        function(){
                          window.location.href = "{{url('user/add-review')}}/"+mid+"/"+bid;
                        });
                        // swal(data.response)
                        // setTimeout(function() {
                        //     location.reload();
                        // }, 900)                        
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
