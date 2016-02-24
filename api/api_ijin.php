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
$id=$_SESSION['user_id'];//Nanti diganti
$no=$purifier->purify($_REQUEST[no]);
$mhs=$purifier->purify($_REQUEST[mhs]);
$qWhere = array("idmahasiswa" => $mhs);
                    $data = $MHS->readMahasiswa($qWhere);
                  //  $UTILITY->show_data($data);
if(count($data)>0){
                    $idmhs = $data["kode"];
                    $passportnumber = $data["nmrpaspor"];
                    $nama_mhs = $data["namamahasiswa"] . " " . $data["namamahasiswa2"];
                    $register_number = $data["idmahasiswa"];
                    $nationality_idnationality = $data["nationality_idnationality"];
                    $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
       $qry = $DB->query("select idjenjangstudi,namajenjangstudi,lama_ijin from jenjangstudi where idjenjangstudi='$jenjangstudi_idjenjangstudi'");
                    while ($row = $DB->fetch_object($qry)) {
                         $idjenjangstudi = $row->idjenjangstudi;
                         $namajenjangstudi = $row->namajenjangstudi;
                         $lamaijin = $row->lama_ijin;
                    }
                    $jenjangstudi_idjenjangstudi = "$namajenjangstudi (Permit License: $lamaijin month)";
                                        
?>
<div id="hasil_<?=$no?>">
<div class="panel-heading te-panel-heading">
     <i class="glyphicon glyphicon-th-large"></i> <p>Personal Information #<?=$no?>  
          
          <input type="button" class="btn btn-danger" value="X"  coba="b" reg="<?=$register_number ?>" name="X" onclick="removeData('<?=$no?>');"/></p>
          <input type="hidden" value="<?=$register_number ?>" id="reg_number_<?=$no?>">
          
          </div>
 <div class="panel-body">

                                        <div class="form-group">
                                             <label for="registerNumber" class="col-md-3 control-label">Register Number </label>
                                             <div class="col-md-9">
<?=$register_number ?>
                                                  <input type="hidden" name="reg[]" value="<?=$register_number ?>"/>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Name</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
<?=$nama_mhs?>
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Pasport Number</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
<?=$passportnumber?>
                                                  </div>
                                             </div>
                                        </div>


                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Nationality</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
<?=$nationality_idnationality?>
                                                  </div>
                                             </div>
                                        </div>


                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Level of Study</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
<?= $jenjangstudi_idjenjangstudi ?>
                                                  </div>
                                             </div>
                                        </div>


                                   </div>
</div>
<?php
}
?>