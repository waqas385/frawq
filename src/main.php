<?php


// Load All Configuration files
foreach (glob(__DIR__ . '/config/*.php') as $filename) {
    require_once $filename;
}

// Load System files
foreach (glob(__DIR__ . '/system/*.php') as $filename) {
    require_once $filename;
}

// Load All Models files
foreach (glob(__DIR__ . '/models/*.php') as $filename) {
    require_once $filename;
}

// Load All Controllers files
foreach (glob(__DIR__ . '/controllers/*.php') as $filename) {
    require_once $filename;
}

use Config\Routes,
    Config\Filters,
    Database\DB;

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
            echo DB::$mysql_error."<br/>";
        }
        
        
        // Initialize class and call its action method
        $class = $classPath;
        $object = new $class();
        return $object->$classMethod();

    }

}

$main = new Main();
echo $main->run();

