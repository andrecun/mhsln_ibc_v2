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

     class modelUser extends mysql_db {

     //put your code here
     public function insertUser($data) {
          $iduser= $data['iduser'];
          $userlogin= $data['userlogin'];
          $password= $data['password'];
          $level_idlevel=$data['level_idlevel'];
          $email=$data['email'];
          $kode_wilayah=$data['kode_wilayah'];
          $universitas_iduniversitas=$data['universitas_iduniversitas'];
          $query = "Insert into user
                         set userlogin='$userlogin',"
                  . "     password='$password',"
                  . "    level_idlevel ='$level_idlevel',  "
                  . "email ='$email', "
                  . "kode_wilayah ='$kode_wilayah', "
                  . " universitas_iduniversitas=' $universitas_iduniversitas' ";

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function updateUser($data) {
          $iduser= $data['iduser'];
         $userlogin= $data['userlogin'];
          $password= $data['password'];
          $level_idlevel=$data['level_idlevel'];
         $kode_wilayah=$data['kode_wilayah'];
              $email=$data['email'];
          $universitas_iduniversitas=$data['universitas_iduniversitas'];
         
           $query = "update user
                         set  userlogin='$userlogin',"
                  . "     password='$password',"
                  . "    level_idlevel ='$level_idlevel',"
                    . "kode_wilayah ='$kode_wilayah', "
                  . "email ='$email', "    . "universitas_iduniversitas=' $universitas_iduniversitas'  where iduser='$iduser' ";
           

          //Execute query
          $result = $this->query($query);

          return $result;
     }
     public function updatePassword($data) {
          $iduser= $data['iduser'];
          $password= $data['password'];
         
           $query = "update user
                         set  "
                  . "     password='$password' "
                  . " where iduser='$iduser' ";
           

          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function deleteUser($id) {
          $query = "delete from user where iduser='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readUser($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from user $paramater";

          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
        
          return $data;
     }
     
     public function readUserFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from user $paramater";
          //Execute query
          $result = $this->query($query);
        //  echo $result;
          //Wrap Output Query
          $data=$this->fetch_object($result);
          
          return $data;
     }

}
?>
