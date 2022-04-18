<style>
tbody tr:hover {
  background-color: #5f94cb;
  color: black;
}
</style>
@extends('layouts.master')
@section('content')
<h1>Filters</h1>
<a href="/filters/add" ype="button" class="btn btn-primary">Add Filter</a>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Type</th>
      <th>Description</th>  
      <td>Edit</th>
    </tr>
  </thead>
  <tbody>
    @php    
    $route = shell_exec("python3 /opt/jasmin/cli/filter.py | awk {'if($1!=\"#Filter\" && $1!=\"Total\" && $1!=\"\" && $1!=\"filter\") {print \"<tr><td>\"$1\"</td><td>\"$2\"</td><td>\"$5\"</td><td><a href='\\''\/filters\/delete\/\"$1\" '\\'' class='\\''bi bi bi-trash3'\\''></a></td></tr>\"}'} | sed 's/#//g'");
    echo $route;    
    @endphp
  </tbody>
</table>
@endsection