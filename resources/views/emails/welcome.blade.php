@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{$user->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Thank you for signing up to use our services at Best Local Chef. If you haven’t already, <a href="https://bestlocalchef.com/find-a-chef">click here</a> to get started on finding a best local chef near you, to come and prepare a healthy home cooked meal.
</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')