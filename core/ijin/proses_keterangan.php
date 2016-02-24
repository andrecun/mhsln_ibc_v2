<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify( $_POST[username] );

$nmrpaspor = $purifier->purify( $_POST["nmrpaspor_ket"] );
$mulaipassport = $_POST["mulaipassport_ket"];
$akhirpassport = $_POST["akhirpassport_ket"];
$passport1=$purifier->purify( $_POST["passport1_ket"] );
$pembiayaan_idpembiayaan = $purifier->purify( $_POST["pembiayaan_idpembiayaan_ket"] );
$sumber_pembiayaan = $purifier->purify( $_POST["sumber_pembiayaan_ket"] );
$keuangan=$purifier->purify( $_POST["keuangan_ket"] );
$pernyataan1=$purifier->purify( $_POST["pernyataan1_ket"] );
$kesehatan=$purifier->purify( $_POST["kesehatan_ket"] );
$loa=$purifier->purify( $_POST["loa_ket"] );

$no_kitas=$purifier->purify( $_POST['no_kitas_ket'] );
$jml_kitas=$purifier->purify( $_POST['jml_kitas_ket'] );

$kitas=$purifier->purify( $_POST["kitas_ket"] );
$tgl_kitas_awal_ket=$purifier->purify( $_POST["tgl_kitas_awal_ket"] );
$tgl_kitas_akhir_ket=$purifier->purify( $_POST["tgl_kitas_akhir_ket"] );
$ijazah_ket=$purifier->purify( $_POST["ijazah_ket"] );
$no_skld_ket=$purifier->purify( $_POST["no_skld_ket"] );
$skld_ket=$purifier->purify( $_POST["skld_ket"] );
$tgl_skld_ket=$purifier->purify( $_POST["tgl_skld_ket"] );

$dok_mou=$purifier->purify( $_POST['dok_mou_ket'] );


$mahasiswa_idmahasiswa=$_POST['mahasiswa_idmahasiswa'];
$kondisi =$_POST['kondisi'];
$keterangan='';
$keterangan_field=array();
$tgl_update=date( "Y-m-d" );
$ekstension=$_POST["ekstension"];
//$UTILITY->show_data($_POST);
//     exit;
if ( $nmrpaspor !="1" ) {
  $keterangan="Nomor Passport tidak lengkap atau salah\n";
  $keterangan_field["nmrpaspor_ket"]=1;
}
if ( $mulaipassport !="1" ) {
  $keterangan.="Tanggal Penetapan tidak lengkap atau salah\n";
  $keterangan_field["mulaipasport_ket"]=1;
}
if ( $akhirpassport!="1" ) {
  $keterangan.="Tanggal berakhir tidak lengkap atau salah\n";
  $keterangan_field["akhirpassport_ket"]=1;
}
if ( $passport1!="1" ) {
  $keterangan.="Scan passport  tidak lengkap atau salah\n";
  $keterangan_field["passport1_ket"]=1;
}
if ( $pembiayaan_idpembiayaan!="1" ) {
  $keterangan.="Pendanaan tidak lengkap atau salah\n";
  $keterangan_field["pembiayaan_idpembiayaan_ket"]=1;
}if ( $sumber_pembiayaan!="1" ) {
  $keterangan.="Penyedia Beasiswa tidak lengkap atau salah\n";
  $keterangan_field["sumber_pembiayaan_ket"]=1;
}
if ( $keuangan!="1" ) {
  $keterangan.="Surat Keuangan tidak lengkap atau salah\n";
  $keterangan_field["keuangan_ket"]=1;
}if ( $pernyataan1!="1" ) {
  $keterangan.="Surat pernyataan tidak lengkap atau salah\n";
  $keterangan_field["pernyataan1_ket"]=1;
}if ( $kesehatan!="1" ) {
  $keterangan.="Surat Kesehatan tidak lengkap atau salah\n";
  $keterangan_field["kesehatan_ket"]=1;
}
if ( $loa!="1" ) {
  $keterangan.="LOA tidak lengkap atau salah\n";
  $keterangan_field["loa_ket"]=1;
}

if ( $dok_mou!="1" ) {
  $keterangan.="Dok mou tidak ada atau salah\n";
  $keterangan_field["dok_mou_ket"]=1;
}

