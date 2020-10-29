<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
    
    exit(header("location:login.php"));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

        <!-- Include css and js files -->
    <?php include_once "Themes.php"   ?>
    
    <title>Index</title>
</head>
<body>

       <div class="container-fluid">
            <div class="row">
             <?php include_once "sidebar.php"   ?>
            <div class="col-sm-10" style="padding:0px">
                <?php   include_once "navbar.php"  ?>

                    <!-- container -->
                    <div class="container">
                        <div class="row mt-5" id="index_emp">
                            <div class="col-sm-3">
                                <div class="card" id="card">
                                    
                                    <div class="card-body">
                                        <?php
                                                 //   employee class

                                            include_once "classes/employee.php";

                                            $employee = new Employee();

                                            // include index class
                                            include_once "classes/index.php";
                                            $index = new Index();


                                            $sql = "SELECT * FROM `employee`";

                                            $show =  $index->dataView($sql);

                                            ?>
                                                <span id="emp_id"> <?php echo  $show  ?></span> <i class="fas fa-users "id="userIcon"></i>
                                                <br>
                                                <span id="emp_text"><i class="fas fa-circle" style="color:#FF3031"></i> TOTAL EMPLOYEES</span>
                                        
                                    </div>
                                </div>
                            
                            </div>

                                <!-- project -->

                            <div class="col-sm-3">
                                <div class="card" id="pro-card">
                                    
                                    <div class="card-body">
                                        <?php
                                                 //   project class

                                            include_once "classes/project.php";

                                            $project = new Project();

                                            // include index class
                                            include_once "classes/index.php";
                                            $index = new Index();


                                            $sql = "SELECT * FROM `project`";

                                            $pro =  $index->projectData($sql);

                                            ?>
                                                <span id="emp_id"> <?php echo  $pro  ?></span> <i class="fas fa-project-diagram"id="pro-Icon" ></i>
                                                <br>
                                                <span id="emp_text"><i class="fas fa-circle" style="color:#67E6DC"></i> TOTAL PROJECTS</span>
                                        
                                    </div>
                                </div>
                            
                            </div>

                            <!-- end -->


                             <!-- expenses -->

                             <div class="col-sm-3">
                                <div class="card" id="exp-card">
                                    
                                    <div class="card-body">
                                        <?php
                                                 //   expanses class

                                            include_once "classes/expances.php";

                                            $expances = new Expances();

                                            // include index class
                                            include_once "classes/index.php";
                                            $index = new Index();


                                            $sql = "SELECT SUM(amount) as `total` FROM `expances`";

                                            $expan =  $index->expancesData($sql);

                                            ?>
                                                <span id="exp_id"> <?php echo  $expan  ?></span><i class="fas fa-euro-sign" id="exp-Icon"></i> 
                                                <br>
                                                <span id="exp_text"><i class="fas fa-circle" style="color:#FFF222"></i> TOTAL EXPENSES</span>
                                        
                                    </div>
                                </div>
                            
                            </div>

                            <!-- end -->


                            <!-- users -->

                            <div class="col-sm-3">
                                <div class="card" id="user-card">
                                    
                                    <div class="card-body">
                                        <?php
                                                 //   users class

                                            include_once "classes/users.php";

                                            $users = new Users();

                                            // include index class
                                            include_once "classes/index.php";
                                            $index = new Index();


                                            $sql = "SELECT * FROM `login`";

                                            $Users =  $index->usersData($sql);

                                            ?>
                                                <span id="emp_id"> <?php echo  $Users  ?></span> <i class="fas fa-user"id="user-Icon" ></i>
                                                <br>
                                                <span id="emp_text"><i class="fas fa-circle" style="color:#45CE30"></i> TOTAL USERS</span>
                                        
                                    </div>
                                </div>
                            
                            </div>

                            <!-- end -->




                            <div class="col-sm-12" style="margin-top:5%" id="index-card">
                                <div class="card">
                                    
                                    <div class="card-body">

                                         <!-- Chart-->
                                        <figure class="highcharts-figure">
                                            <div id="container"></div>
                                        </figure>

                                        <?php
                                                 //   Expenses class

                                            include_once "classes/expances.php";

                                            $expances = new Expances();

                                            // include index class
                                            include_once "classes/index.php";
                                            $index = new Index();



                                            $jan = $index->highChart('01');
                                            $feb = $index->highChart('02');
                                            $march = $index->highChart('03');
                                            $apr = $index->highChart('04');
                                            $may = $index->highChart('05');
                                            $june = $index->highChart('06');
                                            $july = $index->highChart('07');
                                            $aug = $index->highChart('08');
                                            $sep = $index->highChart('09');
                                            $oct = $index->highChart('10');
                                            $nov = $index->highChart('11');
                                            $dec = $index->highChart('12');


                                            ?>

                                            
                                        
                                    </div>
                                </div>
                            
                            </div>

                            <!-- end -->



                        </div>
                    
                    
                    </div>

            </div>



       </div>


      <script src="assets/js/highcharts.js"></script>
      <script src="assets/js/exporting.js"></script>
      <script src="assets/js/export-data.js"></script>
      <script src="assets/js/accessibility.js"></script>
    
    <script>

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Expenses'
                },
                subtitle: {
                    text: 'Source: Xplode.com'
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Expenses'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Months',
                    data: [parseInt("<?php echo $jan   ?>") , parseInt("<?php echo $feb   ?>") , parseInt("<?php echo $march   ?>") , parseInt("<?php echo $apr  ?>") , parseInt("<?php echo $may   ?>") , parseInt("<?php echo $june   ?>") , parseInt("<?php echo $july   ?>") , parseInt("<?php echo $aug   ?>") , parseInt("<?php echo $sep   ?>") , parseInt("<?php echo $oct   ?>") , parseInt("<?php echo $nov   ?>") , parseInt("<?php echo $dec   ?>")]

                }]
            });
                
    
    </script>

</body>
</html>