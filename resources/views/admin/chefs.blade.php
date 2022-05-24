@extends('layouts.admin')

@section('title', 'Chefs')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Chefs</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Service Area by Zip</th>
                    <th>Years Experience</th>
                    <th>View</th>
                    <th>Status</th>
                    <th>Featured</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{$user->first_name}} {{$user->last_name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone_number}}</td>
                      <td>{{$user->service_area}}</td>
                      <td>{{$user->experience}}</td>
                      <td><a href="{{url('/chef')}}/{{$user->id}}/{{strtolower($user->first_name)}}{{strtolower($user->last_name)}}" target="_blank">View</a> | <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">DELETE</button>  </td>
                       <td style="width:100px">
                        @if($user->admin_approved)
                          <a href="javascript:void(0)" class="btn btn-success btn-sm active-status" data-type="0" data-id="{{$user->id}}">Enabled</a>
                        @else
                          <a href="javascript:void(0)" class="btn btn-danger btn-sm active-status" data-type="1" data-id="{{$user->id}}">Disabled</a>
                        @endif                
                      </td>
                      <td>
                        @if($user->featured)
                          <a href="javascript:void(0)" class="btn btn-primary btn-sm set-feature" data-type="0" data-id="{{$user->id}}">Yes</a>
                        @else
                          <a href="javascript:void(0)" class="btn btn-primary btn-sm set-feature" data-type="1" data-id="{{$user->id}}">No</a>
                        @endif
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
    $('#dataTable').DataTable();

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
              text: "You want to delete this user?",
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
                    url:'{{route("admin-delete-user")}}',
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

    $(document).on('click', '.active-status', function() {
            let bid = $(this).attr("data-id");
            let type = $(this).attr("data-type");
            let that = $(this);
            let txt = (type == "0") ? "Disabled" : "Enabled";
            let reptxt = (type == "0") ? "Disabled" : "Enabled";
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
                    url:'{{route("admin-active-user")}}',
                    data: { 'id': bid, 'type': type},
                    success:function(data) {
                      that.text(reptxt)
                      that.attr("data-type", at)
                      if(that.hasClass('btn-danger')) {
                        that.removeClass('btn-danger')
                        that.addClass('btn-success')
                      } else {
                        that.removeClass('btn-success')
                        that.addClass('btn-danger')
                      }
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
                    url:'{{route("admin-feature-chef")}}',
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
  });
</script>
@endsection
@endsection
