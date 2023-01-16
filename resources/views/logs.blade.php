<style>
  tbody tr:hover {
    background-color: #5f94cb;
    color: black;
  }
</style>
@extends('layouts.master')
@section('content')
<h1>Logs</h1>
<table class="table">
  <thead>
    <tr>
      <th>File</th>
      <th>Download</th>
    </tr>
  </thead>
  <tbody>
@foreach ($files as $file)
	<tr><td>{{ $file }} <td>
	<a href="logging/{{$file}}">Donwload</a>
@endforeach
</table>
@endsection
