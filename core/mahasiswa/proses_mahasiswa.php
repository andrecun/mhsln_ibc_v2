<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);

$kondisi = $_POST['kondisi'];
$kode = $_POST['kode'];
$mode = $_POST['mode'];

$id_next = $DB->get_auto_increment("mahasiswa");
if ($kode == "")
     $kode = $id_next;;

function upload_for_mahasiswa($nama, $kode, $tipe, $path_upload) {
     $text_data = $_POST["text_$nama"];
     if ($text_data == "") {
          $index_image = $kode;
          $path_upload_data = "$path_upload" . "$index_image";
          $ekstensi = $_FILES["$nama"]["name"];
          $end = end(explode(".", $ekstensi));
          $text_data = "$nama-" . $index_image . ".$end";
          $UTILITY = new utilityCode();
          $result_data = $UTILITY->upload_gambar("$nama", $path_upload_data, $tipe, $text_data);
          //echo $result_data;
          
         if($result_data =="")$text_data="";
          // echo "$result_data";
         // exit;
     }
     return $text_data;
}

switch ($mode) {
     case 1:
          //mode 1;
          $namamahasiswa = $purifier->purify($_POST["namamahasiswa"]);
          $namamahasiswa2 = $purifier->purify($_POST["namamahasiswa2"]);
          $tempatlahir = $purifier->purify($_POST["tempatlahir"]);
          $tanggallahir = $UTILITY->format_tanggal_db($_POST["tanggallahir"]);
          $sex = $purifier->purify($_POST["sex"]);
          $nationality_idnationality = $purifier->purify($_POST["nationality_idnationality"]);
          $alamat = $purifier->purify($_POST["alamat"]);
          $city = $purifier->purify($_POST["city"]);
          $province = $purifier->purify($_POST["province"]);
          $country = $purifier->purify($_POST["country"]);
          $postal = $purifier->purify($_POST["postal"]);
          $alamatind = $purifier->purify($_POST["alamatind"]);
          $cityind = $purifier->purify($_POST["cityind"]);
          $provinceid = $purifier->purify($_POST["provinceid"]);
          $postalind = $purifier->purify($_POST["postalind"]);
          $telp = $purifier->purify($_POST["telp"]);
          $telp2 = $purifier->purify($_POST["telp2"]);

          $foto = upload_for_mahasiswa("foto", $kode, 1, $path_upload);
       
          $data = array(
              "namamahasiswa" => "$namamahasiswa",
              "namamahasiswa2" => "$namamahasiswa2",
              "tempatlahir" => "$tempatlahir",
              "tanggallahir" => "$tanggallahir",
              "sex" => "$sex",
              "nationality_idnationality" => "$nationality_idnationality",
              "alamat" => "$alamat",
              "city" => "$city",
              "province" => "$province",
              "country" => "$country",
              "postal" => "$postal",
              "alamatind" => "$alamatind",
              "cityind" => "$cityind",
              "provinceind" => "$provinceid",
              "postalind" => "$postalind",
              "telp" => "$telp",
              "telp2" => "$telp2",
              "foto" => "$foto",
              "kode" => "$kode"
          );
          break;
     case 2:
          $universitas_iduniversitas = $purifier->purify($_POST["universitas_iduniversitas"]);
          $fakultas_idfakultas = $purifier->purify($_POST["fakultas_idfakultas"]);
          $jurusan_idjurusan = $purifier->purify($_POST["jurusan_idjurusan"]);
          $jenjangstudi_idjenjangstudi = $purifier->purify($_POST["jenjangstudi_idjenjangstudi"]);
          $mulaibelajar = $UTILITY->format_tanggal_db($_POST["mulaibelajar"]);
          $periode_belajar_start = $UTILITY->format_tanggal_db($_POST["periode_belajar_start"]);
          $periode_belajar_end = $UTILITY->format_tanggal_db($_POST["periode_belajar_end"]);
          $ket_program=$_POST["ket_program"];
          $penyelenggara_program=$_POST["penyelenggara_program"];
          $lamaijin=$_POST["lamaijin"];
          $data = array(
              "universitas_iduniversitas" => "$universitas_iduniversitas",
              "fakultas_idfakultas" => "$fakultas_idfakultas",
              "jurusan_idjurusan" => "$jurusan_idjurusan",
              "jenjangstudi_idjenjangstudi" => "$jenjangstudi_idjenjangstudi",
              "mulaibelajar" => "$mulaibelajar",
              "periode_belajar-start" => "$periode_belajar_start",
              "periode_belajar-end" => "$periode_belajar_end",
              "kode" => "$kode",
              "lamaijin"=>"$lamaijin",
              "ket_program"=>"$ket_program",
              "penyelenggara_program"=>"$penyelenggara_program"
          );
          break;
     case 3:

          $nmrpaspor = $purifier->purify($_POST["nmrpaspor"]);
          $mulaipassport = $UTILITY->format_tanggal_db($_POST["mulaipassport"]);
          $akhirpassport = $UTILITY->format_tanggal_db($_POST["akhirpassport"]);
          //$passport1=$purifier->purify($_POST["passport1"]);
          $pembiayaan_idpembiayaan = $purifier->purify($_POST["pembiayaan_idpembiayaan"]);
          $sumber_pembiayaan = $purifier->purify($_POST["sumber_pembiayaan"]);
          // $keuangan=$purifier->purify($_POST["keuangan"]);
          //$pernyataan1=$purifier->purify($_POST["pernyataan1"]);
          //$kesehatan=$purifier->purify($_POST["kesehatan"]);
          //$loa=$purifier->purify($_POST["loa"]);
          //$ijazah= upload_for_mahasiswa("ijazah", $kode, 3, $path_upload);
          
          $passport1 = upload_for_mahasiswa("passport1", $kode, 3, $path_upload);
          ;
          $keuangan = upload_for_mahasiswa("keuangan", $kode, 3, $path_upload);
          $pernyataan1 = upload_for_mahasiswa("pernyataan1", $kode, 3, $path_upload);
          $kesehatan = upload_for_mahasiswa("kesehatan", $kode, 3, $path_upload);
          ;
          $loa = upload_for_mahasiswa("loa", $kode, 1, $path_upload);
          ;

          $data = array(
              "nmrpaspor" => "$nmrpaspor",
              "mulaipassport" => "$mulaipassport",
              "akhirpassport" => "$akhirpassport",
              "passport1" => "$passport1",
              "pembiayaan_idpembiayaan" => "$pembiayaan_idpembiayaan",
              "sumber_pembiayaan" => "$sumber_pembiayaan",
              "keuangan" => "$keuangan",
              "pernyataan1" => "$pernyataan1",
              "kesehatan" => "$kesehatan",
              "loa" => "$loa",
              "ijazah"=>"$ijazah",
              "kode" => "$kode"
          );
          break;
}
if ($kondisi == "account") {
     $username = $_POST["idmahasiswa"];
     $password = $UTILITY->sha512($_POST["login_password"]);
     $universitas_iduniversitas=$_POST["universitas_iduniversitas"];
     $user_id=$DB->get_auto_increment("user");
     
     $tgl_update=date("Y-m-d");
     $qWhere = array("userlogin" => $username);
     $data = $USER->readUser($qWhere);
     if ($data != "")
          $jData = count($data);
     else
          $jData = 0;
      if ($jData > 0) {
           //update
           //disable untuk sementara waktu
            $DB->query("update mahasiswa set idmahasiswa='$username',user_iduser='$user_id' where kode='$kode'");
          /* $DB->query("update user set password='$password',"
                   . "level_idlevel=3,universitas_iduniversitas='$universitas_iduniversitas' where userlogin='$username'  ");
          */
           $qWhere = array("idmahasiswa" => $username);
           $data = $MHS->readMahasiswa($qWhere);
            $nationality_idnationality = $data["nationality_idnationality"];
            $pembiayaan_idpembiayaan = $data["pembiayaan_idpembiayaan"];
            $universitas_iduniversitas = $data["universitas_iduniversitas"];
            
            
            $qWhere = array("mahasiswa_idmahasiswa" => $username);
             $data = $IJIN->readIjin($qWhere);
              if ($data != "")
                         $jData = count($data);
                    else
                         $jData = 0;
                    if ($jData > 0) {
                         //update
                         $query="update ijin set mahasiswa_idmahasiswa='$username', "
                                 . "mahasiswa_nationality_idnationality='$nationality_idnationality',"
                                 . "mahasiswa_pembiayaan_idpembiayaan='$pembiayaan_idpembiayaan ',"
                                 . "mahasiswa_universitas_iduniversitas='$universitas_iduniversitas',"
                                 . "tgl_update='$tgl_update' "
                                 . " where mahasiswa_idmahasiswa ='$username'";
                         //echo $query;
                         $DB->query($query);
                    }else{
                           $query="insert ijin set mahasiswa_idmahasiswa='$username', "
                                 . "mahasiswa_nationality_idnationality='$nationality_idnationality',"
                                 . "mahasiswa_pembiayaan_idpembiayaan='$pembiayaan_idpembiayaan ',"
                                 . "mahasiswa_universitas_iduniversitas='$universitas_iduniversitas',"
                                   . "tgl_update='$tgl_update', "
                                   . "status_idstatus=0";
                         //        echo $query;
                                 $DB->query($query);
                    }
      }else{
           //tambah
           $DB->query("update mahasiswa set idmahasiswa='$username',user_iduser='$user_id' where kode='$kode'");
         /*  $DB->query("insert into user set userlogin='$username', password='$password',"
                   . "level_idlevel=3,universitas_iduniversitas='$universitas_iduniversitas',iduser='$user_id'  ");*/
          
           $qWhere = array("idmahasiswa" => $username);
           $data = $MHS->readMahasiswa($qWhere);
            $nationality_idnationality = $data["nationality_idnationality"];
            $pembiayaan_idpembiayaan = $data["pembiayaan_idpembiayaan"];
            $universitas_iduniversitas = $data["universitas_iduniversitas"];
            
            
            $qWhere = array("mahasiswa_idmahasiswa" => $username);
             $data = $IJIN->readIjin($qWhere);
              if ($data != "")
                         $jData = count($data);
                    else
                         $jData = 0;
                    if ($jData > 0) {
                         //update
                         $query="update ijin set mahasiswa_idmahasiswa='$username', "
                                 . "mahasiswa_nationality_idnationality='$nationality_idnationality',"
                                 . "mahasiswa_pembiayaan_idpembiayaan='$pembiayaan_idpembiayaan ',"
                                 . "mahasiswa_universitas_iduniversitas='$universitas_iduniversitas',"
                                  . "tgl_update='$tgl_update' "
                                 . " where mahasiswa_idmahasiswa='$username'";
                         //echo $query;
                         $DB->query($query);
                    }else{
                           $query="insert ijin set mahasiswa_idmahasiswa='$username', "
                                 . "mahasiswa_nationality_idnationality='$nationality_idnationality',"
                                 . "mahasiswa_pembiayaan_idpembiayaan='$pembiayaan_idpembiayaan ',"
                                 . "mahasiswa_universitas_iduniversitas='$universitas_iduniversitas',"
                                    . "tgl_update='$tgl_update', "
                                   . "status_idstatus=0";
                         //        echo $query;
                                 $DB->query($query);
                    }
                  
      }
      $UTILITY->location_goto("content/student/permit/$username");
}
if ($kondisi == "tambah") {
     $next = $mode + 1;
     $MHS->insertMahasiswa($data);

     $UTILITY->location_goto("content/student/edit/$id_next/$next");
} else if ($kondisi == "edit") {
     $next = $mode + 1;
     $MHS->updateMahasiswa($data, $mode);
     $UTILITY->location_goto("content/student/edit/$kode/$next");
}
if ($hapusmahasiswa != "") {

     $MHS->deleteMahasiswa($hapusmahasiswa);
     $UTILITY->location_goto("content/student");
}
?>
