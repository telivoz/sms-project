<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@extends('layouts.master')
@section('content')
<h1>Summary</h1>
<form id="countSMS" name="countSMS" action="">
  <input type="radio" id="day" name="countSMS" value="day" checked="checked">
  <label for="html" name="day"> Day</label>
  <!--input type="radio" id="month" name="countSMS" value="month">
  <label for="html"> Month</label>
  <input type="radio" id="year" name="countSMS" value="year">
  <label for="html"> Year</label!-->
</form>
<hr>
<h3>Providers</h3>
 @if (auth()->user()->profile == 1)
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">&ensp;
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Countries.." title="Type in a Contry">&ensp;
<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search for Prefix.." title="Type in a Prefix">
<table class="table" id="myTable">
  <thead>
    <tr class="header">
      <th onclick="sortBy(0)">Provider Name</th>
      <th>Country</th>
      <th>Prefix</th>
      <th>Sent</th>
      <th>Delivered</th>
      <th>Failure or Undeliv</th>
    </tr>
  </thead>
  <tbody>
<?php
$now = date('Y-m-d');
$customers = new  \App\Models\Connectors();
$logs = new  \App\Models\Submit_log();
$rateCustomers = new \App\Models\RateProvider();
foreach ($rateCustomers->orderBy('company','ASC')->get() as $rate) {
	$customer = $customers::where('name',$rate->company)->first();
		$deliv = $logs::where('routed_cid', $customer->name)->where('status','DELIVRD')->where('ratedestprovider',$rate->destination)->where('created_at', '>=',"$now")->count();
                $sent = $logs::where('routed_cid', $customer->name)->where('ratedestprovider',$rate->destination)->where('created_at', '>=',"$now")->count();
                $fail =  $logs::where('routed_cid', $customer->name)->where('ratedestprovider',$rate->destination)->where('status', 'UNDELIV')->where('created_at', '>=',"$now")->count();
                $fail += $logs::where('routed_cid', $customer->name)->where('ratedestprovider',$rate->destination)->where('status', 'like', '%FAIL%')->where('created_at', '>=',"$now")->count();
	 if ($sent != 0) {
		echo "<tr>";
		echo "<td>$customer->name</td>";
		echo "<td>$rate->destination</td>";
		echo "<td>$rate->code</td>";
		echo "<td>$sent</td>";
		echo "<td>$deliv</td>";
		echo "<td>$fail</td>";
		echo "<tr>";
	 }
	}
?>
</tbody>
</table>
@endif
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function myFunction3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
@endsection
