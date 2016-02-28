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
$operation_name = 'getListPT2';

$isRemainingPage = true;
$page = 0;

$totalPT = 0;
       echo "INSERT INTO universitas (iduniversitas, kodeUniversitas,namauniversitas, kodeWilayah) VALUES";
	
while($isRemainingPage)
{
	// inisialisasi client
	$client = new PDDIKTIClient($url, $username, $password);

	//echo "Processing page: $page".PHP_EOL;
	$param = '
	<p:getListPT2 xmlns:p="http://dikti.go.id/pd/v1.0">
    	<xs:page xmlns:xs="http://dikti.go.id/pd/v1.0">'.$page.'</xs:page>
   	</p:getListPT2>
	';

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

		if($result != null)
		{
                    //echo "<pre>";
                    //print_r($result);
                    //exit();
			// Apabila data perguruan tinggi yang dikembalikan lebih dari 1 maka
			// untuk mengakses datanya perlu menggunakan indeks.
			if(isset($result["PerguruanTinggi"][0]))
			{
				$row_count = sizeof($result["PerguruanTinggi"]);
				$totalPT += $row_count;

				//echo 'Jumlah perguruan tinggi: '.$row_count.PHP_EOL;

				for($i = 0; $i < $row_count; $i++)
				{
                                    
                                    
					// Untuk mengakses elemen XML dapat langsung menggunakan nama tag XML-nya.
					$id = $result["PerguruanTinggi"][$i]["ID"];
					$kode = $result["PerguruanTinggi"][$i]["Kode"];
					$nama = addslashes($result["PerguruanTinggi"][$i]["Nama"]);
                                        
					$index = $page * 100 + $i + 1;
					$data = $index.'. '.$id.' - '.$kode.' - '.$nama.PHP_EOL;
					//echo $index.'. '.$kode.' '.$nama.PHP_EOL;
                                 echo " (NULL, \"{$result["PerguruanTinggi"][$i]["Kode"]}\", \"{$nama}\", NULL), \n";
				}
				echo PHP_EOL;
			}
			else
			{
				// Data yang dikembalikan hanya 1, maka tidak perlu menggunakan indeks untuk mengakses datanya.
				$row_count = 1;
				$totalPT += $row_count;

				echo 'Jumlah perguruan tinggi: '.$row_count.PHP_EOL;

				$id = $result["PerguruanTinggi"]["ID"];
				$kode = $result["PerguruanTinggi"]["Kode"];
				$nama = $result["PerguruanTinggi"]["Nama"];
				$index = $page * 100 + $i + 1;
				$data = $index.'. '.$id.' - '.$kode.' - '.$nama.PHP_EOL;
				echo $index.'. '.$kode.' '.$nama.PHP_EOL.PHP_EOL;

				$isRemainingPage = false;
			}
		}
		else
		{
			$isRemainingPage = false;
		}

		$page++;
	}

	unset($client);	
}

echo ";\n";
echo 'Total Jumlah Perguruan Tinggi: '.$totalPT.PHP_EOL;

?>