@extends('packages.mrjuliuss.syntara.layouts.dashboard.master')
@section('content')
<script>
jQuery( document ).ready(function( $ ) {


});


</script>

<div class='container'>
@if(Session::has('message'))
    {{ Session::get('message') }}
@endif
<div class="row">
  <div class="col-xs-12">

  	{{ Form::open(array('url' =>route('updatetrial',array($trial->id)),'method'=>'post','id'=>'updatetrial','role'=>'form','class'=>'form-horizontal')) }}
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <h4>Edit Trial</h4>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Trial Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="title" value="{{$trial->title}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email Subject</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="mailtitle" value="{{$trial->mailtitle}}" >
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="description">{{$trial->description}}</textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Trial Type</label>
    <div class="col-sm-10">
      <select class="form-control" name="type">
		  <option value="voteapprove" @if($trial->type=='voteapprove')  checked='checked'  @endif>Approve</option>
		  <option value="choicevote" @if($trial->type=='choicevote')  checked='checked'  @endif>Choice</option>
      <option value="askcomment" @if($trial->type=='askcomment')  checked='checked'  @endif>Comment</option>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Attach File</label>
    <div class="col-sm-10">
      {{$trial->attach}} <input type="file" id="cdlist" name="attach" />
    </div>
  </div>

  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Update</button> <a href="{{route('trial',array($trial->id))}}" class='btn btn-default'> Cancel</a>
    </div>
  </div>
</form>
	
  </div>

   <div class="col-xs-12">

   </div>
 
  
</div>
</div>

@stop