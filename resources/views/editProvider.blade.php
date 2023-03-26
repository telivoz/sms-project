@extends('layouts.master')
@section('content')
<h1>Edit Provider</h1>
<form action="/provider/update/{{ $providers->id }}" method="POST">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input required type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $providers->name }}">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password" value="">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input required type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email" value="{{ $providers->email }}">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input required type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ $providers->address }}">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input required type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{ $providers->phone }}">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input required type="text" class="form-control" id="company" placeholder="Enter Company" name="company" value="{{ $providers->company }}">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/provider" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
