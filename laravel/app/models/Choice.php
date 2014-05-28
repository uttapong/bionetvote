<?php


class Choice extends Eloquent {


	static $unguarded = true;
	
	public $timestamps=false;
	protected $table = 'choices';

	public function getchoice()
    {
        return $this->belongsTo('Choice','choice');
    }
    
   
    
}