@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$chef->first_name}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Congratulations, you’ve received a booking request. </p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the booking details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	<?php $date2 = date_create($order->booking_date); ?>
	Booking Date: {{@date_format($date2,"m/d/Y")}} <br>
	Booking Time: {{$order->booking_time}} <br>
	No. of Guests: {{$order->guests}} <br>
	Location: {{$order->location}} <br>
	Notes: {{$order->notes}}
</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Please <a  href="https://bestlocalchef.com/login">login</a> to your account, go to your requests page, review the customer information and accept or decline.</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')