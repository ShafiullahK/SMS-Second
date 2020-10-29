<?php

// Include DB connection
include_once "lib/db.php";

class Expances extends db {

    // INSERT QUERY
    public function Create($expances , $amount , $date){

        try{

            $sql = $this->db->prepare("INSERT INTO `expances`(expances , amount , date) VALUES(? , ? , ?)");

            $sql->bindParam(1 , $expances);
            $sql->bindParam(2 , $amount);
            $sql->bindParam(3 , $date);

            $sql->execute();
            return TRUE;
            

        }catch(PDOException $e){
            echo "Error Pleace Check" .$e->getMessage();
            return FALSE;

        }

    }
        // GET UPDATE ID

        public function getID($id){

            $sql = $this->db->prepare("SELECT * FROM expances WHERE id = :id");

            $sql->execute(array(":id"=>$id));

            $editrow = $sql->fetch(PDO::FETCH_ASSOC);

            return $editrow;
        }

      // Sum Function 
      public function getSum($sql){

        $sum = $this->db->prepare($sql);
        $sum->execute();

        $total = $sum->fetch();
        ?>
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <strong>TOTAL <span class="badge badge-success"><?php echo number_format($total['total'] , 2); ?></span></strong>
                </div>
            </div>
        <?php

    }

    // UPDATE QUERY

    public function Update($id , $expances , $amount ,  $date){

        try{

            $sql = $this->db->prepare("UPDATE expances SET expances = :expances , amount = :amount , `date` = :datee WHERE id = :id");

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":expances" , $expances);
            $sql->bindParam(":amount" , $amount);
            $sql->bindParam(":datee" , $date);

            $sql->execute();

            return TRUE;

        }catch(PDOException $e){
            echo "Error Pleace Check" .$e->getMessage();
            return FALSE;

        }

    }

        // DELETE QUERY

        public function delete($id){

            $sql = $this->db->prepare("DELETE FROM `expances` WHERE id = :id");

            $sql->bindParam(":id" , $id);

            $sql->execute();

            return TRUE;

        }

        // Filteration QUERY

        public function searchByDate($sql2 , $date , $role){

            $Select = $this->db->prepare($sql2);

            $Select->bindParam(":date" , $date);

            $Select->execute();

            $i = 0;

            if($Select->rowCount() > 0){
                while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tbody>
                     <tr>
                         <td><?php echo ++$i; ?></td>
                         <td><?php echo $row['expances']; ?></td>
                         <td><?php echo $row['amount']; ?></td>
                         <td><?php echo $row['date']; ?></td>

                            <!-- checking for admin and user -->

                            <?php  if($role === 'Admin'){   ?>


                         <td>
                            <div class="btn-group">

                            <a href="edit_expances.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                            <a href="delete_expances.php?id=<?php echo $row['id'];  ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>

                            </div>
                         </td>

                            <?php  }  ?>

                     </tr>
                 </tbody>
                    <?php
                }
            }
            

        }


    // SELECT QUERY

    public function dataView($sql , $role){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?>  <tbody> <?php

        if($Select->rowCount() > 0){

            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>


                 
                     <tr>
                         <td><?php echo ++$i; ?></td>
                         <td><?php echo $row['expances']; ?></td>
                         <td><?php echo $row['amount']; ?></td>
                         <td><?php echo $row['date']; ?></td>

                            <!-- checking for admin and user -->

                            <?php if($role === 'Admin'){

                              ?>

                         <td>
                            <div class="btn-group">

                            <a href="edit_expances.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                            <a href="delete_expances.php?id=<?php echo $row['id'];  ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>

                            </div>
                         </td>

                           <?php   } ?>         

                     </tr>
                 
               <?php



                
            }

            ?> </tbody> <?php

        }


    }

  


}





?>