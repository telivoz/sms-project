
<style>
tbody tr:hover {
  background-color: white;
  color: black;
}
tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@extends('layouts.master')
@section('content')
<h1>Reports</h1>
<table id="example" style="border-collapse: collapse;font-size:12px;text-align: left;" class="table">
  <thead>
    <tr>
      <th>Date</th>
      <th>User</th>
      <th>MSG ID</th>
      <th>Connector</th>
      <th>Source Address</th>
      <th>Destination Address</th>
      <th>Message</th>
      <th>status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reports as $report)
    <tr>
      <td>{{ $report->created_at }}</td>
      <td>{{ $report->uid }}</td>
      <td><a href="/details/{{ $report->msgid }}" target="_blank">{{ $report->msgid }}</a></td>
      <td>{{ $report->source_connector }}</td>
      <td>{{ $report->source_addr }}</td>
      <td>{{ $report->destination_addr }}</td>
<?php 
$msg = substr($report->short_message, 2);
	if (trim($msg, '0..9A..Fa..f') == '') {
		$hex=hex2bin($msg);
	}
?>
      <td>{{ $hex }}</td>
      <td>{{ $report->status }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
  {!! $reports->withQueryString()->links() !!}
</div>
<center><a>{{ $reports->count() }} of {{ $reports->total() }}</a></center>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#example thead th').each(function () {
		
		var title = $(this).text();
		if (title !== "Details") {
		        $(this).html('<input type="text" placeholder="Search ' + title + '" size="11"/>');
		}
    });

    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
});
</script>
