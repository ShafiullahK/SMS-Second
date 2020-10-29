<?php

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $expances = $_POST['expances'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    if($expaneX->Update($id , $expances , $amount ,  $date)){

       echo "<script> window.location = 'expances.php?updated'</script>";

    }else{

        echo "<script> window.location = 'expances.php?notupdated'</script>";

    }
    
}



?>
