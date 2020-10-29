<?php

    include_once "auth.php";

    

    $email = '';
    
    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
    }

    $sql = "SELECT `role` FROM `login` WHERE email = :email";

    include_once "lib/db.php";

    // include addUsers class
        include_once "classes/add_user.php";
        $adduser = new addUser();

        $role = $adduser->add($sql , $email);
        
        

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>
    
    <title>User</title>
</head>
<body>
       <div class="container-fluid">
           <div class="row">
                <!-- include Sidebar.php -->
             <?php  include_once "sidebar.php"   ?>

               <div class="col-sm-10" style="padding:0px;">

                     <!--Include navbar.php -->
                        <?php include_once "navbar.php";   ?>

                        <?php   

                            // include DB
                            include_once "lib/db.php";
                            $DB = new db();

                            // include users class
                            include_once "classes/users.php";
                            $user = new Users();

                        ?>
                            <!-- Delete Query -->
                             <?php

                                    if(isset($_POST['submit'])){

                                        $id = $_GET['id'];

                                        $user->Delete($id);

                                       echo "<script> window.location = 'users.php?deleted' </script>";
                                        
                                    }

                                ?>

                              <!--GET ID  -->

                        <?php

                            if(isset($_GET['id'])){

                                $id = $_GET['id'];

                                ?>

                                <div class="container">
                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                                <!-- PHP -->
                                        <?php

                                                $sql = $DB->db->prepare("SELECT * FROM `login` WHERE id = :id");

                                                $sql->execute(array(":id"=>$id));

                                                while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                    ?>

                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $row['id'];  ?></td>
                                                            <td><?php echo $row['user'];  ?></td>
                                                            <td><?php echo $row['email'];  ?></td>
                                                            <td><?php echo $row['role'];  ?></td>
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

                                                    <!-- form -->

                                                        <form method="post">
                                                            <div class="form-group">
                                                                <button class="btn btn-success" name="submit" type="submit">
                                                                    <i class="fas fa-trash">Yess</i>
                                                                </button>
                                                                <a href="users.php" class="btn btn-danger"> <i class="fas fa-angle-double-right">NO</i> </a>
                                                            
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
