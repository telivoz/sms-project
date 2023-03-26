@extends('layouts.master')
@section('content')
<h1>Add Provider Rate</h1>
<form action="/rates-provider" method="POST">
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
    <label for="company">Connector / Provider:</label><br>
	        <select class="form-select" id="company" name="company">
        @foreach($providers as $provider)
	<option value="{{ $provider->name }}">{{ $provider->name }} - <?php $providerName = DB::table('providers')->where('id', "$provider->provider")->value('name'); echo $providerName; ?><option>
        @endforeach
        </select>  
</div>
  <div class="form-group">
    <label for="cost">COST:</label>
    <input required class="form-control" id="cost" placeholder="Enter Cost Value" name="cost">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/rates-customer" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
