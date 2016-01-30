<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include '../config/application.php';
$kodeUniversitas=$_GET['kodeUniversitas'];
$idprodi=$_GET['idprodi'];
echo "<select class=\"form-control\" 
                                                                          name=\"jurusan_idjurusan\" value=\"jurusan_idjurusan\">
                                                                 <option value=\"\">Pilih Jurusan</option>";
                                                        
                                                                 $qry = $DB->query("select namaJurusan from prodi"
                                                                         . "    where kodeUniversitas='$kodeUniversitas' and idprodi='$idprodi' "
                                                                         . "group by namaJurusan asc");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $namajurusan = $row->namaJurusan;
                                                                      if ($jurusan_idjurusan == $namajurusan)
                                                                           echo "<option value=\"$namajurusan\" selected>$namajurusan</option>";
                                                                      else
                                                                           echo "<option value=\"$namajurusan\" >$namajurusan</option>";
                                                                 }
                                                                 echo "</select>";
?>
