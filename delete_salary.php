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
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                     <!--Include navbar.php -->
                        <?php include_once "navbar.php";   ?>

                            <?php include_once "lib/db.php"; 
                                
                                include_once "classes/salary.php";

                                $salary = new Salary;

                                $db = new db();
                            
                            ?>
                            
                            <!-- Delete Query -->
                            <?php   

                                    if(isset($_POST['submit'])){

                                        $id = $_GET['id'];

                                        $salary->Delete($id);

                                        echo "<script> window.location = 'salary.php?deleted' </script>";
                                    }



                                //  Get id 
                                if(isset($_GET['id'])){

                                    $id = $_GET['id'];

                                    ?>
                                        
                                    <div class="container">

                                        <table class="table mt-5">
                                            <thead>
                                                <tr>
                                                <th scope="col">S#</th>
                                                <th scope="col">Employee Name</th>
                                                <th scope="col">Basic Salary</th>
                                                <th scope="col">Medical</th>
                                                <th scope="col">Insurance</th>
                                                <th scope="col">Netpay</th>
                                                </tr>
                                            </thead>

                                                <?php

                                                    $sql = $db->db->prepare("SELECT * FROM salary inner join employee on salary.employee_id = employee.id WHERE salary.id = :id");

                                                    $sql->execute(array(":id"=>$id));

                                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                        ?>

                                                            <tbody>

                                                                <tr>
                                                                    <td><?php echo $row['id'];  ?></td>
                                                                    <td><?php echo $row['first_name'].$row['last_name']; ?></td>
                                                                    <td><?php echo $row['basic_salary'];  ?></td>
                                                                    <td><?php echo $row['medical'];  ?></td>
                                                                    <td><?php echo $row['insurance'];  ?></td>
                                                                    <td><?php echo $row['netpay'];  ?></td>
                                                                </tr>
                                                            
                                                            
                                                            </tbody>

                                                        <?php
                                                    }

                                                ?>
                                        </table>
                                    
                                    
                                    </div>
                                        <!-- Button -->
                                    <div class="container">
                                        <p>
                                            
                                            <?php
                                                    if(isset($_GET['id'])){

                                                        ?>

                                                        <form method="post">
                                                            <div class="form-group">
                                                                <button type="submit" name="submit" class="btn btn-success"> 
                                                                 <i class="fas fa-trash"> Yess</i> 
                                                                </button>
                                                                <a href="salary.php" class="btn btn-danger"><i class="fas fa-angle-double-right"></i> NO</a>
                                                            
                                                            </div>
                                                        
                                                        </form>

                                                     <?php   
                                                    }
                                                    ?>
                                               
                                        
                                        
                                        </p>    
                                    
                                    </div>

                            <?php   
                                    
                                }
    
                                ?>


            </div> 
          </div>  
        </div>
</body>
</html>

