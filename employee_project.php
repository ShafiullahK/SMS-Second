<?php

    include_once "auth.php";



    $email = '';

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];

    }

    

    $sql = "SELECT `role` FROM `login` WHERE email = :email";

    // include db 
    include_once "lib/db.php";
    
    // include user_menu class
     include_once "classes/add_user.php";
    $menu = new addUser();

    $role = $menu->employee_projectMU($sql , $email);

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
         <?php include_once "Themes.php"   ?>

    <title>Employee Project</title>

    <script>
        $(document).ready(function(){
            $('#em-tb').DataTable({
                dom : 'Bfrtrip',
                buttons : [
                    'excel','copy','pdf','csv','print'
                ]
            });
        })

    </script>
</head>
<body>
        <div class="container-fluid">
            <div class="row">

            <!-- include sidebar -->
            <?php include_once "sidebar.php";  ?>

                <div class="col-sm-10" style="padding:0px">

                    <!-- include navbar.php -->
                    <?php include_once "navbar.php";  ?>

                    <!-- container -->
                    <div class="container">
                        <div class="row mt-5"id="employee">
                            <div class="col-sm-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Employee Project</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="employee_project.php" method="post">
                                        
                                            <div class="form-group">

                                                <label for="project_id"><i class="fas fa-project-diagram"></i> Project</label>
                                                    <select name="project_id" id="project_id" class="form-control form-control-sm">
                                                        <?php

                                                            $sql = "SELECT * FROM `project`";
                                                            include_once "classes/employee_project.php";
                                                            $employee_project = new Employee_project($sql);

                                                            $employee_project->getProject($sql);
                                                        ?>
                                                    
                                                    
                                                    </select>           
                                            </div>

                                            <div class="form-group">
                                                <label for="employee_id"><i class="fas fa-user-alt"></i> Employee</label>
                                                <select name="employee_id" id="employee_id" class="form-control form-control-sm">
                                                    <?php   

                                                        $sql = "SELECT * FROM `employee`";

                                                        $employee_project = new Employee_project();
                                                        $employee_project->getEmployee($sql);

                                                    ?>
                                                
                                                
                                                </select>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="amount"><i class="fas fa-sort-amount-up"></i> Amount</label>
                                                <input type="number" name="amount" class="form-control form-control-sm" placeholder="Enter Amount" autocomplete="off" required>

                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                                                <input type="date" name="date" class="form-control form-control-sm" autocomplete="off" required>

                                            </div>

                                            <div class="form-group">

                                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="EMPOYE PROJECT">
                                            
                                            
                                            </div>

                                        </form>

                                        <!-- Include employee_project -->
                                        <?php

                                            include_once "classes/employee_project.php";
                                            $employee_project = new Employee_project();
                                            include_once "lib/employee_project.php";

                                        ?>

                                    
                                    </div>
                                </div>

                            
                            
                            
                            </div>
                            <div class="col-sm-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Employee Project</h4>
                                        <br>
                                        <!-- Update Show message -->
                                        <?php

                                        if(isset($_GET['updated'])){
                                        ?>
                                        <div class="container">
                                            <div class="alert alert-success"role='alert'><strong>Record was updated Successfully</strong></div>


                                        </div>
                                        <?php

                                            }
                                        ?>
                                        
                                        <?php

                                        if(isset($_GET['notupdated'])){
                                        ?>
                                        <div class="container">
                                            <div class="alert alert-danger"role='alert'><strong>Sorry record was not updated</strong></div>


                                        </div>
                                        <?php
                                        }

                                        ?>
                                        <!-- Update Show message end -->
                                        <!-- delete message show -->
                                            <div class="container">
                                            <?php

                                            if(isset($_GET['delete'])){
                                                ?>
                                                <div class="alert alert-success" role="alert"><strong>Record was deleted Successfully</strong></div>
                                                <?php
                                            }

                                            ?>

                                            </div>
                                            <!-- delete message end -->
                                        
                                        <!-- Show insert Message  -->

                                        <?php 

                                        if(isset($_GET['insert'])){
                                        ?>
                                        <div class="container">

                                            <div class="alert alert-success"role="alert"><strong>Record Was Inserted Successfully</strong></div>
                                        
                                        
                                        </div>

                                        <?php

                                        }

                                        ?>

                                        <?php 

                                        if(isset($_GET['notinsert'])){
                                        ?>
                                        <div class="container">

                                            <div class="alert alert-danger"role="alert"><strong>Sorry Record was not inserted</strong></div>
                                        
                                        
                                        </div>

                                        <?php

                                        }

                                        ?>

                                        <!-- Show insert Message end -->
                                    </div>
                                    <div class="card-body">
                                        <table id="em-tb" class="table  dt-responsive nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Project Name</th>
                                                    <th>Name Amount</th>
                                                    
                                                   

                                                </tr>
                                            </thead>
                                            <?php
                                                // Project Query in employee_project table
                                                $sql = "SELECT * FROM project ";

                                                $employee_project->dataView($sql , $role);
                                                

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
