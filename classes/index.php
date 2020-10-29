<?php

// include DB connection
include_once "lib/db.php";

class Index extends db {


    // Employee
    public function dataView($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

       $res =  $stmt->rowCount();

        
       return $res;

               
        
    }

    // project
    public function projectData($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

       $project =  $stmt->rowCount();

        
       return $project;

               
        
    }

    // expances
    public function expancesData($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

       $expances =  $stmt->fetch();

        
       return $expances['total'];

               
        
    }


       // Users
       public function usersData($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

       $users =  $stmt->rowCount();

        
       return $users;

               
        
    }


    // Expances highchart

    public function highChart($month){

        $sql = "SELECT SUM(amount) as `total` FROM expances WHERE MONTH(`date`) = $month AND YEAR(`date`) = :cy";
        $stmt = $this->db->prepare($sql);

        $y = date('Y'); // 2020 

        $stmt->bindParam(':cy', $y);
        $stmt->execute();
        
        $expans = $stmt->fetch();

        return $expans['total'];

    }


    
}



?>