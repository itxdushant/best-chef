@extends('layouts.header')
@section('content')
   <div class="favorites_section">
     <div class="container">
        <div class="profile_path">
            <a href="#">Account  >    </a>
            <a href="#">  Favorites</a>
        </div>

         <div class="filters_div">
            <h3 class="h3_profile">Favorites</h3>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/filter.png')}}" alt="">
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="login.html">login</a></li>
                  <li><a class="dropdown-item" href="sign-up.html">Sign Up</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
         </div>
        
         <div class="row">
             @foreach($favs as $fav)
             <div class="col-lg-4 col-md-6">
              <div class="cards_favite">
                      <img src="{{asset('uploads/profiles')}}/{{$fav->profile_pic}}">
                      <div class="card_links">
                       <h4>{{$fav->first_name}} {{$fav->last_name}}</h4>
                       <span>{{$fav->city}}, {{$fav->state}} {{$fav->zip}}</span>
                       <div>
                       @php
   $meal_specalities=explode(',',$fav->meal_speciality)

     @endphp
     @foreach($meal_specalities as $meal_specality)
        <a href="#">{{$meal_specality}}</a>
        
        @endforeach
                       </div>
                      </div>
               </div>
             </div>
             
    @endforeach
    </div>

</div>

     </div>
   </div>
   <script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
@endsection