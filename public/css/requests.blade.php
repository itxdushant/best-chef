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
                @foreach ($upcoming_requests as $req)
                <div class="row">
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "M d, Y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{$req->name}}</p>
                      <p class="request-title"><b>Mumber Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Cost:</b> ${{$req->price}}</p>
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
                </div>
                @endforeach
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
                @foreach ($active_requests as $req)
                <div class="row">
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "M d, Y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
             
                      <p class="request-title"><b>Meal Requested:</b> {{$req->name}}</p>
                      <p class="request-title"><b>Mumber Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Cost:</b> ${{$req->price}}</p>
                      <div class="request-btn">

                        @if($req->completed == 'full-paid')
                          <a href="javascript:void(0)" class="accept completed" data-id="{{$req->id}}">Complete</a>
                        @else
                          <p>Pending Payment</p>
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
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
                @foreach ($past_requests as $req)
                <div class="row">
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "M d, Y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Mumber Of Guests:</b> {{$req->guests}}</p>
                      <p class="request-title"><b>Cost:</b> ${{$req->price}}</p>
                      <div class="request-btn">
                        
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
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
                @foreach ($dec_requests as $req)
                <div class="row">
                  <div class="col-md-6">
                    <div class="request">
                      <p class="request-title"><b>Date/Time:</b>
                        <?php
                          $date2 = date_create($req->booking_date);
                          echo date_format($date2, "M d, Y");
                      ?> | {{$req->booking_time}}</p>
                      <p class="request-title"><b>Address:</b> {{str_replace("+", ", ", $req->location)}}</p>
                      <p class="request-title"><b>Meal Requested:</b> {{$req->name}}</p>
                      <p class="request-title"><b>Cost:</b> ${{$req->price}}</p>
                      <div class="request-btn">
                        
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
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
              text: "You want to mark booking completed?",
              /*type: "warning",*/
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
      
    })
</script>
@endsection
@endsection
