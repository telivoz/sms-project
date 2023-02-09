@extends('layouts.master')
@section('content')
<h1>Add Provider Rate</h1>
<form action="/rates-customer" method="POST">
  @csrf
  <div class="form-group">
    <label for="code">CODE:</label>
    <input type="text" class="form-control" id="code" placeholder="Enter code number" name="code">
  </div>
  <div class="form-group">
    <label for="destination">DESTINATION:</label>
    <input type="text" class="form-control" id="destination" placeholder="Enter Destination name" name="destination">
  </div>
  <div class="form-group">
    <label for="company">COMPANY:</label>
    <input type="text" class="form-control" id="company" placeholder="" name="company">
  </div>
  <div class="form-group">
    <label for="cost">COST:</label>
    <input type="number" step="0.000" class="form-control" id="cost" placeholder="Enter Cost Value" name="cost">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/rates-customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection