@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{$user->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Your next job is booked! Here’s what you need to do:  </p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">1) Add this date to your calendar from the Active Requests section under Requests, on your account</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">2) Make sure you get any additional details from the customer by using the Messaging in your account. </p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">3) Be certain that you’re fully prepared with fresh food, seasonings, and any other materials you’ll need to complete your meal. </p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">4) Leave early enough to make it to your destination on time.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>

@include('emails.footer')