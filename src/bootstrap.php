<?php

// Autoload functionality

function __autoload($className){
    $parts = explode('\\', $className);
    // For Database classes, naming convention is different
    if(end($parts) == "DB"){
        require_once __DIR__ . '/system/Database.php';
    }
    if(end($parts) == "DBSettings"){
        require_once __DIR__ . '/config/database.php';
    }
    
    if(file_exists(__DIR__ . '/config/'.end($parts).'.php')){ // Load All Configuration files
        require_once __DIR__ . '/config/'.end($parts).'.php';
    }
    elseif(file_exists(__DIR__ . '/system/'.end($parts).'.php')){ // Load System files
        require_once __DIR__ . '/system/'.end($parts).'.php';
    }
    elseif(file_exists(__DIR__ . '/models/'.end($parts).'.php')){ // Load All Models files
        require_once __DIR__ . '/models/'.end($parts).'.php';
    }
    elseif(file_exists(__DIR__ . '/controllers/'.end($parts).'.php')){ // Load All Controllers files
        require_once __DIR__ . '/controllers/'.end($parts).'.php';
    }
    else{
        return FALSE;
    }
}

use Config\Routes as Routes,
    Config\Filters as Filters,
    Database\DB as DB;

class Main {

    public $request;
    public $server;
    public $post;
    public $get;
    public $uri;

    function __construct() {
        $this->server = $_SERVER;
        $this->request = $_REQUEST;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->uri = substr($_SERVER['REQUEST_URI'], 1);
        $base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
    
    public function callClassMethod($classPath, $classMethod){
        $class = $classPath;
        $object = new $class();
        return $object->$classMethod();
    }

    public function run() {
        $action = "";
        $params = "";
        $uriArr = explode('/', $this->uri);
        
        if (($uriArr[0] == "" || $uriArr[0] == "/")) {
            $action = "/";
            $params = "";
        }else{
            $action = $uriArr[0];
            $params = (!empty($uriArr[1])) ? $uriArr[1] : false;
        }
        
        if(empty(Routes::$routes[$action])){
            return "404 Not Found";
        }
        
        // Set current action
        \App::$current_action = $action;
        
        
        // Find controller class and its action
        // against current
        $classData = explode('@', Routes::$routes[$action]['uses']);
        $classPath = $classData[0];
        $classMethod = $classData[1];
        
        // Before calling action, call filter if any filter added
        if (!empty(Routes::$routes[$action]['before'])) {
            $beforeRet = "";
            $beforeArr = explode("|", Routes::$routes[$action]['before']);
            
            foreach ($beforeArr as $filter) {
                // check if the filters has implementation in any other class
                if(strpos($filter, '@') !== FALSE){
                    $filterClassData = explode("@", $filter);
                    $filterClassPath = $filterClassData[0];
                    $filterClassMethod = $filterClassData[1];
                    $beforeRet = $this->callClassMethod($filterClassPath, $filterClassMethod);
                    
                }else{
                    $beforeRet = Filters::$filter();
                }
                
                if($beforeRet == "" || $beforeRet === true){
                    continue;
                }else{
                    return $beforeRet;
                }
            }
        }

        // DB connection
        if(!DB::connection()){
            App::$message = DB::$mysql_error;
        }
        
        // Initialize class and call its action method
        $class = $classPath;
        $object = new $class();
        return $object->$classMethod();

    }

}