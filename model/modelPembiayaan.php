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

     class modelPembiayaan extends mysql_db {

     //put your code here
     public function insertPembiayaan($data) {
          $idpembiayaan= $data['idpembiayaan'];
          $jenispembiayaan= $data['jenispembiayaan'];
          
          $query = "Insert into pembiayaan
                         set jenispembiayaan='$jenispembiayaan'";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updatePembiayaan($data) {
          $idpembiayaan= $data['idpembiayaan'];
          $jenispembiayaan= $data['jenispembiayaan'];
         
           $query = "update pembiayaan
                         set jenispembiayaan='$jenispembiayaan' where idpembiayaan='$idpembiayaan' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deletePembiayaan($id) {
          $query = "delete from pembiayaan where idpembiayaan='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readPembiayaan($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from pembiayaan $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readPembiayaanFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from pembiayaan $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
