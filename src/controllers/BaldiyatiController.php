<?php

namespace controllers;

use View,Input;

class BaldiyatiController extends \Controller{
	
	public function createVoter(){
		return "Create Voter";
		
	}
	
	public function saveVoter(){
            echo Input::get('asss');
            return View::make('forms.voter', array('hello' => "Hello World"));
	}
	
	public function listVoters(){
		return "List Voters";
	}
	
	public function printVoters(){
		return "Print Voters";
	}
	
}