@extends('layouts.master')
@section('content')
<h1>Add Filter</h1>
<form action="/filters" method="POST">
  @csrf
  <div class="form-group">
    <label for="fid">FID:</label>
    <input required type="text" class="form-control" id="fid" placeholder="Enter Filter ID" name="fid" >
  </div>
  <div class="form-group">
    <label for="type">Type:</label>
    <select class="form-select" id="type" name="type">
      <option value="">TransparentFilter</option>
      <option value="ConnectorFilter">ConnectorFilter</option>
      <option value="UserFilter">UserFilter</option>
      <option value="GroupFilter">GroupFilter</option>
      <option value="SourceAddrFilter">SourceAddrFilter</option>
      <option value="DestinationAddrFilter">DestinationAddrFilter</option>
      <option value="ShortMessageFilter">ShortMessageFilter</option>
      <option value="TagFilter">TagFilter</option>
    </select> 
  </div>
  <div class="alert alert-info">
  <strong>TransparentFilter</strong> - No parameters are required<br>
  <strong>ConnectorFilter</strong> Ex: <u>cid smpp-01</u> - cid of the connector to match<br>
  <strong>UserFilter</strong> Ex: <u>uid YourUser</u> - uid of the user to match<br>
  <strong>GroupFilter</strong> Ex: <u>gid YourGroup</u> - gid of the group to match<br>
  <strong>SourceAddrFilter</strong> Ex: <u>source_addr ^20d+</u> - source_addr: Regular expression to match source address<br>
  <strong>DestinationAddrFilter</strong> Ex. <u>destination_addr ^85111$</u> - destination_addr: Regular expression to match destination address <br>
  <strong>ShortMessageFilter</strong> Ex. <u>^hello.*$</u> - short_message: Regular expression to match message content <br>
  <strong>TagFilter</strong> Ex. <u>tag 32401</u> - tag: numeric tag to match in message <br>

  </div> 
  <div class="form-group">
    <label for="parameter">Parameter:</label>
    <input required type="text" class="form-control" id="parameter" placeholder="Enter Parameter" name="parameter" >
  </div>
  <button type="submit" class="btn btn-success">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/filters" ype="button" class="btn btn-default">Cancel</a>
</form>
@endsection
