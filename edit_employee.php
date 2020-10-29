<?php

    include_once "auth.php";

$email = '';

if(isset($_SESSION['email'])){

    $email = $_SESSION['email'];
    
}


$sql = "SELECT `role` FROM `login` WHERE email = :email";

include_once "lib/db.php";

// Include employee Class
include_once "classes/add_user.php";
$menu = new addUser();
$role = $menu->AUmenu($sql , $email);



// end
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
        <?php include_once "Themes.php"   ?>
    
    <title>Edit Employee</title>
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px">

                     <!--Include navbar.php -->
                     <?php   include_once "navbar.php";   ?>

                    <div class="container mt-5" id="employee">
                        <div class="row">
                            <div class="col-sm-12">
                            
                            <?php 

                                    include_once 'classes/employee.php';
                                    $employee = new Employee();
                                   
                                 ?>

                                 <!--GetID  -->
                                 <?php

                                    if(isset($_GET['id'])){

                                        $id = $_GET['id'];

                                        $edit = $employee->getID($id);
                                    }


                                    ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4> Edit Employee</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="edit_employee.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">

                                            <div class="form-group">

                                                <label for="first_name"><i class="fas fa-user"></i> First Name</label>
                                                <input type="name" name="first_name" class="form-control form-control-sm" placeholder="Enter First Name" autocomplete="off" required value="<?php echo $edit['first_name'];?>">
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="last_name"><i class="fas fa-user"></i> Last Name</label>
                                                <input type="name" name="last_name" class="form-control form-control-sm" placeholder="Enter Last Name" autocomplete="off"required value="<?php echo $edit['last_name']; ?>">
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="fname"><i class="fas fa-user"></i> Father Name</label>
                                                <input type="name" name="fname" class="form-control form-control-sm" placeholder="Enter Fathers Name" autocomplete="off"required value="<?php echo $edit['fname']; ?>">
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                                <input type="name" name="email" class="form-control form-control-sm" placeholder="Enter Employee Email" autocomplete="off"required value="<?php echo $edit['email']; ?>">
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="dept_no"><i class="fas fa-building"></i> Department No</label>
                                                <input type="name" name="dept_no" class="form-control form-control-sm" placeholder="Enter Department No" autocomplete="off"required value="<?php echo $edit['dept_no']; ?>">
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="phone"><i class="fas fa-phone-alt"></i> Phone No</label>
                                                <input type="number" name="phone" class="form-control form-control-sm" placeholder="Enter Phone No" autocomplete="off"required value="<?php echo $edit['phone']; ?>">
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="cnic"><i class="fas fa-id-card"></i> CNIC No</label>
                                                <input type="name" name="cnic" class="form-control form-control-sm" placeholder="Enter cinc No" autocomplete="off"require value="<?php echo $edit['cnic']; ?>">
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="address"><i class="fas fa-address-book"></i> Address No</label>
                                                <input type="name" name="address" class="form-control form-control-sm" placeholder="Enter Address No" autocomplete="off" required value="<?php echo $edit['address']; ?>">
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="file"><i class="fas fa-image"></i> Image</label>
                                                    <br>
                                                <input type="file" name="image" value="<?php echo $edit['image']; ?>">
                                            
                                            </div>

                                                <!-- hidden file -->
                                            <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                                            
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="UPDATE">
                                            </div>
                                            
                                        </form>

                                        <?php include_once 'lib/edit_employee.php' ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
</body>
</html>



