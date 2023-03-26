@extends('layouts.master')
@section('content')
<h1>Edit Provider Rate</h1>
<form action="/rates-provider/update/{{ $rate->id }}" method="POST">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="code">CODE:</label>
    <input required type="text" class="form-control" id="code" placeholder="Enter code number" name="code" value="{{ $rate->code }}">
  </div>
  <div class="form-group">
    <label for="destination">DESTINATION:</label>
    <input required type="text" class="form-control" id="destination" placeholder="Enter Destination name" name="destination" value="{{ $rate->destination}}">
  </div>
  <div class="form-group">
    <label for="company">Connector / Provider:</label><br>
	        <select class="form-select" id="company" name="company">
	@foreach($connectors as $provider)
	<option value="{{ $provider->name }}">{{ $provider->name }} - <?php $providerName = DB::table('providers')->where('id', "$provider->provider")->value('name'); echo $providerName; ?></option>
        @endforeach
	</select>  
	<script>
document.getElementById("company").value = '{{ $rate->company }}';
        </script>
</div>
  <div class="form-group">
    <label for="cost">COST:</label>
    <input required class="form-control" id="cost" placeholder="Enter Cost Value" name="cost" value="{{ $rate->cost }}">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/rates-provider" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
