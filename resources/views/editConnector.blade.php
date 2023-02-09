@extends('layouts.master')
@section('content')
<h1>Edit Connector</h1>
<form action="/connector/update/{{ $id }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="cid">CID:</label>
    <input type="text" class="form-control" id="cid" placeholder="Enter CID NAME" name="cid">
  </div>
  <div class="form-group">
    <label for="host">Host:</label>
    <input type="text" class="form-control" id="host" placeholder="Enter Host" name="host">
  </div>
  <div class="form-group">
    <label for="port">Port:</label>
    <input type="text" class="form-control" id="port" placeholder="Enter Port" name="port">
  </div>
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
	 <input type="checkbox" onclick="myFunction()"> Show Password 
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/connector" ype="button" class="btn btn-default">Cancel</a>
</form>
<?php
        $connInfo = explode("\n", $conn);
        foreach ($connInfo as $key => $value) {
		if(strpos($value, 'port') !== false){
			$port = explode(" ",$value);
			$port = $port[1];
			$port = str_replace(array("\r", "\n"), '', $port);
		}
		if(strpos($value, 'username') !== false){
                        $username = explode(" ",$value);
                        $username = $username[1];
			$username = str_replace(array("\r", "\n"), '', $username);
		}
		if(strpos($value, 'password') !== false){
			$password = explode(" ",$value);
                        $password = $password[1];
			$password = str_replace(array("\r", "\n"), '', $password);
                }
		if(strpos($value, 'host') !== false){
                        $host = explode(" ",$value);
			$host = $host[1];
			$host = str_replace(array("\r", "\n"), '', $host);
                }
	}
	                echo "<script>
                        function myFunction() {
                                var x = document.getElementById('password');
                                if (x.type === 'password') {
                                        x.type = 'text';
                        } else {
                                x.type = 'password';
                        }
                }
                document.getElementById('cid').value = '$id';
                document.getElementById('host').value = '$host';
        	document.getElementById('port').value = '$port';
	        document.getElementById('username').value = '$username';
        	document.getElementById('password').value = '$password';
                        </script>";
?>
@endsection
