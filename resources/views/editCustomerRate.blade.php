@extends('layouts.master')
@section('content')
<h1>Edit Customer</h1>
<form action="/rates-customer/update/{{ $rate->id }}" method="POST">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="code">CODE:</label>
    <input type="text" class="form-control" id="code" placeholder="Enter code number" name="code" value="{{ $rate->code }}">
  </div>
  <div class="form-group">
    <label for="destination">DESTINATION:</label>
    <input type="text" class="form-control" id="destination" placeholder="Enter Destination name" name="destination" value="{{ $rate->destination }}">
  </div>
  <div class="form-group">
    <label for="company">COMPANY UID:</label>
        <select class="form-select" id="company" name="company">
@foreach($customers as $customer)
                <option value="<?php echo $customer->id?>"><?php echo $customer->name . "-" .$customer->uid?></option>
@endforeach
        </select>
        <script>
                document.getElementById("company").value = {{ $rate->company }};
        </script>
  </div>
  <div class="form-group">
    <label for="cost">COST:</label>
    <input type="text" class="form-control" id="cost" placeholder="Enter Cost Value" name="cost" value="{{ $rate->cost }}">
  </div>
<button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/rates-customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
