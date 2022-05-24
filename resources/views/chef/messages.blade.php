@extends('layouts.chef-header')

@section('title', 'Messages')
<style>
    .right {
        float: right;
        width: 100%;
    }
    .right p, .right img {
        float: right;
        background-color: #90e1e9;
        color: #fff;
        padding: 2px 9px;
        margin-top: 8px;
    }
    .outer-msg .sender p {
        background-color: #d3ab53;
        color: #fff;
    }
    .outer-msg {
        margin: 10px 0;
    }
    .outer-msg {
        height: 400px;
        overflow: scroll;
    }
    /* 867942754 */
</style>
@section('content')
<!-- chef header end here -->
<!-- another section -->
<div class="message_section">
    <div class="container">
        <div class="message_div">
            <div class="left_div_members">
                <div class="profile_path">
                    <a href="#">Messages > </a>
                    <a href="#"> Personal Info </a>
                </div>
                <h3 class="h3_profile">Messages</h3>

                <ul class="chat_prson">
                    @if(!empty($users) )
                        @foreach($users as $user)
                            <li class="person_profile" data-id="{{$user->id}}">
                                @if(!empty($user->profile_pic) )
                                    <img src="/uploads/profiles/{{$user->profile_pic}}" alt="">
                                @else
                                    <img src="/uploads/profiles/dummy-profile-pic.png" alt="">
                                @endif
                                <h3>{{$user->first_name}} {{$user->last_name}}<span>- {{Auth::user()->first_name}} {{Auth::user()->last_name}}</span></h3>
                                <span>{{ getMessages($user->id); }} </span>
                            </li>
                            
                        @endforeach
                    @endif

                    <!-- <li class="person_profile">
                        <img src="{{asset('images/chat_2.png')}}" alt="">
                        <h3>Justin G.<span>- Austin</span></h3>
                        <span>Booking Complete - Jan 2, 2022 </span>
                    </li> -->

                </ul>

            </div>
            <div class="chat_right_div">
                <div class="chat_name">
                    <h4>Hollie M.</h4>
                    <span>Response time: 1 hour </span>
                </div>
                <!-- <div class="message-box">
                    <div class="right">
                        <p>Hi</p>
                    </div>
                    <div class="left">
                        <p>Hello</p>
                    </div>
                </div> -->
                <div class="chats_here">
                        <div class="outer-msg" id="outer-msg">
                            <!-- <div class="booking_rqst_msg">
                                <p><img src="{{asset('images/message.png')}}" >Booking Request Sent</p>
                            </div>
                            <div class="booking_rqst_msg">
                                <p><img src="{{asset('images/message.png')}}" >Booking Request Accepted</p>
                            </div> -->
                        </div>
                    <!-- <span class="chat_date">Jan 4, 2022 </span>

                    <div class="message_typed">
                        <h5>Hollie M.<span>10:45 am</span></h5>
                        <p>I am interested in cooking for your family on January 6. I will be getting with you soon on the details needed for that booking.</p>
                    </div>

                    <span class="chat_date">Jan 6, 2022 </span>

                    <div class="booking_rqst_msg">
                        <p><img src="{{asset('images/message.png')}}" >Let us know what you thought about your booking.</p>
                    </div> -->
                    
                    <div class="message_type">
                        <from name="" action="" class="msg-form" id="msgForm">
                            <input type="hidden" id="current_page">
                            <input type="hidden" id="total_page">
                            <input type="hidden" id="next_page_url">
                            <input type="hidden" id="chef_id">
                            <input type="text" placeholder="Typae a message…" id="msg">
                            <input type="hidden" name="media_ids" id="media_ids">
                            <div class="upload_doc gallery-icon">
                                <div class="upload-file-btn-main">
                                    <label class="">
                                        <img src="{{asset('images/gallery.png')}}" alt="">
                                        <input type="file" id="file" size="60" style="display: none;">
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
@endsection

