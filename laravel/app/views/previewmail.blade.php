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
	  	<p><a href="{{route('trial',array($trial->id))}}" class='btn btn-default'><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a></p>
	  	<p>Dear APBionet Member,</p>
	  	<p></p>
	  	<p>{{$title}}</p>
	  	<div style="text-align:center; width: 100%;margin: 20px;">
	  	@if($type=='voteapprove')
	  	<table style="width: 70%;">
	  		<tr>
	  			<td width="33%"><a class="btn btn-success btn-lg" href="javascript:void(0);">Approve</button></td>
	  			<td width="33%"><a class="btn btn-danger btn-lg"  href="javascript:void(0);">Disapprove</button></td>
	  			<td width="33%"><a class="btn btn-warning btn-lg"  href="javascript:void(0);">Abstain</button></td>
	  		</tr>
	  	</table>
	  	@elseif($type=='choicevote')
	  		<form action="" method="post" class="form-horizontal">
	  			@foreach($choices as $choice)
	  			<div class="form-group">
	  			<div class="checkbox">
				    <label for="choices" class="col-sm-2 control-label">
				      <input type="checkbox" name='choices[]' value="{{$choice->name}}"> {{$choice->name}}
				    </label>
			  	</div>
			  	</div>
			  @endforeach

			</form>
	  	@else
	  		<form action="" method="post" class="form-horizontal">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Your comment:</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputEmail3" name="comment" >
			    </div>
			  </div>

			</form>
	  		
	  	@endif
	  
  
	  	</div>
	  	<p>{{$desc}}</p>
	  </div>
	  <div class="col-md-2"></div>
	</div>

    </div><!-- /.container -->



</body>
</html>