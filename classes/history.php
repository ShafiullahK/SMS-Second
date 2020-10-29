<?php

// include DB connection

include_once "lib/db.php";


class History extends db {

    // Insert QUERY

    public function Insert($project_id , $employee_id , $amount , $date){

        try{

            $sql = $this->db->prepare("INSERT INTO `history`(project_id , employee_id , amount , `date`) VALUES(? , ? , ? , ?)");

            $sql->bindParam("1" , $project_id);
            $sql->bindParam("2" , $employee_id);
            $sql->bindParam("3" , $amount);
            $sql->bindParam("4" , $date);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){

            echo "Pleace Check" .$e->getMessage();
            return FALSE;


        }

        
    }


    // SELECT QUERY

    public function dataView($sql){

        $Select = $this->db->prepare($sql);
        $Select->execute();
        ?><!-- tbody -->
        <tbody><?php

        if($Select->rowCount() > 0){
            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>
                    
                
                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><?php echo $row['first_name'].$row['last_name']; ?></td>
                        <td><?php echo $row['project_name']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>
                

                
               <?php 
            }

            ?> </tbody> <?php
            

        }
    }


    // UPDATE QUERY
    public function Update($emp_id , $proj_id ,  $project , $employee , $new_amount , $date){

        try{

            $sql = $this->db->prepare("UPDATE `history` SET project_id = :project_id , employee_id = :employee_id , amount = :amount , date = :datee WHERE employee_id = :emp_id AND project_id = :pro_id");

            $sql->bindParam(":emp_id" , $employee);
            $sql->bindParam(":pro_id" , $project);
            $sql->bindParam(":project_id" , $proj_id);
            $sql->bindParam(":employee_id" ,  $emp_id);
            $sql->bindParam(":amount" , $new_amount);
            $sql->bindParam(":datee" , $date);

            $sql->execute();

            return TRUE;

        }catch(PDOException $e){
            echo "Error Pleace Check" .$e->getMessage();
            return FALSE;
        }
    }



    // DELETE QUERY

    public function Delete($emp_id , $pro_id){

        $sql = $this->db->prepare("DELETE FROM `history` WHERE employee_id = :emp_id AND project_id = :pro_id");

        $sql->bindParam(":emp_id" , $emp_id);
        $sql->bindParam(":pro_id" , $pro_id);

        $sql->execute();
        return TRUE;

    }

}


?>