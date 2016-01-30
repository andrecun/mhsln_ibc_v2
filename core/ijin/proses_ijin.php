<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);

$kondisi = $_POST['kondisi'];
$kode = $_POST['kode'];
$idijin = $_POST['idijin'];
$nomor = $_POST['nomor'];
$tglijin = $UTILITY->format_tanggal_db($_POST["tglijin"]);
$atasnama = $_POST["atasnama"];
$nip = $_POST["nip"];
$jabatan = $_POST["jabatan"];
$srtrek = $_POST["srtrek"];
$register_number = $_POST["register_number"];
$reg = $_POST["reg"];
$id_next = $DB->get_auto_increment("ijin");
if ($idijin == "")
     $idijin = $id_next;

$tgl_verifikasi_kampus=date("Y-m-d");

function upload_for_ijin($nama, $kode, $tipe, $path_upload) {
     $text_data = $_POST["text_$nama"];
     if ($text_data == "") {
          $index_image = $kode;
          $path_upload_data = "$path_upload" . "$index_image";
          $ekstensi = $_FILES["$nama"]["name"];
          $end = end(explode(".", $ekstensi));
          $text_data = "$nama-" . $index_image . ".$end";
          $UTILITY = new utilityCode();
          $result_data = $UTILITY->upload_gambar("$nama", $path_upload_data, $tipe, $text_data);
          //echo $path_upload_data;
     }
     return $text_data;
}

$srtrek = upload_for_ijin("srtrek", $kode, 3, $path_upload);

//$UTILITY->show_data($data);
//exit;
if ($kondisi == "tambah") {
     foreach ($reg as $kode) {

          $data = array(
              'idijin' => "$idijin",
              'nomor' => "$nomor",
              'status_idstatus' => 1,
              'tglijin' => "$tglijin",
              'atasnama' => "$atasnama",
              'nip' => "$nip",
              'jabatan' => "$jabatan",
              "srtrek" => "$srtrek",
              "kode" => "$kode",
          );
          
          //$UTILITY->show_data($data);
          $IJIN->insertIjin($data);
          $DB->query("update mahasiswa set nosrtrek='$nomor', atasnama='$atasnama',"
                  . " nip='$nip',jabatan='$jabatan',tglsrtrek='$tglijin',srtrek='$srtrek',tgl_verifikasi_kampus='$tgl_verifikasi_kampus',kunci='1' "
                  . " where idmahasiswa='$kode'");
     }
     
     //$UTILITY->location_goto("content/student/permit/$register_number/$id_next");
     $UTILITY->location_goto("content/home");
} else if ($kondisi == "edit") {

     foreach ($reg as $kode) {
          $data = array(
              'idijin' => "$idijin",
              'nomor' => "$nomor",
              'status_idstatus' => 1,
              'tglijin' => "$tglijin",
              'atasnama' => "$atasnama",
              'nip' => "$nip",
              'jabatan' => "$jabatan",
              "srtrek" => "$srtrek",
              "kode" => "$kode",
          );
          //$UTILITY->show_data($data);
          
          $IJIN->updateIjin($data);
         
          $DB->query("update mahasiswa set nosrtrek='$nomor', atasnama='$atasnama',"
                  . " nip='$nip',jabatan='$jabatan',tglsrtrek='$tglijin',srtrek='$srtrek',tgl_verifikasi_kampus='$tgl_verifikasi_kampus',kunci='1'  "
                  . " where idmahasiswa='$kode'");
     }


    // $UTILITY->location_goto("content/student/permit/$register_number/$idijin");
     $UTILITY->location_goto("content/home");
}

if ($hapusijin != "") {

     $IJIN->deleteIjin($hapusijin);
     $UTILITY->location_goto("content/student");
}
?>
