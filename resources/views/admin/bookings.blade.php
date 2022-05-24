@extends('layouts.admin')

@section('title', 'Trips')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Bookings</div>
          <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="active"><a class="nav-item nav-link active" data-toggle="tab" href="#upcoming">UPCOMING</a></li>
                <li><a  class="nav-item nav-link" data-toggle="tab" href="#past">PAST</a></li>
            </ul>
            <div class="tab-content">
              <div id="upcoming" class="tab-pane fade show active mt-3">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Booked Date</th>
                      <th>Menu Name</th>
                      <th>Price</th>                      
                      <th>Booking Date</th>
                      <th>Chef</th>
                      <th>Chef Share</th>
                      <th>Customer</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(count($upcoming_bookings))
                        @foreach ($upcoming_bookings as $book)
                        <?php 
                        	$chef_share = round(@unserialize($book->price_data)['chef_share'], 2);
                        ?>
                          <tr>
                            <td><?php
							
                                  $date1 = date_create($book->booking_date);
                                  $date1 = date_format($date1, "d M Y");
                                  $date_exp = explode(" ", $date1);
                                  if(count($date_exp)) {
                                      echo "<span>".$date_exp[0]."</span>";
                                      echo "<span>".$date_exp[1]."</span>";
                                      echo "<span>".$date_exp[2]."</span>";
                                  }
                              ?></td>
                            <td><strong> <a href="#"> {{$book->name}}</strong></a></td>
                            
                            <td>${{$book->price}}</td>
                            <td><?php 
                                  $date2 = date_create($book->created_at);
                                  echo date_format($date2, "m/d/Y  h:i a");
                              ?></td>
                            <td>{{$book->first_name}} {{$book->last_name}}</td>
                            <td>${{$chef_share}}</td>
                            <td>{{$book->customer_first_name}} {{ $book->customer_last_name }}</td>
                            <td>{{strtoupper($book->completed)}}</td>
                            
                            <td style="width:100px">
                              <a href="{{url('chef')}}/{{$book->chef_id}}">View Chef</a>
                              <a href="{{url('admin/booking')}}/{{$book->id}}">View Details</a>
                              <button class="btn btn-danger delete" data-id="{{$book->id}}">DELETE</button>
                            </td>
                                                      </tr>
                        @endforeach
                      @else
                          <tr>
                            <td colspan="12">
                              <div class="alert alert-info" role="alert">
                                  You don't have upcoming bookings.
                              </div>
                            </td>
                          </tr>
                      @endif
                  </tbody>
                </table>
              </div>

              </div>
              <div id="past" class="tab-pane fade mt-3">
                  <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Booked Date</th>
                      <th>Menu Name</th>
                      <th>Price</th>                      
                      <th>Booking Date</th>
                      <th>Chef</th>
                      <th>Chef Share</th>
                      <th>Customer</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(count($past_bookings))
                        @foreach ($past_bookings as $book)
                        <?php 
                          $chef_share = round(@unserialize($book->price_data)['chef_share'], 2);
                        ?>
                           <tr>
                            <td><?php
							
                                  $date1 = date_create($book->booking_date);
                                  $date1 = date_format($date1, "d M Y");
                                  $date_exp = explode(" ", $date1);
                                  if(count($date_exp)) {
                                      echo "<span>".$date_exp[0]."</span>";
                                      echo "<span>".$date_exp[1]."</span>";
                                      echo "<span>".$date_exp[2]."</span>";
                                  }
                              ?></td>
                            <td><strong> <a href="#"> {{$book->name}}</strong></a></td>
                            
                            <td>${{$book->price}}</td>
                            <td><?php 
                                  $date2 = date_create($book->created_at);
                                  echo date_format($date2, "m/d/Y  H:i A");
                              ?></td>
                            <td>{{$book->first_name}} {{$book->last_name}}</td>
                            <td>${{$chef_share}}</td>
                            <td>{{$book->customer_first_name}} {{ $book->customer_last_name }}</td>
                            <td style="width:100px">
                              <a href="{{url('chef')}}/{{$book->chef_id}}">View Chef</a>
                              <a href="{{url('admin/booking')}}/{{$book->id}}">View Details</a>
                              <button class="btn btn-danger delete" data-id="{{$book->id}}">DELETE</button>
  

                            </td>
                                                      </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="12">
                          <div class="alert alert-info" role="alert">
                              You don't have past bookings.
                          </div>
                        </td>
                      </tr>
                      @endif
                  </tbody>
                </table>
              </div>              
              </div>
            </div>
            
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
    $('#dataTable2').DataTable();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $(document).on('click', '.delete', function() {
            let tid = $(this).attr("data-id");
            let that = $(this);
            swal({
              title: "Are you sure?",
              text: "You want to delete this booking?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{route("admin-delete-booking")}}',
                    data: { 'id': tid},
                    success:function(data) {
                      that.parents("tr").remove()
                      swal(data.response)
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
