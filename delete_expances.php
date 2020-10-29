<?php   

        include_once "auth.php";


    $email = '';

    if(isset($_SESSION['email'])){
        
        $email = $_SESSION['email'];

    }

    

    $sql = "SELECT `role` FROM `login` WHERE email = :email";

    // include db
    include_once "lib/db.php";

    include_once "classes/add_user.php";
    $menu = new addUser();

    $role = $menu->expancesMU($sql , $email);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
    <?php include_once "Themes.php"   ?>
   
    <title>Expances</title>
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                      <!-- Include Expances Class -->
                      <?php include_once "classes/expances.php";
                                    $expaneX = new Expances();

                                    // Include DB connection -->
                                    include_once "lib/db.php";
                                    $db = new db();
                            ?>

                     <!--Include navbar.php -->
                        <?php include_once "navbar.php";   ?>

                            <!-- Delete Query -->
                             <?php 
                                if(isset($_POST['submit'])){

                                    $id = $_GET['id'];

                                    $expaneX->delete($id);

                                       echo "<script> window.location = 'expances.php?deleted' </script>";
                                }

                             
                             ?>   

                        <!-- Get id -->
                        <?php

                            if(isset($_GET['id'])){

                                $id = $_GET['id'];

                                    ?>
                                    <div class="container">
                                        <table class="table mt-5">
                                            <thead>
                                                <tr>
                                                <th scope="col">S#</th>
                                                <th scope="col">Expances Title</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date</th>
                                                </tr>
                                            </thead>

                                            <!-- php -->
                                            <?php

                                            $sql = $db->db->prepare("SELECT * FROM expances WHERE id  = :id");
                                            
                                            $sql->execute(array(":id"=>$id));

                                           while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                               ?>

                                                <!-- tbody -->
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['expances']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['date']; ?></td>
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
                                                                    <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-trash"></i> Yess</button>
                                                                    <a href="expances.php" class="btn btn-danger">
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


</body>
</html>

