<?php
	
        
        // Load All Configuration files
        foreach(glob(__DIR__.'\config\*.php') as $filename){
            require_once $filename;
        }
        
        // Load System files
        foreach(glob(__DIR__.'\system\*.php') as $filename){
            require_once $filename;
        }
        
        // Load All Controllers files
        foreach(glob(__DIR__.'\controllers\*.php') as $filename){
            require_once $filename;
        }
        // Load All Models files
        foreach(glob(__DIR__.'\models\*.php') as $filename){
            require_once $filename;
        }
        
        use Config\Routes, Config\Filters;
	
	class Main{
		
		public $request;
		public $server;
		public $post;
		public $get;
		public $uri;
		
		function __construct(){
			$this->server = $_SERVER;
			$this->request = $_REQUEST;
			$this->post = $_POST;
			$this->get = $_GET;
			$this->uri = substr($_SERVER['REQUEST_URI'], 1);
			
		}
                
		public function run(){
			$action = "";
			$params = "";
			$uriArr = explode('/', $this->uri);
			if(count($uriArr) > 0){
				$action = $uriArr[0];
				$params = $uriArr[1];
			}
			
			echo $action."<br/>";
			echo $params."<br/>";
			
			// Find controller class and its action
                        // against current
			$classData = explode('@',Routes::$routes[$action]['uses']);
			$classPath = $classData[0];
			$classMethod = $classData[1];
			
			// Before calling action, call filter if any filter added
			$beforeArr = explode("|",Routes::$routes[$action]['before']);
			if(count($beforeArr) > 0){
                            foreach($beforeArr as $filter){
                                if(!Filters::$filter()){
                                    echo "YOu need to pass before functionality to view this";
                                    exit();
                                }
                            }
                            
			}
			
			// Initialize class and call its action method
			$class = $classPath;
			$object = new $class();
			echo $object->$classMethod();
			
		}
	}
	
	$main = new Main();
	$main->run();
	
