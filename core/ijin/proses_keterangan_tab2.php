<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);
$kode = $purifier->purify($_POST["kode"]);
$kondisi = $purifier->purify($_POST["kondisi"]);
$mahasiswa_idmahasiswa = $purifier->purify($_POST["mahasiswa_idmahasiswa"]);


$universitas_iduniversitas = $purifier->purify($_POST["universitas_iduniversitas_ket"]);
$jenjangstudi_idjenjangstudi = $purifier->purify($_POST["jenjangstudi_idjenjangstudi_ket"]);


$qWhere = array( "kode" => $kode );
$data = $MHS->readMahasiswa( $qWhere );
$jenjangstudi_idjenjangstudi_query = $data["jenjangstudi_idjenjangstudi"];




$fakultas_idfakultas = $purifier->purify($_POST["fakultas_idfakultas_ket"]);
$jurusan_idjurusan = $purifier->purify($_POST["jurusan_idjurusan_ket"]);

$ket_program = $_POST["ket_program_ket"];
$penyelenggara_program = $_POST["penyelenggara_program_ket"];
$pt_asal = $purifier->purify($_POST["pt_asal_ket"]);

$mulaibelajar = $_POST["mulaibelajar_ket"];
$periode_belajar_start = $_POST["periode_belajar_start_ket"];
$periode_belajar_end = $_POST["periode_belajar_end_ket"];

$lamaijin = $_POST["lamaijin_ket"];


$qWhere = array("idjenjangstudi" => $jenjangstudi_idjenjangstudi_query);
$data_jenjang = $JENJANG_STUDI->readJenjangStudi($qWhere);
//$UTILITY->show_data($_POST);
//exit();

$text = '';
$status = 0;
if ($data_jenjang['show_prodi'] == 1) {
    if ($fakultas_idfakultas != "1") {
        $text.="Fakultas tidak lengkap atau   salah\n";
        $keterangan_studi['jenjangstudi_idjenjangstudi_ket'] = 1;
    }
} 
if ($data_jenjang["show_mou"] == 1) {
   if ( $dok_mou!="1" ) {
    $keterangan.="Dok mou tidak ada atau salah\n";
    $keterangan_studi["dok_mou_ket"]=1;
    }
}

if ($data_jenjang["show_pt_asal"] == 1) {
     if ($pt_asal != "1") {
        $text.="Perguruan asal tidak lengkap atau salah\n";
        $keterangan_studi['pt_asal_ket'] = 1;
    }
} 
if ($data_jenjang["show_ket"] == 1) {
    if ($ket_program != "1") {
        $text.="Keterangan Program salah\n";
        $keterangan_studi['ket_program_ket'] = 1;
    }

    if ($penyelenggara_program != "1") {
        $text.="Penyelenggara program tidak lengkap atau salah\n";
        $keterangan_studi['penyelenggara_program_ket'] = 1;
    }
} 




if ($universitas_iduniversitas != "1") {
    $text.="Nama Universitas  salah\n";
    $keterangan_studi['universitas_iduniversitas_ket'] = 1;
}

if ($jenjangstudi_idjenjangstudi != "1") {
    $text.="Program/Jenjang Studi   salah\n";
    $keterangan_studi['jenjangstudi_idjenjangstudi_ket'] = 1;
}



if ($mulaibelajar != "1") {
    $text.="Waktu mulai belajar salah atau tidak lengkap\n";
    $keterangan_studi['mulaibelajar_ket'] = 1;
}
if ($lamaijin != "1") {
    $text.="Lama ijin studi salah atau tidak sesuai\n";
    $keterangan_studi['lamaijin_ket'] = 1;
}
if ($periode_belajar_start != "1") {
    $text.="Periode awal studi salah atau tidak sesuai\n";
    $keterangan_studi['periode_belajar_start_ket'] = 1;
}
if ($periode_belajar_end != "1") {
    $text.="Periode akhir studi salah atau tidak sesuai\n";
    $keterangan_studi['periode_belajar_end_ket'] = 1;
}


$kondisi = $_POST['kondisi'];

$tgl_update = date("Y-m-d");

//$UTILITY->show_data($_POST);
//exit;
$keterangan_studi_json = json_encode($keterangan_studi);
//$UTILITY->show_data( $data );
$query_ijin = array("mahasiswa_idmahasiswa" => $mahasiswa_idmahasiswa);
$hasil_ijin = $IJIN->readIjin($query_ijin);
$keterangan_db = $hasil_ijin['keterangan'];
/*
  proses untuk memisahkan keterangan untuk 3 tab adalah dengan menggunakan
  delimter--> |
 */
$temp_keterangan = explode("|", $keterangan_db);
$keterangan_mahasiswa = trim($temp_keterangan[0]);
$keterangan_studi = trim($text);
$keterangan_dokumen = trim($temp_keterangan[2]);

$keterangan_full = "$keterangan_mahasiswa \n |\n $keterangan_studi \n|\n $keterangan_dokumen";
//$UTILITY->show_data( $keterangan_full );


if ($text != "") {
    $kunci = 0;
    $status = 6;
} else {
    $status = $hasil_ijin['status_idstatus'];
}
if ($kondisi == "keterangan") {
    $query = "update ijin set tgl_update='$tgl_update', status_idstatus='$status',
          keterangan='$keterangan_full',keterangan_studi='$keterangan_studi_json'
            where mahasiswa_idmahasiswa='$mahasiswa_idmahasiswa' ";
    //       echo $query;
    $DB->query($query);
    //exit;
    $DB->query("update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' ");
    $UTILITY->popup_message("Verifikasi Data Studi telah dilakukan");
}
$UTILITY->location_goto("content/permit/$kode/3");
?>
