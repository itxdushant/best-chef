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
              <td>Graduate Year</td>
              <td>{{$user->graduate_year}}</td>
            </tr>
            <tr>
              <td>Years Experience</td>
              <td>{{$user->experience}}</td>
            </tr>
            <tr>
              <td>Location</td>
              <td>{{$user->experience}}</td>
            </tr>
            <tr>
              <td>Service Area by Zip</td>
              <td>{{$user->service_area}}</td>
            </tr>
            <tr>
              <td>Miles Away</td>
              <td>{{$user->miles_away}}</td>
            </tr>
            <tr>
              <td>Available Dates/Times</td>
              <td>{{$user->available_dates}}</td>
            </tr>
            

            
            
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>

@endsection
