<?php


if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $basic_salary = $_POST['basic_salary'];
    $medical = $_POST['medical'];
    $insurance = $_POST['insurance'];

    $netpay = (int)$basic_salary - ((int)$medical + (int)$insurance);
    


    if($salary->Create( $employee_id ,$basic_salary ,  $medical ,  $insurance , $netpay)){

        echo "<script> window.location = 'salary.php?success'</script>";

    }else{

        echo "<script> window.location = 'salary.php?error'</script>";
    }
}


?>

