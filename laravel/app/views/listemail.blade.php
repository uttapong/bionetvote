<html>
<head>
<title>APBionet Vote</title>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" />
</head>
<body style="padding: 60px;">


    <div class="container">

     <div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
	  	@if($atrial->type=='voteapprove')
	  	<table style="width: 70%;">
	  		<tr>
	  			<td width="33%"><a class="btn btn-success btn-lg" href="{{route('voteapprove',array($token,$atrial->id,'approve'))}}">Approve</a></td>
	  			<td width="33%"><a class="btn btn-danger btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'disapprove'))}}">Disapprove</a></td>
	  			<td width="33%"><a class="btn btn-warning btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'abstain'))}}">Abstain</a></td>
	  		</tr>
	  	</table>
	  	@elseif($atrial->type=='choicevote')
	  		<a class="btn btn-warning btn-lg"  href="{{route('choicevoteform',array($token,$atrial->id))}}">Click here to vote.</a>
	  	@elseif($atrial->type=='askcomment')
	  		<a class="btn btn-warning btn-lg"  href="{{route('askcommentform',array($token,$atrial->id))}}">Click here to add comment.</a>
	  	@else
	  		<a class="btn btn-warning btn-lg"  href="{{route('appointmentform',array($token,$atrial->id))}}">Click here choose appointment date.</a>
	  	@endif


	  	<p>{{$atrial->title}}</p>
	  	<p></p>
	  	@if($atrial->attach)
	  		<p><span class="label label-info"><a style="color: white !important;" href="{{route('home')}}/uploads/{{$atrial->attach}}"><span class="glyphicon glyphicon-paperclip"></span> Download Attached File.</a></span></p>
	  	@endif
	  	
	  	
	  	<div style="text-align:center; width: 100%;margin: 20px;">

	  	</div>
	  	<p>{{$atrial->description}}</p>
	  	<p></p>
	  	@if($atrial->type=='voteapprove')
	  	<table style="width: 70%;">
	  		<tr>
	  			<td width="33%"><a class="btn btn-success btn-lg" href="{{route('voteapprove',array($token,$atrial->id,'approve'))}}">Approve</a></td>
	  			<td width="33%"><a class="btn btn-danger btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'disapprove'))}}">Disapprove</a></td>
	  			<td width="33%"><a class="btn btn-warning btn-lg"  href="{{route('voteapprove',array($token,$atrial->id,'abstain'))}}">Abstain</a></td>
	  		</tr>
	  	</table>
	  	@elseif($atrial->type=='choicevote')
	  		<a class="btn btn-warning btn-lg"  href="{{route('choicevoteform',array($token,$atrial->id))}}">Click here to vote.</a>
	  	@elseif($atrial->type=='askcomment')
	  		<a class="btn btn-warning btn-lg"  href="{{route('askcommentform',array($token,$atrial->id))}}">Click here to add comment.</a>
	  	@else
	  		<a class="btn btn-warning btn-lg"  href="{{route('appointmentform',array($token,$atrial->id))}}">Click here choose appointment date.</a>
	  	@endif
	  </div>
	  <div class="col-md-2"></div>
	</div>

    </div><!-- /.container -->



</body>
</html>