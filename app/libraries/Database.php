<?php

/**
 * Database file
 * 
 */

 class Database
 {
     private $db_host = DB_HOST;
     private $db_user = DB_USER;
     private $db_pass = DB_PASS;
     private $db_name = DB_NAME;

     private $statement;
     private $handler;
     private $error;

     // Create Connection 
    public function __construct(){

          $this->conn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;
          $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          ];

          try{
            $this->handler = new PDO($this->conn,$this->db_user, $this->db_pass, $options);
    
          }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
           }
 
    }

    // Query 
    public function query($sql){
        $this->statement = $this->handler->prepare($sql);
    }

    // Bind Values
    public function bind($parameter, $value, $type = null){ 
     // Check the tye
        switch(is_null($type)){
            case is_int($value) :
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // Execute the statement
    public function execute(){
        $this->statement->execute();
    }

    // Return an array of results
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Return a specific row as obj
    public function singleRow(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

   // Return row count 

   public function rowCount(){
       $this->statement->rowCount();
   }


 }




?>