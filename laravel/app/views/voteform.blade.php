<html>
<head>
<title>APBionet Vote</title>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" />
<script>
$( document ).ready(function( $ ) {


$('#datepicker').datepicker();
    
   
});
</script>
</head>
<body style="padding: 60px;">


    <div class="container">

     <div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
	  	<p>Dear APBionet Member,</p>
	  	<p></p>
	  	<p>{{$atrial->title}}</p>
	  	<div style="text-align:center; width: 100%;margin: 20px;">
	  	@if($atrial->type=='voteapprove')
	  	<table style="width: 70%;">
	  		<tr>
	  			<td width="33%"><a class="btn btn-success btn-lg" href="{{route('voteapprove',array($token,$atrial->id,'approve'))}}">Approve</button></td>
	  			<td width="33%"><a class="btn btn-danger btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'disapprove'))}}">Disapprove</button></td>
	  			<td width="33%"><a class="btn btn-warning btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'abstain'))}}">Abstain</button></td>
	  		</tr>
	  	</table>
	  	@elseif($atrial->type=='choicevote')
	  		<form action="{{route('choicevote',array($token,$atrial->id))}}" method="post" class="form-horizontal ">
	  			@foreach($choices as $choice)
	  			<div class="form-group">
	  			<div class="checkbox">
				    <label for="choices" class="col-sm-2 control-label">
				      <input type="checkbox" name='choices[]' value="{{$choice->name}}"> {{$choice->name}}
				    </label>
			  	</div>
			  	</div>


			  @endforeach

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-warning btn-default">Vote</button>
			    </div>
			  </div>

			</form>
	  	@elseif($atrial->type=='askcomment')
	  		<form action="{{route('askcomment',array($token,$atrial->id))}}" method="post" class="form-horizontal">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-3 control-label">Your comment:</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="inputEmail3" name="comment" >
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-warning btn-default">Save</button>
			    </div>
			  </div>

			</form>
	  	@else
	  	<form action="{{route('appointment',array($token,$atrial->id))}}" method="post" class="form-horizontal">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-3 control-label">Appointment Date:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="datepicker" name="comment" data-date-format="yyyy-mm-dd">
			    </div>
			    <div class="col-sm-2">
			    <select class="form-control" name="selectedtime">
				  <option value="am">AM</option>
				  <option value="pm">PM</option>
				</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-warning btn-default">Save</button>
			    </div>
			  </div>

			</form>
	  	@endif
	  
  
	  	</div>
	  	<p>{{$atrial->description}}</p>
	  </div>
	  <div class="col-md-2"></div>
	</div>

    </div><!-- /.container -->



</body>
</html>