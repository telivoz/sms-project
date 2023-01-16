@extends('layouts.master')
@section('content')
<h1>Dashboard</h1>
<div style="width: 600px; margin: auto;">
    <canvas id="myChart"></canvas>
</div>


<script src="{{ mix('/js/app.js') }}"></script>
@endsection