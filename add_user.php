<?php

include_once "auth.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>

    <title>Signup</title>
</head>
<body>
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">

                <!-- include sidebar -->
                <?php  include_once "sidebar.php"   ?>

                <div class="col-sm-10" style="padding:0px">
                    <!-- Include navbar -->
                    <?php include_once "navbar.php"   ?>

                    <!-- container -->
                    <div class="container">
                        <div class="row mt-5" id="signup">
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-header">
                                        <br>
                                    <!-- Show message -->
                                    <?php

                                    if(isset($_GET['fail'])){

                                    ?>

                                    <div class="container">

                                    <div class="alert alert-danger" role="alert"><strong>Error Pleace Check Your Password</strong></div>


                                    </div>

                                    <?php

                                    }else{

                                    }

                                    ?>
                                    <?php

                                    if(isset($_GET['success'])){

                                    ?>

                                    <div class="container">

                                    <div class="alert alert-success" role="alert"><strong>Registration has been Successfully</strong></div>


                                    </div>

                                    <?php

                                    }else{

                                    }

                                    ?>

                                    <!-- End Show Message -->
                                    
                                    <h5><i class="fas fa-user"></i> ADD USER</h5>
                                        
                                </div>
                                <div class="card-body">
                        <form action="lib/add_user.php" method="post">

                            <div class="form-group">

                            <label for="name"><i class="fas fa-user"></i> User Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter User Name"  autocomplete="off" required>
            
                            </div>

                            <div class="form-group">

                            <label for="email"><i class="fas fa-envelope"></i> User Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter User Email" autocomplete="off" required>
            
                            </div>

                            <div class="form-group">

                            <label for="role"><i class="fas fa-bars"></i> Role</label>
                            <select name="role" class="form-control form-control-sm">
                                    
                                    <option>Select</option>
                                    <option>User</option>
                                    <option>Admin</option>
                            
                            </select>
                            </div>

                            <div class="form-group">

                            <label for="pass"><i class="fas fa-key"></i> User Password</label>
                            <input type="password" name="pass" class="form-control form-control-sm" placeholder="Enter User Password" autocomplete="off" required>
            
                            </div>

                            <div class="form-group">

                            <label for="con_pass"><i class="fas fa-key"></i> Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control form-control-sm" placeholder="Enter Confirm Password" autocomplete="off" required>
            
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="SIGNUP">
                            
                            </div>

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</body>
</html>