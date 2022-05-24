@extends('layouts.header')
@section('styles')
@endsection
@section('title', 'Chat')

    <div class="message_section">
        <div class="container">
            <div class="message_div">
            <div class="left_div_members">
                <div class="profile_path">
                    <a href="#">Messages  >    </a>
                    <a href="#"> Personal Info </a>
                </div>
                <h3 class="h3_profile">Messages</h3>

                <ul class="chat_prson">
                    <li class="person_profile">
                        <img src="images/chat_1.png" alt="">
                        <h3>Hollie M.<span>- Austin</span></h3>
                        <span>Booking Complete - Jan 2, 2022 </span>
                    </li>

                    <li class="person_profile">
                    <img src="images/chat_2.png" alt="">
                    <h3>Justin G.<span>- Austin</span></h3>
                    <span>Booking Complete - Jan 2, 2022 </span>
                </li>

                </ul>

            </div>
            <div class="chat_right_div">
                <div class="chat_name">
                    <h4>Hollie M.</h4>
                    <span>Response time: 1 hour </span>
                </div>
                <div class="chats_here">
                        <span class="chat_date">Jan 2, 2022 </span>

                        <div class="booking_rqst_msg">
                        <p><img src="images/message.png">Booking Request Sent</p>
                        </div>
                        <div class="booking_rqst_msg">
                        <p><img src="images/message.png">Booking Request Accepted</p>
                        </div>

                        <span class="chat_date">Jan 4, 2022  </span>

                        <div class="message_typed">
                            <h5>Hollie M.<span>10:45 am</span></h5>
                            <p>I am interested in cooking for your family on January 6. I will be getting with you soon on the details needed for that booking.</p>
                        </div>

                        <span class="chat_date">Jan 6, 2022  </span>

                        <div class="booking_rqst_msg">
                        <p><img src="images/message.png">Let us know what you thought about your booking.</p>
                        </div>
                    
                    <div class="message_type">
                        <from name="" action="">
                        <input type="text" placeholder="Typae a message…">                            
                        <div class="upload_doc gallery-icon">                           
                            <div class="upload-file-btn-main">
                                <label class=""> 
                                    <img src="images/gallery.png" alt="">
                                    <input type="file" size="60" >
                                </label>                            
                            </div>
                        </div>                           
                        <input class="btn_chef" type="submit" value="Send" />
                    </from>
                    </div> 
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@section('content')



@endsection

@section('scripts')
@endsection