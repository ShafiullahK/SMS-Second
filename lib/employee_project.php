<?php

if(isset($_POST['submit'])){

    $project_id = $_POST['project_id'];
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];


    // SELECT Project amount

    $sql = "SELECT project.amount FROM `project` WHERE id = :project_id ";

    $total = $employee_project->getAmount($sql , $project_id);


    // Total SUM Query
    $project_employee_total = "SELECT SUM(amount) as `total` FROM `employee_project` WHERE project_id = :project_id";

    $Data =  $employee_project->getSum($project_employee_total , $project_id) + $amount;



    if($Data > $total){
        
        echo "<strong><span class='badge  badge-pill badge-warning' style='padding:7px ; font-size:12px;'>Project budget is out of range</span></strong>";
       

    }else{

        if($employee_project->Create($project_id , $employee_id , $amount , $date)){

            // history
            include_once "classes/history.php";
            $history = new History();
            
            $history->Insert($project_id , $employee_id , $amount , $date);


            echo "<script> window.location = 'employee_project.php?insert'</script>";

        }else {

                echo "<script> window.location = 'employee_project.php?notinsert'</script>";

        }
    }
  }

?>