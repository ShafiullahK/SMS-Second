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

    <title>Project</title>

    <script>
        $(document).ready(function(){
            $("#pro").DataTable({
                dom :'Bfrtip',
                buttons : [
                    'excel','copy','pdf','csv','print'
                ]
            });
        });
    
    </script>

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
                            <div class="col-sm-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Project</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="project.php" method="post">

                                            <div class="form-group">
                                                <label for="project_name"><i class="fas fa-project-diagram"></i> Project Name</label>
                                                <input type="text" name="project_name" placeholder="Enter Project Name" class="form-control form-control-sm" autocomplete="off" required>
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="p_form"><i class="fas fa-times-circle"></i> From</label>
                                                <input type="date" name="p_form" placeholder="From" class="form-control form-control-sm" autocomplete="off" required>
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="p_to"><i class="fas fa-times-circle"></i> To</label>
                                                <input type="date" name="p_to" placeholder="To" class="form-control form-control-sm" autocomplete="off" required>
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="amount"><i class="fas fa-sort-amount-up"></i> Amount</label>
                                                <input type="text" name="amount" placeholder="Enter Amount" class="form-control form-control-sm" autocomplete="off" required>
                                            
                                            </div>

                                            
                                           

                                            <div class="form-group">
                                                
                                                <input type="submit" name="submit"  class="btn btn-primary btn-sm" value="PROJECT">
                                            
                                            </div>
                                        
                                        
                                        </form>
                                            <!-- Include project class -->
                                            <?php
                                                include_once "classes/project.php";
                                                $project = new Project();

                                                include_once "lib/project.php";
                                            ?>
                                    
                                    </div>
                                </div>
                            
                            
                            
                            </div>
                            <div class="col-sm-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Project Details</h4>
                                         <br>
                                            <!-- Delete Message -->
                                            <div class="container">

                                            <?php

                                                if(isset($_GET['deleted'])){
                                                    ?>

                                                    <div class="alert alert-success"role="alert"><strong>Record was deleted Successfully</strong></div>

                                                    <?php
                                                }

                                            ?>

                                            </div>
                                            <!-- Delete Message end -->
                                            
                                            <!-- UPDATE Message  -->
                                            <div class="container">
                                            <?php

                                                if(isset($_GET['updated'])){
                                                    ?>

                                                    <div class="alert alert-success"role="alert"><strong>Record was updated Successfully</strong></div>

                                                    <?php
                                                }

                                            ?>

                                            </div>
                                            <div class="container">
                                            <?php

                                                if(isset($_GET['notupdated'])){
                                                    ?>

                                                    <div class="alert alert-danger"role="alert"><strong>Sorry record was not updated</strong></div>

                                                    <?php
                                                }

                                            ?>

                                            </div>
                                            <!-- UPDATE Message end -->

                                        <!-- Insert message  -->
                                        <div class="container">
                                            <?php
                                                if(isset($_GET['insert'])){
                                                    ?>
                                                    <div class="alert alert-success"role="alert"><strong>Record was Inserted Successfully</strong></div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="container">
                                            <?php
                                                if(isset($_GET['notinsert'])){
                                                    ?>
                                                    <div class="alert alert-danger"role="alert"><strong>Sorry record was  not inserted</strong></div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <!-- Insert message  end-->
                                    </div>
                                    <div class="card-body">
                                        <table id="pro" class="table  dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Project Name</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Amount</th>
                                                    <th>Days</th>
                                                    <th>Status</th>
                                                    <th>Mark Ready</th>

                                                    <!-- checking for admin and user -->
                                                    <?php if($role === 'Admin'){

                                                     ?>

                                                    <th>Action</th>

                                                      <?php  }  ?>  
                                                </tr>
                                            </thead>
                                            <?php
                                                $sql = "SELECT * FROM project ORDER BY `id`DESC";

                                                $project->dataView($sql , $role);
                                            ?>
                                        </table>

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