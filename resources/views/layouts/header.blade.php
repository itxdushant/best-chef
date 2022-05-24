<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="{{asset('css/slick/slick.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('css/slick/slick-theme.css')}}" />
  <link href="{{asset('css/sweetalert.css')}}" type="text/css" rel="stylesheet" />
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.3.2/iframeResizer.contentWindow.js" integrity="sha512-cJ7aOLpXbec1Km9craM6xL6UOdlWf9etIz7f+cwQv2tuarLm3PLb3dv3ZqIK++SE4ui+EE0nWqKB0dOaAOv9gQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <link rel="stylesheet" href="https://cdn.tutorialjinni.com/croppie/2.6.5/croppie.min.css"/>
  <script src=" https://cdn.tutorialjinni.com/croppie/2.6.5/croppie.min.js"></script>

 
  
  <title>Best Local Chefs - @yield('title')</title>
</head>

<body>
  <!-- chef header   -->
  <nav class="navbar navbar-expand-lg  chef_header chef_headerfff chef_header_2">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#">Navbar</a> -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('howitworks')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('menu-listing')}}">Find a Chef</a>
          <li class="nav-item">
            <a class="nav-link" href="#">Experiences</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact</a>
          </li>
          <li class="nav-item">
         
           <a class="nav-link" href="#">Chef? Join Today</a>
            <!-- <a class="nav-link" href="join-as-a-chef.html">Chef? Join Today</a> -->
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{asset('images/login.png')}}">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @guest

              <li><a class="dropdown-item" href="{{route('login')}}">login</a></li>
              <li><a class="dropdown-item" href="{{route('register')}}">Sign Up</a></li>
              <li><a class="dropdown-item" href="{{route('support')}}">Support</a></li>
              @else

              <li><a class="dropdown-item" href="{{url(Auth::user()->user_type)}}">{{auth()->user()->first_name }} {{auth()->user()->last_name }}</a></li>
              <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">logout</a></li>
              <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <li><a class="dropdown-item" href="{{route('support')}}">Support</a></li>
              @endguest
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <div class="chef_footer">
    <div class="container">
      <div class="row mb-4 footer_frst_row">
        <div class="col-md-3">
          <div class="frst">
            <h3>Best Local
              <br> Chef
            </h3>
            <div class="footer_social_links">
              <a href="#"><img src="{{asset('images/fb.png')}}"></a>
              <a href="#"><img src="{{asset('images/insta.png')}}"></a>
              <a href="#"><img src="{{asset('images/twitter.png')}}"></a>
              <a href="#"><img src="{{asset('images/youtube.png')}}"></a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-links">
            <h4>Explore BLC </h4>
            <a href="{{route('chef-list')}}">List of Chefs</a>
            <a href="{{route('menu-listing')}}">Book a Chef</a>
            <a href="#">COVID & Safety</a>
            <a href="#">Parter Resources</a>
            <a href="#">Food Safety Guide</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-links">
            <h4>Meet the BLC Family </h4>
            <a href="{{route('chef-list')}}">List of Chefs</a>
            <a href="{{route('menu-listing')}}">Book a Chef</a>
            <a href="#">COVID & Safety</a>
            <a href="#">Parter Resources</a>
            <a href="#">Food Safety Guide</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-links">
            <h4>Company </h4>
            <a href="{{route('about-us')}}">About</a>
            <a href="#">Careers</a>
            <a href="#">Affiliates</a>
            <a href="#">Media Center</a>
            <a href="#">Advertising</a>
          </div>
        </div>
      </div>

      <div class="row copy_right">
        <div class="col-md-4">
          <p>© 2021 Best Local Chef. All rights reserved.</p>
        </div>
        <div class="col-md-8">
          <form class="row g-3">
            <div class="col-auto">
              <label for="email" class="">Get special offers, chef experiences and more from Best Local Chef </label>
              <input type="email" class="form-control" id="" placeholder="Email Address">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn ">SUBSCRIBE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  
  @yield('scripts')
  
</body>

</html>