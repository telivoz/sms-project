<style>
tbody tr:hover {
  background-color: #5f94cb;
  color: black;
}
</style>
@extends('layouts.master')
@section('content')
<h1>Connectores</h1>
<a href="/connector/add" ype="button" class="btn btn-primary">Add Connnector</a>
<table class="table">
  <thead>
    <tr>      
      <th>NAME</th>          
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($connectores as $connector)      
  @if ($connector != "")
	<tr><td>{{$connector}}</td>
	<td>
	  <a href="/connector/edit/{{ $connector }}" class="bi bi-pencil-square"></a>
	  <form action="/connector/delete/{{  $connector }}" method="POST">
	  @csrf
	  @method('delete')
	  <button type="submit" style="color:red;" class="bi bi-trash3"></button>
	  </form>          
	</td>
      </tr>
    @endif
    @endforeach
  </tbody>
</table>
@endsection
