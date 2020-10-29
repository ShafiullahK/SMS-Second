<?php
// Include DB connection
include_once "lib/db.php";

class Employee extends db{
    
        // INSERT QUERY

    public function create($first_name , $last_name , $fname , $email , $dept_no , $phone , $cnic , $address , $filename , $filetype ,  $filesize , $filetmp){

        try{
            
            $sql = $this->db->prepare("INSERT INTO `employee`(first_name , last_name , fname , email , dept_no , phone , cnic , address , image) VALUES(? , ? , ? , ? , ? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $first_name);
            $sql->bindParam(2 , $last_name);
            $sql->bindParam(3 , $fname);
            $sql->bindParam(4 , $email);
            $sql->bindParam(5 , $dept_no);
            $sql->bindParam(6 , $phone);
            $sql->bindParam(7 , $cnic);
            $sql->bindParam(8 , $address);
            $sql->bindParam(9, $filename);


           if($sql->execute()){

            $this->Check($filename , $filetype , $filesize , $filetmp);
            

            return TRUE;

           }
            

         }catch(PDOException $e){

           echo "Error Pleace Check" .$e->getMessage();
           return FALSE;

    }

    }
            // for Insert 
    public function Check($filename , $filetype , $filesize , $filetmp){

        // Allow certain file formate
        if($filetype == "image/jpg" || $filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif"){

            

            // Check File Size

            if($filesize <= 5000000){

             

                if(move_uploaded_file($filetmp , 'uploads/' . $filename)){
                    echo "Seccess";

                    return TRUE;
                }


            }else{
                echo "Sorry Your File is so Large";
                
            }

        }else{

            echo "Sorry Only JPG , JPEG , PNG  , GIF Files Are allowed";

            return FALSE;
        }
    }




        // UPDATE QUERY
    public function Update($id ,$first_name , $last_name , $fname , $email , $dept_no , $phone , $cnic , $address , $filename ,  $filetype ,  $filesize ,  $filetmp){

            

        try{

            if(!empty($filename)){
                $sql = $this->db->prepare("UPDATE employee SET first_name = :first_name , last_name = :last_name , fname = :fname ,  email = :email , dept_no = :dept_no , phone = :phone , cnic = :cnic , `address` = :emp_address , `image` = :emp_image  WHERE id = :id");
            }else{

                $sql = $this->db->prepare("UPDATE employee SET first_name = :first_name , last_name = :last_name , fname = :fname ,  email = :email , dept_no = :dept_no , phone = :phone , cnic = :cnic , `address` = :emp_address  WHERE id = :id");

            }

                $sql->bindParam(":id" ,  $id);
                $sql->bindParam(":first_name" , $first_name);
                $sql->bindParam(":last_name" , $last_name);
                $sql->bindParam(":fname" , $fname);
                $sql->bindParam(":email" , $email);
                $sql->bindParam(":dept_no" , $dept_no);
                $sql->bindParam(":phone" , $phone);
                $sql->bindParam(":cnic" , $cnic);
                $sql->bindParam(":emp_address" , $address);
                

            if(!empty($filename)){

                $sql->bindParam(":emp_image" , $filename);

             }
             
            $sql->execute();

            if(!empty($filename)){
                $this->Check($filename , $filetype , $filesize , $filetmp);
            }
            return TRUE;

        }catch(PDOException $e){
            echo "Error Some problem" .$e->getMessage();

            return FALSE;

        }

    }


    // Get Update Id 
   public function getID($id){
       $sql = $this->db->prepare("SELECT * FROM employee WHERE id =:id");

       $sql->execute(array(":id"=>$id));
       $editrow = $sql->fetch(PDO::FETCH_ASSOC);

       return $editrow;
       

   }

        // Delect QUERY

        public function delete($id){

            $sql = $this->db->prepare("DELETE FROM employee WHERE id = :id");

            $sql->bindParam(":id",$id);
            
            $sql->execute();

            return TRUE;

        }


    // SELECT QUERY
    public function dataview($sql , $role){

        $Select = $this->db->prepare($sql);
        $Select->execute();

        ?> <tbody><?php

        if($Select->rowCount() > 0){

            
            $i = 0;
            while($row = $Select->fetch(PDO::FETCH_ASSOC)){
                ?>

                
                   
                   

                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><a href="show_employee.php?id=<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></a></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['cnic']; ?></td>

                                <!-- Cheking  admin and user condition-->
                                    <?php if($role === 'Admin') {  ?>
                                <td>
                                    <div class="btn-group">
                                         <a href="edit_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                         <a href="delete_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                        </td>
                                     </div>
                                    <?php   } ?>
                            </tr>

                             

             
                      
       
        <?php  
        
        

    }

    ?></tbody>   <?php


   
}

}
    // getemployee start  to employee table to show salary table

    public function getEmployee($sql){

        $sel = $this->db->prepare($sql);

        $sel->execute();

        if($sel->rowCount() > 0){
            ?>  <option value="#">Select Employee</option> <?php 

            while($row = $sel->fetch(PDO::FETCH_ASSOC)){
                
               ?>
                
                <option value="<?php echo $row['id'];?>"><?php echo $row['first_name']. $row['last_name'] ?></option>
               
               
                <?php
                    

            
            }

        }

        

    }

    // Salary class end

    public function showEmployee($id){

        $sql = $this->db->prepare("SELECT * FROM `employee` WHERE id = :id");

        $sql->execute(array(":id"=>$id));

        $showEmplo = $sql->fetch(PDO::FETCH_ASSOC);

        return $showEmplo;
        
    }


    // Pagination function
   
    
    // Pagination function end


}

?>