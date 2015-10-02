<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class View{
    /**
     * Return view of desired file
     * @param type $viewPath
     * @param type $params
     * @return type
     */
    public static function make($viewPath, $params = array()){
        $path = explode(".",$viewPath);
        $absolute_path = __DIR__."/../views/".$path[0]."/";
        $viewFile = $path[1].".php";
        extract($params);
        ob_start();?>
        <?php include $absolute_path.$viewFile;?>
        <?php
        $output = ob_get_contents();
        ob_get_clean();
        return $output;
    }
}

