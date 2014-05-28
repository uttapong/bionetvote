<html>
<head>
<title>APBionet Vote Result</title>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" />
</head>
<body style="padding: 60px;">


    <div class="container">

     <div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
	  	<p>Dear APBionet Member,</p>
	  	<p></p>
	  	<p>The vote entitled "{{$trial->title}}" has been completed. You can view the result by clicking the link below.</p>
	  	<p><a class="btn btn-success btn-lg" href="{{route('result',array($trial->id))}}">View Vote Result</a></p>
	  	<p></p>
	  	<p>Sincerely,</p>
	  	<p>APBionet Team</p>
	  </div>
	  <div class="col-md-2"></div>
	</div>

    </div><!-- /.container -->



</body>
</html>