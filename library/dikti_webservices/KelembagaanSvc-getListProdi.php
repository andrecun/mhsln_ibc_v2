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
$operation_name = 'getListProdi';
$kodePT = '031037';

$totalProdi = 0;

open_connection();

echo "INSERT INTO .prodi (idprodi, kodeUniversitas, namauniversitas, kodeWilayah, kodeProdi, "
. "namaProdi, namaJurusan, bidangRumpun, jenjang, alamat_jalan, nama_wilayah) VALUES "
        . "";

$query="select * from universitas";
$result=  mysql_query($query) or die(mysql_error());
$data=array();
while($row=  mysql_fetch_object($result)){
    
    $kodePT=$row->kodeUniversitas;
    $data[]=$kodePT;
}

foreach ($data as $key => $value) {
   $kodePT=$value;
    
// inisialisasi client
$client = new PDDIKTIClient($url, $username, $password);

    $param = '
            <p:getListProdi xmlns:p="http://dikti.go.id/pd/v1.0">
                    <!--Exactly 1 occurrence-->
                    <xs:kodePT xmlns:xs="http://dikti.go.id/pd/v1.0">'.$kodePT.'</xs:kodePT>
            </p:getListProdi>
    ';
    // Panggil web service-nya.
    $result_object = $client->call_operation($operation_name, $param);

    // apabila ada error, print error-nya.
    if (($result_object->getFault() != null) && ($result_object->getError() != null))
    {
            print_r($result_object->getFault());
            print_r($result_object->getError());
            exit();
    }
    else
    {
            $result = $result_object->getResult();

            if($result != null)
            {
                    // echo "<pre>";
                     //print_r($result);

                    // Apabila data program studi yang dikembalikan lebih dari 1 maka
                    // untuk mengakses datanya perlu menggunakan indeks.
                    if(isset($result["ProgramStudi"][0]))
                    {
                            $row_count = sizeof($result["ProgramStudi"]);
                            $totalProdi += $row_count;

                            //echo 'Jumlah program studi: '.$row_count.PHP_EOL;

                            for($i = 0; $i < $row_count; $i++)
                            {
                                    // Untuk mengakses elemen XML dapat langsung menggunakan nama tag XML-nya.
                                    $id = $result["ProgramStudi"][$i]["ID"];
                                    $kodeuniv=$result["ProgramStudi"][$i]["PerguruanTinggi"]["Kode"];
                                    $namauniv=  addslashes($result["ProgramStudi"][$i]["PerguruanTinggi"]["Nama"]);
                                    $kodeprodi= $result["ProgramStudi"][$i]["Kode"];
                                    $namaprodi = trim(addslashes($result["ProgramStudi"][$i]["Nama"]));
                                    $namajurusan = trim(addslashes($result["ProgramStudi"][$i]["Nama"]));
                                    $alamat_jalan=  trim(addslashes($result["ProgramStudi"][$i]["Jalan"]));
                                    $nama_wilayah=trim(addslashes($result["ProgramStudi"][$i]["KabKota"]["Nama"]));
                                    //echo $id.'. '.$kode.' '.$nama.PHP_EOL;
                                    echo "(NULL, \"$kodeuniv\", \"$namauniv\", \"0\", \"$kodeprodi\", \"$namaprodi\","
                                            . " \"$namajurusan\", \"-\", \"-\", \"$alamat_jalan\", \"$nama_wilayah\"),\n";
                            }
                            //echo PHP_EOL;
                    }
                    else
                    {
                            // Data yang dikembalikan hanya 1, maka tidak perlu menggunakan indeks untuk mengakses datanya.
                            $row_count = 1;
                            $totalProdi += $row_count;

    // Untuk mengakses elemen XML dapat langsung menggunakan nama tag XML-nya.
                                    $id = $result["ProgramStudi"]["ID"];
                                    $kodeuniv=$result["ProgramStudi"]["PerguruanTinggi"]["Kode"];
                                    $namauniv=  trim(addslashes($result["ProgramStudi"]["PerguruanTinggi"]["Nama"]));
                                    $kodeprodi= $result["ProgramStudi"]["Kode"];
                                    $namaprodi = trim(addslashes($result["ProgramStudi"]["Nama"]));
                                    $namajurusan = trim(addslashes($result["ProgramStudi"]["Nama"]));
                                    $alamat_jalan=  trim(addslashes($result["ProgramStudi"]["Jalan"]));
                                    $nama_wilayah=trim(addslashes($result["ProgramStudi"]["KabKota"]["Nama"]));
                                    //echo $id.'. '.$kode.' '.$nama.PHP_EOL;
                                    echo "(NULL, \"$kodeuniv\", \"$namauniv\", \"0\", \"$kodeprodi\", \"$namaprodi\","
                                            . " \"$namajurusan\", \"-\", \"-\", \"$alamat_jalan\", \"$nama_wilayah\"),\n";

                    }
            }
    }
    unset($client);

}


echo ";";
//echo 'Total Jumlah Program Studi: '.$totalProdi.PHP_EOL;


function open_connection(){ 
 $db_host="localhost"; 
 $db_user="root";
 $db_pass="new-password";
 $link=mysql_connect($db_host,$db_user,$db_pass)  
 or die ("Koneksi Database gagal"); 
 mysql_select_db("dikti_final");
 return $link; 
}
?>