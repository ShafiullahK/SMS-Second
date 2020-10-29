<?php

    include_once "auth.php";

    

    $email = '';
    
    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
    }

    $sql = "SELECT `role` FROM `login` WHERE email = :email";

    include_once "lib/db.php";

    // include addUsers class
        include_once "classes/add_user.php";
        $adduser = new addUser();

        $role = $adduser->add($sql , $email);
        
        

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>

    <title>Edit Users</title>
</head>
<body>
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">

                <!--include sidebar  -->

                <?php  include_once "sidebar.php"  ?>

                <div class="col-sm-10"style="padding:0px">

                <!-- include navbar -->

                <?php  include_once "navbar.php"  ?>

                    <!--container  -->
                    <div class="container">
                        <div class="row mt-5" id="users">
                            <div class="col-sm-12">

                            <!-- include users class -->
                            <?php 
                                    include_once "classes/users.php";
                                    $user = new Users();

                              ?>

                                <!-- getID -->
                                <?php
                                      
                                     if(isset($_GET['id'])){

                                        $id = $_GET['id'];

                                       $edit =  $user->getID($id);
                                     } 
                                      

                                    ?>


                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Users</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="edit_users.php?id=<?php echo $id; ?>" method="post">

                                            <div class="form-group">
                                                <label for="name"><i class="fas fa-user"></i> User Name</label>
                                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter User Name"autocomplete="off"required value="<?php echo $edit['user'];  ?>">
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="email"><i class="fas fa-envelope"></i> User Email</label>
                                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter User Email"autocomplete="off"required value="<?php echo $edit['email'];  ?>">
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="role"><i class="fas fa-bars"></i> Role</label>
                                                <select name="role" id="role" class="form-control form-control-sm">

                                                    <option value="Admin" <?php echo $edit['role'] === 'Admin' ? 'selected' : '' ?>>
                                                        Admin
                                                    </option> 

                                                    <option value="User" <?php echo $edit['role'] === 'User' ? 'selected' : '' ?>>
                                                        User
                                                    </option> 
                            
                                                </select>
                                            
                                            </div>

                                                <!-- hidden file -->
                                                <input type="hidden" name="id" value="<?php echo $edit['id'];  ?>">

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="USERS">
                                            </div>
                                        </form>

                                        <!-- include lib/edit_users -->
                                        <?php  include_once "lib/edit_users.php"; ?>

                                            
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