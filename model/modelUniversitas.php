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

     class modelUniversitas extends mysql_db {

     //put your code here
     public function insertUniversitas($data) {
          $iduniversitas= $data['iduniversitas'];
          $kode= $data['kode'];
          $namauniversitas= $data['namauniversitas'];
          
          $query = "Insert into universitas
                         set namauniversitas='$namauniversitas', kode='$kode' ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateUniversitas($data) {
          $iduniversitas= $data['iduniversitas'];
          $namauniversitas= $data['namauniversitas'];
         $kode= $data['kode'];
           $query = "update universitas
                         set namauniversitas='$namauniversitas',  kode='$kode' where iduniversitas='$iduniversitas' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteUniversitas($id) {
          $query = "delete from universitas where iduniversitas='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readUniversitas($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from universitas $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readUniversitasFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from universitas $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
