<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function open_connection(){ 
 $db_host="localhost"; 
 $db_user="root";
 $db_pass="new-password";
 $link=mysql_connect($db_host,$db_user,$db_pass)  
 or die ("Koneksi Database gagal"); 
 mysql_select_db("ijin_belajar08maret2016");
 return $link; 
}

open_connection();

$query ="select nama";
?>

update mahasiswa set namamahasiswa =concat(namamahasiswa," ", namamahasiswa2) where namamahasiswa2!='';
update mahasiswa set namamahasiswa2 ='';
