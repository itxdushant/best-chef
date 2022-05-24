@include('emails.header')
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$chef->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Your request to release payment has been sent to Best Local Chef Team.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the Payment details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	Amount: ${{$price}} <br>
</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">You will be notified once Best Local Chef Team approves your request.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')