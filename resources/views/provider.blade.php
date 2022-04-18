<style>
tbody tr:hover {
  background-color: #5f94cb;
  color: black;
}
</style>
@extends('layouts.master')
@section('content')
<h1>Provider</h1>
<a href="/provider/add" ype="button" class="btn btn-primary">Add Provider</a>
<table class="table">
  <thead>
    <tr>      
      <th>NAME</th>
      <th>Company</th>      
      <th>Balance $</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($providers as $provider)
    <tr>     
      <td>{{ $provider->name }}</td>
      <td>{{ $provider->company }}</td>     
      <td>{{$provider->balance}}</td>
      <td><a href="/provider/edit" class="bi bi-pencil-square"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/provider/delete" style="color:red;" class="bi bi-trash3"></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection