<?php

    if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];


        if($user->Update($id , $name , $email , $role)){

            echo "<script> window.location = 'users.php?update' </script>";

        }else{

            echo "<script> window.location = 'users.php?notupdate' </script>"; 
        }

    }
     

?>



