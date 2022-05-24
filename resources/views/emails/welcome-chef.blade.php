@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{$user->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Thank you so much for joining the Best Local Chef team! Our mission is to get you booked as many jobs as you’d like, doing what you love and are great at - being a chef.</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">We’re currently reviewing your information for approval. You’ll be notified by email if you’re approved. If you do not hear back from us within 48 hours, please contact support at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a>.</p>
@include('emails.footer')