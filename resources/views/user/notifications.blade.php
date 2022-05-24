@extends('layouts.main')

@section('title', 'Profile')

@section('content')

<style type="text/css">
    .star-rating {
      line-height:32px;
      font-size: 30px;
    }

    .star-rating .fa-star{color: rgb(168, 217, 236); font-size: 30px;}
</style>

<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Notifications</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<section class="body-data-box">
    <div class="container-fluid">
		<!-- register  -->
		<div class="row">
			@include('layouts.slic.user_sidebar')
			<div class="col-lg-9 col-md-8 px-md-5 pt-2 content">
				<div class="vc-element-grid text-left">
					<h3 class="inner-section-title">Notifications</h3>
				</div>
			<div class="">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			@if(count($notifications))
				@foreach ($notifications as $notification)
					<div class="alert alert-info">
					  <?php
						$message = @unserialize($notification->message);
						if( $message && $message['type'] == "booking") { ?>                                            
							<strong>Booking Completed!</strong>
							{{$message['message']}}
							<a style="text-decoration: underline;" href="{{ url('user/add-review')}}/{{ $message['menu_id'] }}/{{ $message['booking_id'] }}?n={{ $notification->id }}">Add Reivew</a>
						<?php } 

						if( $message && $message['type'] == "booking-confirm") { ?>                                            
							<strong>Booking!</strong>
							{{$message['message']}}
							<a style="text-decoration: underline;" href="{{ url('/user')}}/requests">View</a>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
					@endforeach           
				@else
				<div class="alert alert-info" role="alert">
					No recent notifications.
				</div>
			@endif
			</div>
		</div>
		<!-- //register -->
	</div>
    </div>
</section>
@section('scripts')
<script type="text/javascript">
    
</script>        
@endsection


@endsection
