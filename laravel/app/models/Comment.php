<?php


class Comment extends Eloquent {

	static $unguarded = true;

	public $timestamps=false;
	protected $table = 'comments';
	

	public function trial()
    {
        return $this->belongsTo('Trial','trial');
    }
    

    
    
    
}