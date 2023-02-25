<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@extends('layouts.master')
@section('content')
<h1>Dashboard</h1>
<form id="countSMS" action="">
  <input type="radio" id="day" name="countSMS" value="day" checked="checked">
  <label for="html">Per Day</label>
  <input type="radio" id="month" name="countSMS" value="month">
  <label for="html">Per Month</label>
  <input type="radio" id="year" name="countSMS" value="year">
  <label for="html">Per Year</label>
</form>
<canvas id="deliver" style=""></canvas>

<script>
let obj;

function createGraph(delivered, failure, ok, others) {
	var xValues = ["Delivered", "Failure", "Ok", "Others"];
	console.log(obj.ok);
	var yValues = [delivered, failure, ok, others];
	var barColors = ["green", "red", "blue","orange"];

	new Chart("deliver", {
	type: "bar",
		data: {
		labels: xValues,
			datasets: [{
			backgroundColor: barColors,
				data: yValues
	}]
	},
		options: {
		legend: {display: true},
			title: {
			display: true,
				text: "SMS Delivery"
	}
	}
	});

}

var val = $('input[name=countSMS]:checked', '#countSMS').val();
console.log(val);
if (val === 'day') {
	$.get("/dashboardAPI",
{
	countSMS : val
},
	function(data,status){

		const txt = data;
		const myJson = JSON.stringify(txt);
		localStorage.setItem("testJSON", myJson);
		let text = localStorage.getItem("testJSON");
		obj = JSON.parse(text);
		var xValues = ["Delivered", "Failure", "Ok", "Others"];

		console.log(obj.ok);
		createGraph(0, 0, obj.ok, 10);
		//alert("Data: " + obj.ok + " - " + obj.price + "\nStatus: " + status);
	});
}
$('#countSMS input').on('change', function() {
	var val = $('input[name=countSMS]:checked', '#countSMS').val();
	console.log(val);
	$.get("/dashboardAPI",
	{
		countSMS : val
	},
		function(data,status){

			const txt = data;
			const myJson = JSON.stringify(txt);
			localStorage.setItem("testJSON", myJson);
			let text = localStorage.getItem("testJSON");
			obj = JSON.parse(text);
			createGraph(0, 0, obj.ok, 10);
		});
});


</script>
@endsection
