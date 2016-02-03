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
                      $universitas_session=trim($_SESSION['unversitas']);
                    $username_session=$_SESSION["user_name$ID"] ;
                    
                    if($level!=1)
                    $qWhere = array("kode" => $id,
                                                  "universitas_iduniversitas"=>$universitas_session);
                    else
                    $qWhere = array("kode" => $id);     
                    
                    $data = $MHS->readMahasiswa($qWhere);
                    //Hitung jmlh data

                    if ($data != "")
                         $jData = count($data);
                    else
                         $jData = 0;
                    if ($jData > 0) {
                         //mode 1
                         
                         //$UTILITY->show_data($data);
                         $namamahasiswa = $data["namamahasiswa"];
                         $namamahasiswa2 = $data["namamahasiswa2"];
                         $tempatlahir = $data["tempatlahir"];
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
                          $pt_asal=$data["pt_asal"];
                         $jml_kitas=$data['jml_kitas'];
                         $dok_mou=$data['dok_mou'];
                         //mode 2
                         $universitas_iduniversitas = $data["universitas_iduniversitas"];
                         $fakultas_idfakultas = $data["prodi_idprodi"];
                                     
                         if($fakultas_idfakultas !=""||$fakultas_idfakultas!="0"){
                              $display_prodi="block";
                         }
                         
                         $jurusan_idjurusan = $data["jurusan_idjurusan"];
                         if($jurusan_idjurusan!=""||$jurusan_idjurusan!="0"){
                              $display_jurusan="block";
                         }
                         
                         $ket_program=$data["ket_program"];
                          $penyelenggara_program=$data["penyelenggara_program"];
                         $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
                         if(abs($jenjangstudi_idjenjangstudi)<=7){
                              $display_prodi="block";
                              $display_jurusan="block";
                         }
                         else{
                                $display_prodi="none";
                              $display_jurusan="none";
                         }
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
                
                         $tanggal = str_replace("-", "", $data["tanggallahir"]);
                         
$ekstension=$data["ekstension"];
                         $login_mahasiswa = $tanggal . "-" . $universitas_iduniversitas . "" . $fakultas_idfakultas . "" . $jurusan_idjurusan . "" . $jenjangstudi_idjenjangstudi . "" . $id;
$idmhs=$data["idmahasiswa"];
                         $data_ijin=$IJIN->readIjin(array("mahasiswa_idmahasiswa"=>$idmhs));
                         $status_ijin=$data_ijin['status_idstatus'];
                         $keterangan=$data_ijin['keterangan'];
                         $statusStudyEkstension=$data_ijin['statusStudyEkstension'];
                              $idijin=$data_ijin['idijin'];
                         
                         if($ekstension==0){
                                 $foto = "";
                         //mode 2
                                  $ijazah="";
                         $ket_program="";
                         $display_prodi="none ";
                         $display_jurusan="none";
                         $universitas_iduniversitas = "";
                         $fakultas_idfakultas = "";
                         $jurusan_idjurusan = "";
                         $jenjangstudi_idjenjangstudi = "";
                         $mulaibelajar = "";
                         $periode_belajar_start = "";
                         $periode_belajar_end = "";

                         //mode 3
                          $ijazah="";
                         $ket_program="";
                         $display_prodi="none ";
                         $display_jurusan="none";
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
                         $id="";
                           $jml_kitas="";
                        $dok_mou="";
                        $pt_asal="";
                         $cek_eksist = 0;
                         $status_edit = 0;
                         }else {
                              $cek_eksist = 1;
                              $status_edit = 1;
                         }
                    } else {
                          $jml_kitas="";
                        $dok_mou="";
                        $pt_asal="";
                          $ijazah="";
                         $ket_program="";
                          $penyelenggara_program="";
                         $display_prodi="none ";
                         $display_jurusan="none";
                         $status_edit = 0;
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
                         $tgl_kitas_akhir="";
                         $no_kitas="";
                         $no_skld="";
                    }

                    $kunci = $data["kunci"];
                    if ($kunci == 1)
                         $cek_eksist = 2;

                    if ($status_edit == 1) {
                         if ($cek_eksist == 0) {

                              $UTILITY->popup_message("Maaf data user tidak ada");
                              $UTILITY->location_goto("content/user");
                              exit;
                         } else if ($cek_eksist == 2) {
                              $UTILITY->popup_message("Maaf data telah di lock karena telah diverifikasi");
                              $UTILITY->location_goto("content/home");
                              exit;
                         }
                    }
                    ?>

                    <script>
                         $().ready(function() {
                              // validate signup form on keyup and submit
                              $("#frmMode1").validate({
                                   rules: {
                                        namamahasiswa: {
                                             required: true,
                                             minlength: 2
                                        },
                                        namamahasiswa2: {
                                             required: true
                                        },
                                        tempatlahir: "required",
                                        tanggallahir: "required",
                                        sex: "required",
                                        nationality_idnationality: "required",
                                        alamat: "required",
                                      //  city: "required",
                                        //province: "required",
                                        country: "required",
                                      //  postal: "required",
                                        alamatind: "required",
                                        telp: "required",
                                        telp2: "required",
                                        foto: "required",
                                        cityind: "required",
                                        provinceid: "required",
                                        postalind: "required"
                                   },
                                   messages: {
                                        namamahasiswa: {
                                             required: "Please enter a firstname",
                                             minlength: "Your firstname must consist of at least 2 characters"
                                        },
                                        namamahasiswa2: {
                                             required: "Please enter a lastname"},
                                        tempatlahir: {
                                             required: "Please fill  place of birth"
                                        },
                                        tanggallahir: {
                                             required: "Please fill date of birth"
                                        },
                                        sex: {
                                             required: "Please choose sex"
                                        },
                                        nationality_idnationality: {
                                             required: "Please choose  nationality"
                                        },
                                        alamat: {
                                             required: "Please fill address user"
                                        },
                                        city: {
                                             required: "Please fill city"
                                        },
                                        province: {
                                             required: "Please fill province"
                                        },
                                        country: {
                                             required: "Please fill country"
                                        },
                                        postal: {
                                             required: "Please fill postal "
                                        },
                                        alamatind: {
                                             required: "Please fill address in indonesia "
                                        },
                                        telp: {
                                             required: "Please fill telp number"
                                        },
                                        telp2: {
                                             required: "Please fill mobile phone"
                                        },
                                        foto: {
                                             required: "Please choose foto"
                                        },
                                        cityind: {
                                             required: "Please fill addres (city) in Indonesia",
                                        },
                                        provinceid: {
                                             required: "Please fill addres (province) in Indonesia",
                                        },
                                        postalind: {
                                             required: "Please fill postal code  in Indonesia",
                                        }




                                   }
                              });
                         });</script>
                    <script>
                         $().ready(function() {
                              $("#frmMode2").validate(
                                      {
                                           rules: {
                                                universitas_iduniversitas: "required",
                                                fakultas_idfakultas: "required",
                                                jurusan_idjurusan: "required",
                                                jenjangstudi_idjenjangstudi: "required",
                                                mulaibelajar: "required",
                                                periode_belajar_start: "required",
                                                periode_belajar_end: "required"
                                           },
                                           messages: {
                                                universitas_iduniversitas: {
                                                     required: "Please fill university in Indonesia",
                                                },
                                                fakultas_idfakultas: {
                                                     required: "Please fill prodi  in Indonesia",
                                                },
                                                jurusan_idjurusan: {
                                                     required: "Please fill major  in Indonesia",
                                                },
                                                jenjangstudi_idjenjangstudi: {
                                                     required: "Please fill degree  in Indonesia",
                                                },
                                                mulaibelajar: {
                                                     required: "Please fill start of study in Indonesia",
                                                },
                                                periode_belajar_start: {
                                                     required: "Please fill start Period of Study Permit in Indonesia",
                                                },
                                                periode_belajar_end: {
                                                     required: "Please fill end period of study permit in Indonesia",
                                                }
                                           }

                                      });
                         });
                    </script>

                    <script>
                       /*  $().ready(function() {
                              $("#frmMode3").validate(
                                      {
                                           rules: {
                                                nmrpaspor: "required",
                                                mulaipassport: "required",
                                                akhirpassport: "required",
                                                pasport1: "required",
                                                pembiayaan_idpembiayaan: "required",
                                                sumber_pembiayaan: "required",
                                                keuangan: "required",
                                                pernyataan1: "required",
                                                kesehatan: "required",
                                                loa: "required",
                                           },
                                           messages: {
                                                nmrpaspor: {
                                                     required: "Please fill passport number in Indonesia",
                                                },
                                                mulaipassport: {
                                                     required: "Please choose Issued Date in Indonesia",
                                                },
                                                akhirpassport: {
                                                     required: "Please choose Expiry Date in Indonesia",
                                                },
                                                pasport1: {
                                                     required: "Please insert Enclosure Passport in Indonesia",
                                                },
                                                pembiayaan_idpembiayaan: {
                                                     required: "Please choose Type of Funding in Indonesia",
                                                },
                                                sumber_pembiayaan: {
                                                     required: "Please fill Scholarship Provider in Indonesia",
                                                },
                                                keuangan: {
                                                     required: "Please choose Financial Statement in Indonesia",
                                                },
                                                pernyataan1: {
                                                     required: "Please choose Statement Letter  Statement in Indonesia",
                                                },
                                                kesehatan: {
                                                     required: "Please choose Medical Statement in Indonesia",
                                                },
                                                loa: {
                                                     required: "Please choose Letter of Acceptance in Indonesia",
                                                }
                                           }

                                      });
                         });*/
                    </script>

                    <div class="col-md-9 te-content te-col-md-9">
                         <!-- Nav tabs -->
                         <ul class="nav nav-tabs" id="teTab" role="tablist">
                              <li class="active">
                                   <a href="#personal_info" role="tab" data-toggle="tab" >
                                        <span class="badge">1</span> Informasi Identitas <i class="glyphicon glyphicon-chevron-right"></i>
                                   </a>
                              </li>
                              <li>
                                   <a href="#study_info" role="tab" data-toggle="tab">
                                        <span class="badge">2</span> Informasi Studi <i class="glyphicon glyphicon-chevron-right"></i>
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

                              <form method="post" action="<?= $url_rewrite ?>content/ekstension/add/">
                                   <div class="panel panel-default">

                                        <!--<div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-search"></i> <p>Nomor register </p>
                                             <div class="panel-body">

                                                  <div class="form-group ">
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" value="<?= $id ?>" id="regnumber" name="regnumber" placeholder="Registration Number">
                                                       </div>
                                                       <div class="col-md-3"> 
                                                            <button type="submit" name="search"  value="1" class="btn btn-primary">Search</button>

                                                       </div>
                                                  </div>
                                             </div>
                                        </div>-->

                                   </div></form>
                              <!-- personal_info -->
                              <div class="tab-pane fade in active" id="personal_info">
                                   <!-- panel personal info -->

                                   <form class="form-horizontal" role="form" id="frmMode1" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/ekstension/">

                                        <!-- panel personal info -->
                                        <div class="panel panel-default">
                                             <!-- Default panel contents -->


                                             <div class="panel-heading te-panel-heading">
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Identitas Pribadi</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group ">
                                                       <label for="inputFirstName" class="col-md-3 control-label">Nama Depan</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" value="<?= $namamahasiswa ?>" id="namamahasiswa" name="namamahasiswa" placeholder="First Name">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputLastName" class="col-md-3 control-label">Nama Belakang</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" value="<?= $namamahasiswa2 ?>" id="namamahasiswa2" name="namamahasiswa2" placeholder="Last Name">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPlaceDateBirth" class="col-md-3 control-label">Tempat/Tanggal Lahir</label>
                                                       <div class="col-md-9">
                                                            <div class="col-md-5 te-no-padding">
                                                                 <input type="text" class="form-control" id="tempatlahir" value="<?= $tempatlahir ?>" name="tempatlahir" placeholder="Place">
                                                            </div>
                                                            <div class="col-md-1">
                                                                 <label for="inputPlaceDateBirth" class="col-md-3 control-label te-no-padding">/</label>
                                                            </div>
                                                            <div class="col-md-6 te-no-padding">
                                                                 <script>
                                                                      $(function() {
                                                                           $("#tanggallahir").datepicker({
                                                                               yearRange: '-70:+30',
                                                                                changeMonth: true,
                                                                                changeYear: true,
                                                                                numberOfMonths: 1,
                                                                                dateFormat: 'd M yy ',
                                                                           });
                                                                      });</script>         
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tanggallahir" value="<?= $tanggallahir ?>"name="tanggallahir" placeholder="Date of Birth">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputGender" class="col-md-3 control-label">Jenis Kelamin</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" id="sex" name="sex">
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
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputNationality" class="col-md-3 control-label">Kebangsaan</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" name="nationality_idnationality" id="nationality_idnationality">
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
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="alamat" value="<?= $alamat ?>"name="alamat" placeholder="Home Address">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputCity" class="col-md-3 control-label">Kota</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="city" name="city" value="<?= $city ?>" placeholder="City">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputProvince" class="col-md-3 control-label">Provinsi/Negara Bagian</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="province" name="province" value="<?= $province ?>"placeholder="Province/State">
                                                       </div>
                                                  </div>

                                         <div class="form-group">
                                                       <label for="inputCountry" class="col-md-3 control-label">Negara</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" name="country" id="country">
                                                                 <option value="">Pilih Negara </option>
                                                                 <?php
                                                                 $qry = $DB->query("select country_name from countries order by country_name  asc ");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $country_name = $row->country_name;
                                                                      if ($country_name == $country)
                                                                           echo "<option value=\"$country_name\" selected>$country_name </option>";
                                                                      else
                                                                           echo "<option value=\"$country_name\" >$country_name </option>";
                                                                 }
                                                                 ?>
                                                            </select>
                                                         <!--   <input type="text" class="form-control" id="country" name="country" value="<?= $country ?>" placeholder="Country">
                                                       -->
                                                         </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Kode Pos</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="postal" value="<?= $postal ?>" name="postal" placeholder="Postal Code">
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
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Tempat Tinggal di Indonesia</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group ">
                                                       <label for="inputCurrentAddress" class="col-md-3 control-label">Alamat Terkini</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="alamatind" value="<?= $alamatind ?>"name="alamatind" placeholder="Current Address">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputCity" class="col-md-3 control-label">Kota</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="cityind" value="<?= $cityind ?>" name="cityind" placeholder="City">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputProvince" class="col-md-3 control-label">Provinsi/Negara Bagian</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="provinceid" value="<?= $provinceid ?>" name="provinceid" placeholder="Province/State">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Kode Pos</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="postalind" value="<?= $postalind ?>" name="postalind" placeholder="Postal Code">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPhone" class="col-md-3 control-label">Telp/Handphone</label>
                                                       <div class="col-md-9">
                                                            <div class="col-md-5 te-no-padding">
                                                                 <input type="text" class="form-control" id="telp" name="telp" value="<?= $telp ?>" placeholder="Phone">
                                                            </div>
                                                            <div class="col-md-1">
                                                                 <label for="inputPhone" class="col-md-3 control-label te-no-padding">/</label>
                                                            </div>
                                                            <div class="col-md-6 te-no-padding">
                                                                 <input type="text" class="form-control" id="telp2" name="telp2" value="<?= $telp2 ?>" placeholder="Mobile Phone">
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPhoto" class="col-md-3 control-label">Foto(jpg/png)</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($foto != "") {
                                                                 echo "<img src='$url_rewrite/data/$id/$foto' style='width:50%'>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rfoto/$id/$foto '\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$foto' name='text_foto'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="foto" name="foto">
                                                                 <?php
                                                            }
                                                            ?>
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
                                   </form>
                              </div>
                              <!-- end of personal_info -->





                                   <!-- study_info -->
                              <div class="tab-pane fade" id="study_info">
                                   <script>
                                     
    function tampilkanProdi()
{
   var id_universitas= document.getElementById("universitas_iduniversitas").value;
   var program= document.getElementById("jenjangstudi_idjenjangstudi").value;
   if (id_universitas!= "")
   {

         var url = "<?=$url_rewrite?>ajax/show_prodi.php?kodeUniversitas=" + id_universitas+"&program="+program;
        ambilData(url, "isi_prodi");

      return;
   }


}
 function tampilkanJurusan()
{
   var id_universitas= document.getElementById("universitas_iduniversitas").value;
   var id_prodi= document.getElementById("fakultas_idfakultas").value;

   if (id_prodi!= "" && id_universitas!="")
   {

         var url = "<?=$url_rewrite?>ajax/show_jurusan.php?kodeUniversitas=" + id_universitas 
                                                            +"&idprodi="+id_prodi;
        ambilData(url, "isi_jurusan");

      return;
   }


}
function showDiv(){
     var program= document.getElementById("jenjangstudi_idjenjangstudi").value;
     //alert(program);
        if(program<=7){
          document.getElementById('prodi-div').style.display = 'block';
          document.getElementById('jurusan-div').style.display = 'block';
          document.getElementById('pt_asal_div').style.display = 'block';
          document.getElementById('content_tambahan').style.display = 'none';
     }else{
          document.getElementById('prodi-div').style.display = 'none';
          document.getElementById('jurusan-div').style.display = 'none';
           document.getElementById('pt_asal_div').style.display = 'none';
          document.getElementById('content_tambahan').style.display = 'block';
     }
}

                                   </script>
                                   <form class="form-horizontal" role="form"  id="frmMode2" name="frmMode2" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/ekstension/">

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
                                                            <select onchange="tampilkanProdi();" class="form-control" name="universitas_iduniversitas" id="universitas_iduniversitas">
                                                                 <option value="">Pilih Universitas</option>
                                                                 <?php
                                                                     $ses_uni=trim($_SESSION[unversitas]);
                                                                 if ($_SESSION["level$ID"]!='1')
                                                                      $where=" where kodeUniversitas='{$ses_uni}' ";
                                                                 else
                                                                      $where='';
                                                                 //echo "WHERE $where ";
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
                                                       <label for="inputPeriod" class="col-md-3 control-label">Program/Jenjang Studi</label>
                                                       <div class="col-md-9" >
                                                            <select onchange="showDiv();" class="form-control" name="jenjangstudi_idjenjangstudi" id="jenjangstudi_idjenjangstudi">
                                                                 <option value="">Pilih Jenjang Studi</option>
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
                                                  
                                                  <div class="form-group" id="prodi-div" style="display: <?=$display_prodi?>">
                                                       <label for="inputFaculty" class="col-md-3 control-label">Prodi</label>
                                                       <div class="col-md-9" id="isi_prodi">
                                                           <?php
                                                                 if($fakultas_idfakultas!=""){
                                                           echo "<select class=\"form-control\" name=\"fakultas_idfakultas\" "
                                                                      . "id=\"fakultas_idfakultas\" onchange=\"tampilkanJurusan();\">
                                                                      <option value=\"\">Pilih Prodi</option>";
                                                                      $qry = $DB->query("select idprodi,namaProdi from prodi where "
                                                                              . " kodeUniversitas='$universitas_iduniversitas' group by namaProdi asc");
                                                                      while ($row = $DB->fetch_object($qry)) {
                                                                           $idprodi = $row->idprodi;
                                                                           $namaprodi= $row->namaProdi;
                                                                           if ($idprodi == $fakultas_idfakultas)
                                                                                echo "<option value=\"$idprodi\" selected>$namaprodi</option>";
                                                                           else
                                                                                echo "<option value=\"$idprodi\" >$namaprodi</option>";
                                                                      }
                                                                      echo "</select>";
                                                                 }?>
                                                       </div>
                                                  </div>

                                                  <div class="form-group" id="jurusan-div" style="display: <?=$display_jurusan?>">
                                                       <label for="inputMajor" class="col-md-3 control-label">Jurusan </label>
                                                       <div class="col-md-9" id="isi_jurusan">
                                                                     <?php
                                                                     if($jurusan_idjurusan!=""){
                                                            echo "<select class=\"form-control\" 
                                                                          name=\"jurusan_idjurusan\" value=\"jurusan_idjurusan\">
                                                                 <option value=\"\">Pilih Jurusan</option>";
                                                        
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
                                                                 echo "</select>";
                                                                     }
                                                                 ?>                  
                                                            
                                                       </div>
                                                  </div>
                                                 <div id="pt_asal_div" style="display:block">
                                                  <div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Perguruan Tinggi Asal</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="pt_asal" value="<?= $pt_asal?>" name="pt_asal" placeholder="">
                                                       </div>
                                                  </div>
                                                  <!--<div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Lokasi/Keterangan Program</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="ket_program" value="<?= $ket_program?>" name="ket_program" placeholder="">
                                                       </div>
                                                  </div>-->
                                                  </div>
                                                  <div id="content_tambahan" style="display:<?php if($jenjangstudi_idjenjangstudi<=7) echo "none"; else echo "block"?>">
                                                  <div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Penyelenggara Program </label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="penyelenggara_program" value="<?= $penyelenggara_program?>" name="penyelenggara_program" placeholder="">
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="inputPostalCode" class="col-md-3 control-label">Lokasi/Keterangan Program</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="ket_program" value="<?= $ket_program?>" name="ket_program" placeholder="">
                                                       </div>
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
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Pengajuan Periode Ijin Belajar</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group">
                                                       <label for="inputStartStudy" class="col-md-3 control-label">Mulai Belajar</label>
                                                       <div class="col-md-9">
                                                            <div class="input-group">
                                                                 <script>
                                                                              $(function() {
                                                                              $("#mulaibelajar").datepicker({
                                                                             yearRange: '-70:+30',
                                                                                      changeMonth: true,
                                                                                      changeYear: true,
                                                                                      numberOfMonths: 1,
                                                                                      dateFormat: 'd M yy ',
                                                                              });
                                                                              });</script>         
                                                                                                                                          <input type="text" readonly="1" class="form-control" id="mulaibelajar" value="<?= $mulaibelajar ?>" name="mulaibelajar" placeholder="Start of Study">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPeriodStudy" class="col-md-3 control-label">Lama Ijin Studi</label>
                                                       <div class="col-md-9">
                                                            
                                                            <select class="form-control" name="lamaijin" id="lamaijin" onchange="lama_ijin();">
                                                                <?php
                                                                      if($lamaijin=="3 Bulan")
                                                                                echo "<option value=\"3 Bulan\" selected>3 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"3 Bulan\">3 Bulan</option>";
                                                                      if($lamaijin=="4 Bulan")
                                                                                echo "<option value=\"4 Bulan\" selected>4 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"4 Bulan\">4 Bulan</option>";
                                                                      if($lamaijin=="5 Bulan")
                                                                                echo "<option value=\"5 Bulan\" selected>5 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"5 Bulan\">5 Bulan</option>";
                                                                      if($lamaijin=="6 Bulan")
                                                                                echo "<option value=\"6 Bulan\" selected>6 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"6 Bulan\">6 Bulan</option>";
                                                                     if($lamaijin=="12 Bulan")
                                                                                echo "<option value=\"12 Bulan\" selected>12 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"12 Bulan\">12 Bulan</option>";
                                                                      if($lamaijin=="24 Bulan")
                                                                                echo "<option value=\"24 Bulan\" selected>24 Bulan</option>";
                                                                      else
                                                                                 echo "<option value=\"24 Bulan\">24 Bulan</option>";
                                                                      
                                                                      ?>
                                                                        
                                                            </select>
                                                       
                                                       </div>
                                                  </div>
                                                      <script>
                                                       function bulan_studi(bln){
                                                            switch(bln){
                                                                 case "1 Bulan":
                                                                      n_bln=1;
                                                                      break;
                                                                 case "2 Bulan":
                                                                      n_bln=2;
                                                                      break;
                                                                 case "3 Bulan":
                                                                      n_bln=3;
                                                                      break;
                                                                 case "4 Bulan":
                                                                      n_bln=4;
                                                                      break;
                                                                 case "5 Bulan":
                                                                      n_bln=5;
                                                                      break;
                                                                 case "6 Bulan":
                                                                      n_bln=6;
                                                                      break;
                                                                case "12 Bulan":
                                                                      n_bln=12;
                                                                      break;
                                                                case "24 Bulan":
                                                                      n_bln=24;
                                                                      break;
                                                            }
                                                            return n_bln;
                                                       }
                                                       function lama_ijin(){
                                                            var lama=bulan_studi($('#lamaijin').val());
                                                                 $("#periode_belajar_end").datepicker("option", "maxDate", " '+ "+lama+"M'");
                                                            //alert(lama);
                                                       }
                                                      
                                                               $(function() {
                                                               $("#periode_belajar_start").datepicker({
                                                               yearRange: '-70:+30',
                                                                       changeMonth: true,
                                                                    
                                                                       numberOfMonths: 3,
                                                                       dateFormat: 'd M yy ',
                                                                       onClose: function(selectedDate) {
                                                                       $("#periode_belajar_end").datepicker("option", "minDate", selectedDate);
                                                                               var lama=(bulan_studi($('#lamaijin').val())+1)*31;
                                                                               var nyd = new Date(selectedDate);
                                                                               nyd.setDate(nyd.getDate() + lama);
                                                                                //alert(nyd);
                                                                            $("#periode_belajar_end").datepicker("option", "maxDate", nyd);
                                                                         //$("#periode_belajar_end").datepicker("option", "maxDate", " '+ "+lama+"M'");
                                                                       }
                                                               });
                                                                       $("#periode_belajar_end").datepicker({
                                                               yearRange: '-70:+30',
                                                                       changeMonth: true,
                                                                           changeYear: true,
                                                                       numberOfMonths: 3,
                                                                       dateFormat: 'd M yy ',
                                                                       //maxDate: " '+ "+bulan_studi($('#lamaijin').val())+"M'",
                                                                       //onClose: function(selectedDate) {
                                                                      // $("#periode_belajar_start").datepicker("option", "maxDate", selectedDate);
                                                                 
                                                                       //}
                                                               });
                                                               });</script>
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
                                                  <button type="submit" name="btnStudy" class="btn btn-primary">Save and Next</button>
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
                                   </form>
                              </div>
                              <!-- end of study_info -->






                              <!-- supporting_document -->
                              <div class="tab-pane fade" id="supporting_document">
                                   <form class="form-horizontal" role="form"  name="frmMode3" id="frmMode3" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/ekstension/">

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
                                                       <div class="col-md-9"></div>
                                                  </div>

                                                  <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor</label>
                                                       <div class="col-md-9">
                                                            <input type="text" value="<?= $nmrpaspor ?>" class="form-control" id="nmrpaspor" name="nmrpaspor" placeholder="Number">
                                                       </div>
                                                  </div>
                                                  <script>
                                                       $(function() {
                                                            $("#mulaipassport").datepicker({
                                                                yearRange: '-70:+30',
                                                                 changeMonth: true,
                                                                 changeYear: true,
                                                                 dateFormat: 'd M yy ',
                                                                 numberOfMonths: 2,
                                                                 onClose: function(selectedDate) {
                                                                      $("#akhirpassport").datepicker("option", "minDate", selectedDate);
                                                                 }
                                                            });
                                                            $("#akhirpassport").datepicker({
                                                                yearRange: '-70:+30',
                                                                 changeMonth: true,
                                                                 changeYear: true,
                                                                 dateFormat: 'd M yy ',
                                                                 numberOfMonths: 2,
                                                                 onClose: function(selectedDate) {
                                                                      $("#mulaipassport").datepicker("option", "maxDate", selectedDate);
                                                                 }
                                                            });
                                                       });</script>         
                                                       <div class="form-group">
                                                            <label for="inputIssuedDate" class="col-md-3 control-label">Tanggal Berlaku</label>
                                                            <div class="col-md-9">
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"  class="form-control" id="mulaipassport" value="<?= $mulaipassport ?>" name="mulaipassport" placeholder="Issued Date">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                  <div class="form-group">
                                                       <label for="inputExpiryDate" class="col-md-3 control-label">Tanggal berakhir</label>
                                                       <div class="col-md-9">
                                                            <div class="input-group">
                                                                 <input type="text" readonly="1"  class="form-control" id="akhirpassport"  value="<?= $akhirpassport ?>" name="akhirpassport" placeholder="Expiry Date">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputEnclosurePassport" class="col-md-3 control-label">Scan Paspor</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($passport1 != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$passport1' >$passport1</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rpassport1/$id/$passport1 '\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$passport1' name='text_passport1'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="passport1" name="passport1">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFunding" class="col-md-3 control-label">Pendanaan</label>
                                                       <div class="col-md-9"></div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFunding" class="col-md-3 control-label">Jenis Pendanaan</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" name="pembiayaan_idpembiayaan">
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
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputScholarshipProvider" class="col-md-3 control-label">Penyedia Beasiswa</label>
                                                       <div class="col-md-9">
                                                            <input type="text" value="<?= $sumber_pembiayaan ?>" class="form-control" id="sumber_pembiayaan" name="sumber_pembiayaan" placeholder="Scholarship Provider">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputFinancialStatement" class="col-md-3 control-label">Surat Keuangan</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($keuangan != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$keuangan' >$keuangan</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rkeuangan/$id/$keuangan'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$keuangan' name='text_keuangan'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="keuangan" name="keuangan">
                                                            <?php }
                                                            ?>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputStatementLetter" class="col-md-3 control-label">Surat Pernyataan</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($pernyataan1 != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$pernyataan1' >$pernyataan1</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rpernyataan1/$id/$pernyataan1'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$pernyataan1' name='text_pernyataan1'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="pernyataan1" name="pernyataan1">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputMedicalStatement" class="col-md-3 control-label">Surat Kesehatan</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($kesehatan != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$kesehatan' >$kesehatan</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rkesehatan/$id/$kesehatan'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$kesehatan' name='text_kesehatan'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="kesehatan" name="kesehatan">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">Letter of Acceptance</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($loa != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$loa' >$loa</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rloa/$id/$loa'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$loa' name='text_loa'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="loa" name="loa">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>
                                                                                                    <div class="form-group">
                                                       <label for="inputMOU" class="col-md-3 control-label">Dokumen Kerjasama (MOU/MOA)</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($dok_mou != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$dok_mou' >$dok_mou</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/student/rmou/$id/$dok_mou'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$dok_mou' name='text_dok_mou'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="dok_mou" name="dok_mou">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>
                                                  
                                                   <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor Kitas</label>
                                                       <div class="col-md-9">
                                                            <input type="text" value="<?= $no_kitas?>" class="form-control" id="no_kitas" name="no_kitas" placeholder="Nomor Kitas">
                                                       </div>
                                                  </div>
                                                  <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Jumlah Kitas</label>
                                                       <div class="col-md-9">
                                                            <input type="text" value="<?= $jml_kitas?>" class="form-control" id="jml_kitas" name="jml_kitas" placeholder="Jumlah Kitas">
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">File KITAS</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($kitas != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$kitas' >$kitas</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rkitas/$id/$kitas'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$kitas' name='text_kitas'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="kitas" name="kitas">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                   <label for="inputTlgKitas" class="col-md-3 control-label">Tgl KITAS Berlaku</label>

                                                    <div class="col-md-9">
                                                                 <script>
                                                                                                              $(function() {
                                                            $("#tgl_kitas").datepicker({
                                                                yearRange: '-70:+30',
                                                                 changeMonth: true,
                                                                 changeYear: true,
                                                                 dateFormat: 'd M yy ',
                                                                 numberOfMonths: 2,
                                                                 onClose: function(selectedDate) {
                                                                      $("#tgl_kitas_akhir").datepicker("option", "minDate", selectedDate);
                                                                 }
                                                            });
                                                            $("#tgl_kitas_akhir").datepicker({
                                                                yearRange: '-70:+30',
                                                                 changeMonth: true,
                                                                 changeYear: true,
                                                                 dateFormat: 'd M yy ',
                                                                 numberOfMonths: 2,
                                                                 onClose: function(selectedDate) {
                                                                      $("#tgl_kitas").datepicker("option", "maxDate", selectedDate);
                                                                 }
                                                            });
                                                       });</script>         
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_kitas" value="<?= $tgl_kitas ?>"name="tgl_kitas" placeholder="Tgl KITAS">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                  </div>
                                                  <div class="form-group">
                                                   <label for="inputTlgKitas" class="col-md-3 control-label">Tgl KITAS Berakhir</label>

                                                    <div class="col-md-9">
                                                                 <script>
                                                                 </script>         
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_kitas_akhir" value="<?= $tgl_kitas_akhir ?>"name="tgl_kitas_akhir" placeholder="Tgl KITAS Berakhir">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">Ijazah</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($ijazah != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$ijazah' >$ijazah</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rijazah/$id/$ijazah'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$ijazah' name='text_ijazah'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="ijazah" name="ijazah">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>
                                                  
                                                   <div class="form-group ">
                                                       <label for="inputNumber" class="col-md-3 control-label">Nomor SKLD/SKJ/STM</label>
                                                       <div class="col-md-9">
                                                            <input type="text" value="<?= $no_skld?>" class="form-control" id="no_skld" name="no_skld" placeholder="Nomor Kitas">
                                                       </div>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="inputLetterAcceptance" class="col-md-3 control-label">SKLD/SKJ/STM</label>
                                                       <div class="col-md-9">
                                                            <?php
                                                            if ($skld != "") {
                                                                 echo "<a href ='$url_rewrite/data/$id/$skld' >$skld</a>&nbsp;&nbsp;&nbsp;";
                                                                 echo "<button type=\"button\" class=\"btn btn-warning btn-sm\"  
                                                                 onclick=\"javascript:location.href='$url_rewrite" . "proses/ekstension/rskld/$id/$skld'\"
                                                                 >Remove File</button>";
                                                                 echo "<input type='hidden' value='$skld' name='text_skld'/>";
                                                            } else {
                                                                 ?>
                                                                 <input type="file" class="form-control" id="skld" name="skld">
                                                                 <?php
                                                            }
                                                            ?>
                                                       </div>
                                                  </div>
                                                  
                                                  
                                                  
                                                  <div class="form-group">
                                                   <label for="inputTlgSKLD" class="col-md-3 control-label">Tgl SKLD/SKJ/STM</label>

                                                  <div class="col-md-9">
                                                                 <script>
                                                                      $(function() {
                                                                           $("#tgl_skld").datepicker({
                                                                               yearRange: '-70:+30',
                                                                                changeMonth: true,
                                                                                changeYear: true,
                                                                                numberOfMonths: 1,
                                                                                dateFormat: 'd M yy ',
                                                                           });
                                                                      });</script>         
                                                                 <div class="input-group">
                                                                      <input type="text" readonly="1"class="form-control" id="tgl_skld" value="<?= $tgl_skld ?>"name="tgl_skld" placeholder="Tgl SKLD">
                                                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                 </div>
                                                            </div>
                                                  </div>
                                             </div>
                                             <!-- end of panel body -->
                                        </div>
                                        <!-- end of panel personal info -->


                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" class="btn btn-primary">Save and Next</button>
                                             </div>
                                        </div>
                                        <input type="hidden" value="3" name="mode"/>
                                        <?php
                                        if ($id != "")
                                             echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
                                        else
                                             echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

                                        echo"<input type=\"hidden\"  name=\"kode\" value=\"$id\">";
                                        ?>
                                   </form>
                              </div>
                              <!-- end of supporting_document -->




                              <!-- verification -->
                              <div class="tab-pane fade" id="verification">
                                  <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?= $url_rewrite ?>proses/ekstension/">

                                         <!--panel account information--> 
                                        <div class="panel panel-default">
                                              <!--Default panel contents--> 
                                             <div class="panel-heading te-panel-heading">
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Account Information</p>
                                             </div>

                                             <div class="clearfix"></div>

                                             <div class="panel-body">
                                                  <div class="form-group ">
                                                       <label for="inputLoginUsername" class="col-md-3 control-label">Desired Login Username</label>
                                                       <div class="col-md-9">
                                                            <input type="text" readonly="1" class="form-control" id="idmahasiswa"  value="<?= $login_mahasiswa ?>" name="idmahasiswa" placeholder="Desired Login Username">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label">Choose a Password</label>
                                                       <div class="col-md-9">
                                                            <input type="hidden" value="<?= $id ?>" name="kode"/>
                                                            <input type="hidden" value="<?= $universitas_iduniversitas ?>" name="universitas_iduniversitas"/>
                                                            <input type="hidden" value="account" name="kondisi"/>
                                                            <input type="password" readonly="1" class="form-control" id="login_password" value="<?= $login_mahasiswa ?>" name="login_password" placeholder="Choose a Password">
                                                       </div>
                                                  </div>


                                             </div>
                                              <!--end of panel body--> 
                                        </div>
                                         <!--end of panel period of study info--> 




                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" name="btnStudy" class="btn btn-primary">Save and Finish</button>
                                             </div>
                                        </div>
                                   </form>
                                   
                                               <div class="panel panel-default">
                                             <!-- Default panel contents -->
                                             <div class="panel-heading te-panel-heading">
                                                  <i class="glyphicon glyphicon-th-large"></i> <p>Verification Information</p>
                                             </div>
                                            <div class="panel-body">
                                                  <div class="form-group ">
                                                       <label for="inputLoginUsername" class="col-md-3 control-label">Status</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control" id="inputStatus" name="status" disabled="1">
                             <option value="">Select Status</option>
                          <?php
                                                                                $qry = $DB->query("select idstatus,namastatus from status ");
                                                                                while ($row = $DB->fetch_object($qry)) {
                                                                                     $idstatus= $row->idstatus;
                                                                                     $namastatus= $row->namastatus;
                                                                                     if($idstatus==$status_ijin)
                                                                                          echo "<option value=\"$idstatus\" selected>$namastatus</option>";
                                                                                     else
                                                                                          echo "<option value=\"$idstatus\" >$namastatus</option>";
                                                                                     
                                                                                }
                                                                                ?>
                        </select>
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label" >Keterangan</label>

                                                       <div class="col-md-9">
                                                             <input type="hidden" value="<?=$id?>" name="kode"/>
                                                            <input type="hidden" value="<?=$idijin?>" name="idijin"/>
                                                            <input type="hidden" value="<?=$idmhs?>" name="mahasiswa_idmahasiswa"/>
                                                            <input type="hidden" value="verification" name="kondisi"/>
                                                            <textarea rows="30" cols="50" type="keterangan"  class="form-control" id="keterangan" disabled="1" value="<?=$keterangan?>" name="keterangan" placeholder="Information"><?=$keterangan?></textarea>
                                                       </div>
                                                  </div>
                                                  
                                                   <?php  if($status_ijin==4){?>
                                                   <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label" >Cetak Berkas Persetujuan</label>
                                                       <div class="col-md-9">
                                                            <a href="<?=$url_rewrite?>content/report/final/<?=$id?>">Download</a>
                                                       </div>
                                                  </div>
                                                   <?php
                                                   }
                                                  ?>
                                             </div>
                                        </div>
                              </div>
                              
                                                   <!-- panel account information -->
                            
                              </div>
                              <!-- end of study_info -->





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