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

    <title>Project</title>
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
                            <div class="col-sm-12">

                                <!-- eployee_project Class  -->
                                <?php
                                        include_once "classes/employee_project.php";
                                        $employee_project = new Employee_project();
                                    ?>

                                    <!-- GET ID -->
                                    <?php 
                                        
                                        if(isset($_GET['employee_id']) && isset($_GET['project_id'])){

                                            $emp_id = $_GET['employee_id'];
                                            $pro_id = $_GET['project_id'];
                                            
                                            $edit =  $employee_project->getID($emp_id, $pro_id);
                                        }
                                        

                                    ?>

                                <div class="card">
                                    <div class="card-header">
                                        <h4>Project Details </h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="edit_employee_project.php?employee_id=<?php echo $edit['employee_id']; ?>&project_id=<?php echo $edit['project_id']; ?>" method="post">
                                        
                                            <div class="form-group">

                                                <label for="project_id"><i class="fas fa-project-diagram"></i> Project</label>
                                                    <select name="project_id" id="project_id" class="form-control form-control-sm">

                                                       <?php
                                                                // Include db 

                                                                $db = new db();

                                                                $sql = $db->db->prepare("SELECT * FROM project");
                                                                $sql->execute();

                                                                if($sql->rowCount() > 0){
                                                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                                        ?>

                                                                        <option value="<?php echo $row['id'];?>" 
                                                                        <?php echo $row['id'] === $edit['project_id'] ? 'selected' : '' ?>
                                                                            ><?php echo $row['project_name'];  ?>
                                                                        </option>

                                                                        <?php
                                                                    }
                                                                }


                                                        ?>
                                                    
                                                    </select>           
                                            </div>

                                            <div class="form-group">
                                                <label for="employee_id"><i class="fas fa-user-alt"></i> Employee</label>
                                                <select name="employee_id" id="employee_id" class="form-control form-control-sm">

                                                                <!--include DB  -->
                                                                <?php

                                                                    $db = new db;

                                                                    $sql = $db->db->prepare("SELECT * FROM employee");
                                                                    $sql->execute();

                                                                    if($sql->rowCount() > 0){

                                                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                                            ?>

                                                                            <option value="<?php echo $row['id']; ?>"
                                                                                <?php echo $row['id'] === $edit['employee_id'] ? 'selected' : '' ?>
                                                                                ><?php echo $row['first_name'].$row['last_name']; ?>
                                                                            </option>

                                                                        <?php

                                                                            }
                                                                    }

                                                                ?>

                                                </select>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="amount"><i class="fas fa-sort-amount-up"></i> Amount</label>
                                                <input type="number" name="amount" class="form-control form-control-sm" placeholder="Enter Amount"  autocomplete="off" required value="<?php echo $edit['amount']; ?>">

                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                                                <input type="date" name="date" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $edit['date']; ?>"> 

                                            </div>

                                                <!-- Hidden file -->
                                                <input type="hidden" name="emp_id" value="<?php echo $edit['employee_id']; ?>">
                                                <input type="hidden" name="proj_id" value="<?php echo $edit['project_id']; ?>">
                                                <input type="hidden" name="old_amount" value="<?php echo $edit['amount']; ?>">

                                            <div class="form-group">

                                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="UPDATE">
                                            
                                            
                                            </div>

                                        </form>

                                        <!-- Include employee_project -->
                                        <?php  include_once "lib/edit_employee_project.php "?>

                                    
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