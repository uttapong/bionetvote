<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::any('/', array('before' => 'authened','as'=>'home','uses'=>'AdminController@home'));

Route::any('/trial', array('before' => 'authened','as'=>'trial','uses'=>'AdminController@trial'));
Route::any('/edittrial/{id}', array('as'=>'edittrial','uses'=>'AdminController@edittrial'));
Route::any('/updatetrial/{id}', array('as'=>'updatetrial','uses'=>'AdminController@updatetrial'));
Route::any('/removetrial/{id}', array('as'=>'removetrial','uses'=>'AdminController@removetrial'));
Route::any('/preview/{id}', array('as'=>'preview','uses'=>'AdminController@preview'));

Route::any('/inserttrial', array('as'=>'inserttrial','uses'=>'AdminController@inserttrial'));
Route::any('/choice/{id}', array('as'=>'choice','uses'=>'AdminController@choice'));
Route::any('/removechoice/{id}', array('as'=>'removechoice','uses'=>'AdminController@removechoice'));
Route::any('/insertchoice/{id}', array('as'=>'insertchoice','uses'=>'AdminController@insertchoice'));
Route::any('/preview/{id}', array('as'=>'preview','uses'=>'AdminController@preview'));

Route::any('/voteapprove/{token}/{trial}/{choice}', array('as'=>'voteapprove','uses'=>'VoteController@approve'));
Route::any('/choicevote/{token}/{trial}', array('as'=>'choicevote','uses'=>'VoteController@choicevote'));
Route::any('/askcomment/{token}/{trial}', array('as'=>'askcomment','uses'=>'VoteController@askcomment'));
Route::any('/appointment/{token}/{trial}', array('as'=>'appointment','uses'=>'VoteController@appointment'));

Route::any('/choicevoteform/{token}/{trial}', array('as'=>'choicevoteform','uses'=>'VoteController@choicevoteform'));
Route::any('/askcommentform/{token}/{trial}', array('as'=>'askcommentform','uses'=>'VoteController@askcommentform'));
Route::any('/appointmentform/{token}/{trial}', array('as'=>'appointmentform','uses'=>'VoteController@appointmentform'));


Route::any('/mailresult/{id}', array('as'=>'mailresult','uses'=>'AdminController@mailresult'));
Route::any('/result/{id}', array('as'=>'result','uses'=>'AdminController@result'));
Route::any('/addfile', array('as'=>'addfile','uses'=>'AdminController@addfile'));

Route::filter('authened', function()
{

    if (!Sentry::getUser())
    {
        return Redirect::to('/dashboard/login');
    }
});