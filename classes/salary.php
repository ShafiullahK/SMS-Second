<?php

// include DB connection
include_once "lib/db.php";

class Salary extends db{

    // INSERT QUERY
    public function Create($employee_id , $basic_salary ,  $medical ,  $insurance , $netpay){

        try{

            $sql = $this->db->prepare("INSERT INTO `salary`(employee_id , basic_salary , medical , insurance , netpay) VALUES(? , ? , ? , ? , ?)");

            $sql->bindParam(1 ,$employee_id);
            $sql->bindParam(2 ,$basic_salary);
            $sql->bindParam(3 ,$medical);
            $sql->bindParam(4 ,$insurance);
            $sql->bindParam(5 ,$netpay);

            $sql->execute();

            return TRUE;

        }catch(PDOException $e){
            echo "Error Something Problem" .$e->getMessage();
            return FALSE;
        }

        

    }

        // UPDATE QUERY

        public function Update($id , $employee_id , $basic_salary , $medical , $insurance , $netpay){

            try{

               $sql =  $this->db->prepare("UPDATE salary SET employee_id = :employee_id , basic_salary = :basic_salary , medical = :medical , insurance = :insurance , netpay = :netpay WHERE id = :id");

               $sql->bindParam(":id" , $id);
               $sql->bindParam(":employee_id" , $employee_id);
               $sql->bindParam(":basic_salary" , $basic_salary);
               $sql->bindParam(":medical" , $medical);
               $sql->bindParam(":insurance" , $insurance);
               $sql->bindParam(":netpay" , $netpay);

               $sql->execute();
               return TRUE;

            }catch(PDOException $e){
                echo "Error SomeProblem" .$e->getMessage();

                return FALSE;

            }

        }


        // Get Update Id
        public function getId($id){

            $sql = $this->db->prepare("SELECT employee.first_name , employee.last_name , salary.* FROM salary inner join employee on salary.employee_id = employee.id WHERE salary.id = :id");
            $sql->execute(array(":id"=>$id));

            $editrow = $sql->fetch(PDO::FETCH_ASSOC);

            return $editrow;



        }

            // DELETE QUERY
            public function Delete($id){

                $sql = $this->db->prepare("DELETE FROM salary WHERE id = :id");

                $sql->bindParam(":id" , $id);
                $sql->execute();

                return TRUE;

            }



        // SELECT QUERY
    public function dataView($sql , $role){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?><tbody><?php

        if($Select->rowCount() > 0){
            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>

                


                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><?php echo $row['first_name'].$row['last_name']; ?></td>
                        <td><?php echo $row['basic_salary']; ?></td>
                        <td><?php echo $row['medical']; ?></td>
                        <td><?php echo $row['insurance']; ?></td>
                        <td><?php echo $row['netpay']; ?></td>

                        <!-- checking for amin and user -->
                            <?php if($role === 'Admin'){

                              ?>

                        <td>
                            <div class="btn-group">
                                <a href="edit_salary.php?id=<?php echo $row['id'];  ?>" class="btn btn-success btn-xs"> <i class="fas fa-pencil-alt"></i></a>
                                <a href="delete_salary.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs"> <i class="fas fa-trash"></i></a>
                            
                            </div>
                        
                        </td>
                            <?php  }  ?>

                    </tr>
                
               

                <?php
            }
            ?> </tbody><?php
        }

    }


    // pagination Function Start
    
    // pagination Function End

    


}




?>