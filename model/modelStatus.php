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

     class modelStatus extends mysql_db {

     //put your code here
     public function insertStatus($data) {
          $idstatus= $data['idstatus'];
          $namastatus= $data['namastatus'];
          
          $query = "Insert into status
                         set namastatus='$namastatus'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateStatus($data) {
          $idstatus= $data['idstatus'];
          $namastatus= $data['namastatus'];
         
           $query = "update status
                         set namastatus='$namastatus' where idstatus='$idstatus' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteStatus($id) {
          $query = "delete from status where idstatus='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readStatus($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from status $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readStatusFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from status $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
