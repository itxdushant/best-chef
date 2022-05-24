<!doctype html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/slick/slick.css" />
	  <link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" >
     <link href="css/style.css" rel="stylesheet">
    <title></title>
  </head>
  
  <body>
    <!-- chef header -->
    <nav class="navbar navbar-expand-lg  chef_header chef_headerfff chef_header_2">
        <div class="container-fluid">
          <!-- <a class="navbar-brand" href="#">Navbar</a> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="account.html">Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.html">Profiles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="booking-request.html">Requests</a> 
              </li>
              <li class="nav-item">
                <a class="nav-link" href="booking-request.html">Booking History</a> 
              </li>
              <li class="nav-item">
                <a class="nav-link" href="banking-info.html">Banking</a> 
              </li>
              <li class="nav-item">
                <a class="nav-link" href="message.html">Messages</a> 
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="images/login.png">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="login.html">login</a></li>
                  <li><a class="dropdown-item" href="sign-up.html">Sign Up</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
       <!-- chef header end here -->
    <!-- another section -->
     <div class="profile_section">
      <div class="container">
          <div class="profile_path">
              <a href="#">Profile  >  </a>
              <a href="#"> Personal Info</a>
          </div>
          <div class="row">
           <div class="col-md-7 col_left">
            <div class="contetn_left_div">
             <h3 class="h3_profile">Profile</h3>
             <div class="prfl_img">
                <img class="pr_img" src="images/profile_1st.png" alt="">
                <div>
                    <img src="images/pencil_edit.png">
                    </div>
             </div>

             <div class="upload_doc">
                <label class="upload-file">Upload meal images</label>
             <div class=" upload-file-btn-main">
                <label class="upload-file-btn"> UPLOAD
                    <input type="file" size="60" >
                </label>
                <img class="add_more" src="images/more.png">
            </div>
             </div>

             <div class="upload_doc">
                <label class="upload-file">Upload meal videos</label>
             <div class=" upload-file-btn-main">
                <label class="upload-file-btn"> UPLOAD
                    <input type="file" size="60" >
                </label>
                <img class="add_more" src="images/more.png">
            </div>
             </div>
              <div class="form_section">
             <div class=" row">
              <div class="col-md-6">
                <input type="text" placeholder="Average meal cost">
              </div>
              <div class="col-md-6">
                <input type="text" placeholder="Average prep time">
              </div>
              <div class="col-md-12">
                 <textarea name="" id="" cols="30" rows="5" placeholder="What can customers expect?"></textarea>
              </div>
             </div>
             <div class="meals_s_l">
               <h4>Meal specialities</h4>
               <div>
                   <label for="">
                       <input type="checkbox">
                       Vegan
                   </label>

                   <label for="">
                    <input type="checkbox">
                    Vegetarian
                </label>

                <label for="">
                    <input type="checkbox">
                    Family
                </label>

                <label for="">
                    <input type="checkbox">
                    Breakfast
                </label>

                <label for="">
                    <input type="checkbox">
                    Meal Prep
                </label>

               </div>
             </div>

             <div class="meals_s_l">
                <h4>Cooking class</h4>
                <div>
                    <label for="">
                        <input type="checkbox">
                        Virtual
                    </label>
                    
                    <label for="">
                     <input type="checkbox">
                     In-person
                 </label>
                 
                 <label for="">
                     <input type="checkbox">
                     No Applicable
                 </label>
                   
                </div>
              </div>

              <div class=" row">
                <div class="col-md-6">
                  <input type="text" placeholder="College attended">
                </div>
                <div class="col-md-6">
                  <select name="" id="">
                    <option value="">Years of experience</option>
                    <option value="">Years of experience</option>
                    <option value="">MYears of experience</option>
                    <option value="">Years of experience</option>
                  </select>
                </div>
                <div class="col-md-12">
                   <textarea name="" id="" cols="30" rows="5" placeholder="Professional bio"></textarea>
                </div>
                <div class="col-md-6">
                    <input type="text" placeholder="Service area by zip code">
                  </div>
                  <div class="col-md-6">
                    <select name="" id="">
                      <option value="">Service area range</option>
                      <option value="">Years of experience</option>
                      <option value="">Years of experience</option>
                      <option value="">Years of experience</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <textarea name="" id="" cols="30" rows="5" placeholder="Certification name and/or number"></textarea>
                 </div>
               </div>

               <div class="meals_s_l">
                <h4>Availability</h4>
                <a href="#" class="select_date_link">Select all dates available</a>
               </div>

            </div> <!-- form last div -->

           <div class="calender_section pb-3">
           <img src="images/calender.jpg" alt="" class="img-fluid">
           </div>

           <div class="timings">
             <div>
                 <span>Monday</span>
                 <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                 - <input type="time" id="" name=""
                 min="09:00" max="18:00" >
             </div>
           </div>
           <div class="timings">
            <div>
                <span>Tuesday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>
          <div class="timings">
            <div>
                <span>Wednesday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>
          <div class="timings">
            <div>
                <span>Thursday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>
          <div class="timings">
            <div>
                <span>Friday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>
          <div class="timings">
            <div>
                <span>Saturday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>
          <div class="timings">
            <div>
                <span>Sunday</span>
                <input type="time" id="" name="" placeholder="" min="09:00" max="18:00" > 
                - <input type="time" id="" name=""
                min="09:00" max="18:00" >
            </div>
          </div>

          <div class="py-4">
              <a href="#" class="btn_c btn_chef">UPDATE PROFILE</a>
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
    <!-- footer -->

    <div class="chef_footer">
      <div class="container">
        <div class="row mb-4 footer_frst_row">
         <div class="col-md-3">
            <div class="frst">
              <h3>Best Local 
               <br> Chef</h3>
                <div class="footer_social_links">
                 <a href="#"><img src="images/fb.png"></a>
                 <a href="#"><img src="images/insta.png"></a>
                 <a href="#"><img src="images/twitter.png"></a>
                 <a href="#"><img src="images/youtube.png"></a>
                </div>
            </div>
         </div>
         <div class="col-md-3">
          <div class="footer-links">
             <h4>Explore BLC </h4>
             <a href="#">List of Chefs</a>
             <a href="#">Book a Chef</a>
             <a href="#">COVID & Safety</a>
             <a href="#">Parter Resources</a>
             <a href="#">Food Safety Guide</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-links">
            <h4>Meet the BLC Family </h4>
            <a href="#">List of Chefs</a>
            <a href="#">Book a Chef</a>
            <a href="#">COVID & Safety</a>
            <a href="#">Parter Resources</a>
            <a href="#">Food Safety Guide</a>
         </div>
        </div>
        <div class="col-md-3">
          <div class="footer-links">
            <h4>Company  </h4>
            <a href="#">About</a>
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
   
    <script src="js/bootstrap.bundle.min.js" ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    
    -->
    <script src="js/jquery.min.js" ></script>
  

  </body>
</html>