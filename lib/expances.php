<?php

if(isset($_POST['submit'])){

    $expances = $_POST['expances'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];




    if($expaneX ->Create($expances , $amount , $date)){

      echo "<script> window.location = 'expances.php?insert' </script>";

    }else{

      echo "<script> window.location = 'expances.php?fail' </script>";
    }


    
  

}

?>
