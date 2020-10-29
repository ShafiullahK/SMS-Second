<?php

if(isset($_POST['submit'])){

    $project_name = $_POST['project_name'];
    $p_form = $_POST['p_form'];
    $p_to = $_POST['p_to'];
    $amount = $_POST['amount'];

    if($project->Create($project_name ,$p_form , $p_to , $amount)){
        
        echo "<script> window.location = 'project.php?insert'</script>";
    }else{

        echo "<script> window.location = 'project.php?notinsert'</script>";

    }
   
}

?>

