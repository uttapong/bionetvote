<?php


class Trial extends Eloquent {


	public static $unguarded = true;
	
	public $timestamps=false;
	protected $table = 'trial';

	public function choice()
    {
        return $this->hasMany('Choice','trial');
    }
    public function format_created_date(){
    	return date("j M y H:i:s",strtotime($this->created_date));
    }

    public function trimDescription(){
        return iconv_substr(strip_tags($this->description),0,60, "UTF-8");
    }
    public function trimTitle(){
        return iconv_substr($this->title,0,30, "UTF-8");
    }

    
    
    
}