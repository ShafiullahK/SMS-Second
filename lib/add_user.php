<?php
// Include DB connection becouse of user menu
include_once "db.php";

// Include Signup Class connection
include_once "../classes/add_user.php";

$user_menu = new addUser();

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = $_POST['pass'];
    $con_pass = $_POST['con_pass'];

    if($pass != $con_pass){

        header("location:../add_user.php?fail");

    }else if($user_menu->create($name , $email , $role , $pass , $con_pass)){

        header("location:../index.php?success");

    }

}   


?>