if ( $ekstension==1 ) {
  /*$no_kitas=$purifier->purify($_POST['no_kitas_ket']);
  $kitas=$purifier->purify($_POST["kitas_ket"]);
 $tgl_kitas_awal_ket=$purifier->purify($_POST["tgl_kitas_awal_ket"]);
 $tgl_kitas_akhir_ket=$purifier->purify($_POST["tgl_kitas_akhir_ket"]);
 $ijazah_ket=$purifier->purify($_POST["ijazah_ket"]);
 $no_skld_ket=$purifier->purify($_POST["no_skld_ket"]);
 $skld_ket=$purifier->purify($_POST["skld_ket"]);
  $tgl_skld_ket=$purifier->purify($_POST["tgl_skld_ket"]);*/

  if ( $no_kitas!="1" ) {
    $keterangan.="No Kitas tidak lengkap atau salah\n";
    $keterangan_field["no_kitas_ket"]=1;
  }
  if ( $jml_kitas!="1" ) {
    $keterangan.="Jumlah kitas  salah\n";
    $keterangan_field["jml_kitas_ket"]=1;
  }
  if ( $kitas!="1" ) {
    $keterangan.="Kitas tidak lengkap atau salah\n";
    $keterangan_field["kitas_ket"]=1;
  }

  if ( $tgl_kitas_awal_ket!="1" ) {
    $keterangan.="TGL Kitas Berlaku tidak lengkap atau salah\n";
    $keterangan_field["tgl_kitas_awal_ket"]=1;
  }
  if ( $tgl_kitas_akhir_ket!="1" ) {
    $keterangan.="TGL Kitas Akhir tidak lengkap atau salah\n";
    $keterangan_field["tgl_kitas_akhir_ket"]=1;
  }
  if ( $ijazah_ket!="1" ) {
    $keterangan.="Ijazah tidak lengkap atau salah\n";
    $keterangan_field["ijazah_ket"]=1;
  }
  if ( $no_skld_ket!="1" ) {
    $keterangan.="NO SKLD tidak lengkap atau salah\n";
    $keterangan_field["no_skld_ket"]=1;
  }

  if ( $skld_ket!="1" ) {
    $keterangan.="SKLD/SKJ/STM tidak lengkap atau salah\n";
    $keterangan_field["skld_ket"]=1;
  }
  if ( $tgl_skld_ket!="1" ) {
    $keterangan.="TGL skld/skj/stm  tidak lengkap atau salah\n";
    $keterangan_field["tgl_skld_ket"]=1;
  }
}
$keterangan_field=  json_encode( $keterangan_field );
/*$UTILITY->show_data($_POST);
$UTILITY->show_data($keterangan);
 $UTILITY->show_data($keterangan_field);
exit;*/

$kode=$purifier->purify( $_POST["kode"] );


$kunci=$_POST["kunci"];
$kunciEkstension=$_POST["kunciEkstension"];

$query_ijin=array( "mahasiswa_idmahasiswa"=>$mahasiswa_idmahasiswa );
$hasil_ijin=$IJIN->readIjin( $query_ijin );
if ( $keterangan!="" ) {
  $kunci=0;
  $status=6;
}else{
  $status=$hasil_ijin['status_idstatus'];
}

$query_ijin=array("mahasiswa_idmahasiswa"=>$mahasiswa_idmahasiswa);
$hasil_ijin=$IJIN->readIjin($query_ijin);
$keterangan_db=$hasil_ijin['keterangan'];
/*
proses untuk memisahkan keterangan untuk 3 tab adalah dengan menggunakan
delimter--> |
 */
$temp_keterangan=explode("|",$keterangan_db);
$keterangan_mahasiswa=trim($temp_keterangan[0]);
$keterangan_studi=trim($temp_keterangan[1]);
$keterangan_dokumen=trim($keterangan);

$keterangan_full="$keterangan_mahasiswa \n |\n $keterangan_studi \n|\n $keterangan_dokumen";

if ( $kondisi == "keterangan" ) {

  $DB->query( "update ijin set tgl_update='$tgl_update', status_idstatus='$status', keterangan='$keterangan_full',keterangan_field='$keterangan_field' where mahasiswa_idmahasiswa='$mahasiswa_idmahasiswa' " );
  //  echo "update ijin set tgl_update='$tgl_update', status_idstatus='$status', keterangan='$keterangan',keterangan_field='$keterangan_field' where mahasiswa_idmahasiswa='$mahasiswa_idmahasiswa' ";
  // exit;
 // echo "update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' ";
  $DB->query( "update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' " );
  $UTILITY->popup_message( "Information has been added" );
}
$UTILITY->location_goto( "content/permit/$kode/4" );

?>
