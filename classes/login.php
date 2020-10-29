<?php

session_start();

// Include DB connection
include_once "../lib/db.php";

class Login extends db {

    public function ViewData($sql , $pass){

        $select = $this->db->prepare($sql);

        $select->setFetchMode(PDO::FETCH_ASSOC);

        $select->execute();

        $data = $select->fetch();

        if(!password_verify($pass, $data['password'])){
            exit(header("location: ../login.php?fail"));

        } else {
            
            // Set sessions
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];

            // Check sessions
            if (isset($_SESSION['password']) && isset($_SESSION['email'])) {
                exit(header("location: ../index.php"));
            }
        }      

    }


}
?>

