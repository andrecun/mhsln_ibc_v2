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

     class modelFakultas extends mysql_db {

     //put your code here
     public function insertFakultas($data) {
          $idfakultas= $data['idfakultas'];
          $namafakultas= $data['namafakultas'];
          
          $query = "Insert into fakultas
                         set namafakultas='$namafakultas'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateFakultas($data) {
          $idfakultas= $data['idfakultas'];
          $namafakultas= $data['namafakultas'];
         
           $query = "update fakultas
                         set namafakultas='$namafakultas' where idfakultas='$idfakultas' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteFakultas($id) {
          $query = "delete from fakultas where idfakultas='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readFakultas($data) {
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
     
     public function readFakultasFull($data) {
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
