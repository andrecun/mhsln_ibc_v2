<!DOCTYPE html>
<html lang="en">
     <?php
     include "view/default/head.php";
     ?>
     <body>
          <div class="container">
               <?php
               include "view/default/img_header.php";
               ?>

               <div class="row te-container te-row">
                    <?php
                    include "view/default/right_menu.php";
                    ?> 
                    <?php
                    $id=  urldecode($id);  
                            //str_replace("%20", " ", $id);
                    $qWhere = array("mahasiswa_idmahasiswa" => $id);
                    $data = $IJIN->readIjin($qWhere);
                    //Hitung jmlh data
                    // $UTILITY->show_data($qWhere);

                    if ($data != "")
                         $jData = count($data);
                    else
                         $jData = 0;

                    if ($jData > 0) {
                         //mode 1
                         $idijin = $data['idijin'];
                         $status=$data['status_idstatus'];
                         $nomor = $data['nomor'];
                         $tglijin = $UTILITY->format_tanggal($data['tglijin']);
                         $jumlahijin = $data['jumlahijin'];

                         $nama = $data['nama'];
                         $nip = $data['nip'];
                         $jabatan = $data['jabatan'];
                         $srtrek = $data['file'];
                         $cek_eksist = 1;
                    } else {
                         $cek_eksist = 0;
                         $idijin = "";
                         $nomor = "";
                         $tglijin = "";
                         $jumlahijin = "";

                         $nama = "";
                         $nip = "";
                         $jabatan = "";
                         $srtrek = "";
                    }

                    $qWhere = array("idmahasiswa" => $id);
                    $data = $MHS->readMahasiswa($qWhere);
                    //  $UTILITY->show_data($data);
                    $idmhs = $data["kode"];
                    $passportnumber = $data["nmrpaspor"];
                    $nama_mhs = $data["namamahasiswa"] . " " . $data["namamahasiswa2"];
                    $register_number = $data["idmahasiswa"];
                    $nationality_idnationality = $data["nationality_idnationality"];
                    $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
                     $universitas_iduniversitas = $data["universitas_iduniversitas"];
                    $qry = $DB->query("select idnationality,namanegara from nationality where idnationality='$nationality_idnationality'");
                    while ($row = $DB->fetch_object($qry)) {
                         $id_nationality = $row->idnationality;
                         $nama_negara = $row->namanegara;
                    }
                    $nationality_idnationality = $nama_negara;

                    $qry = $DB->query("select idjenjangstudi,namajenjangstudi,lama_ijin from jenjangstudi where idjenjangstudi='$jenjangstudi_idjenjangstudi'");
                    while ($row = $DB->fetch_object($qry)) {
                         $idjenjangstudi = $row->idjenjangstudi;
                         $namajenjangstudi = $row->namajenjangstudi;
                         $lamaijin = $row->lama_ijin;
                    }
                    //$jenjangstudi_idjenjangstudi = "$namajenjangstudi (Permit License: $lamaijin month)";
                  $jenjangstudi_idjenjangstudi = "$namajenjangstudi ";
                    
                     $qry = $DB->query("select kodeUniversitas,namauniversitas from universitas where kodeUniversitas='$universitas_iduniversitas' ");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $id_universitas = $row->kodeUniversitas;
                                                                 $nama_universitas = $row->namauniversitas;
                                                                 
                                                                 }
                                                                 //$universitas_iduniversitas=$nama_universitas;
                    ?>

                    <script>
                         $().ready(function() {
                              $("#frmPermit").validate(
                                      {
                                           rules: {
                                                nomor: "required",
                                                tglijin: "required",
                                                atasnama: "required",
                                                nip: "required",
                                                jabatan: "required",
                                                srtrek: "required",
                                           },
                                           messages: {
                                                nomor: {
                                                     required: "Please fill passport number in Indonesia",
                                                },
                                                tglijin: {
                                                     required: "Please choose Issued Date in Indonesia",
                                                },
                                                atasnama: {
                                                     required: "Please choose Expiry Date in Indonesia",
                                                },
                                                nip: {
                                                     required: "Please fill nip",
                                                },
                                                jabatan: {
                                                     required: "Please choose Type of Funding in Indonesia",
                                                },
                                                srtrek: {
                                                     required: "Please fill Scholarship Provider in Indonesia",
                                                },
                                           }

                                      });
                         });
                    </script>
                    <form class="form-horizontal" enctype="multipart/form-data" id="frmPermit" role="form" method="post" action="<?= $url_rewrite ?>proses/permit/">
                         <div class="col-md-9 te-content te-col-md-9">
                              <div class="panel panel-default">
                                   <!-- Default panel contents -->
                                   <div class="panel-heading te-panel-heading">
                                        <i class="glyphicon glyphicon-th-large"></i> <p>Letter of Recommendation From University (<?=$nama_universitas?>)</p>
                                   </div>

                                   <div class="clearfix"></div>

                                   <div class="panel-body">

                                        <div class="form-group">
                                             <label for="inputKode" class="col-md-3 control-label">Number of Letter</label>
                                             <div class="col-md-9">
                                                  <input type="text" class="form-control" value="<?= $nomor ?>" id="nomor" name="nomor" placeholder="Number of Letter">
                                             </div>
                                        </div>
                                        <script>
                                             $(function() {
                                                  $("#tglijin").datepicker({
                                                       yearRange: '-70:+30',
                                                       changeMonth: true,
                                                       changeYear: true,
                                                       numberOfMonths: 1,
                                                       dateFormat: 'd M yy ',
                                                  });
                                             });</script>         
                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label"> Date of letter</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <input type="text" readonly="1"  class="form-control"  value="<?= $tglijin ?>"  id="tglijin" value="<?= $tglijin ?>" name="tglijin" placeholder="Date of letter">
                                                       <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                  </div>
                                             </div>
                                        </div>



                                   </div>


                                   <!-- Default panel contents -->
                                   <div class="panel-heading te-panel-heading">
                                        <i class="glyphicon glyphicon-th-large"></i> <p>Offcial are proposing</p>
                                   </div>
                                   <div class="clearfix"></div>
                                   <div class="panel-body">

                                        <div class="form-group">
                                             <label for="inputKode" class="col-md-3 control-label">Name</label>
                                             <div class="col-md-9">
                                                  <input type="text"  value="<?= $nama ?>"  class="form-control" id="atasnama" name="atasnama" placeholder="Name">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">NIP</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <input type="text"  class="form-control" id="nip" value="<?= $nip ?>" name="nip" placeholder="Date of letter">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Position</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <input type="text"    class="form-control" id="jabatan" value="<?= $jabatan ?>" name="jabatan" placeholder="Date of letter">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputKode" class="col-md-3 control-label">File letter of recomendation</label>
                                             <div class="col-md-9">
                                                  <?php
                                                  if ($srtrek != "") {
                                                       echo "<a href ='$url_rewrite" . "data/$idmhs/$srtrek' >$srtrek</a>&nbsp;&nbsp;&nbsp;";
                                                       if($status==0 || $status=="6")
                                                       echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/student/rsrtrek/$id/$srtrek'\"
                                                                 >Remove File</button>";
                                                       echo "<input type='hidden' value='$srtrek' name='text_srtrek'/>";
                                                  } else {
                                                       ?>
                                                       <input type="file" class="form-control" id="srtrek" name="srtrek">
                                                       <?php
                                                  }
                                                  ?>
                                             </div>
                                        </div>



                                   </div>



                                   <!-- Default panel contents -->
                                   <div class="panel-heading te-panel-heading">
                                        <i class="glyphicon glyphicon-th-large"></i> <p>Personal Information</p>
                                   </div>
                                   <div class="clearfix"></div>
                                   <div class="panel-body">

                                        <div class="form-group">
                                             <label for="registerNumber" class="col-md-3 control-label">Register Number </label>
                                             <div class="col-md-9">
                                                  <?= $register_number ?>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Name</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <?= $nama_mhs ?>
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Pasport Number</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <?= $passportnumber ?>
                                                  </div>
                                             </div>
                                        </div>


                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Nationality</label>
                                             <div class="col-md-9">
                                                  <div class="input-group">
                                                       <?= $nationality_idnationality ?>
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
                                   <!-- end of panel body -->

                                   <!-- Untuk tambahan mahasiswa-->
                                   <script>
                                        function showStudent() {
                                             var kode = $("#kode").val();
                                             var no =$("#jml_mhs").val()
                                             no=parseInt(no)+1;
                                             $.ajax({
                                                  url: "<?= $url_rewrite ?>api/api_ijin.php",
                                                  data: {"mhs": kode,"no":no},
                                                  type: "POST",
                                                  success: function(result) {
                                                       $("#hasil_mahasiswa").append(result);
                                                  }
                                             });
                                               
                                             $("#kode option[value='"+kode+"']").remove();
                                             $("#jml_mhs").val(no);
                                        }
                                   </script>
                                   <script>
                                   
                                        function removeData(no){
                                        var reg=$("#reg_number_"+no).val();
                                        $("#hasil_"+no).remove();
                                        $('#kode').append($('<option>', { 
                                        value: reg,
                                        text : reg
                                    }));
                                     

     }
                                   </script>
                                   <div class="panel-heading te-panel-heading">
                                        <i class="glyphicon glyphicon-th-large"></i> <p>Add Students </p>
                                   </div>
                                   <div class="panel-body" >
                                        <div class="form-group">
                                             <label for="inputFrom" class="col-md-3 control-label">Kode Mahasiswa</label>
                                             <div class="col-md-9">
                                                  <?php
                                      //            echo "select M.kode,M.idmahasiswa from mahasiswa M  left join ijin I on M.idmahasiswa =I.mahasiswa_idmahasiswa where I.status_idstatus=0 and M.universitas_iduniversitas='$id_universitas' ";
                                                  ?>
                                                  <div class="input-group">
                                                       <select class="form-control ct" id="kode" name="kode">
                                                            <option value="">Select Mahasiswa</option>
                                                            <?php
                                                            $qry = $DB->query("select M.kode,M.idmahasiswa from mahasiswa M "
                                                                    . " left join ijin I on M.idmahasiswa =I.mahasiswa_idmahasiswa where I.status_idstatus=0 and M.universitas_iduniversitas='$id_universitas' ");
                                                            
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $kode = $row->kode;
                                                                 $idmahasiswa = $row->idmahasiswa;
                                                                 if ($idmahasiswa != $register_number)
                                                                      echo "<option value=\"$idmahasiswa\" >$idmahasiswa</option>";
                                                            }
                                                            ?>
                                                       </select>
                                                      <?php   if($status==0 || $status=="6") {?>
                                                       <input type="button" class="btn btn-info" onclick="showStudent();" name="Add Student" value="Add Student"/>
                                                      <?php }?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>

                                   <div id="hasil_mahasiswa"> 
                                        <input type="hidden" id="jml_mhs" value="0">
                                   </div>
                                   <!-- Untuk tambahan mahasiswa-->
                              </div>
                             <?php  if($status==0 || $status=="6") {?>
                              <div class="form-group">
                                   <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                   </div>
                              </div>
                              <?php
                             }
                              if ($idijin != "")
                                   echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
                              else
                                   echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";
                              echo"<input type=\"hidden\"  name=\"kode\" value=\"$idmhs\">";
                              echo"<input type=\"hidden\"  name=\"reg[]\" value=\"$register_number\">";
                              echo"<input type=\"hidden\"  name=\"idijin\" value=\"$idijin\">";
                              ?>

                         </div>  </form>
               </div>


               <?php
               include "view/default/footer.php";
               ?>
          </div> <!-- /container -->

     </body>
</html>