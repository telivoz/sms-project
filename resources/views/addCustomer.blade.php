@extends('layouts.master')
@section('content')
<h1>Add Customer</h1>
<form action="/customer" method="POST">
  @csrf
  <div class="form-group">
    <label for="uid">SMPP User:</label>
    <input required type="text" class="form-control" id="uid" placeholder="Enter UID" name="uid">
  </div>
  <div class="form-group">
    <label for="uid">SMPP Password (Max Length 8):</label>
    <input required type="text" class="form-control" id="uidpass" placeholder="Enter Password" name="uidpass" maxlength="8">
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input required type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail (Web Login):</label>
    <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password (Web Login):</label>
    <input required type="pwd" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input required type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
  </div>
  <div class="form-group">
    <label for="pwd">Phone:</label>
    <input required type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
  </div>
  <div class="form-group">
    <label for="pwd">Company:</label>
    <input required type="text" class="form-control" id="company" placeholder="Enter Company" name="company">
  </div>  
  <div class="form-group">
    <label for="pwd">Profile:</label>
    <select class="form-control" id="profile" name="profile"  onchange="checkProfile()">
      <option value="3">Customer</option>
      <option value="2">NOC</option>
      <option value="1">Adminstrator</option>
      <option value="4">Sales</option>
    </select>
	<div id="profileDiv" style="display : none;"> Select Customers:         
		<select class="form-select" id="companySales" name="companySales">
			<option value=""></option>
			 @foreach($customers as $customer)
				@if ($customer->profile == 3)
	                		<option value="<?php echo $customer->id?>"><?php echo $customer->id . " : " . $customer->name . "  -  " .$customer->uid?></option>
				@endif
			@endforeach
        	</select> <br>
		IDs Selected: <input id="selectCustomer" name="selectCustomer" type="text"> 
	</div>
  </div>

  <div class="form-group">
    <label for="pwd">TPS:</label>
    <input required type="number" class="form-control" id="tps" placeholder="Throughput Per Second" name="tps">
  </div>  
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/customer" ype="button" class="btn btn-default">Cancel</a>
</form>
<script>
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
