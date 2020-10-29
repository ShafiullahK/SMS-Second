<?php

include_once "lib/db.php";

class addUser extends db {
    

    public function create($name , $email , $role , $pass , $con_pass){

        try{

        $sql = $this->db->prepare("INSERT INTO `login`(user , email , `role` ,  password) VALUES (? , ? , ? , ?)");
        
        $hash = password_hash($pass , PASSWORD_DEFAULT);

        $sql->bindParam(1 , $name);
        $sql->bindParam(2 , $email);
        $sql->bindParam(3 , $role);
        $sql->bindParam(4 , $hash);

        $sql->execute();

        return TRUE;

    }catch(PDOException $e){
        echo "Error Some Problem" .$e->getMessage();
        
        return FALSE;
        


    }

        

        

    }


    // admin and user menu for employee
    public function AUmenu($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $sel = $stmt->fetch();

            return $sel['role'];
        }

    }


    // admin and user menu for salary
    public function salaryMU($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){

            $sal = $stmt->fetch();

            return $sal['role'];
            

        }
    }

    // admin and user menu for Expances
    public function expancesMU($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){

            $exp = $stmt->fetch();
            return $exp['role'];
        }

    }

    // admin and user menu for project
    public function projectMU($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            $pro = $stmt->fetch();
            return $pro['role'];

        }
    }

    // admin and user menu for project
    public function employee_projectMU($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){

            $e = $stmt->fetch();
            return $e['role'];
        }

    }

    // admin and user menu for sidebar 

    public function sideMU($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            $e = $stmt->fetch();
            return $e['role'];
        }

    }


        // admin and user for Users
        public function add($sql , $email){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email" , $email);

            $stmt->execute();

            if($stmt->rowCount() > 0){

                $u = $stmt->fetch();
                return $u['role'];
            }

        }



    // admin and user for navbar / header
    public function addNav($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);

        $stmt->execute();

        if($stmt->rowCount() > 0){

            $show = $stmt->fetch();
            return $show['user'];
        }

    }
    
}


?>