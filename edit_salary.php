<?php

include_once "auth.php";

// user and admin menu conditons


$email = '';

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];


    }



$sql = "SELECT `role` FROM `login` WHERE email = :email";

// include db 
include_once "lib/db.php";

include_once "classes/add_user.php";
$menu = new addUser();

$role =  $menu->salaryMU($sql , $email);




// end

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>

    <title>Edit Salary</title>
</head>
<body>
        <div class="container-fluid">
            <div class="row">

                <!-- Include sidebar -->
                <?php  include_once "sidebar.php";     ?>
                    <div class="col-sm-10" style="padding:0px;">

                        <!-- Include navbar -->
                        <?php  include_once "navbar.php";   ?>

                           <div class="container">
                                <div class="row mt-5" id="salary">
                                    <div class="col-sm-12">

                                        <!-- Include Salary Class -->
                                        <?php  include_once "classes/salary.php" ;

                                                $salary = new Salary();

                                            ?>

                                        <?php

                                            // Get id
                                            if(isset($_GET['id'])){

                                                $id = $_GET['id'];

                                                $edit = $salary->getId($id);
                                            }

                                            ?>

                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Salary Details</h4>
                                            </div>
                                            <div class="card-body">

                                                <form action="edit_salary.php?id=<?php echo $id ?>" method="post">

                                                    <div class="form-group">
                                                        <label for="employee_id"><i class="fas fa-user"></i> Employee Name</label>
                                                        <select name="employee_id" id="employee_id" class="form-control form-control-sm" >

                                                                <?php
                                                                    // include 'lib/db.php';
                                                                    $DB = new db();

                                                                    $sql = $DB->db->prepare("SELECT * FROM employee");
                                                                    $sql->execute();

                                                                    
                                                                    if($sql->rowCount() > 0){
                                                                        
                                                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                                            ?>

                                                                            <option value="<?php echo $row['id'];?>" <?php echo $row['id'] === $edit['employee_id'] ? 'selected' : '' ?>><?php echo $row['first_name'].$row['last_name']; ?></option>    

                                                                            <?php
                                                                        }

                                        
                                                                        
                                                                    }
                                                                ?>
                                                            
                                                        
                                                        </select>

                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basic_salary"><i class="fa fa-money-bill-alt"></i> Basis Salary</label>
                                                        <input type="number"name="basic_salary" class="form-control form-control-sm" placeholder="Enter Basic Salary" autocomplete="off" required value="<?php echo $edit['basic_salary']; ?>">
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="medical"><i class="fas fa-briefcase-medical"></i> Medical</label>
                                                        <input type="number"name="medical" class="form-control form-control-sm" placeholder="Enter Employee medical" autocomplete="off" required value="<?php  echo $edit['medical']; ?>">
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="insurance"><i class="fas fa-shield-alt"></i> Insurance</label>
                                                        <input type="number"name="insurance" class="form-control form-control-sm" placeholder="Enter Employee Insurance" autocomplete="off" required  value="<?php  echo $edit['insurance'];  ?>">
                                                    
                                                    </div>

                                                    <!-- hidden -->

                                                    <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">

                                                    <div class="form-group">
                                                        <input type="submit"name="submit" class="btn btn-primary btn-sm" value="UPDATE">
                                                    
                                                    </div>

                                                    
                                                
                                                
                                                </form>

                                                <?php  include_once "lib/edit_salary.php";?>
                                                     
                                                   
                                                   
                                                
                                            
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