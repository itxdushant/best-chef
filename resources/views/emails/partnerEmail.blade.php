@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi Admin</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">User has submitted details from Contact us page</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Name: {{@$data['first_name']}} {{@$data['last_name']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Email: {{@$data['email']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Reason: {{@$data['reason']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Message: {{@$data['message']}}</p>


@include('emails.footer')