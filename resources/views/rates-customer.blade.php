<style>
  tbody tr:hover {
    background-color: white;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Customer Rates</h1>
@if (auth()->user()->profile == 1)
<a href="/rates-customer/add" ype="button" class="btn btn-primary">Add Rate</a>
@endif
<table class="table">
  <thead>
    <tr>
      <th>CODE</th>
      <th>DESTINATION</th>
      <th>Customer</th>
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
      <td> <?php $customer = DB::table('customers')->where('id', "$rate->company")->value('name'); echo $customer;?></td>
      <td>{{ $rate->cost }}</td>
     @if (auth()->user()->profile == 1)
	 <td>
          <a href="/rates-customer/edit/{{ $rate->id}}" class="bi bi-pencil-square"></a>
          <form action="/rates-customer/delete/{{ $rate->id }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" style="color:red;" class="bi bi-trash3"></button>
          </form>
      </td>
	@endif
    </tr>
@endforeach
  </tbody>
</table>
@endsection
