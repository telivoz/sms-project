@extends('layouts.master')
@section('content')
<h1>Add Invoice</h1><br>
<form action="/invoices" method="POST">
  @csrf
  <div class="form-group">
    <label for="company">Company:</label>
        <select class="form-select" id="company" name="company">
 @foreach($customers as $customer)
                <option value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
@endforeach
        </select>
  </div>
  <div class="form-group">
    <input type="number" class="form-control" id="refillValue" placeholder="Enter Value" name="refillValue">
  </div>
   <div class="form-group">
    <textarea class="form-control" id="comment" placeholder="Digit Your Comments" name="comment"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/refil" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
