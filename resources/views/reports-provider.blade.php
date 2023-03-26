<style>
tbody tr:hover {
  background-color: white;
  color: black;
}
</style>
@extends('layouts.master')
@section('content')
<h1>Reports</h1>
<table class="table">
  <thead>
    <tr>
      <th>User</th>
      <th>MSG ID</th>
      <th>connector</th>
      <th>Source Address</th>
      <th>Destination Address</th>
      <th>Message</th>
      <th>status</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reports as $report)
    <tr>
      <td>{{ $report->uid }}</td>
      <td><a href="/details/{{ $report->msgid }}" target="_blank">{{ $report->msgid }}</a></td>
      <td>{{ $report->source_connector }}</td>
      <td>{{ $report->source_addr }}</td>
      <td>{{ $report->destination_addr }}</td>
      <td>{{ $report->short_message }}</td>
      <td>{{ $report->status }}</td>
      <td><a href="/details/{{ $report->msgid }}" class="bi bi-info"></td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
  {!! $reports->links() !!}
</div>
<center><a>{{ $reports->count() }} of {{ $reports->total() }}</a></center>
@endsection