<?php


class Maillog extends Eloquent {

	public static $unguarded = true;
	
	public $timestamps=false;
	protected $table = 'maillogs';

	public function getchoice()
    {
        return true;
    }
    

    
    
    
}