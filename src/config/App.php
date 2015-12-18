<?php

class App{
    // update the base_url with the server name you added in vhosts
    // in my case it is : 
    public static $base_url = "http://myfrawq.local/";
    public static $current_action = "";
    public static $message = "";
    public static $message_type = "";
    
    public static function showMessage(){
        $message = self::$message;
        $type = "alert-info";
        switch(self::$message_type){
            case "info":
                $type = "alert-info";
                break;
            case "warning":
                $type = "alert-warning";
                break;
            case "success":
                $type = "alert-success";
                break;
            case "danger":
            case "error":
                $type = "alert-danger";
                break;
        }
        
        return !empty($message) ? $message = '<div class="col-sm-6 col-sm-offset-3 alert '.$type.'" role="alert"> '.$message.' </div>' : "";
        
    }
}