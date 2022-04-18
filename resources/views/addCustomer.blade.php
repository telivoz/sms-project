@extends('layouts.master')
@section('content')
<h1>Add Customer</h1>
<form action="/customer" method="POST">
  @csrf
  <div class="form-group">
    <label for="uid">UID:</label>
    <input type="text" class="form-control" id="uid" placeholder="Enter UID" name="uid">
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input type="text" class="form-control" id="company" placeholder="Enter Company" name="company">
  </div>  
  <div class="form-group">
    <label for="pwd">Profile:</label>
    <select class="form-control" id="profile" name="profile">
      <option value="3">Customer</option>
      <option value="2">NOC</option>
      <option value="1">Adminstrator</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection