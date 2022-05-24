@extends('layouts.admin')

@section('title', 'Trips')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            View Request</div>
          <div class="card-body">
            <div class="table-responsive">
              @if(count($bookings))

                @foreach($bookings as $booking)
                <?php
                  $price_data = @unserialize($booking->price_data);
                  $sales_tax = round( @$price_data['sales_tax'] ?? 0 , 2); 
                  $service_tax = round( @$price_data['service_tax'] ?? 0 , 2); 
                  $chef_share = round( @$price_data['chef_share'] ?? 0 , 2); 
                  // $sales_tax = round(((($booking->cost * $booking->guests) * env('SALES_TAX')) / 100),2); 
                  // $service_tax = round( (($booking->cost * $booking->guests) * env('SERVICE_TAX') / 100) , 2);
                  // $chef_share = round(($booking->cost * $booking->guests) + ($booking->desserts_cost + $booking->appetizers_cost) * 90 / 100, 2);
                  $admin_share = round( $booking->price - $chef_share - $sales_tax - $service_tax  , 2);
                  ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Menu Name</th>
                        <th>Guests</th>
                        <th>Chef Share</th>
                        <th>Tip</th>
                        <th>Sales Tax</th>
                        <th>Service Tax</th>
                        <th>Admin Share</th>
                        <th>Total Cost</th>
                        <th>Booking Time</th>
                        <th>Booking Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->guests}}</td>
                        <td>${{ $chef_share }}</td>
                        <td>${{ $booking->tip }}</td>
                        <td>${{ $sales_tax  }}</td>
                        <td>${{ $service_tax }}</td>
                        <td>${{ $admin_share }}</td>
                        <td>${{ $chef_share + $admin_share }}  </td>
                        <td>{{$booking->booking_time}}</td>
                        <td><?php
                          $date2 = date_create($booking->booking_date);
                          echo date_format($date2, "m/d/Y"); ?></td>
                      </tr>
                    </tbody>
                  </table>
                @endforeach

                <div class="">
                  <span></span>
                </div>
                @if($reqs->status == "completed")
                  <button class="btn btn-primary" disabled>Paid - ${{round($reqs->amount,2)}}</button>
                @else
                  <button class="btn btn-primary" id="confirm" data-id="{{$reqs->id}}" data-amount="{{ round($reqs->amount,2) }}">Confirm Payment - ${{round($reqs->amount,2)}}</button>
                @endif

              @endif


            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>



@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

        $(document).on('click', '#confirm', function() {
            let bid = $(this).attr("data-id");
            let amount = $(this).attr("data-amount");
            let that = $(this);
            that.attr('disabled', 'true')
            swal({
              title: "Are you sure?",
              text: "You are going to pay $" + amount ,
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, pay!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{route("admin-confirm-payment")}}',
                    data: { 'id': bid},
                    success:function(data) {
                      that.attr('disabled', 'true')
                      swal(data.response)
                    },
                    error: function(err) {
                      that.attr('disabled', 'false')
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });

  });
</script>        
@endsection

@endsection
