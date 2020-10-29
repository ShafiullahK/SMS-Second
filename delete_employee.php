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
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                     <!--Include navbar.php -->
                        <?php include_once "navbar.php";   ?>


                        <?php include_once "lib/db.php" ; 
                              include_once "classes/employee.php";

                             $db = new db();
                             $employee = new Employee();
                        
                        ?>
                          
                            <?php
                                // Delete query

                                  if(isset($_POST['submit'])){

                                    $id = $_GET['id'];

                                    $employee->delete($id);

                                    echo "<script> window.location= 'employee.php?deleted' </script>";

                                  }

                                    // Get id
                                if(isset($_GET['id'])){

                                  $id = $_GET['id'];  

                                ?>

                                    <div class="container">
                                      <table class="table mt-5">
                                            <thead>
                                                  <tr>
                                                        <th scope="col">S#</th>
                                                        <th scope="col">First Name</th>
                                                        <th scope="col">Last Name</th>
                                                        <th scope="col">Father Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone No</th>
                                                        <th scope="col">CNIC No</th>
                                                  </tr>
                                            </thead>


                                            <?php

                                              $sql = $db->db->prepare("SELECT * FROM employee WHERE id = :id");

                                              $sql->execute(array(":id"=>$id));

                                              while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                    <!-- tbody -->

                                                    <tbody>
                                                      <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['first_name']; ?></td>
                                                        <td><?php echo $row['last_name']; ?></td>
                                                        <td><?php echo $row['fname']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['phone']; ?></td>
                                                        <td><?php echo $row['cnic']; ?></td>
                                                      </tr>
                                                    </tbody>


                                                <?php


                                                }

                                             ?>

                                      </table>


                                <?php

                                    } 

                                    ?>

                                
                                </div>

                                    <!-- Buttons-->

                                    <div class="container">
                                      <P>
                                          <?php

                                            if(isset($_GET['id'])){

                                          ?>
                                            <form method="post">

                                              <div class="form-group">

                                                <button type="submit" class="btn btn-success" name="submit">

                                                 <i class="fas fa-trash"> Yess</i></button>

                                                 <a href="employee.php" class="btn btn-danger">

                                                   <i class="fas fa-angle-double-right"></i> NO
                                                 </a>
                                                
                                                
                                              
                                              </div>
                                            
                                            
                                            </form>
                                          <?php

                                                }
                                          ?>

                                      </P>
                                    </div>

              </div>
            </div> 
          </div>  
        </div>


</body>
</html>