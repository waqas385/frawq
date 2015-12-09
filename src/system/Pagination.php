<?php

namespace System;

use System\Model;

class Pagination{
    
    
    
    public static function createPagination($table, $search = array(), $limit = 20, $page = 1){
        $data = array();
        $offset = ( $page - 1 ) * $limit;
        $model = new Model();
        $total_records = $model->getCount($table, $search);
        $total_pages = ceil($total_records / $limit);
        $pagination = array(
            'total_pages' => $total_pages,
            'current_page' => $page,
            'previous_page' => $page - 1,
            'next_page' => $page + 1,
            'data' => $data
        );
         
        // make sure selected page number is less than total_pages
        // then fetch records
        if(($page - 1) < $total_pages){
            if(!empty($search) && count($search) > 0){
               $query = "SELECT * FROM `".$table."` WHERE ".$model->prepareSearchQuery($search, "LIKE")." LIMIT ".$limit." OFFSET ".$offset;
               $pagination['data'] = $model->statement($query);  
            }else{
               $pagination['data'] = $model->statement("SELECT * FROM `".$table."` LIMIT ".$limit." OFFSET ".$offset);
            }
            
        }
        
        return $pagination;
    }
}