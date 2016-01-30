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

class modelJurusan extends mysql_db {

     //put your code here
     public function insertJenjangStudi($data) {
          $idjurusan = $data['idjurusan'];
          $namajurusan = $data['namajurusan'];
          $fakultas_idfakultas = $data['fakultas_idfakultas'];
          $jenjangstudi_idjenjangstudi = $data['jenjangstudi_idjenjangstudi'];
          $query = "Insert into jurusan
                         set namajurusan='$namajurusan',"
                  . "   fakultas_idfakultas='$fakultas_idfakultas',"
                  . "Jenjangstudi_idjenjangstudi='$jenjangstudi_idjenjangstudi' ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateJenjangStudi($data) {
          $idjurusan = $data['idjurusan'];
          $namajurusan = $data['namajurusan'];
          $fakultas_idfakultas = $data['fakultas_idfakultas'];
          $jenjangstudi_idjenjangstudi = $data['jenjangstudi_idjenjangstudi'];

          $query = "update jurusan
                         set  namajurusan='$namajurusan',"
                  . "   fakultas_idfakultas='$fakultas_idfakultas',"
                  . "Jenjangstudi_idjenjangstudi='$jenjangstudi_idjenjangstudi' "
                  . "where idjurusan='$idjurusan' ";


          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteJenjangStudi($id) {
          $query = "delete from jurusan where idjurusan='$id'";
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
          $query = "select * from jurusan $paramater";
          //Execute query
          $result = $this->query($query);
          //  echo $result;
          //Wrap Output Query
          $data = $this->fetch_object($result);

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
          $query = "select * from jurusan $paramater";
          //Execute query
          $result = $this->query($query);
          //  echo $result;
          //Wrap Output Query
          $data = $this->fetch_object($result);

          return $data;
     }

}

?>
