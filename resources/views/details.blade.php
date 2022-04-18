@extends('layouts.master')
@section('content')
<h1>Details</h1>
<div class="card bg-info text-white">
  <div class="card-body">{{$details->msgid}}</div>
</div>
@endsection