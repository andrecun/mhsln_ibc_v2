<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
require_once __DIR__ . "/../utility/database/mysql_db.php";

     class modelSex extends mysql_db {

     //put your code here
     public function insertSex($data) {
          $idsex= $data['idsex'];
          $namasex= $data['namasex'];
          
          $query = "Insert into sex
                         set namasex='$namasex'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateSex($data) {
          $idsex= $data['idsex'];
          $namasex= $data['namasex'];
         
           $query = "update sex
                         set namasex='$namasex' where idsex='$idsex' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteSex($id) {
          $query = "delete from sex where idsex='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readSex($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from sex $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readSexFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from sex $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
