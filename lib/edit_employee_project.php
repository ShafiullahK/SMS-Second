<?php


if(isset($_POST['submit'])){

    $emp_id = $_POST['emp_id'];
    $proj_id = $_POST['proj_id'];
    $project = $_POST['project_id'];
    $employee = $_POST['employee_id'];
    $new_amount = $_POST['amount'];
    $old_amount = $_POST['old_amount'];
    $date = $_POST['date'];


    // SELECT project amount 
    $sql = "SELECT project.amount FROM `project` WHERE id = :project_id";

    $total = $employee_project->updateAmount($sql , $proj_id);

   

    // TOTAL SUM Query
    $project_employee_total = "SELECT SUM(amount) as `total` FROM `employee_project` WHERE project_id = :project_id";

    $emp_total = $employee_project->updateSum($project_employee_total , $proj_id) - (int)$old_amount + $new_amount ;

     

    if($emp_total > $total){

       echo "<strong><span class='badge badge-pill badge-warning' style='padding:7px; font-size:12px; '>Project budget is out of range</span></strong>";


    }else{

        if($employee_project->Update($emp_id , $proj_id ,  $project , $employee , $new_amount , $date)){

             // Include History Class
            include_once "classes/history.php";
            $history = new History();

            $history->Update($emp_id , $proj_id ,  $project , $employee , $new_amount , $date);

                echo "<script>window.location = 'employee_project.php?updated' </script>";
        
            }else{

                echo "<script>window.location = 'employee_project.php?notupdated' </script>";

            }

    }

   
}



?>

