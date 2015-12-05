<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Database;

use Config\DBSettings;

class DB{
    private static $dbconnection;
    public static $mysql_error;
    
    private function __construct() {}
    
    public static function connection($cname = ""){
        if(!empty(self::$dbconnection)){
            return self::$dbconnection;
        }
        
        if(empty($cname)){
            $dbSettings = DBSettings::$settings['mysql'];
        }else{
            $dbSettings = (!empty(DBSettings::$settings[$cname])) ? DBSettings::$settings[$cname] : false ;
        }
        
        if($dbSettings){
            self::$mysql_error = "Please provide database information under file 'database' placed under config folder";
        }

        try {
            $dbconnection = mysqli_connect($dbSettings['server'], $dbSettings['username'], $dbSettings['password'], $dbSettings['database']);
            mysqli_set_charset($dbconnection,'utf8');
            if (mysqli_connect_errno()){
                self::$mysql_error = "Could not connect :". mysqli_connect_error();
            }
            return self::$dbconnection = $dbconnection;
            
        } catch (Exception $exc) {
            self::$mysql_error = $exc->getTraceAsString();
        }

        return false;
    }
    
    public static function statement($query){
        if(empty(self::$dbconnection)){
            self::$mysql_error = "Connection lost, please connect to database again";
            return false;
        }
        
        $result = mysqli_query(self::$dbconnection, $query);
        
        if(count(mysqli_error_list(self::$dbconnection)) > 0){
            self::$mysql_error = mysqli_error_list(self::$dbconnection);
            return false;
        }
        
        return $result;
    }
    
    
}