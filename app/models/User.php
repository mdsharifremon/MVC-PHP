<?php

/**
 * Model Class
 * 
 */
class User{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
     }

     public function getUser(){
         $this->db->query("SELECT * FROM user"); 
         $result = $this->db->resultSet();
         return $result;
     }

}


?>