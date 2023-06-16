<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@extends('layouts.master')
@section('content')
<h1>Summary</h1>
<form id="countSMS" action="">
  <input type="radio" id="day" name="countSMS" value="day" checked="checked">
  <label for="html"> Day</label>
  <input type="radio" id="month" name="countSMS" value="month">
  <label for="html"> Month</label>
  <input type="radio" id="year" name="countSMS" value="year">
  <label for="html"> Year</label>
</form>
<hr>
<h3>Customers</h3>
<table class="table" id="sortable">
  <thead>
    <tr>
      <th onclick="sortBy(0)">Customer Name</th>
      <th>Country</th>
      <th>Prefix</th>
      <th>Sent</th>
      <th>Delivered</th>
      <th>Failure or Undeliv</th>
    </tr>
  </thead>
  <tbody>
@if (auth()->user()->profile == 1)
<?php
$customers = new  \App\Models\Customer();
$logs = new  \App\Models\Submit_log();
$rateCustomers = new \App\Models\RateCustomer();
foreach ($rateCustomers->orderBy('company','ASC')->get() as $rate) {
	$customer = $customers::where('id',$rate->company)->first();
	$deliv = $logs::where('uid', $customer->uid)->where('status','DELIVRD')->where('ratedestcustomer',$rate->destination)->count();
         $sent = $logs::where('uid', $customer->uid)->where('ratedestcustomer',$rate->destination)->count();
         $fail =  $logs::where('uid', $customer->uid)->where('ratedestcustomer',$rate->destination)->where('status', 'UNDELIV')->count();
	 $fail += $logs::where('uid', $customer->uid)->where('ratedestcustomer',$rate->destination)->where('status', 'like', '%FAIL%')->count();
	 if ($sent != 0) {
		echo "<tr>";
		echo "<td>$customer->uid</td>";
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
<hr>
<h3>Providers</h3>
<table class="table">
  <thead>
    <tr>
      <th>Connector</th>
      <th>Delivered</th>
      <th>Sent</th>
      <th>Failure</th>
    </tr>
  </thead>
  <tbody>
<?php
$customers = new  \App\Models\Connectors();
$logs = new  \App\Models\Submit_log();
        foreach ($customers->all() as $customer) {
                echo "<tr>";
                echo "<td>$customer->name</td>";
                $deliv = $logs::where('routed_cid', $customer->name)->where('status', 'DELIVRD')->count();
                echo "<td>$deliv</td>";
                $sent = $logs::where('routed_cid', $customer->name)->count();
                echo "<td>$sent</td>";
                $fail =  $logs::where('routed_cid', $customer->name)->where('status', 'UNDELIV')->count();
                $fail += $logs::where('routed_cid', $customer->name)->where('status', 'like', '%FAIL%')->count();
                echo "<td>$fail</td>";
                echo "<tr>";
        }
?>
</tbody>
</table>
@endif
<script>
cPrev = -1; // global var saves the previous c, used to
            // determine if the same column is clicked again

function sortBy(c) {
    rows = document.getElementById("sortable").rows.length; // num of rows
    columns = document.getElementById("sortable").rows[0].cells.length; // num of columns
    arrTable = [...Array(rows)].map(e => Array(columns)); // create an empty 2d array

    for (ro=0; ro<rows; ro++) { // cycle through rows
        for (co=0; co<columns; co++) { // cycle through columns
            // assign the value in each row-column to a 2d array by row-column
            arrTable[ro][co] = document.getElementById("sortable").rows[ro].cells[co].innerHTML;
        }
    }

    th = arrTable.shift(); // remove the header row from the array, and save it
    
    if (c !== cPrev) { // different column is clicked, so sort by the new column
        arrTable.sort(
            function (a, b) {
                if (a[c] === b[c]) {
                    return 0;
                } else {
                    return (a[c] < b[c]) ? -1 : 1;
                }
            }
        );
    } else { // if the same column is clicked then reverse the array
        arrTable.reverse();
    }
    
    cPrev = c; // save in previous c

    arrTable.unshift(th); // put the header back in to the array

    // cycle through rows-columns placing values from the array back into the html table
    for (ro=0; ro<rows; ro++) {
        for (co=0; co<columns; co++) {
            document.getElementById("sortable").rows[ro].cells[co].innerHTML = arrTable[ro][co];
        }
    }
}
</script>
@endsection
