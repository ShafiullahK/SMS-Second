<?php


$email = '';



if(isset($_SESSION['email'])){

    $email = $_SESSION['email'];
    
}


$sql = "SELECT `role` FROM `login` WHERE email = :email";

include_once "lib/db.php";

// Include employee Class
include_once "classes/add_user.php";
$menu = new addUser();

$role =  $menu->sideMU($sql , $email);

// end

?>


        <div class="col-sm-2 sidebar" >
        <img src="assets/img/img.png" alt="" id="img1">
            <br>
            <hr>
            <ul class="nav-pills flex-column">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="Employee.php"><i class="fas fa-users"></i> Employee</a></li>
                <li class="nav-item"><a class="nav-link" href="salary.php"><i class="fas fa-hand-holding-usd"></i> Salary</a></li>
                <li class="nav-item"><a class="nav-link" href="expances.php"><i class="fas fa-dollar-sign"></i> Expenses</a></li>
                <li class="nav-item"><a class="nav-link" href="project.php"><i class="fas fa-project-diagram"></i> Project</a></li>
                <li class="nav-item"><a class="nav-link" href="employee_project.php"> <i class="fas fa-tasks"></i> Employee Project</a></li>
                <li class="nav-item"><a class="nav-link" href="history.php"> <i class="fas fa-history"></i> History</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php"> <i class="fas fa-briefcase"></i> Portfolio</a></li>

                <?php  if($role === 'Admin'){  ?>

                <li class="nav-item"><a class="nav-link" href="add_user.php"><i class="fas fa-plus"></i> Add User</a></li>
                    
                <?php   } ?>

                <li class="nav-item"><a class="nav-link" href="users.php"><i class="fas fa-user"></i> Users</a></li>
                <li class="nav-item"><a class="nav-link" href="setting.php"><i class="fas fa-cogs"></i> Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a></li>
            </ul>
        </div>
 