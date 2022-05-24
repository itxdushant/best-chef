@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">A new customer has just booked a chef. <a href="https://bestlocalchef.com/login">Login</a> to review the booking.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the booking details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	<?php $date2 = date_create($order->booking_date); ?>
	Booking Date: {{@date_format($date2,"m/d/Y")}} <br>
	Booking Time: {{$order->booking_time}} <br>
	No. of Guests: {{$order->guests}} <br>
	Location: {{$order->location}} <br>
	Notes: {{$order->notes}}
</p>

@include('emails.footer')