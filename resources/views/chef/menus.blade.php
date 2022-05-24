@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('public/css/croppie.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('title', 'Profile')

@section('content')

<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Dashboard</h1>
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
                <div class="col-lg-9 col-md-8 p-lg-5 content">
               
                <div class="page-inner-section-main">     
                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif                 
                    <div class="page-inner-section-title">Meal</div>
                    <div class="page-inner-section-main">
					<div class="text-right py-4">
						 <a class="common-link-btn" href="{{url('chef/add-menu')}}">Add New Meal</a>
                         <a class="common-link-btn" target="_blank" href="{{url('chef')}}/{{Auth::user()->id}}/{{strtolower(Auth::user()->first_name)}}{{strtolower(Auth::user()->last_name)}}">View Profile</a>
					</div>
                    <table class="table table-striped table-data-label">
                        <thead>
                          <tr>
                            <th scope="col">Meal Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>                        
                        <tbody>
                            @if(count($menus))
                                @foreach ($menus as $meal)
                                <tr class="card-{{$meal->id}}">
                                    <td data-label="name">{{$meal->name}}</td>
                                    <td data-label="category">{{$meal->category}}</td>
                                    <td data-label="calories">${{$meal->cost}}</td>
                                    <td data-label="Action">
                                        <a href="{{url('chef/edit-menu')}}/{{$meal->id}}" class="link">Edit</a>
                                        <a class="rmv ml-2 delete-menu" data-id="{{$meal->id}}" href="javascript:void(0)" class="link">Delete</a>
                                        @if($meal->status)
                                            <a class="rmv ml-2 enable-menu" data-id="{{$meal->id}}" href="javascript:void(0)" class="link">Enable</a>
                                        @else
                                            <a class="rmv ml-2 disable-menu" data-id="{{$meal->id}}" href="javascript:void(0)" class="link">Disable</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5"> No meals posted.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>                   
					</div>
                </div>

                            
                </div>
            </div>
        </div>
    </div>
</section> 

<div class="modal fade" id="edit-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login px-4 mx-auto mw-100">
                    <h3 class="text-center mb-4">Edit Photo</h3>
                    <div class="col-md-6">
                        <div class="text-center">
                            <div id="upload-demo" style="width:300px;"></div>
                        </div>
                        <strong>Select Image:</strong>
                        <br/>
                        <input type="file" id="upload">
                        <br/>
                        <button type="button" class="btn btn-success upload-result mt-3" style="display: none;">Upload Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset('public/js/croppie.js')}}"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
    
        $('.date').datepicker({
            startDate: moment().format('mm/dd/yyyy'),
            multidate: true,
            format: 'mm/dd/yyyy',
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });         
     
        $(document).on('click', '.delete-menu', function() {
            let menu_id = $(this).attr("data-id");
            let that = $(this);
            swal({
              title: "Are you sure?",
              text: "Once you will delete All bookings for your meal will be removed.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    type:'POST',
                    url:'{{route("chef-delete-menu")}}',
                    data: { 'menu_id': menu_id},
                    success:function(data) {
                        $(".card-"+menu_id).remove();
                        swal(data.response)                        
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        });

        $(document).on('click', '.enable-menu', function() {
            let menu_id = $(this).attr("data-id");
            let that = $(this);
            enableDis(menu_id, 'enable' , 'Once you will enable the meal it will show on your profile.', that)
        });
        $(document).on('click', '.disable-menu', function() {
            let menu_id = $(this).attr("data-id");
            let that = $(this);
            enableDis(menu_id, 'disable' , 'Once you will disable the meal it will not show on your profile.', that)
        });

        function enableDis(menu_id, type, msg, ele) {
            swal({
              title: "Are you sure?",
              text: msg,
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, "+type+" it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    type:'POST',
                    url:'{{route("chef-status-menu")}}',
                    data: { 'menu_id': menu_id, 'type': type },
                    success:function(data) {
                        swal(data.response) 
                        if(type == "enable") {
                            ele.text('Disable')
                            ele.removeClass('enable-menu').addClass('disable-menu');
                        } else {
                            ele.text('Enable')
                            ele.removeClass('disable-menu').addClass('enable-menu');
                        }                      
                    },
                    error: function(err) {
                      swal("Error!", "Please try again", "error");
                    }
                });
            });
        }

        var $uploadCrop = "";

        $('#upload').on('change', function () {
            $('#upload-demo').croppie('destroy');
            $('.upload-result').show();
            $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });          
            
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: "{{url('/photo-upload')}}",
                    type: "POST",
                    data: {"image":resp},
                    success: function (data) {
                        $("#edit-photo").modal("hide");
                        $(".profile-img img").attr('src', resp)
                        $('#upload-demo').croppie('destroy');
                        $('.upload-result').hide();
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
