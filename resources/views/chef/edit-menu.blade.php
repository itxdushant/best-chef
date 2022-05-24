@extends('layouts.main')

@section('styles')
 
@endsection

@section('title', 'Profile')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
				
                <div class="page-inner-section-main">       
					<div class="row">
						<div class="col-lg-4 page-inner-section-title">Meal</div>
						<div class="col-lg-8">
							 <div class="text-md-right">
								 <a class="common-link-btn" href="{{url('chef/add-menu')}}">Add New Meal</a>
								 <a class="common-link-btn" target="_blank" href="{{url('chef')}}/{{Auth::user()->id}}/{{strtolower(Auth::user()->first_name)}}{{strtolower(Auth::user()->last_name)}}">View Profile</a>
							</div>
						</div>
					</div>
					
                    <form action="" method="post" id="edit-meal" class="edit-profile-form-box chef-account p-0" enctype="multipart/form-data">
                        @csrf
                        <div class="chef-account-data-row">
							<label>Meal Category</label>
							<select name="category" class="form-control custom-select dark" required>	
								<option value="Entree" {{ $menu->category == "Entree" ? 'selected' : '' }}>Entree</option>
								<option value="Sides" {{ $menu->category == "Sides" ? 'selected' : '' }}>Sides</option>
								<option value="Dessert" {{ $menu->category == "Dessert" ? 'selected' : '' }}>Dessert</option>
								<option value="Appetizer" {{ $menu->category == "Appetizer" ? 'selected' : '' }}>Appetizer</option>
							</select>
						</div>
						<div class="chef-account-data-row">
							<label>Meal Name</label>
							<input type="text" name="name" placeholder="" required value="{{$menu->name}}" />
						</div>
						<div class="chef-account-data-row">
							<label>Meal Preferences</label>
							<select name="meal_prefrences[]"  multiple="multiple" class="form-control js-example-basic-multiple" required> 
									<option value="">--select any category--</option>								
									<option value="Meat" {{in_array('Meat', $meal_prefrences)?'SELECTED':''}}>Meat</option>
									<option value="Vegan" {{in_array('Vegan', $meal_prefrences)?'SELECTED':''}}>Vegan</option>
									<option value="Vegetarian" {{in_array('Vegetarian', $meal_prefrences)?'SELECTED':''}}>Vegetarian</option>
									<option value="Athlete" {{in_array('Athlete', $meal_prefrences)?'SELECTED':''}}>Athlete</option>
									<option value="Plant_based" {{in_array('Plant_based', $meal_prefrences)?'SELECTED':''}}>Plant-based </option>
									<option value="Gluten_free" {{in_array('Gluten_free', $meal_prefrences)?'SELECTED':''}}>Gluten-free </option>
									<option value="Other" {{in_array('Other', $meal_prefrences)?'SELECTED':''}}>Other</option>
								</select>
						</div>
						<div class="chef-account-data-row" style="display: none;">
							<label>Ingredients</label>
							<input type="text" name="ingredients"  value="{{$menu->ingredients}}" />
						</div>
						<div class="chef-account-data-row">
							<label>Requirements</label>
							<input type="text" name="requirements" placeholder="2 stove tops, ovens, gas grill, etc" value="{{$menu->requirements}}" required/>
						</div>
						<div class="chef-account-data-row">
							<label>Description</label>
							<textarea class="form-control edit-text-area" name="description">{{$menu->description}}</textarea>
						</div>
						
						<div class="chef-account-data-row">
							<div class="row">
								<div class="col-md-3">
									<label>Add Images</label>
								</div>
								<div class="col-md-9 add-img-btn">									
									<ul class="images-container">
									  <?php
									  $imgs =  explode(",", $menu->images);
									  $imgs = array_filter($imgs);
									  if(count($imgs)) { 
										foreach ($imgs as $key => $value) { ?>
										<li class="meal-list-item">   
											<label class="meal-img">	
											<div class="img-preview">	
												<img class="" src="{{asset('public/uploads/menu-images')}}/{{$value}}" width="96" height="96">
											</div>
											<input type="hidden" name="oldpics[]" value="{{$value}}" />
											
											</label>
											<a href="javascript:void(0)" class="remove-pic remv-btn" data-img="{{$value}}"><i class="fa fa-remove"></i></a>													
										 
										</li>  
									  <?php  } ?> 
									 
									<?php } ?>    
									</ul>
									<button type="button" id="add-more" class="btn btn-default"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</div>
						
						<div class="chef-account-data-row">
							<div class="row">
								<!--<div class="col-md-4">-->
								<!--<label>Nutritional facts<a class="search-tooltip"> <i class="fas fa-info-circle"></i><span class="tooltiptext">Calories 105, Sugar 3gm, Total Fat 10g, Sodium 107g, Protein 7g.</span></a></label>-->
								<!--	<input min="0" type="text" name="calories" required value="{{$menu->calories}}"/>-->
								<!--</div>-->
								<!--<div class="col-md-4">-->
								<!--	<label>Prep Time</label>-->
								<!--	<input class="qualification" type="number" name="prep_time" placeholder="" required value="{{$menu->prep_time}}"/>-->
								<!--</div>-->
								<div class="col-md-4">
									<label>Meal Cost</label>
									<input class="qualification" type="number" name="cost" step="any" placeholder="" required value="{{$menu->cost}}"/>
								</div>
								
							</div>                                  
						</div>
					  
						<div class="text-left">                                 
							<input type="submit" class="edit-menu" value="UPDATE" />                                  
						</div>                              
                          
                        </form>
                                    
                </div>
            </div>
        </div>
    </div>
</section>  
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
$(document).ready(function() {

    	$( "#edit-meal" ).submit(function( event ) {  
    		$(".edit-menu").val("Please wait...")
    	});

        $('#add-more').click(function() {
            $('.images-container').append('<li class="meal-list-item"><label class="meal-img"><span class="browseimages">Browse images</span><input type="file" class="image"  name="images[]"><div class="img-preview"></div></label><a href="javascript:void(0)" class="remove_field_trip_files remv-btn"><i class="fa fa-remove"></i></a></li>');
        });
        $(".images-container").on("click",".remove_field_trip_files", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('li').remove();
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.remove-pic').click(function() {            
            let menu_img = $(this).attr("data-img");
            $(this).parent('li').remove();            
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).next(".img-preview").html('<img width="77" src="'+e.target.result+'">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('change', '.image', function(){
            readURL(this);
            $(this).prev('.browseimages').text("");
        });

    })
</script>
@endsection
@endsection
