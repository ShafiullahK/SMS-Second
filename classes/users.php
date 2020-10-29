<?php

// include db 
include_once "lib/db.php";


class Users extends db{

    // users dataview 
    public function dataView($sql , $role){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?> <tbody> <?php

        if($Select->rowCount() > 0){
            $i = 0;

            while($row = $Select->fetch(PDO::FETCH_ASSOC)){

                ?>
                    <tr>
                        <td><?php echo ++$i;   ?></td>
                        <td><?php echo $row['user'];   ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role'];   ?></td>

                            <!-- checking -->
                            <?php if($role === 'Admin'){   ?>

                        <td>
                            <div class="btn-group">
                                
                                <a href="edit_users.php?id=<?php   echo $row['id']; ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                <a href="delete_users.php?id=<?php echo $row['id'];   ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>

                            </div>
                        </td>

                            <?php  }  ?>

                    </tr>

                <?php
            }

            ?> </tbody> <?php
        }

    }



        // Get Update Id
        public function getID($id){

            $sql = $this->db->prepare("SELECT * FROM `login` WHERE id = :id");

            $sql->execute(array(":id"=>$id));
            $editrow = $sql->fetch(PDO::FETCH_ASSOC);

            return $editrow;

            
        }


        // DELETE QUERY
        public function Delete($id){

            $sql = $this->db->prepare("DELETE FROM `login` WHERE id = :id");

            $sql->bindParam(":id" , $id);

            $sql->execute();
            return TRUE;

        }



        // UPDATE QUERY
        public function Update($id , $name , $email , $role){
            try{

                $sql = $this->db->prepare("UPDATE `login` SET user = :user , email = :email , `role` = :rolee WHERE id = :id");

                $sql->bindParam(":id" , $id);
                $sql->bindParam(":user" , $name);
                $sql->bindParam(":email" , $email);
                $sql->bindParam(":rolee" , $role);

                $sql->execute();
                return TRUE;

            }catch(PDOException $e){
                echo "Error Pleace Check" .$e->getMessage();
                return FALSE;
            }

        }






}



?>