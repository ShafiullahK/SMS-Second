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

    <script>
        $(document).ready(function(){
            $('#exp').DataTable({
                dom : 'Bfrtip',
                buttons : [
                    'excel','copy','pdf','csv','print'
                ]
            });
        });
    </script>
</head>
<body>
        <div class="container-fluid">
            <div class="row">
                <!-- Include Sidebar -->
                <?php include_once "sidebar.php" ?>
                <div class="col-sm-10" style="padding:0px;">

                    <!-- Include navbar  -->
                    <?php include_once "navbar.php"; ?>

                        <!--container  -->
                        <div class="container">
                            <div class="row mt-5" id="expances">
                                <div class="col-sm-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Expances Details</h4>
                                        </div>
                                        <div class="card-body">

                                            <form action="expances.php" method="post">

                                                <div class="form-group">
                                                    <label for="expances"><i class="fas fa-rupee-sign"></i> Expances Title</label>
                                                      <input type="text" name="expances" class="form-control form-control-sm" placeholder="Enter Expances" autocomplete="off"required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="amount"><i class="fas fa-sort-amount-up"></i> Amount</label>
                                                      <input type="number" name="amount" class="form-control form-control-sm" placeholder="Enter Amount" autocomplete="off"required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                                                      <input type="date" name="date" class="form-control form-control-sm"  autocomplete="off"required>
                                                </div>

                                                <div class="form-group">
                                                      <input type="submit" class="btn btn-primary btn-sm" name="submit" value="EXPANCES">
                                                </div>

                                            </form>
                                                <!-- Include Expances Classes -->
                                                <?php 
                                                    include_once "classes/expances.php";
                                                        $expaneX = new Expances();
                                                        include_once "lib/expances.php";

                                                ?>
                                        </div>
                                    </div>


                                
                                
                                
                                </div>
                                <div class="col-sm-7">

                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Expances</h4>
                                            <br>
                                                
                                    <!-- Show Update Message -->
                                    <div class="container">
                                    <?php

                                        if(isset($_GET['updated'])){

                                            ?>
                                            <div class="alert alert-success"role="alert"><strong>Record was updated Successfully</strong></div>
                                        <?php
                                        }

                                    ?>

                                    </div>
                                    <div class="container">
                                    <?php

                                        if(isset($_GET['notupdated'])){

                                            ?>
                                            <div class="alert alert-danger"role="alert"><strong>Sorry record was not updated </strong></div>
                                        <?php
                                        }

                                    ?>

                                    </div>
                                    <!-- Show Update Message end-->
                                    
                                            <!-- Delete Message -->
                                            <div class="container">
                                                <?php
                                                    if(isset($_GET['deleted'])){
                                                        ?>

                                                        <div class="alert alert-success"><strong>Record was deleted Successfully</strong></div>


                                                        <?php
                                                    }
                                                    ?>

                                            </div>
                                            <!-- Delete Message end -->

                                    
                                            <!-- Show insert Message -->
                                                <div class="container">
                                                <?php 
                                                if(isset($_GET['insert']))  {
                                                    ?>

                                                    <div class="alert alert-success"role="alert"><strong>Record was inserted  Successfully</strong></div>

                                                    <?php

                                                }


                                                ?>

                                                </div>

                                                <div class="container">
                                                <?php 
                                                if(isset($_GET['fail']))  {
                                                    ?>

                                                    <div class="alert alert-danger"role="alert"><strong>Sorry Data Not inserted</strong></div>

                                                    <?php

                                                }


                                                ?>

                                                </div>
                                                <!-- Show insert Message end -->

                                                 </div>
                                        <div class="card-body">
                                            
                                            <!-- Filteration  -->
                                            <form class="form-inline" method="post" action="expances.php">
                                                <div class="form-group mr-3">
                                                    <input type="date" name="date" class="form-control form-control-sm" >
                                                </div>
                                                    

                                                <div class="form-group">
                                                    <input type="submit" id="btn" class="btn btn-secondary btn-sm " name="filter" value=" Search">
                                                </div>
                                            
                                            </form>
                                                <?php  

                                                    ?>
                                                <br>
                                                <!--Filteration end  -->
                                            <table id="exp" class="table  dt-responsive nowrap" style="width:100%">

                                                <thead>
                                                    <tr>
                                                        <th scope="col">S#</th>
                                                        <th scope="col">Expances Title</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Date</th>

                                                        <!-- Checking amdin and user -->

                                                        <?php if($role === 'Admin'){

                                                          ?>


                                                        <th scope="col">Action</th>

                                                         <?php }  ?>

                                                    </tr>
                                                
                                                </thead>

                                                <!-- Php -->

                                                <?php 
                                                    // Include Expances Class
                                                    include_once "classes/expances.php";
                                                    $expaneX = new Expances();

                                                    $sql = "SELECT * FROM expances ORDER BY `id` DESC";

                                                    

                                                        // Filteration form 
                                                     if(isset($_POST['filter'])){

                                                        $date = $_POST['date'];

                                                        $sql2 = "SELECT * FROM expances WHERE `date` = :date ";

                                                        $expaneX->searchByDate($sql2 , $date , $role);
                                                        

                                                     }else{
                                                        $expaneX->dataView($sql , $role);


                                                     }

                                                    

                                                    


                                                    ?>
                                                
                                            
                                            </table>
                                                <?php
                                                            // Total Sum Query
                                                    $sql = "SELECT SUM(amount) as `total` FROM  `expances`";
                                                    $expaneX->getSum($sql);
                                                ?>
                                        
                                        
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