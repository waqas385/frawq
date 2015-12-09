<<<<<<< HEAD
<?php

namespace Models;

use Database\DB, System\Model;

class HelperModel extends Model {
    /*
     * Table name as used in DB
     */
    protected $table = 'users';
    
    /*
     * Some helping methods
     */
    
    // find by ID
    public function find($id){
        return parent::find($this->table, $id);
    }
    
    // Save form data
    public function save($data){
        
        if(array_key_exists('id', $data)){
            return parent::save($this->table,$data,array('id' => $data['id']));
        }
        
        return parent::save($this->table,$data);
        
    }
    
    // Get total number of records count
    public function getRecordCount(){
        $records = $this->statement("SELECT count(*) AS total_records FROM `voters`");
        return $records[0]['total_records'];
    }
    
    // fetch data from table
    public function select($limit = 10, $offset = 0 ){
        return $this->statement("SELECT * FROM `voters` LIMIT ".$limit." OFFSET ".$offset);
    }
    
    // delete data from the table
    public function delete($where){
        return parent::delete($this->table,$where);
    }
    
=======
<?php

namespace Models;

use Database\DB, System\Model;

class HelperModel extends Model {
    /*
     * Table name as used in DB
     */
    protected $table = 'users';
    
    /*
     * Some helping methods
     */
    
    // find by ID
    public function find($id){
        return parent::find($this->table, $id);
    }
    
    // Save form data
    public function save($data){
        
        if(array_key_exists('id', $data)){
            return parent::save($this->table,$data,array('id' => $data['id']));
        }
        
        return parent::save($this->table,$data);
        
    }
    
    // Get total number of records count
    public function getRecordCount(){
        $records = $this->statement("SELECT count(*) AS total_records FROM `voters`");
        return $records[0]['total_records'];
    }
    
    // fetch data from table
    public function select($limit = 10, $offset = 0 ){
        return $this->statement("SELECT * FROM `voters` LIMIT ".$limit." OFFSET ".$offset);
    }
    
    // delete data from the table
    public function delete($where){
        return parent::delete($this->table,$where);
    }
    
>>>>>>> e1265c9c990972ddd53c4de783f4311101627310
}