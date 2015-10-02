<?php
namespace Config;

class Filters{
	
    public static function isLoggedIn(){
//        return (!empty($_SESSION['user'])) ? true : false;
        return true;
        
    }
	
}