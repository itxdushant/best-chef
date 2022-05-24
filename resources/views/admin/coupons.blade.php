@extends('layouts.admin')

@section('title', 'Trips')

@section('content')

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Coupons</div>
    <div class="card-body">
      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="table-responsive">
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Code</th>
                <th>Discount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($referrals as $referral)
                <tr>
                  <td>{{$referral->promo_code}}</td>
                  <td>{{$referral->amount}} %</td>
                <td>
                  @if($referral->status == "expired")
                    <a href="javascript:void(0)" class="btn btn-primary">Expired</a>
                  @else
                    <a href="javascript:void(0)" data-id="{{$referral->id}}" class="btn btn-primary expire">Expire</a>
                  @endif

                  @if($referral->active == "yes")
                    <a href="javascript:void(0)" class="btn btn-primary active-status" data-type="no" data-id="{{$referral->id}}">Disable</a>
                  @else
                    <a href="javascript:void(0)" class="btn btn-primary active-status" data-type="yes" data-id="{{$referral->id}}">Enable</a>
                  @endif
                </td>
                </tr>
              @endforeach
            </tbody>
          </table>

      </div>
      <form  action="{{ route('admin-store-referral') }}" method="post" autocomplete="off">
        @csrf
        <div class="form-group">
          <label class="col-form-label">Promo Code Name</label>
          <div class="col-md-3">
            <input id="promo_code" type="text" class="form-control" autocomplete="off" required name="promo_code">  
          </div>
          <div class="col-md-3">
            <button type="button" id="generate_code" class="btn btn-primary">Generate Code</button>                  
          </div>
        </div>                  
        <div class="form-group">
          <label class="col-form-label">Discount Percentage</label>
          <input id="price" type="number" class="form-control col-md-3" required name="amount">                    
        </div>
        <div class="form-group">
          <label class="col-form-label">Expire Date</label>
          <input id="expire_date" type="text" class="form-control col-md-3 datepicker" required name="expire_date">                    
        </div>
        <div class="form-group">
          <label class="col-form-label">Full Discount</label>
          <input type="checkbox" class="" value="yes" name="full">                    
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  <div class="card-footer small text-muted"></div>
</div>

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

      $( ".datepicker" ).datepicker();

      $('#dataTable').DataTable();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $("#generate_code").on("click", function() {
            $("#promo_code").val(makeid(10))
        });

        function makeid(length) {
          let text = "";
          let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
          for (let i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

          return text;
        }

        $(document).on('click', '.expire', function() {
            let bid = $(this).attr("data-id");
            let that = $(this);
            swal({
              title: "Are you sure?",
              text: "You want to set Expire.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, Expire!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
               $.ajax({
                    type:'POST',
                    url:'{{route("admin-expire-coupon")}}',
                    data: { 'id': bid},
                    success:function(data) {
                      that.text("Expired")
                      that.removeClass("expire")
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
            let txt = (type == "yes") ? "Disable" : "Enable";
            let at = (type == "yes") ? "no" : "yes";
            swal({
              title: "Are you sure?",
              text: "You want to set status!",
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
                    url:'{{route("admin-active-coupon")}}',
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
