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

     class modelPeriodeBelajar extends mysql_db {

     //put your code here
     public function insertPeriodeBelajar($data) {
          $kode= $data['kode'];
          $periode= $data['periode'];
          
          $query = "Insert into fakultas
                         set periode='$periode'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updatePeriodeBelajar($data) {
          $kode= $data['kode'];
          $periode= $data['periode'];
         
           $query = "update fakultas
                         set periode='$periode' where kode='$kode' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deletePeriodeBelajar($id) {
          $query = "delete from fakultas where kode='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readPeriodeBelajar($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from fakultas $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readPeriodeBelajarFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from fakultas $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
