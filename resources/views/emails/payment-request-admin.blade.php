@include('emails.header')
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$chef->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;"> A chef has requested to withdraw their payment. <a href="https://bestlocalchef.com/login">Login</a> to review the request.
</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the Payment details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	Amount: ${{$price}} <br>
</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')