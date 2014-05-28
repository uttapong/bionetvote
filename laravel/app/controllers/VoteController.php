<?php

class VoteController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function approve($token,$trialid,$choice)
	{
		$data=array();
		
		$trial=Trial::find($trialid);
		if($this::checkVoted($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have already voted for this trial.</div>";
		
		}
		else if(!$this::checkValidToken($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have no access to this trial.</div>";
			
		}
		else{
		

			//update vote count
			if($choice=='approve')$trial->vote_approve++;
			else if($choice=='disapprove')$trial->vote_disapprove++;
			else $trial->vote_abstain++;
			$trial->save();
			//update maillog voted
			$log=Maillog::where('token','=',$token)->first();
			$log->voted++;
			$log->save();


			$data['msg']="<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Thank you, your vote has been saved.</div>";
		}
		return View::make('voteresult',$data);
		
		
		
	}
	public function checkValidToken($trialid,$token){
		
		
		$count=Maillog::where('token','=',$token)->count();
	

		if($count>0)return true;
		else return false;
	}

	public function checkVoted($trialid,$token){
		
		
		$log=Maillog::where('token','=',$token)->first();
		$count=$log->voted;

		if($count>0)return true;
		else return false;
	}
	public function choicevoteform($token,$trialid){

		$data=array();
		$trial=Trial::find($trialid);
		$data['atrial']=$trial;
		$data['token']=$token;
		$data['currentUser']=Sentry::getUser();

		$data['choices']=$trial->choice;

		return View::make('voteform',$data);
	}
	public function choicevote($token,$trialid)
	{
		$data=array();
		
		$trial=Trial::find($trialid);
		if($this::checkVoted($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have already voted for this trial.</div>";
		
		}
		else if(!$this::checkValidToken($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have no access to this trial.</div>";
			
		}
		else{

			//update vote count
			//dd(Input::get('choices'));
			$choices=array();
			$choices=Input::get('choices');
			foreach($choices as $choice){
				$voted_choice=Choice::where('trial','=',$trialid)->where('name','=',$choice)->first();
				$voted_choice->vote_count++;
				$voted_choice->save();

			}

			//update maillog voted
			$log=Maillog::where('token','=',$token)->first();
			$log->voted++;
			$log->save();


			$data['msg']="<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Thank you, your vote has been saved.</div>";
		}
		return View::make('voteresult',$data);
	}
	public function askcommentform($token,$trialid){

		$data=array();
		$trial=Trial::find($trialid);
		$data['atrial']=$trial;
		$data['token']=$token;
		$data['currentUser']=Sentry::getUser();

		$data['choices']=$trial->choice;

		return View::make('voteform',$data);
	}
	public function appointmentform($token,$trialid){

		$data=array();
		$trial=Trial::find($trialid);
		$data['atrial']=$trial;
		$data['token']=$token;
		$data['currentUser']=Sentry::getUser();

		$data['choices']=$trial->choice;

		return View::make('voteform',$data);
	}
	public function askcomment($token,$trialid)
	{
		Eloquent::unguard();
		$data=array();
		
		$trial=Trial::find($trialid);
		if($this::checkVoted($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have already voted for this trial.</div>";
		
		}
		else if(!$this::checkValidToken($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have no access to this trial.</div>";
			
		}
		else{

			$new_comment = array(
			 'comment' => Input::get('comment'),
			 'trial'=>$trialid
			 );
			 // let's setup some rules for our new data
			 // I'm sure you can come up with better ones
			$rules = array(
				'comment' => 'required'
			 );
			 // make the validator
			$v = Validator::make($new_comment, $rules);
			 if ( $v->fails() )
			 {
			 // redirect back to the form with
			 // errors, input and our currently
			 // logged in user
			 	return $v->messages();;
			 
			 }
			 // create the new post
			$comment = new Comment($new_comment);

			if(strval($comment->save())){
				$data['msg']= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Your comment has been successfully saved.</div>";
				//update maillog voted
				$log=Maillog::where('token','=',$token)->first();
				$log->voted++;
				$log->save();
			}
			else
			$data['msg']= "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error saving comment, please try again.</div>";
		}
		return View::make('voteresult',$data);
	}

	public function appointment($token,$trialid)
	{
		$data=array();
		
		$trial=Trial::find($trialid);
		if($this::checkVoted($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have already voted for this trial.</div>";
		
		}
		else if(!$this::checkValidToken($trialid,$token)){
			$data['msg']="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Sorry, you have no access to this trial.</div>";
			
		}
		else{

			$new_comment = array(
			 'comment' => Input::get('comment'),
			 'selectedtime' => Input::get('selectedtime'),
			 'trial'=>$trialid
			 );
			 // let's setup some rules for our new data
			 // I'm sure you can come up with better ones
			$rules = array(
				'comment' => 'required',
				'selectedtime' => 'required',
			 );
			 // make the validator
			$v = Validator::make($new_comment, $rules);
			 if ( $v->fails() )
			 {
			 // redirect back to the form with
			 // errors, input and our currently
			 // logged in user
			 	return $v->messages();;
			 
			 }
			 // create the new post
			$comment = new Comment($new_comment);

			if(strval($comment->save())){
				$data['msg']= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Your selected date has been successfully saved.</div>";
				//update maillog voted
				$log=Maillog::where('token','=',$token)->first();
				$log->voted++;
				$log->save();
			}
			else
			$data['msg']= "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error saving date, please try again.</div>";
		}
		return View::make('voteresult',$data);
	}

}