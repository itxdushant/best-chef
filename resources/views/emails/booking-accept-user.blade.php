@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{$user->first_name}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Your chef request has been accepted. Here’s what you need to do next: </p>
<ul style="color:#3d4852;font-size: 16px;line-height: 1.5em;list-style:none">
<li style="color:#3d4852;font-size: 16px;line-height: 1.5em;list-style:none">1) Add this date to your calendar from the Active Requests section under Requests, on your account.</li>
<li style="color:#3d4852;font-size: 16px;line-height: 1.5em;list-style:none">2) Make sure you communicate any additional details to the chef by using the Messaging in your account. </li>
<li style="color:#3d4852;font-size: 16px;line-height: 1.5em;list-style:none">3) Once your chef has came and completed the service, release payment from your account, and leave a review. </li>
</ul>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')