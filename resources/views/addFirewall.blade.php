<style>
  tbody tr:hover {
    background-color: #5f94cb;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Add Rule</h1>
<form action="/firewall/add" method="POST">
  @csrf
  <div class="form-group">
    <label for="desc">Description:</label>
    <input type="text" class="form-control" id="desc" placeholder="Description of Rule" name="desc" >
  </div>
  <div class="form-group">
    <label for="type">Type:</label>
    <select class="form-select" id="type" name="type">
      <option value="1">ACCEPT</option>
      <option value="0">REJECT</option>
    </select> 
  </div>
  <div class="form-group">
    <label for="parameter">IP:</label>
    <input type="text" class="form-control" id="ip" placeholder="Enter IP" name="ip" >
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/firewall" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
