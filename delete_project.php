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
    
    <title>Delete project</title>
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                <!--Include navbar.php -->
                <?php include_once "navbar.php";   ?>

                    <!-- Include project class -->
                        <?php
                            include_once "lib/db.php";
                            include_once "classes/project.php";
    
                            $db = new db();
                            $project = new Project();

                        ?>

                    <?php  
                        // DELETE QUERY
                        if(isset($_POST['submit'])){

                            $id = $_GET['id'];

                            $project->delete($id);

                            echo "<script> window.location = 'project.php?deleted' </script>";
                        }



                        
                         //Get id
                        if(isset($_GET['id'])){

                            $id = $_GET['id'];
                            ?>
                            <div class="container">
                                <table class="table mt-5">
                                    <thead>
                                        <tr>
                                            <th>S#</th>
                                            <th>Project Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <?php

                                        $sql = $db->db->prepare("SELECT * FROM project WHERE id = :id");

                                        $sql->execute(array(":id"=>$id));

                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                            ?>

                                            <!-- tbody -->
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['id'];?></td>
                                                    <td><?php echo $row['project_name'];?></td>
                                                    <td><?php echo $row['p_from'];?></td>
                                                    <td><?php echo $row['p_to'];?></td>
                                                    <td><?php echo $row['amount'];?></td>
                                                    
                                                </tr>
                                            </tbody>

                                            <?php
                                        }

                                    ?>
                                
                                </table>
                            
                            </div>
                            
                            <!--button  -->
                            <div class="container">
                                <p>
                                <?php

                                    if(isset($_GET['id'])){
                                        ?>

                                        <form method="post">
                                        
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-success">
                                                <i class="fas fa-trash"></i> Yess
                                                </button>
                                                <a href="project.php" class="btn btn-danger">
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
