@extends('packages.mrjuliuss.syntara.layouts.dashboard.master')
@section('content')
<script>
jQuery( document ).ready(function( $ ) {


});

function confirmRemove(choiceid){
  bootbox.confirm("Are you sure you want to remove this choice?", function(result) {
    if(result){
      location.href='{{route('home')}}/removechoice/'+choiceid;
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
  	{{ Form::open(array('url' =>route('insertchoice',array($trial->id)),'method'=>'post','id'=>'inserttrial','role'=>'form','class'=>'form-horizontal')) }}
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <h4>Add New Candidate</h4>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Candidate Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputEmail3" name="name" >
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Add</button>
    </div>
  </div>
</form>
	
  </div>

   <div class="col-sm-offset-2 col-xs-10">
   <div style="width: 100%;text-align:center;margin: 5px;">{{$choices->links();}}</div>
  	<ol class="sortable">	
      <?php $count=0; ?>
  	@foreach($choices as $choice)
  		
  			<li style="width: 40%;clear:both;padding: 5px"><span style="float:left">{{$choice->name}}</span><span style="float:right"> <button class="btn btn-danger btn-xs" onclick="confirmRemove({{$choice->id}})"><span class="glyphicon glyphicon-remove"></span> Remove</button></span></li>
    @endforeach
   </ol>
 
  
</div>
</div>

@stop