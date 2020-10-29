<?php

include_once "auth.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Include css and js files -->
     <?php include_once "Themes.php"   ?>

    <title>Employee Portfolio</title>
    <script>
            
            $(document).ready(function(){
                $("#example").DataTable({
                    dom : 'Bfrtip',
                    buttons:[
                        'excel','copy','pdf','csv','print'
                    ]
                });

            });
            
        </script>

</head>
<body>
        <div class="container-fluid">
            <div class="row">

                <!-- Include sidebar -->
                <?php    include_once "sidebar.php";  ?>

                <div class="col-sm-10" style="padding:0px">

                    <!-- include navbar -->
                    <?php   include_once "navbar.php"; ?>

                    <!-- container -->
                     <div class="container">
                        <div class="row mt-5" id="portfolio">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Employee Porfolio</h4>
                                    </div>
                                    <div class="card-body">
                                    <table id="example" class="table  dt-responsive nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Name</th>
                                                    <th>Projects</th>
                                                </tr>
                                            </thead>

                                                <!-- include protfolio Class -->
                                                <?php

                                                    include_once "classes/portfolio.php";

                                                    $protfolio = new Portfolio();

                                                    $sql = "SELECT * FROM `employee`";

                                                    $protfolio->dataView($sql);

                                                ?>

                                        
                                        </table>
                                    
                                    </div>
                                </div>
                            
                            
                            </div>
                        </div>
                     
                     </div>
            </div>
        
        
        </div>
</body>
</html>
