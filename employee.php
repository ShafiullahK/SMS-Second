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
    
    <title>Employee</title>

    <script>
        $(document).ready(function(){
            $('#emp').DataTable({
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
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                     <!--Include navbar.php -->
                        <?php include_once "navbar.php";   ?>

                    <div class="container mt-5" id="employee">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Employee Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="employee.php" method="post" enctype="multipart/form-data">

                                            <div class="form-group">

                                                <label for="first_name"><i class="fas fa-user"></i> First Name</label>
                                                <input type="name" name="first_name" class="form-control form-control-sm" placeholder="Enter First Name" autocomplete="off"required>
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="last_name"><i class="fas fa-user"></i> Last Name</label>
                                                <input type="name" name="last_name" class="form-control form-control-sm" placeholder="Enter Last Name" autocomplete="off"required>
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="fname"><i class="fas fa-user"></i> Father Name</label>
                                                <input type="name" name="fname" class="form-control form-control-sm" placeholder="Enter Fathers Name" autocomplete="off"required>
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                                <input type="name" name="email" class="form-control form-control-sm" placeholder="Enter Employee Email" autocomplete="off"required>
                                            
                                            </div>
                                            <div class="form-group">

                                                <label for="dept_no"><i class="fas fa-building"></i> Department No</label>
                                                <input type="name" name="dept_no" class="form-control form-control-sm" placeholder="Enter Department No" autocomplete="off"required>
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="phone"><i class="fas fa-phone-alt"></i> Phone No</label>
                                                <input type="number" name="phone" class="form-control form-control-sm" placeholder="Enter Phone No" autocomplete="off"required>
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="cnic"><i class="fas fa-id-card"></i> CNIC No</label>
                                                <input type="name" name="cnic" class="form-control form-control-sm" placeholder="Enter cinc No" autocomplete="off"required>
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="address"><i class="fas fa-address-book"></i> Address No</label>
                                                <input type="name" name="address" class="form-control form-control-sm" placeholder="Enter Address No" autocomplete="off" required>
                                            
                                            </div>
                                             <div class="form-group">

                                                <label for="file"><i class="fas fa-image"></i> Image</label>
                                                    <br>
                                                <input type="file" name="image">
                                            
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-sm" name="submit" value="EMPLOYEE">
                                            </div>
                                        </form>

                                        
                                    
                                        <?php 
                                            include_once 'classes/employee.php';
                                            $employee = new Employee();
                                            include_once 'lib/employee.php'; 
                                        ?>
                                    </div>
                                </div>
                            
                            
                            
                            
                            </div>
                            <div class="col-sm-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Employees</h4> 
                                            <br>  
                                            
                                        <!-- Show  Update Message -->
                                           <div class="container">

                                            <?php

                                            if(isset($_GET['update'])){
                                            ?>

                                            <div class="alert alert-success" role="alert"> <strong>Record Was Updated Successfull</strong></div>

                                            <?php   
                                            }else{

                                            }

                                            ?>

                                            </div>

                                            <div class="container">

                                            <?php

                                            if(isset($_GET['notupdate'])){
                                            ?>

                                            <div class="alert alert-danger" role="alert"> <strong>Sorry  Record was Not Updated </strong></div>

                                            <?php   
                                            }else{
                                                
                                            }

                                            ?>

                                            </div> 
                                                                                            

                                        <!-- Show Update Message end -->

                                                 <!-- Show delete Message  -->
                                        <div class="container">
                                            <?php
                                                if(isset($_GET['deleted'])){
                                                  ?>
                                                      
                                                    <div class="alert alert-success"role = alert><strong>Record was deleted Successfully</strong></div>
                                                  <?php

                                                }
                                                
                                              ?>
                                        </div>
                                      
                                  <!-- Show  deleteMessage end-->

                                             <!-- Show Message  insert-->
                                                                                                        
                                                        <?php

                                                        if(isset($_GET['success'])){
                                                            ?>

                                                        <div class="container">
                                                            <div class="alert alert-success" role="alert"><strong>Record was inserted  Successfully</strong></div>

                                                        </div>

                                                        <?php  


                                                        }else{

                                                        }


                                                        ?>
                                                        <?php

                                                        if(isset($_GET['fail'])){
                                                            ?>

                                                        <div class="container">
                                                            <div class="alert alert-danger" role="alert"><strong>Sorry Data Not inserted</strong></div>

                                                        </div>

                                                        <?php  


                                                        }else
                                                            
                                                        


                                                        ?>
                                        <!-- Show insert Message end -->
                                    </div>
                                       
                                    <div class="card-body">
                                         <table id="emp" class="table  dt-responsive nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S#</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Father Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone No</th>
                                                    <th scope="col">CNIC No</th>
                                                        
                                                       <!-- Checking amdin and user -->

                                                     <?php if($role === 'Admin'){  
                                                          ?> 

                                                    <th scope="col">Action</th>

                                                     <?php     }else{
                                                         
                                                     } ?>
                                                
                                                
                                                
                                                </tr>
                                            
                                            </thead>
                                       

                                        <?php 
                                            
                                            $sql = "SELECT * FROM employee ORDER BY `id` DESC";

                                            // Pagination 
                        
                                            // Pagination 
                                            
                                            $employee->dataview($sql , $role);    # $sql2 is the pagination variable  and the insert is $sql 
                                        
                                         ?>

                                            </table>


                                                 <!-- Pagination start -->
                                            

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