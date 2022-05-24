@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Users</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>City</th>
                    <th>State</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{$user->first_name}} {{$user->last_name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone_number}}</td>
                      <td>{{$user->city}}</td>
                      <td>{{$user->state}}</td>
                      <td><a href="{{url('admin/user')}}/{{$user->id}}">View</a> | <button class="btn btn-danger delete" data-id="{{$user->id}}">DELETE</button> </td>
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

  });
</script>
@endsection
@endsection
