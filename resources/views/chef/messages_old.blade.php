@extends('layouts.main')

@section('title', 'Messages')

@section('content')
<style type="text/css">
  #file-input {
    display: none;
  }

  .current-user {
    font-weight: bold;
  }
</style>

<!-- banner -->
<section class="inner-page-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title-wrap text-center">
          <h1 class="page-title-heading">Messages</h1>

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
      <div class="col-lg-9 col-md-8 p-lg-5 p-4 content">

        <section class="message-box-section pb-md-4">
          <div class="row">
            <?php

            if (sizeof($users) > 0) {

            ?>
              <div class="col-md-12 col-lg-8">
                <h3 class="title-heading-small">Direct Messages</h3>
                <div class="chat_box_grid">
                  <div id="all-message"></div>
                  <div class="message-submit-box msg_div">
                    <form enctype="multipart/form-data" id="fupForm">
                      @csrf

                      <span class="form-group comment-grid">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="text" class="form-control message-box" id="message" aria-describedby="text" name="message" placeholder="WRITE A MESSAGE" required="">
                      </span>

                      <span class="submit-message-grid"><button type="submit" name="sub"><i class="fa fa-send-o"></i></button></span>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4 user-msg-sidebar">
                <h5 class="title-heading-small">Choose User</h5>
                @foreach ($users as $user)
                <div class="user-msg-grid">
                  @if($user->profile_pic)
                  <img width="50" height="50" class="img-responsive mr-2 user-img{{$user->id}}" src="{{asset('public/uploads/profiles')}}/{{$user->profile_pic}}" onerror="this.onerror=null;this.src='{{asset('public/img/default-user.png')}}';" />
                  @else
                  <img width="50" height="50" class="img-responsive mr-2 user-img{{$user->id}}" src="{{asset('public/img/default-user.png')}}" />
                  @endif
                  <a href="javascript:void(0)" class="user user-name{{$user->id}}" data-id="{{$user->id}}">{{$user->first_name}}</a>
                </div>
                @endforeach
              </div>

              <div class="clearfix"></div>
            <?php
            } else {
              echo "<p class='no-user-msg'>No recent messages</p>";
            }
            ?>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var usid = 0;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let cuid = "{{Auth::user()->id}}";
    $.ajax({
      type: 'POST',
      url: '{{url("chef/read-msg")}}',
      data: {
        'uid': cuid
      },
      success: function(data) {
        $(".umsg").text(0);
      },
      error: function(err) {}
    });

    // $('#message').keypress(function(event){
    //     var keycode = (event.keyCode ? event.keyCode : event.which);
    //     if(keycode == '13'){
    //         sendMsg();
    //     }
    // });

    $("#fupForm").on('submit', function(e) {
      e.preventDefault();
      let uid = $("#user_id").val();
      let message = $.trim($("#message").val());
      var formData = new FormData(this);

      if (message != "") {
        formData.append('message', linkify(message));
        $.ajax({
          type: 'POST',
          processData: false,
          contentType: false,
          url: '{{url("chef/send-msg")}}',
          data: formData,
          success: function(data) {
            $("#message").val('')
            loadmsgs(uid);
          },
          error: function(err) {
            swal("Error!", "Please try again", "error");
          }

        });
      }

    });

    // $("#send_msg").on("click", function(e) {
    //     e.preventDefault();
    //     sendMsg();
    // });

    function linkify(inputText) {
      var replacedText, replacePattern1, replacePattern2, replacePattern3;

      //URLs starting with http://, https://, or ftp://
      replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
      replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

      //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
      replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
      replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

      //Change email addresses to mailto:: links.
      replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
      replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

      return replacedText;
    }

    function sendMsg() {
      let uid = $("#user_id").val();
      let message = $.trim($("#message").val());

      if (message != "") {
        $.ajax({
          type: 'POST',
          url: '{{url("chef/send-msg")}}',
          data: {
            'uid': uid,
            'message': linkify(message)
          },
          success: function(data) {
            $("#message").val('')
            loadmsgs(uid);
          },
          error: function(err) {
            swal("Error!", "Please try again", "error");
          }
        });
      }
    }

    $(".user").on("click", function() {
      let uid = $(this).attr("data-id");
      $(".user").removeClass("current-user")
      $(this).addClass("current-user")
      usid = uid;
      loadmsgs(uid);
    });

    setTimeout(function() {
      usid = $("a.user").attr("data-id");
      if (usid) {
        loadmsgs(usid);
      }
    }, 300);

    setInterval(function() {
      if (usid) {
        loadmsgs(usid);
      }
    }, 3000)

    let msglen = 0;

    function loadmsgs(uid) {
      let recevierImg = $(".user-img" + uid).attr("src");
      let recevierName = $(".user-name" + uid).text();
      $("#user_id").val(uid);
      $.ajax({
        type: 'POST',
        url: '{{url("chef/loadmsgs")}}',
        data: {
          'uid': uid
        },
        success: function(data) {
          let html = "";
          if (data.response.length) {
            let messageData = data.response;
            let flag = 0;
            for (let key in messageData) {
              let dclass = '';
              let senderImg = $(".profile-img img").attr("src");
              let senderName = $(".user-name a").text();
              let img = senderImg;
              let nameRe = senderName;
              let imgCls = '';
              let time = moment(messageData[key].created_at).format("MM/DD/YYYY hh:mm A")
              if (messageData[key].sender == uid) {
                dclass = "darker";
                img = recevierImg;
                nameRe = recevierName;
                imgCls = 'right';

                html += `<div class="activity-row activity-row1 ${dclass}">
                                  <div class="outer_msg_activity clearfix">
										<div class="activity-img">
											<img src="${img}" width='60px' height='60px' class="img-responsive ${imgCls}" alt=""><span>${time}</span>
										</div>
										<div class="activity-desc-sub1">
											<h5>${nameRe}</h5>
											<p>${messageData[key].message}</p>
										</div>
									</div>
								</div>`;
              } else {
                html += `<div class="activity-row activity-row1 ${dclass}">
								<div class="income_msg_activity clearfix">
									<div class="activity-img">
										<img src="${img}" width='60px' height='60px' class="img-responsive ${imgCls}" alt=""><span>${time}</span>
									</div>
                                
                                    <div class="activity-desc-sub">
                                      <h5>${nameRe}</h5>
                                      <p>${messageData[key].message}</p>
                                    </div>
                                 </div>
                                </div>`;
              }

              flag = messageData[key].sender;
            }
            $("#all-message").html(html);

            if (data.response.length != msglen) {
              var height = 0;
              $('#all-message .activity-row').each(function(i, value) {
                height += parseInt($(this).height());
              });
              $('#all-message').scrollTop(height + 1000);
            }
            msglen = data.response.length;

          } else {
            html = "<span>No message found!</span>";
            $("#all-message").html(html);
          }
          // all-message
          $(".msg_div").show()
        }
      });
    }
  });
</script>
@endsection

@endsection