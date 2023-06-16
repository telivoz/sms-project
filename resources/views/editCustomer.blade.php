@extends('layouts.master')
@section('content')
<h1>Edit Customer</h1>
<form action="/customer/update/{{ $customers->id }}" method="POST">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="uid">SMPP User:</label>
    <input type="text" class="form-control" id="uid" placeholder="Enter User to send SMS" name="uid" value="{{ $customers->uid }}">
  </div>
  <div class="form-group">
    <label for="uid">SMPP Password (Max Length 8):</label>
    <input type="password" class="form-control" id="uidpass" placeholder="Enter Password" name="uidpass" maxlength="8" value="{{ $customers->smpppass}}">
	<input type="checkbox" onclick="myFunction()"> Show Password
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $customers->name }}">
  </div> 
  <div class="form-group">
    <label for="pwd">E-mail (Web Login):</label>
    <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email" value="{{ $customers->email }}">
  </div>
  <div class="form-group">
    <label for="pwd">Password (Web Login):</label>
    <input type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ $customers->address }}">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{ $customers->phone }}">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input type="text" class="form-control" id="company" placeholder="Enter Company" name="company" value="{{ $customers->company }}">
  </div>  
  <div class="form-group">
    <label for="pwd">Profile:</label>
    <select class="form-control" id="profile" name="profile"  onchange="checkProfile()">
      <option value="3" {{ ($customers->profile) == 3 ? "selected" : "" }}>Customer</option>
      <option value="2" {{ ($customers->profile) == 2 ? "selected" : "" }}>NOC</option>
      <option value="1" {{ ($customers->profile) == 1 ? "selected" : "" }}>Adminstrator</option>
      <option value="4" {{ ($customers->profile) == 4 ? "selected" : "" }}>Sales</option>
    </select>
	 <div id="profileDiv" style="display : none;"> Select Customers:
                <select class="form-select" id="companySales" name="companySales">
                        <option value=""></option>
                         @foreach($customersAll as $customer)
                                @if ($customer->profile == 3)
                                        <option value="<?php echo $customer->id?>"><?php echo $customer->id . " : " . $customer->name . "  -  " .$customer->uid?></option>
                                @endif
                        @endforeach
                </select> <br>
		IDs Selected: <input id="selectCustomer" name="selectCustomer" type="text" value="<?php echo $customers->sales_customers;?>">
        </div>
  </div>
  <div class="form-group">
    <label for="pwd">TPS:</label>
    <input type="number" class="form-control" id="tps" placeholder="Throughput Per Second" name="tps" value="{{ $customers->tps}}" >
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/customer" ype="button" class="btn btn-default">Cancel</a>
</form>
<?php
echo  "               <script>
                        function myFunction() {
                                var x = document.getElementById('uidpass');
                                if (x.type === 'password') {
                                        x.type = 'text';
                        	} else {
                               	 	x.type = 'password';
			
				}
			}
  </script>";
?>
<script>
var x = document.getElementById("profileDiv");
if(document.getElementById('profile').value == "4") {
	x.style.display = "block";
}
function checkProfile() {
        var x = document.getElementById("profileDiv");
        if(document.getElementById('profile').value == "4") {
                        x.style.display = "block";
        } else {
                 x.style.display = "none";
                }
}
$('#companySales').on('change', function() {
        console.log('teste!!!');
        var selectFilter = document.getElementById("companySales");
        var selectFilterValue = selectFilter.value;
        var input = document.getElementById('selectCustomer');
        if (selectFilterValue !== "") {
                if (input.value != "") {
                        input.value = input.value + ";" +selectFilterValue;
                } else {
                        input.value = selectFilterValue;
                }
        }
});
</script>
@endsection