@section('scripts')
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/core.js')}}"></script>
<script type="text/javascript" src="{{asset('js/init.js')}}"></script>
<script type="text/javascript" src="{{asset('js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on("click", ".person_profile", function(){
            $('.person_profile').removeClass('active');
            $(this).addClass('active');
            //var current_user_id = 225;
            var current_user_id = '{{auth()->user()->id; }}';
            var chef_id = $(this).attr('data-id');
            $('#chef_id').val(chef_id);
            var url = '{{ route("chef-conversation") }}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "chef_id": chef_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    if(data.message.data.length > 0 ){
                        var msg = data.message.data;
                        $("#current_page").val(data.message.current_page);
                        $("#total_page").val(data.message.total);
                        $("#next_page_url").val(data.message.next_page_url);
                        var html = '';
                        $.each(msg, function (key, item) {
                            var class_ = 'sender';
                            if(current_user_id == item.receiver){
                                class_ = 'receiver';
                            }

                            var img = '';
                            if( item.media_ids && item.media_ids.length > 0){
                                var medias  = item.media_ids;
                                $.each(medias, function (key, media) {
                                    img += '<img src="/uploads/media/'+media.file_name+'" data-id="'+media.id+'">';
                                });
                            }
                            html += '<div class="booking_rqst_msg '+class_+'">'+img+'<p>'
                            html +='<img src="" >'+item.message+'</p></div>';
                        });
                        
                    }
                    $('.outer-msg').html(html);
                    var objDiv = document.getElementById("outer-msg");
                    objDiv.scrollTop = objDiv.scrollHeight;
                },
                error: function(err) {
                    swal("Error!", "Please try again", "error");
                }
            });
        });
        $("#outer-msg").scroll(function(){
            var objDiv = document.getElementById("outer-msg");
            //var current_user_id = 225;
            var current_user_id = '{{auth()->user()->id; }}';
            var st = $(this).scrollTop();
            if(st == 0 ){
                var current_page = $("#current_page").val();
                var total_page = $("#total_page").val();
                if( total_page != current_page){
                    var chef_id = $('#chef_id').val();
                    var url = $("#next_page_url").val();
                    if( url ){
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                "chef_id": chef_id,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if(data.message.data.length > 0 ){
                                    var msg = data.message.data;
                                    $("#current_page").val(data.message.current_page);
                                    $("#total_page").val(data.message.total);
                                    $("#next_page_url").val(data.message.next_page_url);
                                    var html = '';
                                    $.each(msg, function (key, item) {
                                        var class_ = 'sender';
                                        if(current_user_id == item.receiver){
                                            class_ = 'receiver';
                                        }

                                        var img = '';
                                        if( item.media_ids && item.media_ids.length > 0){
                                            var medias  = item.media_ids;
                                            $.each(medias, function (key, media) {
                                                img += '<img src="/uploads/media/'+media.file_name+'" data-id="'+media.id+'">';
                                            });
                                        }
                                        html += '<div class="booking_rqst_msg '+class_+'">'+img+'<p>'
                                        html +='<img src="" >'+item.message+'</p></div>';
                                    });
                                    
                                }
                                $('.outer-msg').prepend(html);
                                var objDiv = document.getElementById("outer-msg");
                                console.log(objDiv);
                                objDiv.scrollTop = 100;
                            },
                            error: function(err) {
                                swal("Error!", "Please try again", "error");
                            }
                        });
                    }
                }
            }
            console.log(st);
        });
        $(document).on("click",".remove", function(){
            var id = $(this).attr('data-id');
            var media_id = $('#media_ids').val();
            var media_ids = media_id.split(',');
            var mediaIDs = media_ids.filter(function(item) {
                return item !== media_id;
            });
            var mediaID = '';
            if( mediaIDs.length > 0){
                mediaID = mediaIDs.join(',');
            }
            $('#media_ids').val(mediaID);
            $(this).parent(".pip").remove();
        });

        $(document).on('change','#file', function(e) {
            // var fileSize = this.files[0].size;
            // if (fileSize > 10000) {
            //    alert("file should be grater than 10 MB ");
            // }
            var files = e.target.files,
            filesLength = files.length;
            
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                var file = e.target;
                    $.ajax({
                        type: 'POST',
                        url: '{{url("sotre-media")}}',
                        data: {
                            'file': e.target.result,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if(data.length > 0){
                                var media_ids = $('#media_ids').val();
                                var list = '';
                                if(media_ids.length > 0){
                                    list = media_ids+','+data;
                                }else{
                                    list = data;
                                }
                                $('#media_ids').val(list);
                                $("<span class=\"pip\">" +
                                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                    "<br/><span class=\"remove\" data-id=\"" +data + "\">Remove image</span>" +
                                    "</span>").insertBefore(".msg-form");
                            }
                            $("#message").val('')
                        },
                        error: function(err) {
                            swal("Error!", "Please try again", "error");
                        }
                    });
                });
                fileReader.readAsDataURL(f);
            }
            
            

           // sotre-media

        });

        // $(document).on('click','.btn_chef', function(){

        // });
        $(document).on("click",".btn_chef",function() {
            var chef_id = $("#chef_id").val();
            var msg = $("#msg").val();
            var media_ids = $("#media_ids").val();
            var current_user_id = '{{auth()->user()->id; }}';
            var actionUrl = '/send-message';
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: { chef_id: chef_id, msg:msg, media_ids: media_ids, "_token": "{{ csrf_token() }}" }, // serializes the form's elements.
                success: function(data)
                {
                    if(data.message  ){
                        var class_ = 'sender';
                        if(current_user_id == data.message.receiver){
                            class_ = 'receiver';
                        }
                        var html = '';
                        var img = '';
                        if( data.message.media_ids && data.message.media_ids.length > 0){
                            var medias  = data.message.media_ids;
                            $.each(medias, function (key, media) {
                                img += '<img src="/uploads/media/'+media.file_name+'" data-id="'+media.id+'">';
                            });
                        }
                        html += '<div class="booking_rqst_msg '+class_+'">'+img+'<p>'
                        html +='<img src="" >'+data.message.message+'</p></div>';
                    }
                    $('.outer-msg').append(html);
                    var objDiv = document.getElementById("outer-msg");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
            });
        });
        // var usid = 0;
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // let cuid = "{{Auth::user()->id}}";
        // $.ajax({
        //     type: 'POST',
        //     url: '{{url("chef/read-msg")}}',
        //     data: {
        //         'uid': cuid
        //     },
        //     success: function(data) {
        //         $(".umsg").text(0);
        //     },
        //     error: function(err) {}
        // });

        // // $('#message').keypress(function(event){
        // //     var keycode = (event.keyCode ? event.keyCode : event.which);
        // //     if(keycode == '13'){
        // //         sendMsg();
        // //     }
        // // });

        // $("#fupForm").on('submit', function(e) {
        //     e.preventDefault();
        //     let uid = $("#user_id").val();
        //     let message = $.trim($("#message").val());
        //     var formData = new FormData(this);

        //     if (message != "") {
        //         formData.append('message', linkify(message));
        //         $.ajax({
        //             type: 'POST',
        //             processData: false,
        //             contentType: false,
        //             url: '{{url("chef/send-msg")}}',
        //             data: formData,
        //             success: function(data) {
        //                 $("#message").val('')
        //                 loadmsgs(uid);
        //             },
        //             error: function(err) {
        //                 swal("Error!", "Please try again", "error");
        //             }

        //         });
        //     }

        // });

        // // $("#send_msg").on("click", function(e) {
        // //     e.preventDefault();
        // //     sendMsg();
        // // });

        // function linkify(inputText) {
        //     var replacedText, replacePattern1, replacePattern2, replacePattern3;

        //     //URLs starting with http://, https://, or ftp://
        //     replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
        //     replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

        //     //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
        //     replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
        //     replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

        //     //Change email addresses to mailto:: links.
        //     replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
        //     replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

        //     return replacedText;
        // }

        // function sendMsg() {
        //     let uid = $("#user_id").val();
        //     let message = $.trim($("#message").val());

        //     if (message != "") {
        //         $.ajax({
        //             type: 'POST',
        //             url: '{{url("chef/send-msg")}}',
        //             data: {
        //                 'uid': uid,
        //                 'message': linkify(message)
        //             },
        //             success: function(data) {
        //                 $("#message").val('')
        //                 loadmsgs(uid);
        //             },
        //             error: function(err) {
        //                 swal("Error!", "Please try again", "error");
        //             }
        //         });
        //     }
        // }

        // $(".user").on("click", function() {
        //     let uid = $(this).attr("data-id");
        //     $(".user").removeClass("current-user")
        //     $(this).addClass("current-user")
        //     usid = uid;
        //     loadmsgs(uid);
        // });

        // setTimeout(function() {
        //     usid = $("a.user").attr("data-id");
        //     if (usid) {
        //         loadmsgs(usid);
        //     }
        // }, 300);

        // setInterval(function() {
        //     if (usid) {
        //         loadmsgs(usid);
        //     }
        // }, 3000)

        // let msglen = 0;

        // function loadmsgs(uid) {
        //     let recevierImg = $(".user-img" + uid).attr("src");
        //     let recevierName = $(".user-name" + uid).text();
        //     $("#user_id").val(uid);
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{url("chef/loadmsgs")}}',
        //         data: {
        //             'uid': uid
        //         },
        //         success: function(data) {
        //             let html = "";
        //             if (data.response.length) {
        //                 let messageData = data.response;
        //                 let flag = 0;
        //                 for (let key in messageData) {
        //                     let dclass = '';
        //                     let senderImg = $(".profile-img img").attr("src");
        //                     let senderName = $(".user-name a").text();
        //                     let img = senderImg;
        //                     let nameRe = senderName;
        //                     let imgCls = '';
        //                     let time = moment(messageData[key].created_at).format("MM/DD/YYYY hh:mm A")
        //                     if (messageData[key].sender == uid) {
        //                         dclass = "darker";
        //                         img = recevierImg;
        //                         nameRe = recevierName;
        //                         imgCls = 'right';

        //                         html += `<div class="activity-row activity-row1 ${dclass}">
        //                           <div class="outer_msg_activity clearfix">
		// 								<div class="activity-img">
		// 									<img src="${img}" width='60px' height='60px' class="img-responsive ${imgCls}" alt=""><span>${time}</span>
		// 								</div>
		// 								<div class="activity-desc-sub1">
		// 									<h5>${nameRe}</h5>
		// 									<p>${messageData[key].message}</p>
		// 								</div>
		// 							</div>
		// 						</div>`;
        //                     } else {
        //                         html += `<div class="activity-row activity-row1 ${dclass}">
		// 						<div class="income_msg_activity clearfix">
		// 							<div class="activity-img">
		// 								<img src="${img}" width='60px' height='60px' class="img-responsive ${imgCls}" alt=""><span>${time}</span>
		// 							</div>
                                
        //                             <div class="activity-desc-sub">
        //                               <h5>${nameRe}</h5>
        //                               <p>${messageData[key].message}</p>
        //                             </div>
        //                          </div>
        //                         </div>`;
        //                     }

        //                     flag = messageData[key].sender;
        //                 }
        //                 $("#all-message").html(html);

        //                 if (data.response.length != msglen) {
        //                     var height = 0;
        //                     $('#all-message .activity-row').each(function(i, value) {
        //                         height += parseInt($(this).height());
        //                     });
        //                     $('#all-message').scrollTop(height + 1000);
        //                 }
        //                 msglen = data.response.length;

        //             } else {
        //                 html = "<span>No message found!</span>";
        //                 $("#all-message").html(html);
        //             }
        //             // all-message
        //             $(".msg_div").show()
        //         }
        //     });
        // }
    });
</script>
@endsection