@extends('layouts.admin')

@section('title', 'Trips')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Trips</div>
          <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="active"><a class="nav-item nav-link active" data-toggle="tab" href="#upcoming">UPCOMING TRIPS</a></li>
                <li><a  class="nav-item nav-link" data-toggle="tab" href="#past">PAST TRIPS</a></li>
            </ul>
            <div class="tab-content">
              <div id="upcoming" class="tab-pane fade show active mt-3">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Booked Date</th>
                      <th>Trip Name</th>
                      <th>Deposit</th>
                      <th>Total Price</th>                      
                      <th>Booking Date</th>
                      <th>Guide</th>
                      <th>Guide share</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(count($upcoming_trips))
                        @foreach ($upcoming_trips as $trip)
                          <tr>
                            <td><?php
                                  $date1 = date_create($trip->book_date);
                                  $date1 = date_format($date1, "d M Y");
                                  $date_exp = explode(" ", $date1);
                                  if(count($date_exp)) {
                                      echo "<span>".$date_exp[0]."</span>";
                                      echo "<span>".$date_exp[1]."</span>";
                                      echo "<span>".$date_exp[2]."</span>";
                                  }
                              ?></td>
                            <td><strong> <a href="{{url('trip')}}/{{$trip->trip_id}}"> {{$trip->trip_name}}</strong></a></td>
                            <td> @if($trip->deposit_required=="yes")
                                                                    ${{$trip->price}}
                                                                @else
                                                                    ---
                                                                @endif</td>
                            <td>${{$trip->total_price}}</td>
                            <td><?php 
                                  $date2 = date_create($trip->created_at);
                                  echo date_format($date2, "m/d/Y  H:i A");
                              ?></td>
                            <td>{{$trip->guide_name}}</td>
                            <td> ${{$trip->total_price * 90 / 100}}</td>
                            
                            <td style="width:100px">
                              <a href="{{url('trip')}}/{{$trip->trip_id}}">View Trip</a>
                              <a href="{{url('admin/booking')}}/{{$trip->id}}">View Details</a>
                            </td>
                                                      </tr>
                        @endforeach
                      @else
                          <tr>
                            <td colspan="12">
                              <div class="alert alert-info" role="alert">
                                  You don't have upcoming trips.
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
                      <th>Trip Name</th>
                      <th>Deposit</th>
                      <th>Total Price</th>
                  
                      <th>Booking Date</th>
                      <th>Guide</th>
                      <th>Guide share</th>
                  
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(count($past_trips))
                        @foreach ($past_trips as $trip)
                          <tr>
                            <td><?php
                                  $date1 = date_create($trip->book_date);
                                  $date1 = date_format($date1, "d M Y");
                                  $date_exp = explode(" ", $date1);
                                  if(count($date_exp)) {
                                      echo "<span>".$date_exp[0]."</span>";
                                      echo "<span>".$date_exp[1]."</span>";
                                      echo "<span>".$date_exp[2]."</span>";
                                  }
                              ?></td>
                            <td><strong> <a href="{{url('trip')}}/{{$trip->trip_id}}"> {{$trip->trip_name}}</strong></a></td>
                            <td> @if($trip->deposit_required=="yes")
                                                                    ${{$trip->price}}
                                                                @else
                                                                    ---
                                                                @endif</td>
                            <td>${{$trip->total_price}}</td>
                            
                            <td><?php 
                                  $date2 = date_create($trip->created_at);
                                  echo date_format($date2, "m/d/Y  H:i A");
                              ?></td>
                            <td>{{$trip->guide_name}}</td>
                            <td> ${{$trip->total_price * 40 / 100}}</td>
                           
                            <td style="width:100px"><a href="{{url('trip')}}/{{$trip->trip_id}}">View Trip</a>
                              <a href="{{url('admin/booking')}}/{{$trip->id}}">View Details</a>
                            </td>
                          </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="12">
                          <div class="alert alert-info" role="alert">
                              You don't have past trips.
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
  });
</script>
@endsection
@endsection
