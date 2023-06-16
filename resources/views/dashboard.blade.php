<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@extends('layouts.master')
@section('content')
<h1>Dashboard</h1>
<form id="countSMS" action="">
  <input type="radio" id="day" name="countSMS" value="day" checked="checked">
  <label for="html"> Day</label>
  <input type="radio" id="month" name="countSMS" value="month">
  <label for="html"> Month</label>
  <input type="radio" id="year" name="countSMS" value="year">
  <label for="html"> Year</label>
@if ((auth()->user()->profile == 1))
  <label for"html"> - Customer</label>
  <select id="customer" name="customer">
	<?php 
		$customer = new  \App\Models\Customer();
		$customers = $customer::where('profile',3)->get();
		foreach ($customers as $customer) {
			echo "<option value='$customer->uid'>$customer->name - $customer->uid</option>";
		}
	?>
  </select>
  @endif
  @if ((auth()->user()->profile == 4))
  <label for"html"> - Customer</label>
  <select id="customer" name="customer">
        <?php
		$customer = new  \App\Models\Customer();
		$sales_customers = auth()->user()->sales_customers;
		$sales_customers = explode(";",$sales_customers);
                $customers = $customer::whereIn('id',$sales_customers)->get();
                foreach ($customers as $customer) {
                        echo "<option value='$customer->uid'>$customer->name - $customer->uid</option>";
                }
        ?>
  </select>
  @endif
  @if (auth()->user()->profile == 3)
  <label for"html"></label>
  <select id="customer" name="customer">
  	<option value="{{ auth()->user()->uid }}">{{ auth()->user()->name }} -  {{ auth()->user()->uid }}</option>
	</select>
@endif 
</form>
<canvas id="deliver" style="width:10px !important; height:4px !important;"></canvas>

<script>
<?php
		$customer = new  \App\Models\Customer();
		$customers = $customer::where('profile',3)->get();
		$i = 0;
		$len = count($customers);
		foreach ($customers as $key => $customer) {
			$arrContextOptions=array(
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);
			$response = Http::get('http://localhost:998/dashboardAPI', [
    'countSMS' => 'day',
    'customer' => $customer->name,
]);
			echo $response;
			if ($key == 0) {
				$customersPrint = "'" . $customer->name . "'";
			} else {
				$customersPrint = $customersPrint . "," . "'" . $customer->name . "'";
			}
			if ($i == $len - 1) {
				$CustomerPrint = "[" . $customersPrint . "]";
			}
			$i++;
		}
?>
var graphProd;
function createGraph(delivered, failure, ok) {
	//	var xValues = ["Delivered", "Failure", "Sent"];
	var xValues = <?php echo $CustomerPrint;?>; 
		var yValues = [delivered, failure, ok];
	var barColors = ["green", "red", "blue","orange"];
	var labels = ["Delivered", "Failure/Undelivered/UNKNOWN", "OK", "Others"];
	
	graph = new Chart("deliver", {
	type: "bar",
		data: {
		labels: xValues,
			datasets: [{
			backgroundColor: barColors,
				data: yValues
	}]
	},
		options: {
		responsive: true,
		legend: {display: false},
			title: {
			display: true,
				text: "SMS Delivery"
	}
	}
	});
	return graph;

}/*
var val = $('input[name=countSMS]:checked', '#countSMS').val();
var customer = $('#customer').val();
console.log("Customer: " + customer);
        $.get("/dashboardAPI",
{
	countSMS : val,
	customer : customer
},
        function(data,status){

                const txt = data;
                const myJson = JSON.stringify(txt);
                localStorage.setItem("testJSON", myJson);
                let text = localStorage.getItem("testJSON");
                let obj = JSON.parse(text);

                console.log(obj.ok);
                graphProd = createGraph(obj.delivered, obj.failure, obj.ok);
                //alert("Data: " + obj.ok + " - " + obj.price + "\nStatus: " + status);
        });
   setInterval(function(){  
	   var val = $('input[name=countSMS]:checked', '#countSMS').val();
           var customer = $('#customer').val();
console.log(val);
console.log(customer);
	$.get("/dashboardAPI",
{
	countSMS : val,
	customer : custome
},
	function(data,status){
                        const txt = data;
                        const myJson = JSON.stringify(txt);
                        localStorage.setItem("testJSON", myJson);
                        let text = localStorage.getItem("testJSON");
                        let obj = JSON.parse(text);
                        graphProd.data.datasets[0].data[0] = obj.delivered;
                        graphProd.data.datasets[0].data[1] = obj.failure;
                        graphProd.data.datasets[0].data[2] = obj.ok;
                        graphProd.update();

	});
   },30000);*/
$('#countSMS input').on('change', function() {
	var val = $('input[name=countSMS]:checked', '#countSMS').val();
	var customer = $('#customer').val();
	console.log(val);
	console.log(customer);
	$.get("/dashboardAPI",
	{
		countSMS : val,
		customer: customer
		
	},
		function(data,status){

			const txt = data;
			const myJson = JSON.stringify(txt);
			localStorage.setItem("testJSON", myJson);
			let text = localStorage.getItem("testJSON");
			let obj = JSON.parse(text);
			graphProd.data.datasets[0].data[0] = obj.delivered;
			graphProd.data.datasets[0].data[1] = obj.failure;
			graphProd.data.datasets[0].data[2] = obj.ok;
			graphProd.update();
		});
});
$('#customer').on('change', function() {
        var val = $('input[name=countSMS]:checked', '#countSMS').val();
        var customer = $('#customer').val();
        console.log(val);
        console.log(customer);
        $.get("/dashboardAPI",
        {
                countSMS : val,
                customer: customer
                
        },
                function(data,status){

                        const txt = data;
                        const myJson = JSON.stringify(txt);
                        localStorage.setItem("testJSON", myJson);
                        let text = localStorage.getItem("testJSON");
                        let obj = JSON.parse(text);
                        graphProd.data.datasets[0].data[0] = obj.delivered;
                        graphProd.data.datasets[0].data[1] = obj.failure;
                        graphProd.data.datasets[0].data[2] = obj.ok;
                        graphProd.update();
                });
});
</script>
@endsection
