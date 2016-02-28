<?php

/*
Catatan:
- Disarankan untuk mengeksekusi script ini dengan menggunakan CLI.
- Pada file class.nusoap_base.php ubah nilai $GLOBALS['_transient']['static']['nusoap_base']['globalDebugLevel'] dari 9 menjadi 0.
- Gunakan ini_set('memory_limit', '128M') atau nilai yang lain untuk meningkatkan cache memory.
- set default timezone menjadi 'Asia/Jakarta'

*/

// Library untuk mengakses Web Service PDDIKTI
require_once('lib/PDDIKTIClient.php');

ini_set('max_execution_time', 600);
ini_set('memory_limit', '512M');
date_default_timezone_set('Asia/Jakarta');

$url = 'http://118.98.235.161:8280/services/services/t/pd.dikti.go.id/KelembagaanSvc?wsdl';
$username = 'izinbelajar';
$password = 'izinbelajarGSmR8x';

// nama operasi web service yang akan dipanggil
$operation_name = 'getPT';

$kodePT = '031037';
// inisialisasi client

$param = '
   <p:getPT xmlns:p="http://dikti.go.id/pd/v1.0">
      <!--Exactly 1 occurrence-->
      <xs:kodePT xmlns:xs="http://dikti.go.id/pd/v1.0">.'.$kodePT.'.</xs:kodePT>
   </p:getPT>
';

// Inisialisasi objek PDDIKTIClient
$client = new PDDIKTIClient($url, $username, $password);

// Panggil web service-nya.
$result_object = $client->call_operation($operation_name, $param);


// apabila ada error, print error-nya.
if (($result_object->getFault() != null) && ($result_object->getError() != null))
{
	echo $result_object->getFault();
	echo $result_object->getError();
	exit();
}
else
{
	$result = $result_object->getResult();

	if(!empty($result))
	{
		print_r($result);

		echo '<br/><br/>';
		
		echo 'Kode Perguruan Tinggi: '.$result["PerguruanTinggi"]["Kode"].'<br/>';
		echo 'Nama Perguruan Tinggi: '.$result["PerguruanTinggi"]["Nama"].'<br/>';
		echo 'Nama Singkat: '.$result["PerguruanTinggi"]["NamaSingkat"].'<br/>';
		echo 'Jalan: '.$result["PerguruanTinggi"]["Nama"].'<br/>';
		echo 'Kota: '.$result["PerguruanTinggi"]["KabKota"]["Nama"].'<br/>';
		echo 'Kode Pos: '.$result["PerguruanTinggi"]["KodePos"].'<br/>';
		echo 'Website: '.$result["PerguruanTinggi"]["Website"].'<br/>';
		echo 'Status Kepemilikan: '.$result["PerguruanTinggi"]["StatusKepemilikan"]["Nama"].'<br/>';
		echo 'Bentuk Pendidikan: '.$result["PerguruanTinggi"]["BentukPendidikan"]["Nama"].'<br/>';
		echo 'Pembina: '.$result["PerguruanTinggi"]["Pembina"]["Nama"].'<br/>';
	}

	else if (empty($result))
	{
		echo "Tidak ada data yang ditemukan. <br>";
	}
	
}

?>