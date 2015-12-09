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
        
        $dbSettings = null;
        
        if(empty($cname) && !empty(DBSettings::$settings['mysql'])){
            // get default DB settings added with under index 'mysql'
            $dbSettings = DBSettings::$settings['mysql'];
        }elseif(!empty($cname)){
            $dbSettings = (!empty(DBSettings::$settings[$cname])) ? DBSettings::$settings[$cname] : false ;
        }
        
        if(empty($dbSettings)){
            \App::$message =  self::$mysql_error = "Please provide database information under file 'database' placed under config folder";
            \App::$message_type = 'info';
            return false;
        }

        try {
            $dbconnection = mysqli_connect($dbSettings['server'], $dbSettings['username'], $dbSettings['password'], $dbSettings['database']);
            mysqli_set_charset($dbconnection,'utf8');
            if (mysqli_connect_errno()){
                \App::$message = self::$mysql_error = "Could not connect :". mysqli_connect_error();
                \App::$message_type = 'error';
            }
            return self::$dbconnection = $dbconnection;
            
        } catch (Exception $exc) {
            self::$mysql_error = $exc->getTraceAsString();
        }

        return false;
    }
    
    public static function statement($query){
        if(empty(self::$dbconnection)){
            \App::$message = self::$mysql_error = "Connection lost, please connect to database again";
            \App::$message_type = 'error';
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
