<?php

// include DB connection
include_once "lib/db.php";

class Employee_project extends db{


    // Get Project
    public function getProject($sql){

        $sel = $this->db->prepare($sql);

        $sel->execute();

        if($sel->rowCount() > 0){

            ?> <option value="#">Select Project</option><?php

            while($row = $sel->fetch(PDO::FETCH_ASSOC)){
                ?>

                <option value="<?php echo $row['id']; ?>"><?php echo $row['project_name']; ?></option>

                <?php

            }
        }

    }

    // Get Employee
    public function getEmployee($sql){

        $sel = $this->db->prepare($sql);

        $sel->execute();

        if($sel->rowCount() > 0){

            ?> <option value="#">Select Employee</option><?php
            
            while($row = $sel->fetch(PDO::FETCH_ASSOC)){
                ?>

                    <option value="<?php echo $row['id'];?>"><?php echo $row['first_name'].$row['last_name'];?></option>

                <?php
            }
        }

    }

    // Project amount filtoration

    public function getAmount($sql , $project_id){

        $sel = $this->db->prepare($sql);

        $sel->bindParam(":project_id" , $project_id);
        $sel->execute();

        if($sel->rowCount() > 0){
            
            $fin = $sel->fetch();

            return $fin['amount'];
        }

    }


     // Employee_project SUM  QUERY

     public function getSum($project_employee_total , $project_id){

        $sql = $this->db->prepare($project_employee_total);
        $sql->bindParam(":project_id" ,$project_id);

        $sql->execute();
        $sum = $sql->fetch();

        return $sum['total'];
    }

    // INSERT QUERY

    public function Create($project_id , $employee_id , $amount , $date){

       try{

            $sql = $this->db->prepare("INSERT INTO `employee_project`(project_id , employee_id , amount , `date`) VALUES(? , ? , ? , ?)");

            $sql->bindParam(1 , $project_id);
            $sql->bindParam(2 , $employee_id);
            $sql->bindParam(3 , $amount);
            $sql->bindParam(4 , $date);

            $sql->execute();
            
            return TRUE;

        }catch(PDOException $e){
           echo "Error pleace check" .$e->getMessage();
           return FALSE;
       }

    }

    // GET UPDATE ID
    public function getID($emp_id, $pro_id){
  
        $sql = $this->db->prepare("SELECT employee_project.project_id, employee.id as employee_id, project.project_name , employee.first_name , employee.last_name , employee_project.amount , employee_project.date FROM employee_project  INNER JOIN project on employee_project.project_id = project.id
        INNER JOIN employee on employee_project.employee_id = employee.id WHERE employee.id = :emp_id AND project.id = :pro_id");

        $sql->bindParam(":emp_id" , $emp_id);
        $sql->bindParam(":pro_id" , $pro_id);
        $sql->execute();

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;
    }


    // UPDATE QUERY
    public function Update($emp_id , $proj_id , $project , $employee , $amount , $date){

        try{

            $sql = $this->db->prepare("UPDATE `employee_project` SET project_id = :project_id , employee_id = :employee_id , amount = :amount , `date` = :datee  WHERE employee_id = :emp_id AND project_id = :proj_id");

            $sql->bindParam(":emp_id" , $emp_id);
            $sql->bindParam(":proj_id" , $proj_id);
            $sql->bindParam(":project_id" , $project);
            $sql->bindParam(":employee_id" , $employee);
            $sql->bindParam(":amount" , $amount);
            $sql->bindParam(":datee" , $date);
    
            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo "Error Please Check" .$e->getMessage();
            return FALSE;

        }
    }


    // DELETE QUERY
        public function delete($emp_id , $pro_id){

            $sql = $this->db->prepare("DELETE FROM `employee_project` WHERE employee_id = :emp_id AND project_id = :pro_id");
            $sql->bindParam(":emp_id" , $emp_id);
            $sql->bindParam(":pro_id" , $pro_id);

            $sql->execute();
            return TRUE;

        }
    


     // Project amount filtoration Update
     public function updateAmount($sql , $proj_id){

        $amount = $this->db->prepare($sql);
        $amount->bindParam(":project_id" , $proj_id);
        $amount->execute();
        
        if($amount->rowCount() > 0){

            $fin = $amount->fetch();
            return $fin['amount'];
        }
     }

    //  Employee_project SUM Update Query
    public function updateSum($project_employee_total , $proj_id){

        $sql = $this->db->prepare($project_employee_total);
        $sql->bindParam(":project_id" , $proj_id);

        $sql->execute();

        $tot = $sql->fetch();
        return $tot['total'];
    }



    // SELECT QUERY

    public function dataView($sql , $role){

        $Select = $this->db->prepare($sql);

        $Select->execute();
        
        ?> <tbody> <?php
        if($Select->rowCount() > 0){

            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>

                <!-- tbody -->

                
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['project_name']; ?></td>

                        <td>

                        <?php 
                        
                            $sql = "SELECT project.project_name, employee.id as employee_id, employee.first_name , employee.last_name , employee_project.amount, employee_project.date FROM `employee_project` INNER JOIN project on employee_project.project_id = project.id 
                            INNER JOIN employee on employee_project.employee_id = employee.id WHERE  employee_project.project_id = :project_id";

                            $project_id = $row['id'];
                            $employee_id = $row['id'];


                            $record = $this->db->prepare($sql);
                            $record->bindParam(":project_id" , $project_id);

                            $record->execute();

                           $data = $record->fetchAll(PDO::FETCH_ASSOC);

                           foreach($data as $d):
                           
                           ?>
                                <div><?php echo $d['first_name']. ' '  . $d['last_name'] ?>  <span class="badge badge-pill badge-success"><strong> <?php echo $d['amount'] ?></strong></span>

                                <!-- checking for admin and user -->
                                <?php  if($role === 'Admin'){ ?>

                                 <a href="edit_employee_project.php?employee_id=<?php echo $d['employee_id']; ?>&project_id=<?php echo $project_id; ?>" class='btn btn-success btn-xs'  style="font-size:5px">    
                                    <i class='fas fa-pencil-alt'></i> 
                                </a>  
                                 <a href="delete_employee_project.php?employee_id=<?php echo $d['employee_id']; ?>&project_id=<?php echo $project_id; ?>" class='btn btn-danger btn-xs'  style="font-size:5px">
                                    <i class='fas fa-trash'></i> </a> </br>

                                <?php }  ?>
                                <!-- end -->

                                </div>

                           <?php 
                            endforeach;
                            
                        
                        
                        ?>
                        
                        </td>

                <?php
            }

            ?> </tbody> <?php

        }


    }
    

}



?>