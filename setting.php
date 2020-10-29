<?php

include_once "auth.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
   
   <!-- Include css and js files -->
   <?php include_once "Themes.php"   ?>

    <title>Setting</title>

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
                                        <h4>Setting</h4>
                                        <br>

                                    </div>
                                    <div class="card-body">
                                        <form action="" id="my-form">
                                            <div class="form-group">
                                                <select name="sitting" id="sitting" class="form-control form-control-sm" required>
                                                    <option value="">Select theme</option>
                                                    <option value="Blue">Blue</option>
                                                    <option value="Green Light">Green Light</option>
                                                    <option value="Purple">Purple</option>
                                                    <option value="Black">Black</option>
                                                    <option value="Dark Red">Dark Red</option>
                                                
                                                </select>
                                            </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-sm" id="submit" name="submit" value="SUBMIT">
                                                </div>    

                                        </form>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        
        </div>

        <script defer>

        const myForm = document.querySelector('#my-form');
        const sitting = document.querySelector('#sitting');

        myForm.addEventListener('submit', onSubmit);

        function onSubmit(e){
            e.preventDefault();

            console.log(sitting.value);

            var setValue = sitting.value;

            window.localStorage.setItem('Theme Name', setValue);

        }       
    
    </script>
</body>
</html>