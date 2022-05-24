@extends('layouts.admin')

@section('title', 'User')

@section('content')

<div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
       {{$user->name}}</div>
    <div class="card-body">
      <div class="table-responsive">
        <p>
          <img width="150" height="150" src="{{asset('public/uploads/profiles')}}/{{$user->profile_pic}}"class="img-fluid" />
        </p>
        <table class="table table-bordered" width="100%" cellspacing="0">
          <tbody>
            <tr>
              <td>Email</td>
              <td>{{$user->email}}</td>
            </tr>

            <tr>
              <td>First Name</td>
              <td>{{$user->first_name}}</td>
            </tr>

            <tr>
              <td>Last Name</td>
              <td>{{$user->last_name}}</td>
            </tr>

            <tr>
              <td>Phone Number</td>
              <td>{{$user->phone_number}}</td>
            </tr>

            <tr>
              <td>City</td>
              <td>{{$user->city}}</td>
            </tr>
            <tr>
              <td>State</td>
              <td>{{$user->state}}</td>
            </tr>
            <tr>
              <td>Zip</td>
              <td>{{$user->zip}}</td>
            </tr>
            
            <tr>
              <td>Address</td>
              <td>{{$user->address}}</td>
            </tr>            
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>

@endsection
