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
                <!-- Include Sidebar -->
                <?php include_once "sidebar.php" ?>
                <div class="col-sm-10" style="padding:0px;">

                    <!-- Include navbar  -->
                    <?php include_once "navbar.php"; ?>

                        <!--container  -->
                        <div class="container">
                            <div class="row mt-5" id="expances">
                                <div class="col-sm-12">

                                    <?php  include_once "classes/expances.php";
                                             $expaneX = new Expances(); 
                                              ?>
                                   <!-- Get Id -->
                                    <?php  
                                        if(isset($_GET['id'])){

                                            $id = $_GET['id'];

                                            $edit = $expaneX->getID($id);
                                        }

                                        ?>

                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Expances Details</h4>
                                        </div>
                                        <div class="card-body">

                                            <form action="edit_expances.php?id=<?php echo $id   ?>" method="post">

                                                <div class="form-group">
                                                    <label for="expances"><i class="fas fa-rupee-sign"></i> Expances Title</label>
                                                      <input type="text" name="expances" class="form-control form-control-sm" placeholder="Enter Expances" autocomplete="off"required value="<?php echo $edit['expances']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="amount"><i class="fas fa-sort-amount-up"></i> Amount</label>
                                                      <input type="number" name="amount" class="form-control form-control-sm" placeholder="Enter Amount" autocomplete="off"required value="<?php echo $edit['amount']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                                                      <input type="date" name="date" class="form-control form-control-sm"  autocomplete="off"required value="<?php echo $edit['date'];  ?>">
                                                </div>
                                                    <!-- hidden file -->
                                                    <input type="hidden" name="id" value="<?php echo $edit['id'];  ?>">
                                                    
                                                <div class="form-group">
                                                      <input type="submit" class="btn btn-primary btn-sm" name="submit" value="EXPANCES">
                                                </div>

                                            </form>
                                                
                                                <?php   include_once "lib/edit_expances.php" ?>
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