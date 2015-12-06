<?php
namespace Config;

use View, Redirect;

class Filters{
	
    public static function isLoggedIn(){
        if((!empty($_SESSION['user']))){
            return true;
        }else{
            
            $home = View::make('forms.login');
            return View::make('main', array('content' => $home));
        }
    }
    
    public static function isAdmin(){
        if(!empty($_SESSION['user']) && $_SESSION['user'] == "admin@admin.com"){
            return TRUE;
        }
        
        return Redirect::to("/list",array("message" => "You dont have permission to view this link"));
        
    }
	
}