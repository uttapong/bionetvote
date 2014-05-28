@extends('packages.mrjuliuss.syntara.layouts.dashboard.master')
@section('content')
<script>
jQuery( document ).ready(function( $ ) {


  $(".uploadform").submit(function(e)
  {
    var formObj = $(this);
      var formData = new FormData(this);
      var formURL = $(this).attr("action");
      
      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : formData,
          mimeType:"multipart/form-data",
      contentType: false,
        cache: false,
        processData:false,
          success:function(data, textStatus, jqXHR) 
          {

            if(data==0){
                
                bootbox.alert("Sending email(s).", function() {
          });
              }
              else {
                bootbox.alert("Email(s) has been sent.", function() {
          });
              }
          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
              //if fails      
          }
      });
      e.preventDefault(); //STOP default action
  });

  
});
function confirmRemove(trialid){
  bootbox.confirm("Are you sure you want to remove this trial?", function(result) {
    if(result){
      location.href='{{route('home')}}/removetrial/'+trialid;
    }
  }); 
}

function mailresult(trialid){
  bootbox.confirm("Are you sure you want to send this results to all participant?", function(result) {
    if(result){

      $.ajax(
      {
          url : "{{route('home')}}/mailresult/"+trialid,
          type: "POST",
        contentType: false,
        cache: false,
        processData:false,
          success:function(data, textStatus, jqXHR) 
          {
            bootbox.alert(data, function() {});
              
          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
              bootbox.alert("Error, sending emails(s) fail", function() {});
          }
      });
      
    }
  }); 
}
</script>

<div class='container'>
@if(Session::has('message'))
    {{ Session::get('message') }}
@endif
<div class="row">
  <div class="col-xs-12">

  	{{ Form::open(array('url' =>route('inserttrial'),'enctype'=>'multipart/form-data','method'=>'post','id'=>'inserttrial','role'=>'form','class'=>'form-horizontal')) }}
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <h4>Add New Trial</h4>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Trial Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="title" >
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email Subject</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="mailtitle" >
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Trial Type</label>
    <div class="col-sm-10">
      <select class="form-control" name="type">
		  <option value="voteapprove">Approve</option>
		  <option value="choicevote">Choice</option>
      <option value="askcomment">Comment</option>
       <option value="appointment">Appointment</option>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Attach File</label>
    <div class="col-sm-10">
      <input type="file" id="cdlist" name="attach" />
    </div>
  </div>

  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Add</button>
    </div>
  </div>
</form>
	
  </div>

   <div class="col-xs-12">
   <div style="width: 100%;text-align:center;margin: 5px;">{{$trials->links();}}</div>
  <table class="table">
  	<tr>
  		<th>No.</th>
  		<th>Trial Name</th>
  		<th>Description</th>
  		<th>Type</th>
  		<th>Send E-Mail</th>
  		<th>Created On</th>
      <th>Preview</th>
  		<th>Edit</th>
  		<th>Delete</th>
  		<th>Add Choices</th>
      <th>Vote Result</th>
      <th>Email Result</th>
  	</tr>
  		<?php $count=0; ?>
  	@foreach($trials as $trial)
  		<tr>
  			<td>{{++$count}}</td>
  			<td><a href="route('preview',array($trial->id))" >{{$trial->trimTitle()}}</a></td>
  			<td><a href="route('preview',array($trial->id))" >{{$trial->trimDescription()}}</a></td>
  			<td>{{$trial->type}}</td>
  			<td>
        {{ Form::open(array('url' =>'addfile','enctype'=>'multipart/form-data','method'=>'post','id'=>'uploadform','role'=>'form','class'=>'form-horizontal uploadform')) }}
            <input type="file" id="cdlist" name="candidatelist" /> <button type="submit" class="btn btn-default btn-xs">upload</button>
            <input type="hidden" name="trialid" value="{{$trial->id}}" />
            </form>

        </td>
  			<td>{{$trial->format_created_date()}}</td>
        <td><a href="{{route('preview',array($trial->id))}};" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Preview</a></td>
  			<td><a href="{{route('edittrial',array($trial->id))}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td>
  			<td><button onclick="confirmRemove({{$trial->id}});" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete</button></td>
  			<td>@if($trial->type=='choicevote')<a href="{{route('choice',array($trial->id))}}" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span> Add Choice</a>@endif</td>
        <td><a href="{{route('result',array($trial->id))}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-stats"></span> Results</a></td>
        <td><button onclick="mailresult( {{$trial->id}} )" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-envelope"></span> Send Result</a></td>

        </tr>
    @endforeach
   </table>
   </div>
 
  
</div>
</div>

@stop