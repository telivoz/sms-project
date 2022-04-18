@extends('layouts.master')
@section('content')
<h1>Add Connector</h1>
<form action="/connector" method="POST">
  @csrf
  <div class="form-group">
    <label for="cid">CID:</label>
    <input type="text" class="form-control" id="cid" placeholder="Enter CID NAME" name="cid">
  </div>
  <div class="form-group">
    <label for="host">Host:</label>
    <input type="text" class="form-control" id="host" placeholder="Enter Host" name="host">
  </div>
  <div class="form-group">
    <label for="port">Port:</label>
    <input type="text" class="form-control" id="port" placeholder="Enter Port" name="port">
  </div>
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/connector" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection