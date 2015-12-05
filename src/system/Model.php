<?php

namespace System;

use Database\DB;

class Model{
    
    private function prepareWhereClause($where){
        // Prepare where statement
        $index = 0;
        $whereClause = "";
        
        foreach($where as $key => $value){
            $whereClause .= "`".$key."` = ?";
            if($index < sizeof($where) - 1){
                $whereClause .= " AND ";
            }
            $index++;
        }
        return $whereClause;
    }
    
    private function prepareWhereOrClause($where){
        // Prepare where statement
        $index = 0;
        $whereClause = "";
        
        foreach($where as $key => $value){
            $whereClause .= "`".$key."` = ?";
            if($index < sizeof($where) - 1){
                $whereClause .= " Or ";
            }
            $index++;
        }
        return $whereClause;
    }
    
    protected function getType($string){
        if($string === 0){
            return 'i';
        }
        
        if(is_string($string)){
            return "s";
        }
        
        if(strrpos($string, '.') === false && strrpos($string, ' ') === false && intval($string) > 0){
            if(strlen($string) > 11){
                return "s";
            }
            return "i";
        }
        
        if(strrpos($string, '.') !== false && strrpos($string, ' ') === false && floatval($string) > 0){
            return "d";
        }
        
                
        if(is_double($string)){
            return "b";
        }
    }
    
    
    public function save($table, $cols, $where = array()){
        if(count($where) > 0){
            return $this->update($table, $cols, $where);
        }else{
            return $this->insert($table, $cols);
        }
    }
    
    /**
     * Insert record in table, return last inserted record id on successfull insertion
     * @param type $table
     * @param type $cols
     * @return type
     */
    public function insert($table, $cols){
        $db = DB::connection();
        // create prepare statement
        $query = "INSERT INTO `".$table."` ";
        $colName = "";
        $colValue = "";
        $index = 0;
        foreach($cols as $column => $value){
            $colName .= "`".$column."`";
            $colValue .= "?";
            if($index < sizeof($cols) - 1){
                $colName .= ",";
                $colValue .= ",";
            }
            $index++;
        }
        
        $query = $query."(".$colName.") VALUES (".$colValue.") ";
         
        $stmnt = mysqli_prepare($db, $query);
        call_user_func_array('mysqli_stmt_bind_param', $this->bindPrepareArray($stmnt, $cols));

        try {
            mysqli_stmt_execute($stmnt);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
        return mysqli_insert_id($db);
    }
    
    private function bindPrepareArray($stmnt, $cols){
        // bind params
        $params = array();
        $params_type = "";
      
        // Populate params type
        foreach($cols as $key => $value){
            $params_type .= $this->getType($value);    
        }
        
        $params[] = &$stmnt; 
        $params[] = $params_type;    
        
        // Populate param
        $arr = array_values($cols);
        for($i = 0; $i < count($arr); $i++){
            $params[] = &$arr[$i];
        }
        
        return $params;
    }
    
    /**
     * Update the record in table 
     * @param type $table
     * @param type $cols
     * @param string $where
     * @return boolean
     */
    public function update($table, $cols, $where){
        $db = DB::connection();
        // create update statement
        $query = "UPDATE `".$table."` SET ";
        $colNameValue = "";
        $whereClause = "";
        $index = 0;
        $id = $cols['id'];
        // unset id/Id
        unset($cols['id']);
        
        foreach($cols as $column => $value){
            $colNameValue .= "`".$column ."` = ?";
            if($index < sizeof($cols) - 1){
                $colNameValue .= ",";
            }
            $index++;
        }
        
        $query = $query.$colNameValue." WHERE ".$this->prepareWhereClause($where);
        
        $stmnt = mysqli_prepare($db, $query);
        
        // add id/Id to complete the process
        $cols['id'] = $id;
        //print_r($this->bindPrepareArray($stmnt, $cols));die;
        call_user_func_array('mysqli_stmt_bind_param', $this->bindPrepareArray($stmnt, $cols));    
        try {
            mysqli_stmt_execute($stmnt);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
        return TRUE;
    }
    
    
    public function delete($table, $where){
        $db = DB::connection();
        $query = "DELETE FROM `".$table."` WHERE ";
        $query = $query.$this->prepareWhereClause($where);
        
        // create prepare statement
        $stmnt = mysqli_prepare($db, $query);
        
        // bind params to statement
        call_user_func_array('mysqli_stmt_bind_param', $this->bindPrepareArray($stmnt, $where));    
        
        try {
            mysqli_stmt_execute($stmnt);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
        return TRUE;
    }
    
    /**
    * Query should be prepare statement type
    */
    public function statement($query, $params = array()){
        $db = DB::connection();
        $row = null;
        // Where params is given
        if(count($params) > 0){
            
            $stmnt = mysqli_prepare($db, $query);
            call_user_func_array('mysqli_stmt_bind_param', $this->bindPrepareArray($stmnt,$params));
            mysqli_stmt_execute($stmnt);
            $result = mysqli_stmt_get_result($stmnt);
           
        }else{
            $result = mysqli_query($db, $query);    
        }
        
        
        try {
            $rows = array();
            while($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
        //return (count($rows) == 1) ? $rows[0] : $rows;
        return $rows;
    }
    
    /**
    * $searchType (AND, OR, LIKE)
    */
    public function prepareSearchQuery($searchArr, $searchType = "AND"){
        $query = "";
        switch($searchType){
            case "AND":
                $index = 0;
                foreach($searchArr as $key => $value){
                    
                    if($this->getType($value) === "s"){
                        $query .= "`".$key."` = '".$value."'";
                    }else{
                        $query .= "`".$key."` = ".$value."";
                    }
                    if($index < sizeof($searchArr) - 1){
                        $query .= " AND ";
                    }
                    $index++;
                }
                break;
            case "OR":
                $index = 0;
                foreach($searchArr as $key => $value){
                    
                    if($this->getType($value) === "s"){
                        $query .= "`".$key."` = '".$value."'";
                    }else{
                        $query .= "`".$key."` = ".$value."";
                    }
                    if($index < sizeof($searchArr) - 1){
                        $query .= " AND ";
                    }
                    $index++;
                }
                break;
            case "LIKE":
                $index = 0;
                foreach($searchArr as $key => $value){
                    $query .= "`".$key."` LIKE '%".$value."%'";
                    if($index < sizeof($searchArr) - 1){
                        $query .= " OR ";
                    }
                    $index++;
                }
                break;
        }
        
        return $query;
    }
    
    public function getCount($table, $searchKey = array()){
        if(!empty($searchKey) && count($searchKey) > 0){
            $whereClause = $this->prepareSearchQuery($searchKey, 'LIKE');
            $records = $this->statement("SELECT count(*) AS total_records FROM `".$table."` WHERE ".$whereClause);
        }else{
            $records = $this->statement("SELECT count(*) AS total_records FROM `".$table."`");
        }
        
        return $records[0]['total_records'];
    }
    
    public function find($table, $id){
        $data = $this->statement("SELECT * FROM `".$table."` WHERE `id` = ?", array('id' => $id));  
        if(count($data) == 1){
            $data = $data[0];
        }
        return $data;
    }
}