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
		<div class="row">
			@include('layouts.slic.chef_sidebar')
			<div class="col-lg-9 col-md-8 p-md-5 p-4 content">
				
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
						if( $message && $message['type'] == "review") { ?>                                            
							<strong>Review Completed!</strong>
							{{$message['message']}}
							<!--<a style="text-decoration: underline;" href="{{ url('/chef')}}/{{ $notification->to_user }}?n={{ $notification->id }}">View</a>-->
							<a style="text-decoration: underline;" href="{{ url('/chef')}}?n={{ $notification->id }}">View</a>
						<?php }
						if( $message && $message['type'] == "chef-book") { ?>                                            
							<strong>New Booking Request!</strong>
							<span>Booking Date: {{$message['booking_date']}} </span>
							<a style="text-decoration: underline;" href="{{ url('/chef')}}/requests">View</a>
						<?php } 
						if( $message && $message['type'] == "payment") { ?>                                            
							<strong>Booking Payment! </strong>
							{{$message['message']}}
							<a style="text-decoration: underline;" href="{{ url('/chef')}}/requests">View</a>
						<?php } ?>
					</div>
				<div class="clearfix"></div>
				@endforeach           
			@else
				<div class="alert alert-info" role="alert">
					No recent notifications
				</div>
			@endif
			</div>
		</div>

	</div>
    </div>
</section>
@section('scripts')
<script type="text/javascript">
    
    
</script>        
@endsection

@endsection