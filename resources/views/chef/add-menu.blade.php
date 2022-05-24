@extends('layouts.main')

@section('styles')
 
@endsection

@section('title', 'Profile')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
textarea.form-control{
	color:#000;
	font-family: none !important;
	font-weight: 500;	
}
textarea.form-control:focus {
    color: #000 !important;
}
</style>
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
           		<?php $first_last_name = strtolower(Auth::user()->first_name.Auth::user()->last_name); ?>
                <div class="page-inner-section-main"> 
					<div class="row">
						<div class="col-lg-4 page-inner-section-title">Meal</div>
						<div class="col-lg-8">	
							<div class="text-md-right">
								 <a class="common-link-btn" href="{{url('chef/add-menu')}}">Add New Meal</a>
								 <a class="common-link-btn" target="_blank" href="{{url('chef')}}/{{Auth::user()->id}}/<?php echo $first_last_name; ?>">View Profile</a>
							</div>
						</div>
					</div>
					
                    <form action="{{ url('chef/save-menu') }}" method="post" id="add-meal" enctype="multipart/form-data" class="edit-profile-form-box chef-account p-0">
                        @csrf
                        
                        <div class="chef-account-data-row">
							<label>Meal Category</label>
							<select name="category" class="form-control custom-select dark" required>
								<option value="Entree">Entree</option>
								<option value="Sides">Sides</option>
								<option value="Dessert">Dessert</option>
								<option value="Appetizer">Appetizer</option>
							</select>
						</div>

                        <div class="chef-account-data-row">
							<label>Meal Name</label>
							<input type="text" name="name" placeholder="" required />
						</div>
						 <div class="chef-account-data-row {{ $errors->has('meal_prefrences') ? ' has-error' : '' }}">
							<label>Meal Preferences</label>
								<select name="meal_prefrences[]" multiple="multiple" class="form-control js-example-basic-multiple" required> 
									<option value="">--select any category--</option>								
									<option value="Meat">Meat</option>
									<option value="Vegan">Vegan</option>
									<option value="Vegetarian">Vegetarian</option>
									<option value="Athlete">Athlete</option>
									<option value="Plant_based">Plant-based </option>
									<option value="Gluten_free">Gluten-free </option>
									<option value="Other">Other</option>
								</select>
								@if ($errors->has('meal_prefrences'))
										<span class="help-block">
											<strong>{{ $errors->first('meal_prefrences') }}</strong>
										</span>
								 @endif
						</div>
						<div class="chef-account-data-row" style="display: none;">
							<label>Meal Ingredients <i>(List items followed by comma)</i></label>
							<input type="text" name="ingredients"/>
						</div>
						<div class="chef-account-data-row">
							<label>Requirements<a class="search-tooltip"> <i class="fas fa-info-circle"></i><span class="tooltiptext">2 stove tops, ovens, gas grill, etc.</span></a></label>
							<input type="text" name="requirements"  required/>
						</div>
						<div class="chef-account-data-row">
							<label>Description</label>
							<textarea class="form-control" name="description"></textarea>
						</div>  
						
						<div class="chef-account-data-row">
							<div class="row">
								<div class="col-md-3">
									<label>Add Images</label>                                            
								</div>
								<div class="col-md-9 add-img-btn">
									<ul class="images-container">
										<li class="meal-list-item">
											<label class="meal-img">
												<span class="browseimages">Browse images</span>
												<input class="qualification image main-image" type="file" name="images[]"  accept="image/*,video/*" />
												<div class="img-preview"></div>
											</label>
										</li>
									</ul>
									
									<button type="button" id="add-more" class="btn btn-default"><i class="fa fa-plus"></i></button>
									<div class="img-preview"></div>
									
									<div class="img-dim-mess" style="font-size:13px;">
									    *Images are best display at [300px 200px]*
									</div>
									
								</div>
							</div>                                  
						</div>
						
						<div class="chef-account-data-row">
							<div class="row">
								<!--<div class="col-md-4">-->
								<!--	<label>Nutritional facts<a class="search-tooltip"> <i class="fas fa-info-circle"></i><span class="tooltiptext">Calories 105, Sugar 3gm, Total Fat 10g, Sodium 107g, Protein 7g.</span></a></label>-->
								<!--	<input type="text" name="calories" />-->
								<!--</div>-->
								<!--<div class="col-md-4">-->
								<!--	<label>Prep Time(minutes)</label>-->
								<!--	<input min="0" type="number" name="prep_time" />-->
								<!--</div>-->
								<div class="col-md-4">
									<label>Meal Cost</label>
									<input min="0" type="number" name="cost" step="any" required />
								</div>
								<!-- <div class="col-md-3">
									<label>No. Of Guest</label>
									<select name="no_of_guest" required>
									@for($i=2; $i<=24; $i+=2)
										  <option value="{{$i}}">{{$i}}</option>
									@endfor	
									</select>
								</div> -->
							</div>                                  
						</div>
						<!-- <div class="chef-account-data-row">
							<label>Requirements</label>
							<input type="text" name="requirements" placeholder="2 stove tops, ovens, gas grill, etc" required/>
						</div>  -->
                                
						<div class="text-left">                                 
							<input class="add-menu" type="submit" name="EDIT" value="Submit Meal" />
							<!--<input class="" type="button" name="Add_more" value="Add More Menus" />-->
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

    	$( "#add-meal" ).submit(function( event ) {  
    		$(".add-menu").val("Please wait...")
    	});
        $('#add-more').click(function() {
            $('.images-container').append('<li class="meal-list-item"><label class="meal-img"><span class="browseimages">Browse images</span><input type="file" class="image" name="images[]"><div class="img-preview"></div></label><a href="javascript:void(0)" class="remove_field_trip_files remv-btn"><i class="fa fa-remove"></i></a></li>');
        });

        $(".images-container").on("click",".remove_field_trip_files", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('li').remove();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).next(".img-preview").html('<img width="96" height="96" src="'+e.target.result+'">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('change', '.image', function(){
            readURL(this);
            $(this).prev('.browseimages').text("");
        });
		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
				console.log('hhhddhdhdhdhhdh');
                reader.onload = function (e) {
                    $(input).next(".img-preview").html('<img width="96" height="96" src="'+e.target.result+'">');
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
