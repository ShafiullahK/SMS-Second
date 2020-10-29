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

    <title>Users</title>

    <script>
       $(document).ready(function(){
           $('#user').DataTable({
               dom : 'Bfrtip',
               buttons : [
                'excel','copy','pdf','csv','print'
               ]
           });
       });
    </script>

</head>
<body>
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">

                <!--include sidebar  -->

                <?php  include_once "sidebar.php"  ?>

                <div class="col-sm-10"style="padding:0px">

                <!-- include navbar -->

                <?php  include_once "navbar.php"  ?>

                    <!--container  -->
                    <div class="container">
                        <div class="row mt-5" id="users">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Users</h4>
                                        <br>

                                            <!--Show Update message  -->

                                            <div class="container">
                                            <?php

                                                if(isset($_GET['update'])){

                                                    ?>
                                                    <div class="alert alert-success"role="alert"><strong>Record was updated Successfully</strong></div>

                                                    <?php
                                                }else{

                                                }

                                            ?>
                                            </div>

                                            <div class="container">
                                            <?php

                                                if(isset($_GET['notupdate'])){

                                                    ?>
                                                    <div class="alert alert-danger"role="alert"><strong>Sorry Record was not updated</strong></div>

                                                    <?php
                                                }else{
                                                    
                                                }

                                            ?>
                                            </div>

                                            <!--Show Update message end -->

                                            <!-- Show DELETE message  -->
                                                <div class="container">
                                                
                                                <?php

                                                if(isset($_GET['deleted'])){
                                                    ?>

                                                    <div class="alert alert-success"role="alert"><strong>Record was deleted Successfully</strong></div>

                                                    <?php
                                                }

                                                ?>

                                                </div>
                                                <!-- Show DELETE message  end-->

                                    </div>
                                    <div class="card-body">
                                            <table id="user" class="table  dt-responsive nowrap" style="width:100%">
                                                <thead>
                                                        <tr>
                                                            <th scope="col">S#</th>
                                                            <th scope="col">User Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Role</th>

                                                               <!--checking   -->
                                                               <?php  if($role === 'Admin'){  ?>

                                                            <th scope="col">Action</th>

                                                               <?php }  ?>


                                                        </tr>
                                                </thead>

                                                <!-- include Users class -->

                                                <?php  
                                                    include_once "classes/users.php";
                                                    $user = new Users();

                                                    $sql = "SELECT * FROM `login`";
                                                    
                                                    $user->dataView($sql ,$role);

                                                ?>

                                        </table>
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