@extends('layouts.master')
@section('content')
<h1>Details</h1>
<div class="card bg-info text-white">
    @foreach($details as $detail)
<div class="card-body"><strong>Date:</strong> <?php print_r($detail['created_at']);?></div>
<div class="card-body"><strong>ID:</strong> <?php print_r($detail['msgid']);?></div>
<div class="card-body"><strong>user:</strong> <?php print_r($detail['uid']);?></div>
<div class="card-body"><strong>source_connector:</strong> <?php print_r($detail['source_connector']);?></div>
<div class="card-body"><strong>routed_cid:</strong> <?php print_r($detail['routed_cid']);?></div>
<div class="card-body"><strong>source_addr:</strong> <?php print_r($detail['source_addr']);?></div>
<div class="card-body"><strong>destination_addr:</strong> <?php print_r($detail['destination_addr']);?></div>
<div class="card-body"><strong>Customer Rate:</strong> <?php print_r($detail['ratecustomer']);?></div>
<div class="card-body"><strong>Customer Rate:</strong> <?php print_r($detail['ratedestcustomer']);?></div>
@if ((auth()->user()->profile == 1))
<div class="card-body"><strong>Provider Rate:</strong> <?php print_r($detail['rateprovider']);?></div>
<div class="card-body"><strong>Provider Rate:</strong> <?php print_r($detail['ratedestprovider']);?></div>
@endif
<?php
        $msg = substr($detail['short_message'], 2);
	$hex=hex2bin($msg);
?>
<div class="card-body"><strong>short_message:</strong> <?php echo $hex;?></div>
<div class="card-body"><strong>Size Message:</strong> <?php print_r($detail['sizemessage']);?></div>
<div class="card-body"><strong>status:</strong> <?php print_r($detail['status']);?></div>
    @endforeach
</div>
@endsection
