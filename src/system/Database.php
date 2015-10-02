<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace database;


class DB{
    private $dbname;
    private $uname;
    private $pwd;
    private static $dbconnection;
    
    public function __construct() {
        
    }
    
    public static function connection($cname){
        if(!empty(self::$dbconnection)){
            return $dbconnection;
        }
        $dbSettings = (!empty(\database::$connection($cname))) ? \database::$connection($cname) : false ;
        if($dbSettings){
            return "Please provide database information under file 'database' placed under config folder";
        }
        
        try {
            $dbconnection = mysql_connect($dbSettings['server'], $dbSettings['username'], $dbSettings['password']);
            if(!$dbconnection){
                return "Could not connect :". mysql_error();
            }
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }

        
    }
    
    
}