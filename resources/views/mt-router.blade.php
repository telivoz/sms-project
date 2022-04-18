<style>
tbody tr:hover {
  background-color: #5f94cb;
  color: black;
}
</style>
@extends('layouts.master')
@section('content')
<h1>Mt Routes</h1>
<a href="/mt-router/add" ype="button" class="btn btn-primary">Add Router</a>
<table class="table">
  <thead>
    <tr>
      <th>Order</th>
      <th>Type</th>
      <th>Connector</th>
      <th>Filter</th>
      <td>Edit</th>
    </tr>
  </thead>
  <tbody>
    @php    
    $route = shell_exec("python3 /opt/jasmin/cli/mtrouters.py | awk {'if($1!=\"#Order\" && $1!=\"Total\" && $1!=\"\" && $1!=\"mtrouter\") {print \"<tr><td>\"$1\"</td><td>\"$2\"</td><td>\"$5\"</td><td>\"$7\"</td><td><a href='\\''\/mt-router\/delete\/ \"$1\" '\\'' class='\\''bi bi bi-trash3'\\''></a></td></tr>\"}'} | sed 's/#//g'");
    echo $route;    
    @endphp
  </tbody>
</table>
@endsection