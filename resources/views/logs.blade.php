<style>
  tbody tr:hover {
    background-color: white;
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
  @if ($file == '.')
  @elseif ($file == '..')
  @else
	<tr><td>{{ $file }} <td>
	<a href="logging/{{$file}}">Downloads</a>
	@endif
@endforeach
</table>
@endsection
