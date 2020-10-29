<?php


// Include Login Class
include_once "../classes/login.php";

$login = new Login();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $pass = $_POST['pass'];


   $sql = "SELECT * FROM `login` WHERE email = '$email'";
    $login->ViewData($sql , $pass);

}




?>