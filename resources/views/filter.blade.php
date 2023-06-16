<style>
tbody tr:hover {
  background-color: white;
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
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @php    
    $route = shell_exec("python3 /opt/jasmin/cli/filter.py | sed 's/<U//g' | sed 's/<DA//g' | sed 's/<SA//g' | sed 's/<C//g' | sed 's/<SM//g'| sed 's/<TG//g'| sed 's/>//g' | sed 's/MT//g' | sed 's/MO//g' | awk {'print \"<tr><td>\"$1\"</td><td>\"$2\"</td><td>\" $3 \"</td><td><a href='\\''\/filters\/delete\/\"$1\" '\\'' class='\\''bi bi bi-trash3'\\''></a></td></tr>\"'} | sed 's/#//g'");
	    echo $route;
    @endphp
  </tbody>
</table>
@endsection
