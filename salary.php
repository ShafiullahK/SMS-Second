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
    
    <title>Salary</title>

    <script>
        $(document).ready(function(){
            $('#sal').DataTable({
                dom : 'Bfrtip',
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

                <!-- Include sidebar -->
                <?php  include_once "sidebar.php";     ?>
                    <div class="col-sm-10" style="padding:0px;">

                        <!-- Include navbar -->
                        <?php  include_once "navbar.php";   ?>

                           <div class="container">
                                <div class="row mt-5" id="salary">
                                    <div class="col-sm-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Salary Details</h4>
                                            </div>
                                            <div class="card-body">

                                                <form action="salary.php" method="post">

                                                    <div class="form-group">
                                                        <label for="employee_id"><i class="fas fa-user"></i> Employee Name</label>
                                                        <select name="employee_id" id="employee_id" class="form-control form-control-sm">

                                                                <?php
                                                                    $sql = "SELECT * From employee";
                                                                    include_once "classes/employee.php";
                                                                    $employee = new Employee();
                                                                    $employee->getEmployee($sql);
                                                                ?>
                                                            
                                                        
                                                        </select>
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basic_salary"><i class="fa fa-money-bill-alt"></i> Basis Salary</label>
                                                        <input type="number"name="basic_salary" class="form-control form-control-sm" placeholder="Enter Basic Salary" autocomplete="off"required>
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="medical"><i class="fas fa-briefcase-medical"></i> Medical</label>
                                                        <input type="number"name="medical" class="form-control form-control-sm" placeholder="Enter Employee medical" autocomplete="off"required>
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="insurance"><i class="fas fa-shield-alt"></i> Insurance</label>
                                                        <input type="number"name="insurance" class="form-control form-control-sm" placeholder="Enter Employee Insurance" autocomplete="off"required>
                                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="submit"name="submit" class="btn btn-primary btn-sm" value="SALARY">
                                                    
                                                    </div>

                                                    
                                                
                                                
                                                </form>

                                                <?php
                                                    include_once "classes/salary.php";
                                                    $salary = new Salary();
                                                    include_once "lib/salary.php";

                                                    ?>
                                                
                                            
                                            </div>
                                        </div>
                                    
                                    
                                    
                                    
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Salary</h4>
                                                    <br>
                                                        <!-- Show Update message -->
                                                        <div class="container">

                                                                <?php

                                                                    if(isset($_GET['update'])){
                                                                        ?>

                                                                        <div class="alert alert-success" role="alert"><strong>Record was updated Successfully </strong></div>
                                                                    <?php
                                                                    }else{

                                                                    }

                                                                ?>
                                                                    
                                                                </div>

                                                                <div class="container">

                                                                <?php

                                                                    if(isset($_GET['notupdate'])){
                                                                        ?>

                                                                        <div class="alert alert-danger" role="alert"><strong>Sorry Record was not updated  </strong></div>
                                                                    <?php
                                                                    }else{
                                                                        
                                                                    }

                                                                ?>
                                                                    


                                                                </div>

                                                        <!-- Show Update message  end-->

                                                            <!-- Delete Message -->
                                                        <div class="container">
                                                                <?php

                                                                if(isset($_GET['deleted'])){

                                                                ?>

                                                                <div class="alert alert-success"role="alert"><strong>Record was deleted Successfully </strong></div>

                                                                <?php
                                                            }

                                                            ?>

                                                        </div>
                                                        <!-- Delete Message end -->

                                                         <!-- Show Insert Message -->
                                                     <?php
                                                        
                                                            if(isset($_GET['success'])){
                                                                ?>

                                                            <div class="container">
                                                                <div class="alert alert-success" role="alert"><strong>Record was inserted  Successfully</strong></div>
                                                            
                                                            </div>
                                                            <?php
                                                         }



                                                        ?>

                                                        <?php
                                                        
                                                        if(isset($_GET['error'])){
                                                            ?>

                                                            <div class="container">
                                                                <div class="alert alert-danger" role="alert"><strong>Sorry data not Inserted</strong></div>
                                                            
                                                            </div>
                                                            <?php
                                                        }



                                                        ?>
                                                <!-- Show Insert Message  end-->

                                            </div>
                                            <div class="card-body">
                                                <table id="sal" class="table  dt-responsive nowrap" style="width:100%">
                                                     <thead>
                                                        <tr>
                                                            <th scope="col">S#</th>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Basic Salary</th>
                                                            <th scope="col">Medical</th>
                                                            <th scope="col">Insurance</th>
                                                            <th scope="col">Netpay</th>
                                                            
                                                          <!-- Checking admin and user -->

                                                            <?php if($role === 'Admin'){

                                                               ?>

                                                            <th scope="col">Action</th>
                                                        </tr>
                                                                
                                                                <?php  } ?>     
                                                        
                                                    </thead>

                                                        <?php

                                                            $sql = "SELECT employee.first_name , employee.last_name , salary.* FROM salary inner join employee on salary.employee_id = employee.id ORDER BY `salary`.`id` DESC";
                                                            
                                                            // Pagination start

                                                            // Pagination end

                                                            $salary->dataView($sql , $role);        #sql2 is the pagination veriable and $sql is the seletec 

                                                        ?>
                                                
                                                
                                                </table>
                                                        
                                                        <!-- Pagination Start -->

                                                        <!-- Pagination end -->
                                            
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