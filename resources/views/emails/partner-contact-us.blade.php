@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi Admin</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">User has submitted details from partner page</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Name: {{@$data['f_name']}} {{@$data['l_name']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Email: {{@$data['email']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Phone Number: {{@$data['phone']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">City/State: {{@$data['location']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Short Term Rental: {{@$data['shortrental']}}</p>


@include('emails.footer')