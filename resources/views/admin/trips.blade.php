@extends('layouts.admin')

@section('title', 'Trips')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Trips</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Trip Name</th>
                    <th>Guide Name</th>
                    <th>Trip Start Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
					<th>Created Date</th>
                    <th>Deposit Rquired</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($trips as $trip)
                    <tr>
                      <td>{{$trip->trip_name}}</td>
                      <td>{{$trip->guide_name}}</td>
                      <td>{{$trip->trip_start_location}}</td>
                      <td><?php 
                                  $date2 = date_create($trip->start_date);
                                  echo date_format($date2, "m/d/Y");
                              ?></td>
                      <td><?php 
                                  $date2 = date_create($trip->end_date);
                                  echo date_format($date2, "m/d/Y");
                              ?></td>
                                <td><?php 
                                  $date2 = date_create($trip->created_at);
                                  echo date_format($date2, "m/d/Y");
                              ?></td>
                      <td>{{$trip->deposit_required}}</td>
                      <td>
                        @if($trip->featured)
                          <a href="javascript:void(0)" class="btn btn-primary set-feature" data-type="0" data-id="{{$trip->id}}">Yes</a>
                        @else
                          <a href="javascript:void(0)" class="btn btn-primary set-feature" data-type="1" data-id="{{$trip->id}}">No</a>
                        @endif
                      </td>
                      <td style="width:100px">
                        @if($trip->status)
                          <a href="javascript:void(0)" class="btn btn-primary active-status" data-type="0" data-id="{{$trip->id}}">Disable</a>
                        @else
                          <a href="javascript:void(0)" class="btn btn-primary active-status" data-type="1" data-id="{{$trip->id}}">Enable</a>
                        @endif                
                      </td>
                      <td>
                        <a href="javascript:void(0)" class="btn btn-primary del-trip" data-id="{{$trip->id}}">Delete Trip</a>
                        
                        <a href="{{url('trip')}}/{{$trip->id}}" target="_blank">View Trip</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

    $('#dataTable').DataTable({
      "sort": false,
	  "pageLength":50,
    });

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $(document).on('click', '.active-status', function() {
            let bid = $(this).attr("data-id");
            let type = $(this).attr("data-type");
            let that = $(this);
            let txt = (type == "0") ? "Disable" : "Enable";
            let reptxt = (type == "0") ? "Enable" : "Disable";
            let at = (type == "1") ? "0" : "1";
            swal({
              title: "Are you sure?",
              text: "Are you sure you want to "+txt+" this?",
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
                    url:'{{route("admin-active-trip")}}',
                    data: { 'id': bid, 'type': type},
                    success:function(data) {
                      that.text(reptxt)
                      that.attr("data-type", at)
                      swal(data.response)
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });  

    $(document).on('click', '.set-feature', function() {
            let bid = $(this).attr("data-id");
            let type = $(this).attr("data-type");
            let that = $(this);
            let txt = (type == "1") ? "Yes" : "No";
            let at = (type == "1") ? "1" : "0";
            swal({
              title: "Are you sure?",
              text: "You want to set featured " + txt,
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
                    url:'{{route("admin-feature-trip")}}',
                    data: { 'id': bid, 'type': type},
                    success:function(data) {
                      that.text(txt)
                      that.attr("data-type", at)
                      swal(data.response)
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });

      $(document).on('click', '.del-trip', function() {
            let tid = $(this).attr("data-id");
            let that = $(this);
            swal({
              title: "Are you sure?",
              text: "You want to delete this trip?",
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
                    url:'{{route("admin-delete-trip")}}',
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
