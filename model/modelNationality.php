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

     class modelNationality extends mysql_db {

     //put your code here
     public function insertNationality($data) {
          $idnationality= $data['idnationality'];
          $namanegara= $data['namanegara'];
          
          $query = "Insert into nationality
                         set namanegara='$namanegara'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateNationality($data) {
          $idnationality= $data['idnationality'];
          $namanegara= $data['namanegara'];
         
           $query = "update nationality
                         set namanegara='$namanegara' where idnationality='$idnationality' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteNationality($id) {
          $query = "delete from nationality where idnationality='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readNationality($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from nationality $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readNationalityFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from nationality $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
