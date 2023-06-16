@extends('layouts.master')
@section('content')
<h1>Add MT Router</h1>
<div class="alert alert-info">
<strong>- DefaultRoute</strong> a route without a filter, this one can only set with the lowest order to be a default/fallback route<br>
<strong>- StaticMTRoute</strong> a basic route with Filters and one Connector<br>
<strong>- RandomRoundrobinMTRoute</strong> a route with Filters and many Connectors, will return a random Connector if its Filters are matching, can be used as a load balancer route<br>
<strong>- FailoverMTRoute a route</strong> with Filters and many Connectors, will return an available (connected) Connector if its Filters are matched <br>
</div>
<form action="/mt-router" method="POST">
  @csrf
  <div class="form-group">
    <label for="type">Type:</label>
    <select class="form-select" id="type" name="type">
      <option value="DefaultRoute">DefaultRoute</option>
      <option value="StaticMTRoute">StaticMTRoute</option>
      <option value="RandomRoundrobinMTRoute">RandomRoundrobinMTRoute</option>
      <option value="FailoverMTRoute">FailoverMTRoute</option>
    </select>
  </div>
  <div class="form-group">  
    <label for="host">Order:</label>
    <div class="alert alert-alert">
    Order <strong>0</strong> is reserved for DefaultRoute only. 
  </div>
    <input required type="number" class="form-control" id="order" placeholder="Enter Order" name="order" min="0" max="1000" value="0">
  </div>
  <div class="form-group">
    <label for="connector">Connector:</label>
    <select class="form-select" id="connector" name="connector">
  @php 
    $lineTd = shell_exec("python3 /opt/jasmin/cli/mtrouters.py | wc -l");
    $lineTd = (int)$lineTd - 2;
    $connetors = shell_exec("python3 /opt/jasmin/cli/mt-connectors.py | awk {'print \"<option value='\\''\"$1\"'\\''>\"$1\"</option>\"'} | sed 's/#//g' | sed 's/smppccm//g' | sed 's/Connector//g' | sed 's/Total//g'");
    echo $connetors;
  @endphp
    </select> 
  </div> 
  <div class="form-group">
    <label for="filter">Filter:</label>
    <input required type="text" class="form-control" id="filter" placeholder="filter1;filter2" name="filter">
    <select class="form-select" id="filter-choice" name="filter-choice">
	<option>Choose:</option>
  @php     
    $filter = shell_exec("python3 /opt/jasmin/cli/filter.py | awk {'print \"<option value='\\''\"$1\"'\\''>\"$1\"</option>\"'} | sed 's/#//g' | sed 's/filter//g' | sed 's/Filter//g' | sed 's/Total//g'");
    echo $filter;
  @endphp
    </select> 
  </div> 
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/mt-router" ype="button" class="btn btn-default">Cancel</a>
</form>
<script>
$('#filter-choice').on('change', function() {
        console.log('teste');
        var selectFilter = document.getElementById("filter-choice");
        var selectFilterValue = selectFilter.value;
	var input = document.getElementById('filter');
	if (selectFilterValue !== "Choose:") {
		if (input.value != "") {
			input.value = input.value + ";" +selectFilterValue;
		} else {
			input.value = selectFilterValue;
		}
	}
});
</script>

@endsection
