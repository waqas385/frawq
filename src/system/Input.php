<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Input{
    
    
    /**
     * Parse $_REQUEST array and return value against key
     * @param type $key
     * @param type $defaultValue
     * @return type
     */
    public static function get($key, $defaultValue = ""){
        return !empty(self::getRequest()[$key]) ? self::getRequest()[$key] : $defaultValue;
    }
    
    public static function all(){
        $inputs = array();
        foreach(self::getRequest() as $key => $value){
            if($key != 'path' && $key != 'previous_url'){
                $inputs[$key] = $value;
            }
        }
        return $inputs;
    }
    
    /**
     * Set variable in $_REQUEST
     * @param type $key
     * @param type $value
     */
    public static function set($key, $value){
        self::setRequestVar($key, $value);
        
    }
    
    private static function getRequest(){
        return $_REQUEST;
    }
    
    /**
     * 
     * @param type $key
     * @param type $value
     * @return type
     */
    private static function setRequestVar($key, $value){
        return !empty($_REQUEST[$key]) ? $_REQUEST[$key] = $value  : false;
    }
    
}