@extends('layouts.main')
@section('content')
<!-- banner -->
<section class="inner-page-banner">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="page-title-wrap text-center">
               <h1 class="page-title-heading">Thank you</h1>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- //banner -->   
<div class="content-wrap thankspage">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-lg-8 offset-lg-2 offset-md-2 mt-5">
            <!--<table id="cart" class="table table-hover table-condensed">-->
            <h3 class="alert p-0">You have successfully booked your chef.</h3>
            <table id="cart" class="table table-hover table-condensed">
               <thead>
                  <tr>
                     <th>Meal</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td data-th="Meal">
                        <div class="product-checkout-info">
                           <h5 class="nomargin">{{$order->name}}</h5>
                           <!--<h6 class="nomargin">{{$order->ingredients}}</h4>-->
                           <p style="display:none">Location: <strong>{{$order->location}}</strong></p>
                        </div>
                     </td>
                     <td data-th="Price" class="">  ${{ $order->cost }} * {{ $order->guests }}(guests) =  ${{ $order->cost * $order->guests }}</td>
                  </tr>
                  <?php   $totalprice = $order->cost * $order->guests; ?>
               </tbody>
            </table>
            <table id="cart" class="table table-hover table-condensed">
               <?php foreach($desserts as $key => $value){?>
               <thead>
                  <tr>
                     <th>Desserts</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td data-th="Desserts">
                        <div class="product-checkout-info">
                           <h5 class="nomargin">{{$value->name}}</h5>
                           <!--<h6 class="nomargin">{{$value->ingredients}}</h4>-->
                           <p style="display:none">Location: <strong>{{$value->cost}}</strong></p>
                        </div>
                     </td>
                     <td data-th="Price" class=""> ${{ $value->cost}} * {{ $order->dessert_guests }}(guests) =  ${{ $value->cost * $order->dessert_guests }}</td>
                  </tr>
                  <?php $totalprice = $totalprice + ($value->cost * $order->dessert_guests); }  ?>
               </tbody>
            </table>
            <table id="cart" class="table table-hover table-condensed">
               <?php foreach($appetizers as $key => $value){ ?>
               <thead>
                  <tr>
                     <th>Appetizers</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td data-th="Appetizers">
                        <div class="product-checkout-info">
                           <h5 class="nomargin">{{$value->name}}</h5>
                           <!--<h6 class="nomargin">{{$value->ingredients}}</h4>-->
                           <p style="display:none">Location: <strong>{{$value->location}}</strong></p>
                        </div>
                     </td>
                     <td data-th="Price" class=""> ${{ $value->cost}} * {{ $order->appetizer_guests }}(guests) =  ${{ $value->cost * $order->appetizer_guests }}</td>
                  </tr>
                  <?php  $totalprice = $totalprice + ($value->cost * $order->appetizer_guests); }  ?>
               </tbody>
            </table>
            <table id="cart" class="table table-hover table-condensed">
               <?php foreach($sides as $key => $value){ ?>
               <thead>
                  <tr>
                     <th>Sides</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td data-th="Sides">
                        <div class="product-checkout-info">
                           <h5 class="nomargin">{{$value->name}}</h5>
                           <!--<h6 class="nomargin">{{$value->ingredients}}</h4>-->
                           <p style="display:none">Location: <strong>{{$value->location}}</strong></p>
                        </div>
                     </td>
                     <td data-th="Price" class=""> ${{ $value->cost}} * {{ $order->side_guests }}(guests) =  ${{ $value->cost * $order->side_guests }}</td>
                  </tr>

                  <?php  $totalprice = $totalprice + ($value->cost * $order->side_guests); }  ?>

  </tbody>
            </table>

                   <table id="cart" class="table table-hover subpaget">

                  <?php  $sales_tax = round((($totalprice) * env('SALES_TAX')) / 100, 2); 
                     $service_tax = number_format((float) (($totalprice) * env('SERVICE_TAX') / 100) , 2, '.', '');
                     ?>
                  <tr>
                     <?php
                        $da = date_create($order->booking_date);
                        $df = date_format($da,"m/d/Y");
                        ?>
                     <td>
                        <p>Booking Date: <strong>{{$df}}</strong></p>
                     </td>
                     <td>
                        <p>Booking Time: <strong>{{$order->booking_time}}</strong></p>
                     </td>
                     <td>
                        <p>Guests: <strong>{{$order->guests}}</strong></p>
                     </td>                   
                  </tr>
               
           
            </table>

            
            <table id="cart" class="table table-hover subpaget">
               <tbody>
                  <tr>
                     <td>Service Tax: (<?php echo env('SERVICE_TAX'); ?>%)</td>
                     <td>$<strong><?php echo $service_tax; ?></td>
                  </tr>
                  <tr>
                     <td>Sales Tax: (<?php echo env('SALES_TAX'); ?>%)</td>
                     <td>$<strong><?php echo $sales_tax; ?></td>
                  </tr>
                  <tr>
                     <td>Total Price:</td>
                     <td>$<strong>{{$order->price}}</td>
                  </tr>
               </tbody>
            </table>
            <div class="row">
               <div class="col-md-8 col-lg-8 offset-lg-2 offset-md-2 text-center py-4">
                  Need Help?
                  <a href="{{route('contact-us')}}">Contact Us</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection