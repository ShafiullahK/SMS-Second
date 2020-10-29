<?php

    include_once "auth.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    
        <!-- Include js and css files -->
        <?php include_once "Themes.php"   ?>

    <title>Show Employee</title>
</head>
<body>
        <!--container-fluid -->
        <div class="container-fluid">

            <div class="row">

                <!-- Include sidebar -->
                <?php  include_once "sidebar.php"  ?>
                <div class="col-sm-10" style="padding:0px">

                    <!-- include navbar.php -->
                    <?php  include_once "navbar.php"  ?>


                    <!-- container -->
                        <div class="container">
                            <div class="row mt-5" id="employee">
                                <div class="col-sm-12">


                                         <!-- include Employee class -->
                                         <?php include_once "classes/employee.php";
                                                
                                                $employee = new Employee(); 
                                            ?>

                                            <!-- get employee Id to show employee  -->
                                            <?php

                                                if(isset($_GET['id'])){

                                                    $id = $_GET['id'];

                                                   $show =  $employee->showEmployee($id);
                                                }


                                                ?>


                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Employee</h4>
                                            <div class="card-body">
                                               <ul class="list-group">
                                               <li class="list-group-item"><img src="uploads/<?php echo $show['image']   ?>" height="100px" width="100px" ></li>
                                                   <li class="list-group-item"><?php echo $show['first_name'].$show['last_name']   ?></li>
                                                   <li class="list-group-item"> <?php echo $show['fname']   ?></li>
                                                   <li class="list-group-item"><?php echo $show['email']  ?></li>
                                                   <li class="list-group-item"><?php echo $show['dept_no']   ?></li>
                                                   <li class="list-group-item"><?php echo $show['phone']  ?></li>
                                                   <li class="list-group-item"><?php echo $show['cnic']  ?></li>
                                                   <li class="list-group-item"><?php echo $show['address']  ?></li>
                                               </ul>
                                                
                                               

                                            
                                            </div>
                                        </div>
                                    </div>                                
                                
                                </div>
                                <!-- <div class="col-sm-6"></div> -->
                            </div>
                        </div>
                    

                
                </div>
            </div>
        
        </div>
</body>
</html>