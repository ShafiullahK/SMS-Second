<?php

if(isset($_POST['submit'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $dept_no = $_POST['dept_no'];
    $phone = $_POST['phone'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];

    $filename = $_FILES['image']['name'];
    $filetype = $_FILES['image']['type'];
    $filesize = $_FILES['image']['size'];
    $filetmp = $_FILES['image']['tmp_name'];

    if($employee->create($first_name , $last_name , $fname , $email , $dept_no , $phone , $cnic , $address , $filename , $filetype , $filesize , $filetmp)){
        echo "<script> window.location = 'employee.php?success'  </script>";
    }else{
        echo "<script> window.location = 'employee.php?fail ' </script>";
    }

    
   
}


?>
