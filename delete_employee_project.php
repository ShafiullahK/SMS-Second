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
                              include_once "classes/employee_project.php";

                             $db = new db();
                             $employee_project = new Employee_project();
                            ?>

                                <!-- DELETE QUERY -->
                                <?php
                                    
                                    if(isset($_POST['submit'])){

                                        $emp_id = $_GET['employee_id'];
                                        $pro_id = $_GET['project_id'];

                                        $employee_project->delete($emp_id , $pro_id);

                                        // Include history_class
                                        
                                        include_once "classes/history.php";
                                        $history = new History();
                                        $history->Delete($emp_id , $pro_id);
                                        
                                        echo  "<script> window.location = 'employee_project.php?delete'</script>";
                                       
                                    }


                                ?>

                            <?php
                                
                                if(isset($_GET['employee_id']) && isset($_GET['project_id'])){

                                    $emp_id = $_GET['employee_id'];
                                    $pro_id = $_GET['project_id'];

                                    ?>
                                        <div class="container">
                                            <table class="lable table mt-5">
                                                <thead>
                                                    <tr>
                                                        <th>S#</th>
                                                        <th>Project Name</th>
                                                        <th>Name</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                    $sql = $db->db->prepare("SELECT employee_project.project_id , employee_project.employee_id , project.project_name , employee.first_name , employee.last_name , employee_project.amount , employee_project.date FROM `employee_project` INNER JOIN `project` ON employee_project.project_id = project.id
                                                     INNER JOIN employee ON employee_project.employee_id = employee.id WHERE  employee_project.employee_id = :emp_id AND employee_project.project_id = :pro_id");

                                                     $sql->bindParam(":emp_id" ,  $emp_id);
                                                     $sql->bindParam(":pro_id" ,  $pro_id);

                                                     $sql->execute();

                                                   

                                                     while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                         ?>
                                                         <!-- tbody -->
                                                         <tbody>
                                                             <tr>
                                                                 <td><?php echo $row['employee_id'];?></td>
                                                                 <td><?php echo $row['project_name']; ?></td>
                                                                 <td><?php echo $row['first_name'].$row['last_name']; ?></td>
                                                                 <td><?php echo $row['amount']; ?></td>
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

                            if(isset($_GET['employee_id']) && isset($_GET['project_id'])){
                                ?>

                                    <form method="post">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" name="submit">
                                            <i class="fas fa-trash"> Yess</i> </button>

                                            <a href="employee_project.php" class="btn btn-danger">

                                                <i class="fas fa-angle-double-right"></i> NO
                                            </a>
                                        
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

