@include('emails.header')
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$chef->first_name}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">A recent customer has left you a new rating and review on Menu: {{@$menu->name}}. Please login to your account to view it. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')