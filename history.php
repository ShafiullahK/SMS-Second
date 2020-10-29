<?php


    include_once "auth.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
        <?php include_once "Themes.php"   ?>

    <title>History</title>
    <script>
            
            $(document).ready(function(){
                $("#my_ta").DataTable({
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

                <?php include_once "sidebar.php"    ?>

                <div class="col-sm-10" style="padding:0px">

                    <!-- include navbar -->

                    <?php include_once "navbar.php"   ?>

                    <!-- container -->
                    <div class="container">
                        <div class="row mt-5" id="history">
                            <div class="col-sm-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h4>History details</h4>
                                    
                                    </div>
                                    <div class="card-body">
                                        <table class="table dt-responsive nowrap" id='my_ta' style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Name</th>
                                                    <th>Project</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>

                                            <?php

                                                include_once "classes/history.php";
                                                $history = new History();

                                                $sql = "SELECT project.project_name , employee.first_name , employee.last_name , history.amount , history.date FROM history INNER JOIN employee on history.employee_id = employee.id INNER JOIN project on  history.project_id = project.id ORDER BY `history`.`id` DESC";
                                                    
                                                $history->dataView($sql);


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