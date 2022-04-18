@extends('layouts.master')
@section('content')
<h1>Edit Customer</h1>
@foreach($customers as $customer)
<form action="/customer/update/{{ $customer->id }}" method="POST">
@method('PUT')
  @csrf
  <div class="form-group">
    <label for="uid">UID:</label>
    <input type="text" class="form-control" id="uid" placeholder="Enter UID" name="uid" value="{{ $customer->uid }}">
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $customer->name }}">
  </div> 
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email" value="{{ $customer->email }}">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ $customer->address }}">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{ $customer->phone }}">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input type="text" class="form-control" id="company" placeholder="Enter Company" name="company" value="{{ $customer->company }}">
  </div>  
  <div class="form-group">
    <label for="pwd">Profile:</label>
    <select class="form-control" id="profile" name="profile">
      <option value="3" {{ ($customer->profile) == 3 ? "selected" : "" }}>Customer</option>
      <option value="2" {{ ($customer->profile) == 2 ? "selected" : "" }}>NOC</option>
      <option value="1" {{ ($customer->profile) == 1 ? "selected" : "" }}>Adminstrator</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endforeach
@endsection