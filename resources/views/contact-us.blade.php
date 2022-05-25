@extends('layouts.header')
@section('styles')
@endsection

@section('title', 'Contact us')

@section('content')


<div class="profile_section ">
      <div class=" container">

          <div class="profile_path">
              <!-- <a href="{{route('contact-us')}}">Contact us </a> -->
              <!-- <a href="#"> Personal Info</a> -->
          </div>
		 
          <div class="booking_section row">
           <div class="col-md-7 col_left">
            <div class="contetn_left_div">
                <h3 class="h3_profile">Contact Us</h3>
                <div class="banking_information_form mt-4">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				@if (session('warning'))
					<div class="alert alert-warning">
						{{ session('warning') }}
					</div>
				@endif
		
				<form method="post" action="{{ route('contactus.store') }}" onsubmit="return submitUserForm();">
					{{ csrf_field() }} 
                    <div class="row">
						
                      <div class="col-md-12">
					  <input type="text" name="first_name" class="form-control" placeholder="First Name *"  required />
					 @if ($errors->has('first_name'))
											<span class="help-block">
												<strong>{{ $errors->first('first_name') }}</strong>
											</span>
					 @endif
                      </div>
					  <div class="col-md-12">
					  <input type="text" name="last_name" class="form-control" placeholder="Last Name *"  required />
					 @if ($errors->has('last_name'))
											<span class="help-block">
												<strong>{{ $errors->first('last_name') }}</strong>
											</span>
					 @endif
                      </div>
                         <div class="col-md-6">
						 <input type="email" name="email" class="form-control" placeholder="Your Email *"  required />
								 @if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
								 @endif
                             </div>
                             <div class="col-md-6">
							 <input type="text" name="reason" class="form-control" placeholder="Reason *"  required />
					 @if ($errors->has('reason'))
											<span class="help-block">
												<strong>{{ $errors->first('reason') }}</strong>
											</span>
					 @endif
                                 </div>

                             <div class="col-md-12">
                             <textarea id="messageval" name="message"  class="form-control" placeholder="Message" style="width: 100%; height: 150px;" required></textarea>
							 @if ($errors->has('message'))
							<span class="help-block">
							<strong>{{ $errors->first('message') }}</strong>
							</span>
							@endif
                                 </div>
                                 
                                <div class="mt-3">
                                <a href="#" class=" "> <button class="btn_c btn_chef" type="submit" name="btnSubmit">Send</button></a>
                              </div>
                    </div>
</form>
                   </div>
            </div>
           </div>
  
           <div class="col-md-5 col-right">
           <div class="content_right_div">
              <div class="content_detail_text">
                 <img src="images/lock.png" alt="">
                 <h4>Which details can be edited?</h4>
                <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
              </div>
              <div class="content_detail_text">
                <img src="images/busines_card.png" alt="">
                <h4>What info is shared with others?</h4>
               <p class="p_grey">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
             </div>
           </div>
        </div>
          </div>
      </div>
     </div>
<!-- banner -->
<!-- <section class="inner-page-banner contact-page-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap text-center">
					<h1 class="page-title-heading">Contact us</h1>
					<p class="page-sub-title">For your Next Fine Dining Experience<br/> No Matter Where You Are</p>
				</div>
			</div>
		</div>
    </div> -->
</section>
<!-- //banner -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function submitUserForm() {
    var response = grecaptcha.getResponse();
    /* Restrict Bad words from Message */	
     var bad_words=new Array("shit","sex","xxx","fuck","adult","dating","bitch");
	 var check_text=document.getElementById("messageval").value;
	 var error=0;
	 for(var i=0;i<bad_words.length;i++)
	 {
	  var val=bad_words[i];
	  if((check_text.toLowerCase()).indexOf(val.toString())>-1)
	  {
	   error=error+1;
	  }
	 }
		
	 if(error>0)
	 {
	  document.getElementById("message-text-error").innerHTML='<span style="color:red;">Please do not use abusive words!</span>';
	  return false;
	 }else{
	 	document.getElementById("message-text-error").innerHTML="";
	 }

    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
 
// function verifyCaptcha() {
//     document.getElementById('g-recaptcha-error').innerHTML = '';
// }

</script>
@section('scripts')

@endsection
@endsection