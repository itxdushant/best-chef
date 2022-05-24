@include('emails.header')
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hello Admin,</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">You’ve completed the payment to the chef. <a href="https://bestlocalchef.com/login">Login</a> to review </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the Payment details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	Amount: ${{$price}} <br>
</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')