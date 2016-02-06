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
                    $qWhere = array("kode" => $id);
                    $data = $MHS->readMahasiswa($qWhere);
                    //Hitung jmlh data

                    if ($data != "")
                         $jData = count($data);
                    else
                         $jData = 0;
                    if ($jData > 0) {
                         //mode 1
                         $namamahasiswa = $data["namamahasiswa"];
                         $namamahasiswa2 = $data["namamahasiswa2"];
                         $tempatlahir = $data["tempatlahir"];
                         $idmhs = $data["idmahasiswa"];
                         $tanggallahir = $UTILITY->format_tanggal($data["tanggallahir"]);
                         $sex = $data["sex"];
                         $nationality_idnationality = $data["nationality_idnationality"];
                         $alamat = $data["alamat"];
                         $city = $data["city"];
                         $province = $data["province"];
                         $country = $data["country"];
                         $postal = $data["postal"];
                         $alamatind = $data["alamatind"];
                         $cityind = $data["cityind"];
                         $provinceid = $data["provinceind"];
                         $postalind = $data["postalind"];
                         $telp = $data["telp"];
                         $telp2 = $data["telp2"];
                         $foto = $data["foto"];
                         //mode 2
                         $universitas_iduniversitas = $data["universitas_iduniversitas"];
                         $fakultas_idfakultas = $data["prodi_idprodi"];
                         $jurusan_idjurusan = $data["jurusan_idjurusan"];
                         $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
                         $mulaibelajar = $UTILITY->format_tanggal($data["mulaibelajar"]);
                         $periode_belajar_start = $UTILITY->format_tanggal($data["periode_belajar_awal"]);
                         $periode_belajar_end = $UTILITY->format_tanggal($data["periode_belajar_akhir"]);

                         //mode 3
                         $nmrpaspor = $data["nmrpaspor"];
                         $mulaipassport = $UTILITY->format_tanggal($data["mulaipassport"]);
                         $akhirpassport = $UTILITY->format_tanggal($data["akhirpassport"]);
                         $passport1 = $data["passport1"];
                         $pembiayaan_idpembiayaan = $data["pembiayaan_idpembiayaan"];
                         $sumber_pembiayaan = $data["sumber_pembiayaan"];
                         $keuangan = $data["keuangan"];
                         $pernyataan1 = $data["pernyataan1"];
                         $kesehatan = $data["kesehatan"];
                         $loa = $data["loa"];
                          $kunci=$data['kunci'];
                          $ekstension=$data['ekstension'];
                            $ijazah=$data['ijazah'];
                         
                         $jurusan_idjurusan = $data["jurusan_idjurusan"];
                         $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
                         $mulaibelajar = $UTILITY->format_tanggal($data["mulaibelajar"]);
                         $periode_belajar_start = $UTILITY->format_tanggal($data["periode_belajar_awal"]);
                         $periode_belajar_end = $UTILITY->format_tanggal($data["periode_belajar_akhir"]);
  $lamaijin=$data["LamaIjin"];
                         //mode 3
                         $nmrpaspor = $data["nmrpaspor"];
                         $mulaipassport = $UTILITY->format_tanggal($data["mulaipassport"]);
                         $akhirpassport = $UTILITY->format_tanggal($data["akhirpassport"]);
                         $passport1 = $data["passport1"];
                         $pembiayaan_idpembiayaan = $data["pembiayaan_idpembiayaan"];
                         $sumber_pembiayaan = $data["sumber_pembiayaan"];
                         $keuangan = $data["keuangan"];
                         $pernyataan1 = $data["pernyataan1"];
                         $kesehatan = $data["kesehatan"];
                         $loa = $data["loa"];
       $kitas=$data["kitas"];
          $skld=$data["skld"];
          $tgl_kitas=$UTILITY->format_tanggal($data["tglkitas"]);
          $tgl_skld=$UTILITY->format_tanggal($data["tglkitas"]);
          
             $tgl_kitas_akhir=$UTILITY->format_tanggal($data["tgl_kitas_akhir"]);
  $no_kitas= $data["no_kitas"];
             $no_skld= $data["no_skld"];
             $ijazah=$data['ijazah'];
             
                         $tanggal = str_replace("-", "", $data["tanggallahir"]);

                         $login_mahasiswa = $tanggal . "-" . $universitas_iduniversitas . "" . $fakultas_idfakultas . "" . $jurusan_idjurusan . "" . $jenjangstudi_idjenjangstudi . "" . $id;

                         $data_ijin = $IJIN->readIjin(array("mahasiswa_idmahasiswa" => $idmhs));
                         $status_ijin = $data_ijin['status_idstatus'];
                         $keterangan = $data_ijin['keterangan'];
                        
                         $keterangan_field = get_object_vars(json_decode($data_ijin['keterangan_field']));
                       //$UTILITY->show_data($keterangan_field);
                         $idijin = $data_ijin['idijin'];
                         $cek_eksist = 1;
                    } else {
                         $cek_eksist = 0;
                         $namamahasiswa = "";
                         $namamahasiswa2 = "";
                         $tempatlahir = "";
                         $tanggallahir = "";
                         $sex = "";
                         $nationality_idnationality = "";
                         $alamat = "";
                         $city = "";
                         $province = "";
                         $country = "";
                         $postal = "";
                         $alamatind = "";
                         $cityind = "";
                         $provinceid = "";
                         $postalind = "";
                         $telp = "";
                         $telp2 = "";
                         $foto = "";
                         //mode 2
                         $universitas_iduniversitas = "";
                         $fakultas_idfakultas = "";
                         $jurusan_idjurusan = "";
                         $jenjangstudi_idjenjangstudi = "";
                         $mulaibelajar = "";
                         $periode_belajar_start = "";
                         $periode_belajar_end = "";

                         //mode 3
                         $nmrpaspor = "";
                         $mulaipassport = "";
                         $akhirpassport = "";
                         $passport1 = "";
                         $pembiayaan_idpembiayaan = "";
                         $sumber_pembiayaan = "";
                         $keuangan = "";
                         $pernyataan1 = "";
                         $kesehatan = "";
                         $loa = "";
                    }
                    if ($status_edit == 1) {

                         if ($cek_eksist == 0) {

                              $UTILITY->popup_message("Maaf data user tidak ada");
                              $UTILITY->location_goto("content/user");
                         }
                    }
                    ?>



                    <div class="col-md-9 te-content te-col-md-9">
                         <!-- Nav tabs -->
                         <ul class="nav nav-tabs" id="teTab" role="tablist">
                              <li class="active">
                                   <a href="#personal_info" role="tab" data-toggle="tab" >
                                        <span class="badge">1</span> Informasi Pribadi<i class="glyphicon glyphicon-chevron-right"></i>
                                   </a>
                              </li>
                              <li>
                                   <a href="#study_info" role="tab" data-toggle="tab">
                                        <span class="badge">2</span> Informasi Studi<i class="glyphicon glyphicon-chevron-right"></i>
                                   </a>
                              </li>
                              <li>
                                   <a href="#supporting_document" role="tab" data-toggle="tab">
                                        <span class="badge">3</span> Dokumen Pendukung<i class="glyphicon glyphicon-chevron-right"></i>
                                   </a>
                              </li>
                              <li>
                                   <a href="#verification" role="tab" data-toggle="tab">
                                        <span class="badge">4</span> Verifikasi <i class="glyphicon glyphicon-chevron-right"></i>
                                   </a>
                              </li>
                         </ul>

                         <!-- Tab panes -->
                         <div id="teTabContent" class="tab-content">

                              <div class="panel panel-default">

                                   <div class="panel-heading te-panel-heading">
                                        <i class="glyphicon glyphicon-search"></i> <p>Nomor Registrasi</p>
                                        <div class="panel-body">

                                             <div class="form-group ">
                                                  <div class="col-md-9">
                                                       <input type="text" class="form-control" value="<?= $idmhs ?>" id="regnumber" name="regnumber" placeholder="Registration Number">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                              <!-- personal_info -->
                              <div class="tab-pane fade in active" id="personal_info">
                                   <!-- panel personal info -->


                                   <!-- panel personal info -->
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->


                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-th-large"></i> <p>Informasi Identitas </p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <div class="form-group ">
                                                  <div class="col-md-9"></div>
                                            <div class="col-md-3"><center><b>(Tandai Bila Benar)</b></center></div>
                                             </div> 
                                            <div class="form-group ">
                                                  <label for="inputFirstName" class="col-md-3 control-label">Nama Depan</label>
                                                  <div class="col-md-6">
                                                       <input type="text" readonly="1" class="form-control" value="<?= $namamahasiswa ?>" id="namamahasiswa" name="namamahasiswa" placeholder="First Name">
                                                  </div>    
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['namamahasiswa_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="namamahasiswa_ket" name="namamahasiswa_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputLastName" class="col-md-3 control-label">Nama Belakang</label>
                                                  <div class="col-md-6">
                                                       <input type="text" readonly="1" class="form-control" value="<?= $namamahasiswa2 ?>" id="namamahasiswa2" name="namamahasiswa2" placeholder="Last Name">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['namamahasiswa2_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="namamahasiswa2_ket" name="namamahasiswa2_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPlaceDateBirth" class="col-md-3 control-label">TTL</label>
                                                  <div class="col-md-6">
                                                       <div class="col-md-4 te-no-padding">
                                                            <input type="text" readonly="1" class="form-control" id="tempatlahir" value="<?= $tempatlahir ?>" name="tempatlahir" placeholder="Place">
                                                       </div>
                                                       <div class="col-md-1">
                                                            <label for="inputPlaceDateBirth" class="col-md-3 control-label te-no-padding">/</label>
                                                       </div>
                                                       <div class="col-md-6 te-no-padding">

                                                            <div class="input-group">
                                                                 <input type="text" readonly="1"class="form-control" id="tanggallahir" value="<?= $tanggallahir ?>"name="tanggallahir" placeholder="Date of Birth">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['tanggallahir_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="tanggallahir_ket" name="tanggallahir_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputGender" class="col-md-3 control-label">Jenis Kelamin</label>
                                                  <div class="col-md-6">
                                                       <select readonly="1" class="form-control" id="sex" name="sex">
                                                            <option value="">Select Gender</option>
                                                            <?php
                                                            $qry = $DB->query("select idsex,namasex from sex");
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $id_sex = $row->idsex;
                                                                 $nama_sex = $row->namasex;
                                                                 if ($id_sex == $sex)
                                                                      echo "<option value=\"$id_sex\" selected>$nama_sex</option>";
                                                                 else
                                                                      echo "<option value=\"$id_sex\" >$nama_sex</option>";
                                                            }
                                                            ?>
                                                       </select>
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['sex_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="sex_ket" name="sex_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputNationality" class="col-md-3 control-label">Kebangsaan</label>
                                                  <div class="col-md-6">
                                                       <select readonly="1" class="form-control" name="nationality_idnationality" id="nationality_idnationality">
                                                            <option value="">Select nationality</option>
                                                            <?php
                                                            $qry = $DB->query("select idnationality,namanegara from nationality");
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $id_nationality = $row->idnationality;
                                                                 $nama_negara = $row->namanegara;
                                                                 if ($id_nationality == $nationality_idnationality)
                                                                      echo "<option value=\"$id_nationality\" selected>$nama_negara</option>";
                                                                 else
                                                                      echo "<option value=\"$id_nationality\" >$nama_negara</option>";
                                                            }
                                                            ?>
                                                       </select>
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['nationality_idnationality_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="sex_ket" name="nationality_idnationality_ket" >
                                                       </div>
                                             </div>

                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                                   <!-- end of panel personal info -->

                                   <!-- panel residence info -->
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-th-large"></i> <p>Tempat Tinggal</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <div class="form-group ">
                                                  <label for="inputHomeAddress" class="col-md-3 control-label">Alamat Rumah</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="alamat" value="<?= $alamat ?>"name="alamat" placeholder="Home Address">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['alamat_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="sex_ket" name="alamat_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputCity" class="col-md-3 control-label">Kota</label>
                                                  <div class="col-md-6">
                                                       <input  readonly="1" type="text" class="form-control" id="city" name="city" value="<?= $city ?>" placeholder="City">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['city_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="city_ket" name="city_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputProvince" class="col-md-3 control-label">Provinsi</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="province" name="province" value="<?= $province ?>"placeholder="Province/State">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['province_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="province_ket" name="province_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputCountry" class="col-md-3 control-label">Negara</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="country" name="country" value="<?= $country ?>" placeholder="Country">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['country_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="country_ket" name="country_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPostalCode" class="col-md-3 control-label">Kode Pos</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="postal" value="<?= $postal ?>" name="postal" placeholder="Postal Code">
                                                  </div>
                                                   <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['postal_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="postal_ket" name="postal_ket" >
                                                       </div>
                                             </div>

                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                                   <!-- end of panel residence info -->

                                   <!-- panel current address info -->
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-th-large"></i> <p>Tempat Tinggal Di Indonesia</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <div class="form-group ">
                                                  <label for="inputCurrentAddress" class="col-md-3 control-label">Alamat Terkini</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="alamatind" value="<?= $alamatind ?>"name="alamatind" placeholder="Current Address">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['alamatind_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="alamatind_ket" name="alamatind_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputCity" class="col-md-3 control-label">Kota</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="cityind" value="<?= $cityind ?>" name="cityind" placeholder="City">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['cityind_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="cityind_ket" name="cityind_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputProvince" class="col-md-3 control-label">Provinsi</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1"type="text" class="form-control" id="provinceid" value="<?= $provinceid ?>" name="provinceid" placeholder="Province/State">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['provinceid_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="provinceid_ket" name="provinceid_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPostalCode" class="col-md-3 control-label">Kode Pos</label>
                                                  <div class="col-md-6">
                                                       <input readonly="1" type="text" class="form-control" id="postalind" value="<?= $postalind ?>" name="postalind" placeholder="Postal Code">
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['postalind_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="postalind_ket" name="postalind_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPhone" class="col-md-3 control-label">Telp/Handphone</label>
                                                  <div class="col-md-6">
                                                       <div class="col-md-4 te-no-padding">
                                                            <input readonly="1" type="text" class="form-control" id="telp" name="telp" value="<?= $telp ?>" placeholder="Phone">
                                                       </div>
                                                       <div class="col-md-1">
                                                            <label for="inputPhone" class="col-md-3 control-label te-no-padding">/</label>
                                                       </div>
                                                       <div class="col-md-6 te-no-padding">
                                                            <input readonly="1" type="text" class="form-control" id="telp2" name="telp2" value="<?= $telp2 ?>" placeholder="Mobile Phone">
                                                       </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['telp2_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="telp2_ket" name="telp2_ket" >
                                                       </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPhoto" class="col-md-3 control-label">Foto  (jpg/png)</label>
                                                  <div class="col-md-6">
                                                       <?php
                                                       if ($foto != "") {
                                                            echo "<img src='$url_rewrite/data/$id/$foto' style='width:50%'>&nbsp;&nbsp;&nbsp;";
                                                            echo "&nbsp";
                                                       } else {
                                                            ?>
                                                            <input type="hidden" class="form-control" id="foto" name="foto">
                                                            <?php
                                                       }
                                                       ?>
                                                  </div>
                                                  <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['foto_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="foto_ket" name="foto_ket" >
                                                       </div>
                                             </div>

                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                                   <!-- end of panel current address info -->


                                   <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                             <button type="submit" name="btnPersonal" class="btn btn-primary">Save and Next</button>
                                        </div>
                                   </div>
                                   <input type="hidden" value="1" name="mode"/>
                                   <?php
                                   if ($id != "")
                                        echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
                                   else
                                        echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

                                   echo"<input type=\"hidden\"  name=\"kode\" value=\"$id\">";
                                   ?>

                              </div>
                              <!-- end of personal_info -->





                              <!-- study_info -->
                              <div class="tab-pane fade" id="study_info">

                                   <!-- panel study info -->
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-th-large"></i> <p>Informasi Studi</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <div class="form-group ">
                                                  <label for="inputUniversity" class="col-md-3 control-label">Universitas</label>
                                                  <div class="col-md-9">
                                                       <select readonly="1" class="form-control" name="universitas_iduniversitas" id="universitas_iduniversitas">
                                                            <option value="">Select University</option>
                                                                  <?php
                                                                 $ses_uni=trim($_SESSION[unversitas]);
                                                                 if ($_SESSION["level$ID"]!='1')
                                                                      $where=" where kodeUniversitas='{$ses_uni}' ";
                                                                 else
                                                                      $where='';
                                                                 $qry = $DB->query("select kodeUniversitas,namauniversitas from universitas $where");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $kodeUniversitas = trim($row->kodeUniversitas);
                                                                      $nama_universitas = $row->namauniversitas;
                                                                      if ($kodeUniversitas == $universitas_iduniversitas)
                                                                           echo "<option value=\"$kodeUniversitas\" selected>$nama_universitas</option>";
                                                                      else
                                                                           echo "<option value=\"$kodeUniversitas\" >$nama_universitas</option>";
                                                                 }
                                                                 ?>
                                                       </select>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputFaculty" class="col-md-3 control-label">Prodi</label>
                                                  <div class="col-md-9">
                                                       <select  readonly="1" class="form-control" name="fakultas_idfakultas" id="fakultas_idfakultas">
                                                         <?php
                                                                 if($fakultas_idfakultas!=""){
                                                   
                                                                      $qry = $DB->query("select idprodi,namaProdi from prodi where "
                                                                              . " kodeUniversitas='$universitas_iduniversitas' and idprodi='$fakultas_idfakultas' group by namaProdi asc");
                                                                      while ($row = $DB->fetch_object($qry)) {
                                                                           $idprodi = $row->idprodi;
                                                                           $namaprodi= $row->namaProdi;
                                                                           if ($idprodi == $fakultas_idfakultas)
                                                                                echo "<option value=\"$idprodi\" selected>$namaprodi</option>";
                                                                           else
                                                                                echo "<option value=\"$idprodi\" selected>$namaprodi</option>";
                                                                      }
                                                                 }?>
                                                       </select>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputMajor" class="col-md-3 control-label">Jurusan</label>
                                                  <div class="col-md-9">
                                                       <select readonly="1" class="form-control" name="jurusan_idjurusan" value="jurusan_idjurusan">
                                                            <option value="">Pilih Jurusan</option>
                                                          <?php
                                                                     if($jurusan_idjurusan!=""){
                                                        
                                                                 $qry = $DB->query("select namaJurusan from prodi"
                                                                         . "   where kodeUniversitas='$universitas_iduniversitas' and idprodi='$fakultas_idfakultas' "
                                                                         . "group by namaJurusan asc");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $namajurusan = $row->namaJurusan;
                                                                      if ($jurusan_idjurusan == $namajurusan)
                                                                           echo "<option value=\"$namajurusan\" selected>$namajurusan</option>";
                                                                      else
                                                                           echo "<option value=\"$namajurusan\" >$namajurusan</option>";
                                                                 }
                                                                     }
                                                                 ?>                             
                                                       </select>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputPeriod" class="col-md-3 control-label">Jenjang</label>
                                                  <div class="col-md-9" >
                                                       <select readonly="1" class="form-control" name="jenjangstudi_idjenjangstudi" id="jenjangstudi_idjenjangstudi">
                                                            <option value="">Select Degree</option>
                                                            <?php
                                                            $qry = $DB->query("select idjenjangstudi,namajenjangstudi from jenjangstudi");
                                                            while ($row = $DB->fetch_object($qry)) {
                                                                 $idjenjangstudi = $row->idjenjangstudi;
                                                                 $namajenjangstudi = $row->namajenjangstudi;
                                                                 if ($jenjangstudi_idjenjangstudi == $idjenjangstudi)
                                                                      echo "<option value=\"$idjenjangstudi\" selected>$namajenjangstudi</option>";
                                                                 else
                                                                      echo "<option value=\"$idjenjangstudi\" >$namajenjangstudi</option>";
                                                            }
                                                            ?>                  
                                                       </select>
                                                  </div>
                                             </div>

                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                                   <!-- end of panel personal info -->

                                   <!-- panel period of study info -->
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-th-large"></i> <p>Pengajuan Lama Ijin Belajar</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <div class="form-group">
                                                  <label for="inputStartStudy" class="col-md-3 control-label">Awal Belajar</label>
                                                  <div class="col-md-9">
                                                       <div class="input-group">

                                                            <input type="text" readonly="1" class="form-control" id="mulaibelajar" value="<?= $mulaibelajar ?>" name="mulaibelajar" placeholder="Start of Study">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                       </div>
                                                  </div>
                                             </div>

                                          
                                             <div class="form-group">
                                                  <label for="inputFrom" class="col-md-3 control-label">Dari</label>
                                                  <div class="col-md-9">
                                                       <div class="input-group">
                                                            <input type="text" readonly="1"  class="form-control" id="periode_belajar_start" value="<?= $periode_belajar_start ?>" name="periode_belajar_start" placeholder="From">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="inputTo" class="col-md-3 control-label">Sampai</label>
                                                  <div class="col-md-9">
                                                       <div class="input-group">
                                                            <input type="text"  readonly="1"  class="form-control" id="periode_belajar_end" value="<?= $periode_belajar_end ?>" name="periode_belajar_end" placeholder="To">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                       </div>
                                                  </div>
                                             </div>


                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                                   <!-- end of panel period of study info -->



                                   <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                        </div>
                                   </div>
                                   <input type="hidden" value="2" name="mode"/>
                                   <?php
                                   if ($id != "")
                                        echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
                                   else
                                        echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

                                   echo"<input type=\"hidden\"  name=\"kode\" value=\"$id\">";
                                   ?>

                              </div>
                              <!-- end of study_info -->






                              <!-- supporting_document -->
                              <div class="tab-pane fade" id="supporting_document">
                                   <form class="form-horizontal" role="form"  name="frmMode3" id="frmMode3" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/keterangan/">

                                        <!-- panel study info -->
                                        <div class="panel panel-default">
                                             <!-- Default panel contents -->
                                             <div class="panel-heading te-panel-heading">
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Dokumen Pendukung</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group">
                                                       <label for="inputPassport" class="col-md-3 control-label">Paspor</label>
                                                       <div class="col-md-6"></div>
                                                       <div class="col-md-3"><center><b>(Tandai Bila Benar)</b></center></div>
                                                  </div>

                                                  <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor</label>
                                                       <div class="col-md-6">
                                                            <input readonly="1" type="text" value="<?= $nmrpaspor ?>" class="form-control" id="nmrpaspor" name="nmrpaspor" placeholder="Number">
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" <?php
                                   if ($keterangan_field['nmrpaspor_ket'] !="1")
                                        echo "checked";
                                   ?> value="1" class="form-control" id="nmrpaspor_ket" name="nmrpaspor_ket" >
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputIssuedDate" class="col-md-3 control-label">Tanggal Berlaku</label>
                                                       <div class="col-md-6">
                                                            <div class="input-group">
                                                                 <input type="text" readonly="1"  class="form-control" id="mulaipassport" value="<?= $mulaipassport ?>" name="mulaipassport" placeholder="Issued Date">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>

                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="mulaipassport_ket" name="mulaipassport_ket"  
                                                                 <?php
                                                            if ($keterangan_field['mulaipasport_ket']!="1")
                                                            echo "checked";
                                   ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputExpiryDate" class="col-md-3 control-label">Tanggal Berakhir</label>
                                                       <div class="col-md-6">
                                                            <div class="input-group">
                                                                 <input type="text" readonly="1"  class="form-control" id="akhirpassport"  value="<?= $akhirpassport ?>" name="akhirpassport" placeholder="Expiry Date">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="akhirpassport_ket" name="akhirpassport_ket"  <?php if($keterangan_field['akhirpassport_ket']!="1") 
                                                                    echo "checked" ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputEnclosurePassport" class="col-md-3 control-label">Scan Paspor</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($passport1 != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$passport1' >$passport1</a>&nbsp;&nbsp;&nbsp;";
                                                            } else {
                                                                 ?>
                                                                 <input type="hidden" class="form-control" id="passport1" name="passport1">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="passport1_ket" name="passport1_ket" <?php if($keterangan_field['passport1_ket']!="1")echo "checked"; ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFunding" class="col-md-3 control-label">Pendanaan</label>
                                                       <div class="col-md-9"></div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFunding" class="col-md-3 control-label">Jenis Pendanaan</label>
                                                       <div class="col-md-6">
                                                            <select readonly="1" class="form-control" name="pembiayaan_idpembiayaan">
                                                                 <option value="">Select Funding</option>
                                                                 <?php
                                                                 $qry = $DB->query("select idpembiayaan,jenispembiayaan from pembiayaan");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $idpembiayaan = $row->idpembiayaan;
                                                                      $jenispembiayaan = $row->jenispembiayaan;
                                                                      if ($pembiayaan_idpembiayaan == $idpembiayaan)
                                                                           echo "<option value=\"$idpembiayaan\" selected>$jenispembiayaan</option>";
                                                                      else
                                                                           echo "<option value=\"$idpembiayaan\" >$jenispembiayaan </option>";
                                                                 }
                                                                 ?>        
                                                            </select>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="pembiayaan_idpembiayaan_ket" name="pembiayaan_idpembiayaan_ket"  <?php if($keterangan_field['pembiayaan_idpembiayaan_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputScholarshipProvider" class="col-md-3 control-label">Penyedia Beasiswa</label>
                                                       <div class="col-md-6">
                                                            <input readonly="1" type="text" value="<?= $sumber_pembiayaan ?>" class="form-control" id="sumber_pembiayaan" name="sumber_pembiayaan" placeholder="Scholarship Provider">
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="sumber_pembiayaan_ket" name="sumber_pembiayaan_ket" <?php if($keterangan_field['sumber_pembiayaan_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFinancialStatement" class="col-md-3 control-label">Surat Keuangan</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($keuangan != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$keuangan' >$keuangan</a>&nbsp;&nbsp;&nbsp;";
                                                            } else {
                                                                 ?>
                                                                 <input readonly="1" type="hidden" class="form-control" id="keuangan" name="keuangan">
                                                            <?php }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="keuangan_ket" name="keuangan_ket"  <?php if($keterangan_field['keuangan_ket']!="1")echo "checked"; ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputStatementLetter" class="col-md-3 control-label">Surat Pernyataan</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($pernyataan1 != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$pernyataan1' >$pernyataan1</a>&nbsp;&nbsp;&nbsp;";
                                                            } else {
                                                                 ?>
                                                                 <input readonly="1" type="hidden" class="form-control" id="pernyataan1" name="pernyataan1">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="pernyataan1_ket" name="pernyataan1_ket"  <?php if($keterangan_field['pernyataan1_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputMedicalStatement" class="col-md-3 control-label">Surat Kesehatan</label>
                                                       <div class="col-md-6">
<?php
if ($kesehatan != "") {
     echo "<a href ='$url_rewrite/data/$id/$kesehatan' >$kesehatan</a>&nbsp;&nbsp;&nbsp;";
} else {
     ?>
                                                                 <input readonly="1" type="hidden" class="form-control" id="kesehatan" name="kesehatan">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="kesehatan_ket" name="kesehatan_ket"  <?php if($keterangan_field['kesehatan_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">Letter of Acceptance</label>
                                                       <div class="col-md-6">
<?php
if ($loa != "") {
     echo "<a href ='$url_rewrite/data/$id/$loa' >$loa</a>&nbsp;&nbsp;&nbsp;";
     echo "<input type='hidden' value='$loa' name='text_loa'/>";
} else {
     ?>
                                                                 <input  type="hidden" class="form-control" id="loa" name="loa">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="loa_ket" name="loa_ket"  <?php if($keterangan_field['loa_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  <?php
                                                  if($ekstension==1){
                                                  ?>
                                                  
                                                   <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor Kitas</label>
                                                       <div class="col-md-6">
                                                            <?= $no_kitas?>
                                                            
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="no_kitas_ket" name="no_kitas_ket" <?php if($keterangan_field['no_kitas_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">File KITAS</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($kitas != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$kitas' >$kitas</a>&nbsp;&nbsp;&nbsp;";
                                                                 
                                                            } 
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="kitas_ket" name="kitas_ket" <?php if($keterangan_field['kitas_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                   <label for="inputTlgKitas" class="col-md-3 control-label">Tgl KITAS Berlaku</label>

                                                    <div class="col-md-6">
                                                                 
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_kitas" value="<?= $tgl_kitas ?>"name="tgl_kitas" >
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                   <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="tgl_kitas_awal_ket" name="tgl_kitas_awal_ket" <?php if($keterangan_field['tgl_kitas_awal_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                   <label for="inputTlgKitas" class="col-md-3 control-label">Tgl KITAS Berakhir</label>

                                                    <div class="col-md-6">
                                                                 <script>
                                                                 </script>         
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_kitas_akhir" value="<?= $tgl_kitas_akhir ?>"name="tgl_kitas_akhir" >
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                   <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="tgl_kitas_akhir_ket" name="tgl_kitas_akhir_ket" <?php if($keterangan_field['tgl_kitas_akhir_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">Ijazah</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($ijazah != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$ijazah' >$ijazah</a>&nbsp;&nbsp;&nbsp;";
                                                             
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="ijazah_ket" name="ijazah_ket" <?php if($keterangan_field['ijazah_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  
                                                   <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor SKLD/SKJ/STM</label>
                                                       <div class="col-md-6">
                                                            <input readonly="1" type="text" value="<?= $no_skld?>" class="form-control" id="no_skld" name="no_skld" placeholder="Nomor Kitas">
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="no_skld_ket" name="no_skld_ket" <?php if($keterangan_field['no_skld_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">SKLD/SKJ/STM</label>
                                                       <div class="col-md-6">
                                                            <?php
                                                            if ($skld != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$skld' >$skld</a>&nbsp;&nbsp;&nbsp;";
                                                            
                                                            }
                                                            ?>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="skld_ket" name="skld_ket" <?php if($keterangan_field['skld_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  
                                                  
                                                  
                                                  <div class="form-group">
                                                   <label for="inputTlgSKLD" class="col-md-3 control-label">Tgl SKLD/SKJ/STM</label>

                                                  <div class="col-md-6">
                                                                
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_skld" value="<?= $tgl_skld ?>"name="tgl_skld" placeholder="Tgl SKLD">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                   <div class="col-md-3">
                                                            <input  type="checkbox" value="1" class="form-control" id="tgl_skld_ket" name="tgl_skld_ket" <?php if($keterangan_field['tgl_skld_ket']!="1")echo "checked" ?>/>
                                                       </div>
                                                  </div>
                                                  <?php }?>
                                             </div>
                                             <!-- end of panel body -->
                                        </div>
                                        <!-- end of panel personal info -->


                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">

                                             </div>
                                        </div>
                                        <input type="hidden" value="3" name="mode"/>
<?php
if ($id != "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"keterangan\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"keterangan\">";

echo"<input type=\"hidden\"  name=\"kode\" value=\"$id\">";
echo"<input type=\"hidden\"  name=\"ekstension\" value=\"$ekstension\">";
?>
                                        <input type="hidden" value="<?= $idmhs ?>" name="mahasiswa_idmahasiswa"/>
                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" name="btnStudy" class="btn btn-primary">Tambahkan keterangan</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                              <!-- end of supporting_document -->




                              <!-- verification -->
                              <div class="tab-pane fade" id="verification">
                                   <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/status/">

                                        <!-- panel account information -->
                                        <div class="panel panel-default">
                                             <!-- Default panel contents -->
                                             <div class="panel-heading te-panel-heading">
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Verification</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group ">
                                                       <label for="inputLoginUsername" class="col-md-3 control-label">Status</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" id="inputStatus" name="status">
                                                                 <option value="">Select Status</option>
<?php
$qry = $DB->query("select idstatus,namastatus from status ");
while ($row = $DB->fetch_object($qry)) {
     $idstatus = $row->idstatus;
     $namastatus = $row->namastatus;
     if ($idstatus == $status_ijin)
          echo "<option value=\"$idstatus\" selected>$namastatus</option>";
     else
          echo "<option value=\"$idstatus\" >$namastatus</option>";
}
?>
                                                            </select>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label">Keterangan</label>

                                                       <div class="col-md-9">
                                                            <input type="hidden" value="<?= $id ?>" name="kode"/>
                                                            <input type="hidden" value="<?= $idijin ?>" name="idijin"/>
                                                            <input type="hidden" value="<?= $idmhs ?>" name="mahasiswa_idmahasiswa"/>
                                                            <input type="hidden" value="<?= $periode_belajar_start ?>" name="mulaiperiode"/>
                                                            <input type="hidden" value="<?= $periode_belajar_end ?>" name="batasperiode"/>

                                                            <input type="hidden" value="verification" name="kondisi"/>
                                                            <textarea  rows="10" cols="50" type="keterangan"  class="form-control" id="keterangan" value="<?= $keterangan ?>" name="keterangan" placeholder="Information"><?= $keterangan ?></textarea>
                                                       </div>
                                                  </div>


                                                  <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label">Lock Data</label>

                                                       <div class="col-md-9">
                                                            <input type="checkbox" value="1" name="kunci" <?php if($kunci==1) echo "checked"?>/> Lock Data<br/>
                                                       </div>
                                                  </div>   

                                             </div>
                                             <!-- end of panel body -->
                                        </div>
                                        <!-- end of panel period of study info -->




                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" name="btnStudy" class="btn btn-primary">Save and Finish</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>           <!-- end of study_info -->





                         </div>
                         <!-- end of tab-panes -->

                    </div>
                    <!-- end of row -->


               </div>


<?php
include "view/default/footer.php";
?>
          </div> <!-- /container -->
          <script type="text/javascript">
               $('#teTab a').click(function(e) {
                    e.preventDefault();
                    //        console.log($(this));
                    $(this).tab('show');
               });
               $(document).ready(function() {
<?php
switch ($tab_mode) {
     case 1:
          echo "  activaTab('personal_info');";
          break;
     case 2:
          echo "  activaTab('study_info');";
          break;
     case 3:
          echo "  activaTab('supporting_document');";
          break;
     case 4:
          echo "  activaTab('verification');";
          break;

     default:
          echo "  activaTab('personal_info');";
          break;
}
?>

               });
               function activaTab(tab) {
                    //    alert(tab);
                    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
               }
               ;
          </script>


     </body>
</html>