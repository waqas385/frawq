<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Config\Routes;

class Redirect{
    /**
     * Return view of desired file
     * @param type $viewPath
     * @param type $params
     * @return type
     */
    public static function to($key, $params = array()){
        $previous_url = "";
        $bypass_action = "1";
        if(!empty($_SERVER['HTTP_REFERER'])){
            $previous_url = $_SERVER['HTTP_REFERER'];
        }
        
        ?>
<div style="display: none">
<form action="<?php echo $key ?>" method="post">
        <?php foreach($params as $key => $value){?>
    <input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" />
        <?php } ?>
    
        <?php foreach($_REQUEST as $key => $value){?>
    <input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" />
        <?php } ?>
    <input type="text" name="previous_url" value=" <?php echo $previous_url?>" />
    <input type="text" name="bypass_action" value=" <?php echo $bypass_action?>" />
</form>
    <script>
        window.onload = document.forms[0].submit();
    </script>
</div>
<?php
        exit();
    }
}

