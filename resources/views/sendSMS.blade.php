<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@extends('layouts.master')
@section('content')
<h1>Send SMS</h1>
<br><a>{{ $response ?? ''}}</a><br>
<form action="sendSMS" method="POST">
@csrf
        <label for="origem">Souce:</label>
        <input type="text" id="origem" name="origem"><br>
        <label for="destino">Destination:</label>
        <input type="text" id="destino" name="destino"><br>
        <label for="mensagem">Message:</label><br>
        <textarea id="mensagem" name="mensagem" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit">
</form>
@endsection
