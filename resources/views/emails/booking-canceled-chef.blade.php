@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{$chef->first_name}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Your booking has been canceled by {{ $user->first_name }}.</p>


@include('emails.footer')