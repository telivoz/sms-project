<style>
tbody tr:hover {
  background-color: white;
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
      <td><a href="/provider/edit/{{ $provider->id }}" class="bi bi-pencil-square"></a>
	<form action="/provider/delete/{{ $provider->id }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" style="color:red;" class="bi bi-trash3"></button>
          </form>
	</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
