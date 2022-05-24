@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Please click the button below to verify your email address. <br> <br> <a href="{{$url}}" style="font-family:'-apple-system', BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';color:#FFF;text-decoration:none;background-color:#3490DC;border-top:10px solid #3490DC;border-right:18px solid #3490DC;border-bottom:10px solid #3490DC;border-left:18px solid #3490DC;">Verify Email Address</a> 
</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">If you did not create an account, no further action is required.</p>

<p style="color:#3d4852;font-size: 10px;line-height:1.5em;">If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {{$url}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')