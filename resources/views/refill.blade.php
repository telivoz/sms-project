<style>
  tbody tr:hover {
    background-color: white;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Refill</h1>
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
    @foreach($customers as $customer)
      <td>{{ $customer->name }}</td>
      <td>{{ $customer->company }}</td>
      <td>{{$customer->balance}}</td>
@if (auth()->user()->profile == 1)
      <td>
          <a href="/refill/add/{{ $customer->id }}" class="fa fa-dollar"></a>
          </form>
      </td>
@endif
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
