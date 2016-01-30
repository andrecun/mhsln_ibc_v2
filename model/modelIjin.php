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

     class modelIjin extends mysql_db {

     //put your code here
     public function insertIjin($data) {
          $idijin=$data["idijin"];
          $nomor= $data['nomor'];
          $tglijin= $data['tglijin'];
          $jumlahijin= $data['jumlahijin'];
          $status_idstatus=$data["status_idstatus"];
          $nama= $data['atasnama'];
          $nip= $data['nip'];
          $jabatan= $data['jabatan'];
          $file= $data['srtrek'];
          $idmahasiswa=$data["kode"];
          $query = "Insert into ijin 
                         set nomor='$nomor',tglijin='$tglijin',status_idstatus=$status_idstatus,"
                  . " nama='$nama',nip='$nip',jabatan='$jabatan',file='$file' " ;
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateIjin($data) {
        $idijin=$data["idijin"];
          $nomor= $data['nomor'];
          $tglijin= $data['tglijin'];
          $jumlahijin= $data['jumlahijin'];
          $status_idstatus=$data["status_idstatus"];
          $nama= $data['atasnama'];
          $nip= $data['nip'];
          $jabatan= $data['jabatan'];
          $file= $data['srtrek'];
                    $idmahasiswa=$data["kode"];
          $query = "update ijin 
                         set nomor='$nomor',tglijin='$tglijin',status_idstatus=$status_idstatus,"
                  . " nama='$nama',nip='$nip',jabatan='$jabatan',file='$file' "
                  . "where mahasiswa_idmahasiswa='$idmahasiswa'" ;
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteIjin($id) {
          $query = "delete from ijin where idlevel='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readIjin($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from ijin $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_array($result);
        
          return $data;
     }
     
     public function readIjinFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from ijin $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
