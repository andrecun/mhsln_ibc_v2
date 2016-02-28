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
 mysql_select_db("ijin_belajar_02feb2016");
 return $link; 
}
open_connection();

$query="select kode,prodi_idprodi from mahasiswa  where kode <=1257 order by kode asc";
$result=  mysql_query($query) or die(mysql_error());
$no=1;
while($row=  mysql_fetch_array($result)){
    $kode=$row['kode'];
    $prodi_idprodi=$row['prodi_idprodi'];
    $query_prodi="select idprodi,kodeProdi from prodi where idprodi='$prodi_idprodi' limit 1";
    $result_prodi=  mysql_query($query_prodi) or die(mysql_error());
    while($row_prodi=  mysql_fetch_array($result_prodi)){
        $kodeProdi=trim($row_prodi['kodeProdi']);
    }
    
    
    $query_update="update mahasiswa set prodi_idprodi='$kodeProdi' where kode='$kode'; \n  ";
    echo $query_update;
    $no++;
}
echo  "--Total Update $no";