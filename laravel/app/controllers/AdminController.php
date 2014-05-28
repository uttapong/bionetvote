<?php

class AdminController extends BaseController {

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

	public function home()
	{
		return Redirect::route('trial');
	}
	public function upload()
	{
		$data=array('currentUser'=>Sentry::getUser());

		return View::make('upload',$data);
	}

	public function addfile()
	{
		$data=array('currentUser'=>Sentry::getUser());

		$active_trial=Trial::find(Input::get('trialid'));
		$trial_type=$active_trial->type;
		
		$data['checks']=Choice::where('trial','=',Input::get('trialid'))->get();
		$data['atrial']=$active_trial;
		//dd($active_trial->type);
		//$data['checks']=array('test1','test2');;
		//die($data['checks']);
		$choices=array();
		foreach($data['checks'] as $choice){
			array_push($choices,$choice->name);
		}
		$data['choices']=$choices;

		if(Input::file('candidatelist'))
	 	{
	 		$file =Input::file('candidatelist');
	
			$content = file_get_contents(Input::file('candidatelist')->getRealPath());
	    	//$content_arr=str_getcsv ( $content );
	    	$emails= explode("\n", $content);
	    	//print_r($emails);

	    	$key=Config::get('app.key');

			$password = Hash::make('secret');
			

			
			
			foreach($emails as $email)
			{ 
				$text=trim($email).",".$active_trial->id;
				$encrypted = md5($text);
				$data['token']=$encrypted;
				//print_r($trial_type);
				
				if($trial_type=='voteapprove'){
				$data['link']=route('voteapprove', array('token'=>$encrypted,'trial'=>$active_trial->id));
				
				}
				else if($trial_type=='choicevote'){
					$data['link']=route('choicevote', array('token'=>$encrypted,'trial'=>$active_trial->id));
					
					//die($data['type']);
				}
				else if ($trial_type=='askcomment'){
					$data['link']=route('askcomment', array('token'=>$encrypted,'trial'=>$active_trial->id));
				}
				else{
					$data['link']=route('appointment', array('token'=>$encrypted,'trial'=>$active_trial->id));
				}

				//die($active_trial);
				Mail::send('listemail', $data, function($message) use ($email,$active_trial,$encrypted)
				{
					//dd($user->email);
					
					$message->from('uttapong.rua@biotec.or.th', 'Uttapong Ruangrit');
				    $message->to($email,$email)->subject($active_trial->mailtitle);
					
				    //insert token
					//$new_log= array('trial' => $active_trial->id,'email'=>$email,'token'=>$encrypted);
					
					$saveLog=new Maillog;
					
					$saveLog->trial=$active_trial->id;
					$saveLog->email=$email;
					$saveLog->token=$encrypted;
					
					
					//die('test');
					$saveLog->save();
				});
			}

	    	return "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> The email(s) has been sent.</div>";

		}
		return "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error sending email(s), please try again.</div>";

	}

	public function mailresult($trialid)
	{
		$data=array('currentUser'=>Sentry::getUser());

		$active_trial=Trial::find($trialid);
		
		$emails=Maillog::where('trial','=',$trialid)->get();
		$data['link']=route('result',array($trialid));
		$data['trial']=$active_trial;
			
		foreach($emails as $email)
		{ 
			$text=trim($email).",".$active_trial->id;
			
			Mail::send('mailresult', $data, function($message) use ($email,$active_trial)
			{
				//dd($user->email);
				$message->from('uttapong.rua@biotec.or.th', 'Uttapong Ruangrit');
			    $message->to($email->email,$email->email)->subject('APBionet : Vote result of "'.$active_trial->title.'"');

			});
		}

	    return "All the result email(s) has been sent.";

		
		//return "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error sending email(s), please try again.</div>";

	}

	public function trial()
	{
		$data=array();
		$data['currentUser']=Sentry::getUser();

		$data['trials']=Trial::orderBy('created_date','desc')->paginate(10);


		return View::make('trial',$data);
	}

	public function edittrial($id)
	{
		$data=array();
		$data['currentUser']=Sentry::getUser();
		$trial=Trial::find($id);
		$data['trial']=$trial;


		return View::make('edittrial',$data);
	}

	public function preview($id)
	{
		$data=array();
		$trial=Trial::find($id);
		$data['trial']=$trial;

		$data['currentUser']=Sentry::getUser();


		$data['title']=$trial->title;
		$data['desc']=$trial->description;
		$data['type']=$trial->type;
		$data['choices']=$trial->choice;

		return View::make('previewmail',$data);
	}
	public function updatetrial($id){


		$new_trial = array(
		 'title' => Input::get('title'),
		 'description' => nl2br(Input::get('description')),
		 'type'=>Input::get('type'),
		 'created_date'=>date("Y-m-d H:i:s"),
		 'mailtitle'=>Input::get('mailtitle')
		 );
		 // let's setup some rules for our new data
		 // I'm sure you can come up with better ones
		$rules = array(
			'title' => 'required',
		 'description' => 'required',
		 'mailtitle'=>'required'
		 );

		if(Input::file('attach'))
	 	{
	 		
	 		$attach =Input::file('attach');
	 		//die($attach->getRealPath());
			$filename=uniqid();
			$destinationPath='./uploads/';
			$ext=trim(strtolower($attach->getClientOriginalExtension()));
			$attach->move($destinationPath, $filename.".".$ext);
			$new_trial['attach']=$filename.".".$ext;
		}



		 // make the validator
		$v = Validator::make($new_trial, $rules);
		 if ( $v->fails() )
		 {
		 // redirect back to the form with
		 // errors, input and our currently
		 // logged in user
		 	return $v->messages();;
		 
		 }
		 // create the new post
		

		if(strval(Trial::find($id)->update($new_trial))){
			
			$msg= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> New trial has been successfully updated.</div>";
		}
			
		else $msg= "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error updating trial, please try again.</div>";
			
		Session::flash('message', $msg);

		return Redirect::route('trial');
	}



