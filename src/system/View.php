<<<<<<< HEAD
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
        $absolute_path = __DIR__."/../views/";
        
        if(count($path) > 1){
            foreach($path as $index => $folder){
                if($index < count($path) - 1){
                    $absolute_path .= $folder."/";
                }
            }
            $viewFile = $path[count($path) - 1].".php";
        }else{
            
            $viewFile = $path[0].".php";
        }
        extract($params);
        if(!empty($_REQUEST['bypass_action']) && $_REQUEST['bypass_action'] == 1){
            extract($_REQUEST);
        }
        
        ob_start();?>
        <?php 
            include $absolute_path.$viewFile;
        ?>
        <?php
        $output = ob_get_contents();
        ob_get_clean();
        return $output;
    }
}

=======
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
        $absolute_path = __DIR__."/../views/";
        
        if(count($path) > 1){
            foreach($path as $index => $folder){
                if($index < count($path) - 1){
                    $absolute_path .= $folder."/";
                }
            }
            $viewFile = $path[count($path) - 1].".php";
        }else{
            
            $viewFile = $path[0].".php";
        }
        extract($params);
        if(!empty($_REQUEST['bypass_action']) && $_REQUEST['bypass_action'] == 1){
            extract($_REQUEST);
        }
        
        ob_start();?>
        <?php 
            include $absolute_path.$viewFile;
        ?>
        <?php
        $output = ob_get_contents();
        ob_get_clean();
        return $output;
    }
}

>>>>>>> e1265c9c990972ddd53c4de783f4311101627310
