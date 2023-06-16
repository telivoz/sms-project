<style>
  tbody tr:hover {
    background-color: white;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Firewall</h1>
<a href="/firewall/add" ype="button" class="btn btn-primary">Add Rule</a>
<table class="table">
  <thead>
    <tr>
      <th>Description</th>
      <th>IP/NET</th>
      <th>Rule</th>
       <th>Port</th>
    </tr>
  </thead>
  <tbody>
    @foreach($rules as $customer)
    <tr>
      <td>{{ $customer->identify }}</td>
      <td>{{ $customer->ip }}</td>
      @if ($customer->rule == 'true')
      <td>ACCEPT</td>
      	@else
      	<td>REJECT</td>
	@endif
	<td>{{ $customer->port }}</td>
      <td>
          <form action="/firewall/delete/{{ $customer->id }}" method="POST">
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