	public function inserttrial(){

    	
		$new_trial = array(
		 'title' => Input::get('title'),
		 'description' => nl2br(Input::get('description')),
		 'type'=>Input::get('type'),
		 'created_date'=>date("Y-m-d H:i:s"),
		 'mailtitle'=>Input::get('mailtitle')
		 );
		 // let's setup some rules for our new data
		 // I'm sure you can come up with better ones
		$rules = array(
			'title' => 'required',
		 'description' => 'required',
		 'mailtitle'=>'required'
		 );

		if(Input::file('attach'))
	 	{
	 		
	 		$attach =Input::file('attach');
	 		//die($attach->getRealPath());
			$filename=uniqid();
			$destinationPath='./uploads/';
			$ext=trim(strtolower($attach->getClientOriginalExtension()));
			$attach->move($destinationPath, $filename.".".$ext);
			$new_trial['attach']=$filename.".".$ext;
		}
		
		 // make the validator
		$v = Validator::make($new_trial, $rules);
		 if ( $v->fails() )
		 {
		 // redirect back to the form with
		 // errors, input and our currently
		 // logged in user
		 	return $v->messages();;
		 
		 }
		 // create the new post
		$trial = new Trial($new_trial);

		if(strval($trial->save())){
			
			$msg= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> New trial has been successfully saved.</div>";
		}
			
		else $msg= "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error saving new trial, please try again.</div>";
			
		Session::flash('message', $msg);

		return Redirect::route('trial');
    }

    public function choice($id)
	{
		$data=array();
		$data['currentUser']=Sentry::getUser();

		$data['trial']=Trial::find($id);

		$data['choices']=Choice::where('trial','=',$id)->orderBy('order','asc')->paginate(10);


		return View::make('choice',$data);
	}

	public function insertchoice($id)
	{
		$new_choice = array(
		 'name' => Input::get('name'),
		 'trial'=>$id
		 );
		 // let's setup some rules for our new data
		 // I'm sure you can come up with better ones
		$rules = array(
			'name' => 'required'
		 );
		 // make the validator
		$v = Validator::make($new_choice, $rules);
		 if ( $v->fails() )
		 {
		 // redirect back to the form with
		 // errors, input and our currently
		 // logged in user
		 	return $v->messages();;
		 
		 }
		 // create the new post
		$choice = new Choice($new_choice);

		if(strval($choice->save())){
			$msg= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> New Candidate has been successfully saved.</div>";
		}
			
		else $msg= "<div class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error saving new candidate, please try again.</div>";
			
		Session::flash('message', $msg);

		return Redirect::route('choice',array($id));
	}

	public function removechoice($id)
	{

		if(Choice::find($id)){

		$choice=Choice::find($id);
		$trialid=$choice->trial;
		Choice::destroy($id);

		$msg= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Your choice has been successfully removed.</div>";
		Session::flash('message', $msg);
		
		}
		else{

			$msg= "<div class='alert alert-danger'><span class='glyphicon glyphicon-ok'></span> Sorry, we cant find the choice you would like to remove.</div>";
			Session::flash('message', $msg);
		}

		return Redirect::route('choice',array($trialid));


	}

	public function removetrial($id)
	{

		if(Trial::find($id)){

		Trial::destroy($id);

		$msg= "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Your trial has been successfully removed.</div>";
		Session::flash('message', $msg);
		
		}
		else{

			$msg= "<div class='alert alert-danger'><span class='glyphicon glyphicon-ok'></span> Sorry, we cant find the trial you would like to remove.</div>";
			Session::flash('message', $msg);
		}

		return Redirect::route('trial');


	}
	public function result($trialid){

		$data=array();
		$data['currentUser']=Sentry::getUser();
		$trial=Trial::find($trialid);
		$data['trial']=$trial;
		$chart=array();
		if($trial->type=='voteapprove'){
			
			$data['approve']=$trial->vote_approve;
			$data['disapprove']=$trial->vote_disapprove;
			$data['abstain']=$trial->vote_abstain;
			$all=$data['approve']+$data['disapprove']+$data['abstain'];
			//$data['no vote']=(Maillog::where('trial','=',$trialid)->count())-$all;
			//$data['chart']=json_encode($chart);
		}
		else if($trial->type=='choicevote'){
			
			$data['choice_result']=Trial::find($trialid)->choice;
			//$all=$data['approve']+$data['disapprove']+$data['abstain'];
			//$data['no vote']=(Maillog::where('trial','=',$trialid)->count())-$all;
			//$data['chart']=json_encode($chart);
		}
		else if($trial->type=='askcomment'){
			$data['comments']=Comment::where('trial','=',$trialid)->get();

		}
		else{
			$data['choice_result']=DB::select(DB::raw("SELECT concat(comment,' ',selectedtime) as name,count(concat(comment,' ',selectedtime)) as freq from comments where trial={$trialid} group by concat(comment,' ',selectedtime) order by concat(comment,' ',selectedtime) asc"));

			
		}

		return View::make('result',$data);
	}

		
	

}