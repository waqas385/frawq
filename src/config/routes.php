<?php
namespace Config;

class Routes{
	
    public static $routes = array(
//            '/' => array('uses' => '\Controllers\IndexController@index', 'before' => 'isLoggedIn'),
            '/' => array('uses' => '\Controllers\IndexController@index'),
    );
        
    // example to call filter before action calling in controller
    /*
    public static $routes = array(
            'login' => array('uses' => '\Controllers\IndexController@login', 'before' => 'staticFunctionName')
    );*/
	
}