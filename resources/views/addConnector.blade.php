@extends('layouts.master')
@section('content')
<h1>Add Connector</h1>
<form action="/connector" method="POST">
  @csrf
  <div class="form-group">
    <label for="cid">CID:</label>
    <input required type="text" class="form-control" id="cid" placeholder="Enter CID NAME" name="cid">
  </div>
  <div class="form-group">
    <label for="host">Host:</label>
    <input required type="text" class="form-control" id="host" placeholder="Enter Host" name="host">
  </div>
  <div class="form-group">
    <label for="port">Port:</label>
    <input required type="text" class="form-control" id="port" placeholder="Enter Port" name="port">
  </div>
  <div class="form-group">
    <label for="username">Username:</label>
    <input required type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input required type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
    <div class="form-group">
    <label for="pwd">Provider:</label>
	<select required class="form-select" id="provider" name="provider">
	@foreach($providers as $provider)
		<option value="{{ $provider->id }}">{{ $provider->name }}<option>
	@endforeach
	</select>
  </div>
  <div class="form-group">
    <label for="pwd">TPS:</label>
    <input required type="number" class="form-control" id="tps" placeholder="Throughput Per Second" name="tps">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/connector" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
