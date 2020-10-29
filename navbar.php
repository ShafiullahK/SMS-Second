<?php

            
                if(isset($_SESSION['email'])){

                    $email = $_SESSION['email'];
                }

                $sql = "SELECT `user` FROM `login` WHERE email = :email";
                
                // include db
                include_once "lib/db.php";

                include_once "classes/add_user.php";
                $adduser = new addUser();

            $username =  $adduser->addNav($sql , $email);



    ?>

            
                    <!-- end PHP -->


        <nav class="navbar navbar-black navbar-expand-sm">
            <ul class="navbar-nav ml-auto">

                <!-- checking  -->


                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo $username ?></a></li>

                <li class="nav-item"><a class="nav-link" href="lib/logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a></li>
            </ul>

        </nav>