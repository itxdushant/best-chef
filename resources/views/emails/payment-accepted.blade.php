@include('emails.header')
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$chef->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">The customer has released your payment and you’ve been paid. Your payment will be released on the weekly chef pay period, and should show in your bank account within 2-5 days, depending on your financial institution.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the Payment details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	Amount: ${{$price}} <br>
</p>


<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')