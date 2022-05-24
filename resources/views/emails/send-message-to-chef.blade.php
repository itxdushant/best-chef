@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$data['chef_name']}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">You have Message from {{@$data['name']}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Message:{{@$data['message']}} </p>



@include('emails.footer')