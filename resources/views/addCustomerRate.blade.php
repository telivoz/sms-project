@extends('layouts.master')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<h1>Add Customer Rate</h1>
<form action="/rates-customer" method="POST">
  @csrf
  <div class="form-group">
    <label for="code">CODE:</label>
    <input required type="text" class="form-control" id="code" placeholder="Enter code number" name="code">
  </div>
  <div class="form-group">
    <label for="destination">DESTINATION:</label>
    <input required type="text" class="form-control" id="destination" placeholder="Enter Destination name" name="destination">
  </div>
  <div class="form-group">
    <label for="company">COMPANY UID:</label>
	<select class="form-select" id="company" name="company" placeholder="Pick a Customer">
	<option value="">Select a Customer...</option>
 @foreach($customers as $customer) 
		<option value="<?php echo $customer->id?>"><?php echo $customer->name . "-" .$customer->uid?></option>
@endforeach
    	</select>
  </div>
  <div class="form-group">
    <label for="cost">COST:</label>
    <input required type="text" class="form-control" id="cost" placeholder="Enter Cost Value" name="cost">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/rates-customer" ype="button" class="btn btn-default">Cancel</a>
</form>
<script>
$(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
@endsection
