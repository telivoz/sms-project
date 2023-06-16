<style>
  tbody tr:hover {
    background-color: white;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Providers Rates</h1>
<a href="/rates-provider/add" ype="button" class="btn btn-primary">Add Rate</a>
<table class="table">
  <thead>
    <tr>
      <th>CODE</th>
      <th>DESTINATION</th>
      <th>PROVIDER/CONNECTOR</th>
      <th>COST</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach($rates as $rate)
<tr>
      <td>{{ $rate->code }}</td>
      <td>{{ $rate->destination }}</td>
      <td><?php $idProvider = DB::table('connectors')->where('name', "$rate->company")->value('provider'); $providerName = DB::table('providers')->where('id',$idProvider)->value('name'); echo$providerName;?> / {{ $rate->company }}</td>
      <td>{{ $rate->cost }}</td>
      <td>
          <a href="/rates-provider/edit/{{ $rate->id }}" class="bi bi-pencil-square"></a>
          <form action="/rates-provider/delete/{{ $rate->id }}" method="POST">
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
