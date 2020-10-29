<?php

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $project_name = $_POST['project_name'];
    $p_from = $_POST['p_from'];
    $p_to = $_POST['p_to'];
    $amount = $_POST['amount'];

    if($project->Update($id , $project_name , $p_from , $p_to , $amount)){

        echo "<script> window.location = 'project.php?updated'</script>";

    }else{

        echo "<script> window.location = 'project.php?notupdated'</script>";

    }
    
}




?>
