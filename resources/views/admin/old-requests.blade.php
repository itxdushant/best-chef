@extends('layouts.admin')

@section('title', 'Payment Requests')

@section('content')

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Payment Requests</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                   <th>Chef Name</th>
                    <th>Chef Email</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reqs as $req)
                    <tr>                      
                      <td>{{$req->first_name}} {{$req->last_name}}</td>
                      <td>{{$req->email}}</td>
                      <td>{{$req->phone_number}}</td>
                      <td>${{round($req->amount, 2)}}</td>                     
                      <td>
                        @if($req->status == "completed")
                          <?php $date2 = date_create($req->updated_at);
                          echo date_format($date2, "m/d/Y h:i:s"); ?>
                        @endif
                      </td>                     
                      <td><a href="{{route('admin-view-request', ['id'=>$req->id])}}">View</a></td>
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
  });
</script>
@endsection
@endsection
