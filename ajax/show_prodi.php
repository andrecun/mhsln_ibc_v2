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
echo "<select class=\"form-control\" name=\"fakultas_idfakultas\" "
 . "id=\"fakultas_idfakultas\" >
<option value=\"\">Pilih Prodi</option>";
$qry = $DB->query("select idprodi,namaProdi,kodeProdi from prodi where kodeUniversitas='$kodeUniversitas'"
        . " group by namaProdi asc");
while ($row = $DB->fetch_object($qry)) {
     $idprodi = $row->idprodi;
     $kodeProdi=$row->kodeProdi;
     $namaprodi = $row->namaProdi;
     if ($idprodi == $fakultas_idfakultas)
          echo "<option value=\"$kodeprodi\" selected>$namaprodi</option>";
     else
          echo "<option value=\"$kodeProdi\" >$namaprodi</option>";
}
echo "</select>";
?>
