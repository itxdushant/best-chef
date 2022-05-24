@extends('layouts.main')

@section('title', 'Payment Info')

@section('content')
<style>
.btn-success.green
{
    background: green;
    border: green;
    margin-top: 12px;
    padding: 12px 20px;
    font-size: 14px;
    text-transform: uppercase;
}
</style>
<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Payment Information</h1>
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
			@include('layouts.slic.chef_sidebar')
			<div class="col-lg-9 col-md-8 p-lg-5 content">
				<div class="vc-element-grid text-left">
					<h3 class="title-heading-small">Payment Information</h3>
					   <div class="pymt-info-text">
					      * To receive payment from jobs that you complete, please add your banking information below
					   </div>
				</div>
					 
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			<div class="request-info-table">
			@if(!$details)
				<div class="text-left my-4">
					 <a href="{{route('payment-edit')}}" class="link common-link-btn">						
						Add Bank						
					</a>
				</div>
				@else
				<table class="table table-striped table-data-label">
					<thead>
					  <tr>
						
						<th scope="col">Routing Number</th>
						<th scope="col">Account Number</th>
						<th scope="col">Action</th>
					  </tr>
					</thead>
					<tbody>
					  <tr class="mb-md-0 mb-4">
						
						<td data-label="Routing Number">{{$details['routing_number']}} &nbsp;</td>
						<td data-label="Account Number">{{$details['account_number']}} &nbsp;</td>
						<td data-label="Action"> <a href="{{route('payment-edit')}}" class="link">
							@if($details)
								Edit
							@endif
							</a></td>
					  </tr>
					</tbody>
				</table>
				@endif				
			</div>
			
			@if(count($bookings))
			<div class="vc-element-grid text-left">
				<h3 class="title-heading-small">Payments List</h3>
			</div>
			<div class="responsive_payment-table">	
			<table class="table listing-trip-table table-data-label payment_list-table">
				<thead>
					<tr>
						<th scope="col">Menu</th>
						<th scope="col">Date</th>
						<th scope="col">Entree</th>
						<th scope="col">Dessert</th>
						<th scope="col">Appetizer</th>
						<th scope="col">Side</th>
						<th scope="col">Chef share</th>
						<th scope="col">Total</th>
						<th scope="col">Tip</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				
				<tbody>
						<?php
						$total = 0;
						$payids = array();
						?>
						@foreach ($bookings as $booking)
						<?php
						 $dessert_cost = $booking->price_data['desserts_cost'] ?? 0;
                        $appetizer_cost = $booking->price_data['appetizers_cost'] ?? 0;
                        $side_cost = $booking->price_data['sides_cost'] ?? 0;
                        $meal_cost = round( $booking->price_data['menu_cost'] * $booking->guests, 2);
                        $total_cost = $dessert_cost+$appetizer_cost+$meal_cost+$side_cost;
                        ?>
							<tr class="mb-md-0 mb-4 b-{{$booking->id}}">
								<td data-label="Menu">{{$booking->name}}</td>
								<td data-label="Date Date"><?php
		                          $date2 = date_create($booking->booking_date);
		                          echo date_format($date2, "m/d/Y"); ?>  	
		                        </td>
								<td data-label="Meal Cost">${{ round( @$booking->price_data['menu_cost'] * $booking->guests, 2) }}</td>
								<td data-label="Dessert Cost">${{ @$booking->price_data['desserts_cost'] ?? 0 }}</td>
								<td data-label="Appetizer Cost">${{ @$booking->price_data['appetizers_cost'] ?? 0 }}</td>
								<td data-label="Side Cost">${{ @$booking->price_data['sides_cost'] ?? 0 }}</td>
								<td data-label="Chef share">
									@if($booking->completed == "full-paid" || $booking->completed == "completed")
										${{(@$booking->price_data['chef_share'] ?? 0) + $booking->tip }}
										<?php
											if(!$booking->payment_request) {
												array_push($payids, $booking->id);
												$total = round($total + (@$booking->price_data['chef_share'] ?? 0 ) + $booking->tip, 2);
											}
										?>
									@else
										N/A
									@endif
								</td>
								<!--<td data-label="Total Cost">${{ @$booking->price}}</td>-->
								<td data-label="Total Cost">${{ $total_cost}}</td>
								@if($booking->tip && $booking->tip != '')
								<td data-label="Tip">${{$booking->tip}}</td>
								@else
								<td data-label="Tip">$0</td>
								@endif
								<td data-label="Status">
									@if($booking->payment_request == 2)
										<span>Completed</span>
									@elseif($booking->payment_request == 1)
										<span>Requested</span>
									@else
										<span>No</span>
									@endif
								</td>
								<td data-label="Action">
									@if($booking->completed == "full-paid" || $booking->completed == "completed")
										<span>Payment Completed</span>
									@else
										<span>Payment Pending</span>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>	
				<span>Total amount: <strong>  ${{$total}}  </strong> </span>
				<br>
				<br>
				@if(!$details)
					<h5>Add Account details to send request Payment.</h5>
				@else 
					@if(count($payids))
						<button class="btn btn-default mb-4" data-pays="{{implode(',', $payids)}}" id="send-req">Request Payment</button>
					@else
						<button class="btn btn-default mb-4" disabled>Request Payment</button>
					@endif
				@endif
			@else
				<div class="alert alert-info" role="alert">
					You don't have a booking history yet.
				</div>
			@endif

		</div>
		<!-- //register -->
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

        
        $(document).on('click', '#send-req', function() {
            let book_ids = $(this).attr("data-pays");
            let that = $(this);

            swal({
              title: "Are you sure?",
              text: "You want to request.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-success green",
              confirmButtonText: "Yes, Request",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{route("chef-payment-requests")}}',
                    data: { 'book_ids': book_ids},
                    success:function(data) {
                        swal(data.response);
                        setTimeout(function() {
                            location.reload();
                        }, 900)
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error!", "Please try again", "error");
                    }
                });
            });
        });
    });
</script>
@endsection
@endsection
