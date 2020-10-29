<?php


if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];
    $basic_salary = $_POST['basic_salary'];
    $medical = $_POST['medical'];
    $insurance = $_POST['insurance'];

    $netpay = (int)$basic_salary - ((int)$medical + (int)$insurance);

    if($salary->Update($id , $employee_id , $basic_salary , $medical , $insurance , $netpay)){

        echo "<script> window.location = 'salary.php?update'</script>";
    }else{

        echo "<script> window.location = 'salary.php?notupdate'</script>";
    }



}



?>


