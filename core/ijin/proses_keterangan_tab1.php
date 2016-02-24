<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify( $_POST[username] );
$kode=$purifier->purify( $_POST["kode"] );
$kondisi=$purifier->purify( $_POST["kondisi"] );
$mahasiswa_idmahasiswa=$purifier->purify( $_POST["mahasiswa_idmahasiswa"] );
$namamahasiswa = $purifier->purify( $_POST["namamahasiswa_ket"] );
$namamahasiswa2 = $purifier->purify( $_POST["namamahasiswa2_ket"] );
$tempatlahir = $purifier->purify( $_POST["tempatlahir_ket"] );
$tanggallahir = $_POST["tanggallahir_ket"];
$sex = $purifier->purify( $_POST["sex_ket"] );
$nationality_idnationality = $purifier->purify( $_POST["nationality_idnationality_ket"] );
$alamat = $purifier->purify( $_POST["alamat_ket"] );
$city = $purifier->purify( $_POST["city_ket"] );
$province = $purifier->purify( $_POST["province_ket"] );
$country = $purifier->purify( $_POST["country_ket"] );
$postal = $purifier->purify( $_POST["postal_ket"] );
$alamatind = $purifier->purify( $_POST["alamatind_ket"] );
$cityind = $purifier->purify( $_POST["cityind_ket"] );
$provinceid = $purifier->purify( $_POST["provinceid_ket"] );
$postalind = $purifier->purify( $_POST["postalind_ket"] );
$telp2 = $purifier->purify( $_POST["telp2_ket"] );
$foto = $purifier->purify( $_POST["foto_ket"] );

$kondisi =$_POST['kondisi'];
$text='';
$tgl_update=date( "Y-m-d" );
$keterangan_mahasiswa=array();
if ( $namamahasiswa!="1" ) {
  $text.="Nama Depan tidak lengkap atau salah\n";
  $keterangan_mahasiswa['namamahasiswa_ket']=1;
}
if ( $namamahasiswa2!="1" ) {
  $text.="Nama Belakang tidak lengkap atau salah\n";
  $keterangan_mahasiswa['namamahasiswa2_ket']=1;
}
if ( $tanggallahir!="1" ) {
  $text.="Tempat / Tanggal lahir tidak lengkap atau salah\n";
  $keterangan_mahasiswa['tanggallahir_ket']=1;
}
if ( $sex!="1" ) {
  $text.="Jenis Kelamin salah\n";
  $keterangan_mahasiswa['sex_ket']=1;
}
if ( $nationality_idnationality!="1" ) {
  $text.="Kebangsaan tidak lengkap atau salah\n";
  $keterangan_mahasiswa['nationality_idnationality_ket']=1;
}
if ( $alamat!="1" ) {
  $text.="Alamat tidak lengkap atau salah\n";
  $keterangan_mahasiswa['alamat_ket']=1;
}
if ( $alamat!="1" ) {
  $text.="Alamat tidak lengkap atau salah\n";
  $keterangan_mahasiswa['alamat_ket']=1;
}
if ( $city!="1" ) {
  $text.="Kota  tidak lengkap atau salah\n";
  $keterangan_mahasiswa['city_ket']=1;
}
if ( $province!="1" ) {
  $text.="Alamat tidak lengkap atau salah\n";
  $keterangan_mahasiswa['province_ket']=1;
}
if ( $country!="1" ) {
  $text.="Negara tidak lengkap atau salah\n";
  $keterangan_mahasiswa['country_ket']=1;
}
if ( $postal!="1" ) {
  $text.="Kode Post tidak lengkap atau salah\n";
  $keterangan_mahasiswa['postal_ket']=1;
}
if ( $alamatind!="1" ) {
  $text.="Alamat di Indonesia salah atau tidak ada\n";
  $keterangan_mahasiswa['alamatind_ket']=1;
}
if ( $cityind!="1" ) {
  $text.="Alamat kota di Indonesia tidak lengkap atau salah\n";
  $keterangan_mahasiswa['cityind_ket']=1;
}
if ( $provinceid!="1" ) {
  $text.="Alama Profinsi  tidak lengkap atau salah\n";
  $keterangan_mahasiswa['provinceid_ket']=1;
}
if ( $postalind!="1" ) {
  $text.="Kode Post di Indonesia tidak lengkap atau salah\n";
  $keterangan_mahasiswa['postalind_ket']=1;
}
if ( $telp2!="1" ) {
  $text.="Nomor Telepon/HP  tidak lengkap atau salah\n";
  $keterangan_mahasiswa['telp2_ket']=1;
}
if ( $foto!="1" ) {
  $text.="Foto tidak sesuai\n";
  $keterangan_mahasiswa['foto_ket']=1;
}


//$UTILITY->show_data($_POST);
//exit;
$keterangan_mahasiswa_json=json_encode( $keterangan_mahasiswa );
//$UTILITY->show_data( $data );
$query_ijin=array("mahasiswa_idmahasiswa"=>$mahasiswa_idmahasiswa);
$hasil_ijin=$IJIN->readIjin($query_ijin);
$keterangan_db=$hasil_ijin['keterangan'];
/*
proses untuk memisahkan keterangan untuk 3 tab adalah dengan menggunakan
delimter--> |
 */
$temp_keterangan=explode("|",$keterangan_db);
$keterangan_mahasiswa=trim($text);
$keterangan_studi=trim($temp_keterangan[1]);
$keterangan_dokumen=trim($temp_keterangan[2]);


$keterangan_full="$keterangan_mahasiswa \n |\n $keterangan_studi \n|\n $keterangan_dokumen";
//$UTILITY->show_data( $keterangan_full );

$query_ijin=array( "mahasiswa_idmahasiswa"=>$mahasiswa_idmahasiswa );
$hasil_ijin=$IJIN->readIjin( $query_ijin );

if ( $text!="" ) {
  $kunci=0;
  $status=6;
}else{
  $status=$hasil_ijin['status_idstatus'];
}

if ( $kondisi == "keterangan" ) {
  $query="update ijin set tgl_update='$tgl_update', status_idstatus='$status', 
          keterangan='$keterangan_full',keterangan_datadiri='$keterangan_mahasiswa_json' 
            where mahasiswa_idmahasiswa='$mahasiswa_idmahasiswa' ";
   //       echo $query;
  $DB->query( $query );
 //exit;
  $DB->query( "update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' " );
  $UTILITY->popup_message( "Verifikasi data diri (cv) telah dilakukan" );
}
$UTILITY->location_goto( "content/permit/$kode/2" );


?>
