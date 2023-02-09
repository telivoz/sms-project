<style>
  tbody tr:hover {
    background-color: #5f94cb;
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
      <td>
          <a href="/refill/add/{{ $customer->id }}" class="fa fa-dollar"></a>
          </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection