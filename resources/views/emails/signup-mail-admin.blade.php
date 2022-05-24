@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">You have a new user request to join Best Local Chef. <a href="https://bestlocalchef.com/login">Login</a> to review their information</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
	<p>User Name: {{@$user->first_name}} {{@$user->last_name}}</p>
	<p>User Email ID: {{@$user->email}}</p>
</p>


@include('emails.footer')