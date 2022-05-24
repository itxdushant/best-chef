@extends('layouts.admin')

@section('title', 'Booking')

@section('content')

<div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
     Booking</div>
    <div class="card-body">
      <div class="table-responsive">
       
        <table class="table table-bordered" width="100%" cellspacing="0">
          <tbody>
            <tr>
              <td>Booked Date</td>
              <td><?php
                    $date2 = date_create($booking->booking_date);
                    echo date_format($date2, "m/d/Y"); ?>   
              </td>
            </tr>

            <tr>
              <td>Meal Name</td>
              <td>{{$booking->name}}</td>
            </tr>

            <tr>
              <td>Price</td>
              <td>${{$booking->price}}</td>
            </tr>  
            <!--<tr>-->
            <!--  <td>Meal Ingredients</td>-->
            <!--  <td>{{$booking->ingredients}}</td>-->
            <!--</tr>  -->
            <!--<tr>-->
            <!--  <td>Meal Description</td>-->
            <!--  <td>{{$booking->description}}</td>-->
            <!--</tr>  -->
            <tr>
              <td>Desserts Requested</td>
              <td> 
                @foreach($menu_desserts as $key => $dessert)
                 {{@$dessert->name}}
                @endforeach
              </td>
            </tr>  
            <tr>
              <td>No. Of Guests</td>
              <td> 
                {{$booking->dessert_guests}}
              </td>
            </tr> 
            <tr>
              <td>Desserts Cost</td>
              <td> 
                {{$price_data['desserts_cost']}}
              </td>
            </tr> 
            <tr>
              <td>Appetizers Requested</td>
              <td>
                @foreach($menu_appetizers as $key => $appetizer)
                 {{@$appetizer->name}}
                @endforeach
              </td>
            </tr>
              <tr>
              <td>No. Of Guests</td>
              <td> 
                {{$booking->appetizer_guests}}
              </td>
            </tr>  
             <tr>
              <td>Appetizers Cost</td>
              <td> 
                {{$price_data['appetizers_cost']}}
              </td>
            </tr> 
            <tr>
              <td>Status</td>
              <td>{{strtoupper($booking->completed)}}</td>
            </tr>  
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>

@endsection
