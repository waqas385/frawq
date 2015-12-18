<?php
namespace Config;

class Routes{
	
    public static $routes = array(
            '/' => array('uses' => '\Controllers\IndexController@index'),
            'login' => array('uses' => '\Controllers\IndexController@login'),
            'do-login' => array('uses' => '\Controllers\IndexController@doLogin'),
            'logout' => array('uses' => '\Controllers\IndexController@logout'),
            'dashboard' => array('uses' => '\Controllers\IndexController@dashboard', 'before' => 'isLoggedIn'),
    );
        
    // example to call filter before action calling in controller
    /*
    public static $routes = array(
            'login' => array('uses' => '\Controllers\IndexController@login', 'before' => 'staticFunctionName')
    );*/
	
}