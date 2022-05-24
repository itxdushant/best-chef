@extends('layouts.main')

@section('title', 'Profile')

@section('content')

<style type="text/css">
    .star-rating {
      line-height:32px;
      font-size: 30px;
    }

    .star-rating .fa-star{color: rgb(168, 217, 236); font-size: 30px;}
</style>


<!-- banner -->
<section class="inner-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Add Review</h1>
				</div>
			</div>
		</div>
    </div>
</section>
<!-- //banner -->

    
<section class="body-data-box">
    <div class="container-fluid">
		<!-- register  -->
		<div class="row">
			@include('layouts.slic.user_sidebar')
			<div class="col-lg-9 col-md-8 px-md-5 pt-2 content">
				<div class="vc-element-grid text-left">
					<h3 class="inner-section-title">Add Review</h3>
				</div>
			<div class="">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			@if($chef)           
				<form  action="{{ url('user/submit-review') }}" method="post" enctype="multipart/form-data">
					@csrf				
					<div class="form-group">
						 <div class="star-rating">
							<span class="fa fa-star-o" data-rating="1"></span>
							<span class="fa fa-star-o" data-rating="2"></span>
							<span class="fa fa-star-o" data-rating="3"></span>
							<span class="fa fa-star-o" data-rating="4"></span>
							<span class="fa fa-star-o" data-rating="5"></span>
							<input type="hidden" name="rating" class="rating-value" value="5">
						  </div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Review</label>
						<textarea class="form-control" rows="6" cols="75" name="review" required></textarea>                        
					</div>
					<input type="hidden" name="chef_id" value="{{$chef->id}}"> 
					<input type="hidden" name="menu_id" value="{{$id}}">                               
					<input type="hidden" name="bid" value="{{$bid}}">                               
					<button type="submit" class="btn btn-default submit-btn">Submit</button>
				</form>
			@else
				<div class="alert alert-info" role="alert">
					Chef Not Found.
				</div>
			@endif
			</div>
		</div>
		<!-- //register -->
	</div>
</div>
</section>
@section('scripts')
<script type="text/javascript">
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
      return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
          return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
          return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
      });
    };

    $star_rating.on('click', function() {
      $star_rating.siblings('input.rating-value').val($(this).data('rating'));
      return SetRatingStar();
    });

    SetRatingStar();
    
</script>        
@endsection


@endsection
