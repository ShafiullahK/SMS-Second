<?php

class db {
    public $db;

    // Create DataBase connection
    public function __construct(){
        try{

            $this->db= new PDO("mysql:host=localhost;dbname=sms","root","");

        }catch(PDOException $e){
            echo "Error Some Problem" . $e->getMessage();
        }
        
    }
}

?>

  



