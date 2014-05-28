@extends('packages.mrjuliuss.syntara.layouts.dashboard.master')
@section('content')
<script>
jQuery( document ).ready(function( $ ) {


	$("#uploadform").submit(function(e)
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
</script>

<div class='container'>
<div class="row">
  <div class="col-xs-12">
  	{{ Form::open(array('url' =>'addfile','enctype'=>'multipart/form-data','method'=>'post','id'=>'uploadform','role'=>'form','class'=>'form-horizontal')) }}
  
  
  <div class="form-group">
    <label for="exampleInputFile">File upload</label>
    <input type="file" id="candidatelist" name="candidatelist">
    <p class="help-block">Candidates list file (csv format)</p>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
	
  </div>
  <div class="col-xs-12">
  	<table id="uploadcontent">
  	</table>
  </div>
</div>
</div>

@stop