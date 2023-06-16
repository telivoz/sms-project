@extends('layouts.master')
@section('content')
<h1>Add Refill<h1>
<form action="/refil/update/{{$id}}" method="POST">
  @csrf
<h2 name="id" value="{{$id}}" id="id"><?php $customer = DB::table('customers')->where('id', "$id")->value('name'); echo $customer?> </h2>
  <div class="form-group">
    <input type="text" class="form-control" id="refillValue" placeholder="Enter Value" name="refillValue">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/refil" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
