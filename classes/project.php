<?php

// Include DB connection
include_once "lib/db.php";

class Project extends db {

    // INSERT QUERY
    public function Create($project_name ,$p_form , $p_to , $amount ){
        try{

            $sql = $this->db->prepare("INSERT INTO `project`(project_name , p_from , p_to , amount ) VALUES(? , ? , ? , ?)");

            $sql->bindParam(1 , $project_name);
            $sql->bindParam(2 , $p_form );
            $sql->bindParam(3 , $p_to);
            $sql->bindParam(4 , $amount);
           

            $sql->execute();
            return TRUE;


        }catch(PDOException $e){
            echo "Error Pleace Check" .$e->getMessage();
            return FALSE;

        }

    }
        // MarkReady
        public function markReady($id){

            $sql =$this->db->prepare("UPDATE project SET project_status = 1 WHERE id = :id");

            $sql->bindParam(":id" , $id);

            if ($sql->execute()) {
                return true;
            }

            
        }

        
  

    // UPDATE QUERY

    public function Update($id , $project_name , $p_from , $p_to , $amount){
        try{

            $sql = $this->db->prepare("UPDATE `project`SET project_name = :project_name , p_from = :p_from , p_to = :p_to , amount = :amount WHERE id = :id");

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":project_name" , $project_name);
            $sql->bindParam(":p_from" , $p_from);
            $sql->bindParam(":p_to" , $p_to);
            $sql->bindParam(":amount" , $amount);
            
            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo "Error Something Problem" .$e->getMessage();
            
            return FALSE;


        }

    }


    // DELETE QUERY
    public function delete($id){

       $sql = $this->db->prepare("DELETE FROM `project`WHERE id = :id");

       $sql->bindParam("id" , $id);
       $sql->execute();

       return TRUE;

    }


      // Get UPDATE Id
      public function getID($id){

        $sql = $this->db->prepare("SELECT * FROM project WHERE id = :id");

        $sql->execute(array(":id"=>$id));

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;


    }
        

    // SELECT QUERY

    public function dataView($sql , $role){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?> <tbody><?php

        $i = 0;
        if($Select->rowCount() > 0){

            while($row = $Select->fetch(PDO::FETCH_ASSOC)){

                ?>
                    <!-- tbody -->
                    
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td><?php echo $row['p_from']; ?></td>
                            <td><?php echo $row['p_to']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td>
                                <!-- filter days between to table -->
                                <?php
                                    $from = $row['p_from'];
                                    $to = $row['p_to'];

                                    $earlier = new DateTime($from);
                                    $later = new DateTime($to);

                                    $diff = $later->diff($earlier)->format("%a");
                                    
                                    
                                    // Status Condition
                                    if($row['project_status'] == 1){

                                        echo "<strong><span class='badge badge-pill badge-success' style='padding:7px; font-size:9px'>COMPLETED</span></strong>";


                                    }else{
                                        echo $diff;
                                    }
                                    

                                          ?>
                            
                            </td>
                            <td>
                                <!-- Status condition -->
                                <?php  
                                    if ($row['project_status'] == 1) {
                                        
                                        echo "<strong><span class='badge badge-pill badge-success' style='padding:7px; font-size:9px'>DONE</span></strong>";

                                    } else if ($row['project_status']  == 0 && $diff  > 0) {

                                        echo "<strong><span class='badge badge-pill badge-warning' style='padding:7px; font-size:9px'>RUNING</span></strong>";                                        

                                    }else if($row['project_status']  == 0 && $diff  == 0){

                                        echo "<strong><span class='badge badge-pill badge-danger' style='padding:7px; font-size:9px'>DATELINE CROSS Cross</span></strong>";


                                    }

                                ?>
                            </td>
                                    
                                        <!-- markReady -->
                            <td>
                                    <form >
                                        <div class="form-group">
                                            <button type="button" name="mark" id="donBtn-<?php echo $row['id'] ?>" class="btn btn-success btn-xs" value="<?php echo $row['id'] ?>">Done</button>
                                        </div>
                                    </form>

                                    <script>
                                        $(document).ready(function(){
                                            $('#donBtn-<?php echo $row['id'] ?>').click(function(){
                                                
                                                $.post('project.php', {
                                                    project_id: $(this).val()

                                                }, function(response){

                                                    window.location.reload();
                                                    
                                                })

                                            });

                                        });
                                    </script>
                                    
                            </td>   

                                    <!-- checking for admin and user -->
                                    <?php if($role === 'Admin'){

                                      ?>

                            <td>
                                <div class="btn-group">
                                    <a href="edit_project.php?id=<?php  echo $row['id'];   ?>" class="btn btn-success btn-xs">

                                        <i class="fas fa-pencil-alt"></i> </a>

                                    <a href="delete_project.php?id=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs">

                                        <i class="fas fa-trash"></i> </a>
                                </div>
                            </td>

                                     <?php  }  ?>  

                                      <!--end  -->

                        </tr>
                    
                <?php

            }

            ?> </tbody> <?php

        }
            
        }
   
    }  



// Class end




// Checking  markReady  form

if(isset($_POST['project_id'])){

    $project_id = $_POST['project_id'] ;
    $project = new Project();
    if ($project->markReady($project_id)) {
        echo 'success';
    }
}


?>