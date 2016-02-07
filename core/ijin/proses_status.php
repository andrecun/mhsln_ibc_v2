<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify( $_POST[username] );

$kondisi = $_POST['kondisi'];
$kode = $_POST['kode'];
$idijin = $_POST['idijin'];
$status=$_POST["status"];
$qry = $DB->query( "select idstatus,namastatus from status where idstatus='$status'" );
while ( $row = $DB->fetch_object( $qry ) ) {
	$idstatus = $row->idstatus;
	$namastatus = $row->namastatus;
}

$kunci=$_POST["kunci"];
$kunciEkstension=$_POST["kunciEkstension"];
$tgl_update=date( "Y-m-d" );

//$UTILITY->show_data( $_POST );

$mulaiperiode= $UTILITY->format_tanggal_db( $_POST['mulaiperiode'] );
$batasperiode=$UTILITY->format_tanggal_db( $_POST['batasperiode'] );

$mahasiswa_idmahasiswa=$_POST["mahasiswa_idmahasiswa"];
$keterangan =  addslashes( $_POST['keterangan'] );

//echo  "update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' " ;
//exit;
//$alamat=$_SESSION['email'];
//$UTILITY-> mail("Confirmasi Verifikasi Mahasiswa $mahasiswa_idmahasiswa [$namastatus]",$keterangan,$alamat);

if ( $kondisi == "verification" ) {
	$DB->query( "update ijin set tgl_update='$tgl_update',mulaiperiode='$mulaiperiode',batasperiode='$batasperiode', status_idstatus='$status',keterangan='$keterangan' where mahasiswa_idmahasiswa='$mahasiswa_idmahasiswa' " );
	$DB->query( "update mahasiswa set kunci='$kunci' where idmahasiswa='$mahasiswa_idmahasiswa' " );
	$UTILITY->popup_message( "Data mahasiswa telah diverifikasi" );
}
$UTILITY->location_goto( "content/permit/$kode" );

?>
