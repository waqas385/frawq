<?php
namespace Config;

class Routes{
	
    public static $routes = array(
            'login' => array('uses' => '\Controllers\IndexController@login'),
            'do-login' => array('uses' => '\Controllers\IndexController@doLogin'),
            'form'	=> array('uses' => '\Controllers\BaldiyatiController@createVoter', 'before' => 'isLoggedIn'),
            'save-form'	=> array('uses' => '\Controllers\BaldiyatiController@saveVoter', 'before' => 'isLoggedIn'),
            'list'	=> array('uses' => '\Controllers\BaldiyatiController@listVoters', 'before' => 'isLoggedIn'),
            'print' => array('uses' => '\Controllers\BaldiyatiController@printVoters', 'before' => 'isLoggedIn'),
    );
        
    // example to call filter before action calling in controller
    /*
    public static $routes = array(
            'login' => array('uses' => '\Controllers\IndexController@login', 'before' => 'staticFunctionName')
    );*/
	
}