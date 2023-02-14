@extends('layouts.master')
@section('content')
<h1>Edit Customer</h1>
<form action="/customer/update/{{ $customers->id }}" method="POST">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="uid">UID:</label>
    <input type="text" class="form-control" id="uid" placeholder="Enter User to send SMS" name="uid" value="{{ $customers->uid }}">
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $customers->name }}">
  </div> 
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email" value="{{ $customers->email }}">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ $customers->address }}">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{ $customers->phone }}">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input type="text" class="form-control" id="company" placeholder="Enter Company" name="company" value="{{ $customers->company }}">
  </div>  
  <div class="form-group">
    <label for="pwd">Profile:</label>
    <select class="form-control" id="profile" name="profile">
      <option value="3" {{ ($customers->profile) == 3 ? "selected" : "" }}>Customer</option>
      <option value="2" {{ ($customers->profile) == 2 ? "selected" : "" }}>NOC</option>
      <option value="1" {{ ($customers->profile) == 1 ? "selected" : "" }}>Adminstrator</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
