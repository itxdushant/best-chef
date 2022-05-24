@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">A customer has paid a chef. <a href="https://bestlocalchef.com/login">Login</a> to review the booking.</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Below are the booking details. </p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">
    
    Meal Requested: {{$price_data['menu_name']}}<br>
    Number Of Guests: {{$order->guests}}<br>
    Meal Cost: ${{ $price_data['menu_cost'] * $order->guests }}<br>
                      
                      
    @foreach($menus_desserts as $key => $dessert)
     Dessert Requested {{$key+1}}: {{$dessert->name}}<br>
    @endforeach
    Number Of Guest: {{$order->dessert_guests}}<br>
    Dessert Cost: ${{$price_data['desserts_cost']}}<br>
    
     @foreach($menus_appetizers as $key => $appetizer)
      Appetizer Requested {{$key+1}}: {{$appetizer->name}}<br>
    @endforeach

    Number Of Guest: {{$order->appetizer_guests}}<br>
    Appetizer Cost: ${{$price_data['appetizers_cost']}}<br>
    
     @foreach($menus_sides as $key => $side)
      Side Requested {{$key+1}}: {{$side->name}}<br>
    @endforeach
    Number Of Guest: {{$order->side_guests}}<br>
    Side Cost: ${{$price_data['sides_cost']}}<br>
    
    
	Booking price: ${{$order->price}} <br>
	Booking Date: {{$order->booking_date}} <br>
	Booking Time: {{$order->booking_time}} <br>
	Location: {{$order->location}} <br>
	Notes: {{$order->notes}}
</p>


@include('emails.footer')