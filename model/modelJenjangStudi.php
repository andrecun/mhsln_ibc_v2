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

class modelJenjangStudi extends mysql_db {

     //put your code here
     public function insertJenjangStudi($data) {
          $idjenjangstudi= $data['idjenjangstudi'];
          $namajenjangstudi= $data['namajenjangstudi'];
          $lama_ijin=$data['lama_ijin'];
          $query = "Insert into jenjangstudi
                         set namajenjangstudi='$namajenjangstudi',"
                  . "    lama_ijin='$lama_ijin' ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateJenjangStudi($data) {
          $idjenjangstudi= $data['idjenjangstudi'];
          $namajenjangstudi= $data['namajenjangstudi'];
          $lama_ijin=$data['lama_ijin'];
           $query = "update jenjangstudi
                         set  jenjangstudi
                         set namajenjangstudi='$namajenjangstudi',"
                  . "    lama_ijin='$lama_ijin' where idjenjangstudi='$idjenjangstudi' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteJenjangStudi($id) {
          $query = "delete from jenjangstudi where idjenjangstudi='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readJenjangStudi($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from jenjangstudi $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readJenjangStudiFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from jenjangstudi $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
