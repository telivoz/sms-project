<style>
  tbody tr:hover {
    background-color: #5f94cb;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Customer Rates</h1>
<a href="/rates-customer/add" ype="button" class="btn btn-primary">Add Rate</a>
<table class="table">
  <thead>
    <tr>
      <th>CODE</th>
      <th>DESTINATION</th>
      <th>Company</th>
      <th>COST</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
<tr>
@foreach($rates as $rate)
<tr>
      <td>{{ $rate->code }}</td>
      <td>{{ $rate->destination }}</td>
      <td>{{ $rate->company }}</td>
      <td>{{ $rate->cost }}</td>
      <td>
          <a href="/rates-customer/edit/" class="bi bi-pencil-square"></a>
          <form action="/rates-customer/delete/" method="POST">
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
