@extends('layouts.main')

@section('styles')
 
@endsection

@section('title', 'Profile')

@section('content')

<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Favorite Chef</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

<section class="body-data-box">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.slic.user_sidebar')
            <div class="col-lg-9 col-md-8 px-lg-5 content">
                <div class="inner-section-title">Favorite Chef</div>
				
                <div class="chef-data-list">
                    <div class="row">
                         @if(count($favs))
                            @foreach ($favs as $fav)
                            <div class="col-md-4 px-md-2 mb-4">
                                <div class="chef-list fav-chef-list">
                                    @if($fav->profile_pic)
                                        <img alt="profile pic" src="{{asset('/public/uploads/profiles')}}/{{$fav->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/uploads/profiles/1573714106.png')}}';"/>
                                    @else
                                        <img alt="profile pic" src="{{asset('/public/uploads/profiles/1573714106.png')}}" />
                                    @endif
                                    <h4>{{$fav->first_name}} {{$fav->last_name}}</h4>
									<p>{{$fav->address}}&nbsp;</p>
                                    
                                </div>
								<div class="row chef-list-btn">
									<div class="col-6 pr-1 btn-profile">
										<input type="button" name="remove" class="remove-to-fav" data-id="{{$fav->chef_id}}" value="Remove Fav" />
									</div>
									
									<div class="col-6 pl-1 btn-profile">
										<a name="profile" href="{{url('chef')}}/{{$fav->chef_id}}/{{strtolower($fav->first_name)}}{{strtolower($fav->last_name)}}" target="_blank">View Profile</a>
									</div>
									
								</div>
                            </div>
                            @endforeach
                        @else
                            <div class="alert alert-info" role="alert">
                                You haven’t added any favorite chefs.
                            </div>
                        @endif
                        
                    </div>
                </div>
               
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
    })
    $(document).on('click', '.remove-to-fav', function() {
        let chef_id = $(this).attr("data-id");
        let that = $(this);
        
        swal({
          title: "Are you sure?",
          text: "You want to remove from Favorite.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, remove it",
          closeOnConfirm: true
        },
        function(){
           $.ajax({
                type:'POST',
                url:'{{route("remove-to-fav")}}',
                data: { 'chef_id': chef_id},
                success:function(data) {
                    that.parents('.col-md-4').remove();         
                    swal("Done!", data.response, "success")                        
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
