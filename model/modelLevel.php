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

     class modelLevel extends mysql_db {

     //put your code here
     public function insertLevel($data) {
          $idlevel= $data['idlevel'];
          $nama= $data['nama'];
          
          $query = "Insert into level
                         set nama='$nama'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateLevel($data) {
          $idlevel= $data['idlevel'];
          $nama= $data['nama'];
         
           $query = "update level
                         set nama='$nama' where idlevel='$idlevel' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteLevel($id) {
          $query = "delete from level where idlevel='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readLevel($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from level $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readLevelFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from level $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
