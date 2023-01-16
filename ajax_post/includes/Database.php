<?php
 class Database{

   private $host = "localhost";
   private $db_name = "ajax_tuts";
   private $username = "root";
   private $password = "";
   public $conn;

   //get the database connection
   public function getConnection(){
     $this->conn = NULL;

     try{
       $this->conn = new PDO('mysql:host=' . $this->host .';dbname=' .$this->db_name, $this->username, $this->password);
       $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
     }
     return $this->conn;

   }//function getConnection Ends

 }// class Database ends
 ?>
