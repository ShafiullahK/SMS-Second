<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
        
       exit( header("location:index.php"));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>

    <title>Login</title>
</head>
<body style="background: lightgrey">
    <div class="container-fluid mt-5" id="login">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <div class="container">
                        
                           <img src="assets/img/img.png" alt="" id="img">
                        </div>
                            <br>

                              <!--Show Message  -->
                            <?php

                                if(isset($_GET['fail'])){

                                ?>
                                <div class="alert alert-danger" role="alert"><strong>Invalid User Email Or Password</strong></div>

                                <?php

                                }

                            ?>

                            <!-- End Show message -->

                        <h5><i class="fas fa-user"></i> Login</h5>
                            
                    </div>
                    <div class="card-body">
                        <form action="lib/login.php" method="post" class="form-section">

                            <div class="form-group">

                            <label for="email"> <i class="fas fa-envelope"></i> User Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter User Email" autocomplete="off" required>
            
                            </div>

                            <div class="form-group">

                            <label for="pass"><i class="fas fa-key"></i> User Password</label>
                            <input type="password" name="pass" class="form-control form-control-sm" placeholder="Enter User Password" autocomplete="off" required>
            
                            </div>

                                <div class="form-group">
                                    <a href="#">Forgot Password?</a>
                                </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block"name="submit" value="LOGIN  &rarr;" >
                            
                            </div>

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</body>
</html>