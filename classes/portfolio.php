<?php

// Include DB connection

include_once "lib/db.php";

class Portfolio extends db{


    public function dataView($sql){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?> <tbody> <?php

        if($Select->rowCount() > 0){
            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>

                    <!-- tbody -->
                    
                        <tr>
                            <td><?php echo ++$i;   ?></td>
                            <td><?php echo $row['first_name'].$row['last_name'];   ?></td>
                            <td>
                                <?php

                                    $emp_id = $row['id'];

                                    $sql = $this->db->prepare("SELECT project.project_name, employee_project.amount FROM employee_project INNER JOIN project on employee_project.project_id = project.id WHERE employee_project.employee_id = :emp_id");

                                    $sql->bindParam(":emp_id" , $emp_id);
                                    
                                    $sql->execute();
                                    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($data as $d):

                                        ?>
                                            <span><?php echo $d['project_name'];   ?> <strong> <span class="badge badge-pills badge-success"><?php echo $d['amount'];   ?> </span> 
                                            </strong><br></span>

                                        <?php

                                    endforeach;



                                ?>
                            
                             </td>
                        </tr>

                <?php
            }

            ?>  </tbody> <?php
        }

    }


}


?>

