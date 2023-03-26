@extends('layouts.master')
@section('content')
<h1>Add Provider</h1>
<form action="/provider" method="POST">
  @csrf
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input required type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input required type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input required type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input required type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input required type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input required type="text" class="form-control" id="company" placeholder="Enter Company" name="company">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/provider" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
