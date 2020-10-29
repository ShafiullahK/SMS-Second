<?php

    include_once "auth.php";

    
    $email = '';

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];


    }

    

    $sql = "SELECT * FROM `login` WHERE email = :email";

    // include db
    include_once "lib/db.php";

    // include menu_class
    include_once "classes/add_user.php";

    $menu = new addUser();

    $role = $menu->projectMU($sql , $email);


?>



<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
     <?php include_once "Themes.php"   ?>

    <title>Edit Project</title>
</head>
<body>
        <div class="container-fluid">
            <div class="row">

                <!-- include sidebar.php -->
                <?php include_once "sidebar.php";   ?>

                <div class="col-sm-10"style="padding:0;">

                    <!-- Include navbar.php -->
                    <?php include_once "navbar.php";   ?>

                    <div class="container">
                        <div class="row mt-5" id="project">
                            <div class="col-sm-12">

                               <!-- include project  -->
                                <?php
                                    include_once "classes/project.php";
                                    $project = new Project();
                                ?>
                                <!-- Get id -->
                                <?php   

                                    if(isset($_GET['id'])){

                                        $id = $_GET['id'];

                                        $edit = $project->getID($id);
                                    }

                                ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Project Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="edit_project.php?id=<?php echo $id  ?>" method="post">

                                            <div class="form-group">
                                                <label for="project_name"> Project Name</label>
                                                <input type="text" name="project_name" placeholder="Enter Project Name" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $edit['project_name'];?>">
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="p_from"> From</label>
                                                <input type="date" name="p_from" placeholder="From" class="form-control form-control-sm" autocomplete="off" required  value="<?php echo $edit['p_from'];?>">
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="p_to"> To</label>
                                                <input type="date" name="p_to" placeholder="To" class="form-control form-control-sm" autocomplete="off" required  value="<?php echo $edit['p_to'];?>">
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="amount"> Amount</label>
                                                <input type="text" name="amount" placeholder="Enter Amount" class="form-control form-control-sm" autocomplete="off" required  value="<?php echo $edit['amount'];?>">
                                            
                                            </div>

                                            
                                           
                                            <!-- hidden file -->
                                            <input type="hidden" name="id" value="<?php echo $edit['id']  ?>">
                                            <div class="form-group">
                                                
                                                <input type="submit" name="submit"  class="btn btn-primary btn-sm" value="UPDATE">
                                            
                                            </div>
                                        
                                        
                                        </form>
                                            <!-- Include project  -->
                                            <?php  include_once "lib/edit_project.php"   ?>
                                    
                                    </div>
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