<?php

ob_start();
ob_clean();
include '../config/application.php';
$id = $_SESSION['user_id']; //Nanti diganti

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array('M.namamahasiswa', 'M.universitas_iduniversitas', 'I.status_idstatus', 'M.ekstension', 'M.tgl_update', 'M.alamat',);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "kode";

/* DB table to use */
$sTable = "mahasiswa as M";



//$document=$_GET["document"];
$sWhere = "";

$level = $_SESSION["level$ID"];
$universitas_session = trim($_SESSION['unversitas']);
$username_session = $_SESSION["user_name$ID"];
if ($level == 1||$level == 4) {
     $sWhere = "";
} else if ($level == 2) {
     $sWhere = "Where U.kodeUniversitas='$universitas_session' ";
} else if ($level == 3) {
     $sWhere = "Where idmahasiswa='$username_session' ";
}

if ($status != "") {
     $sWhere = "Where idstatus ='$status' ";
}
if ($universitas != "") {
     if ($sWhere != "")
          $sWhere.=" and U.kodeUniversitas='$universitas' ";
     else
          $sWhere = "Where U.kodeUniversitas= '$universitas' ";
}

if ($keyword != "") {
     if ($sWhere != "")
          $sWhere.=" and namamahasiswa like '%$keyword%' ";
     else
          $sWhere = "Where namamahasiswa like '%$keyword%' ";
}

if ($major != "") {
     if ($sWhere != "")
          $sWhere.=" and idjurusan='$major' ";
     else
          $sWhere = "Where idjurusan = '$universitas' ";
}

if ($faculty != "") {
     if ($sWhere != "")
          $sWhere.=" and idfakultas='$faculty' ";
     else
          $sWhere = "Where idfakultas= '$faculty' ";
}

if ($periode_belajar_start != "") {
     if ($sWhere != "")
          $sWhere.=" and I.tgl_update >= '$periode_belajar_start' ";
     else
          $sWhere = "Where I.tgl_update >= '$periode_belajar_start' ";
}

if ($periode_belajar_end != "") {
     if ($sWhere != "")
          $sWhere.=" and I.tgl_update <= '$periode_belajar_end' ";
     else
          $sWhere = "Where I.tgl_update <= '$periode_belajar_end' ";
}
/*
  if($document!=""){
  if($sWhere!="")
  $sWhere.=" and ekstension='$document' ";
  else
  $sWhere="Where ekstension= '$document' ";
  } */
/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
             intval($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
     $sOrder = "ORDER BY  ";
     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
               //$sOrder .= "'" . $aColumns[intval($_GET['iSortCol_' . $i])] . "' " .
               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     $sWhere = "WHERE (";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE ";
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}


/*
 * SQL queries
 * Get data to display
 */
/*
  $sQuery ="select SQL_CALC_FOUND_ROWS M.namamahasiswa as namamahasiswa,
  M.namamahasiswa2 as namamahasiswa,
  U.namauniversitas as namauniversitas,
  I.status_idstatus as status_idstatus,
  M.alamat as alamat , M.kode as kode
  from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
  left join universitas U on U.iduniversitas=M.universitas_iduniversitas
  $sWhere
  $sOrder
  $sLimit
  " ; */
$sQuery = "select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,M.tgl_update as tgl_ubah,M.jml_kitas as jml_kitas,
    M.penyelenggara_program  as penyelenggara_program,
     U.namaUniversitas as namaPT, F.namaProdi as nProdi,N.namanegara as namanegara,M.email as EM 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
                 left join nationality N on N.idnationality=M.nationality_idnationality
               left join prodi F on F.kodeProdi=M.prodi_idprodi and F.kodeUniversitas=M.universitas_iduniversitas
                $sWhere
	$sOrder
	$sLimit";
//echo $sQuery;
//exit;
$rResult = $DB->query($sQuery);

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DB->query($sQuery);
$aResultFilterTotal = $DB->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
$rResultTotal = $DB->query($sQuery);
$aResultTotal = $DB->fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
//echo "<pre>";
$sExportFile = "Rekapitulasi Ijin Belajar.xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=' . $sExportFile . '.xls');
echo "<html><head></head><body><table border=1  width='2000px'>"
 . "
     <thead>
   <tr><th colspan='24'>Rekapitulasi Ijin Belajar</th></tr>
        <thead>
                     <th  width=\"10px\">No</th>
                      <th width=\"200px\">Nama</th>
                       <th width=\"200px\">Jenis Kelamin</th>
                      <th width=\"300px\">Tempat , Tgl Lahir</th>
                       <th width=\"100px\">Negara</th>
                      <th width=\"300px\">Alamat Asal</th>
                      <th width=\"300px\">Alamat di Indonesia</th>
                      <th width=\"200px\">Institusi</th>
                      <th width=\"200px\">Prodi / Penyelenggara Program</th>
                        <th width=\"200px\">Program/Jenjang Studi</th>
                      <th width=\"100px\">Jenis Ijin (Baru/ Perpanjang)</th>
                      <th width=\"200px\">Lama Ijin</th> 
                     
                      <th width=\"100px\">Tlg Awal Belajar</th>
                      <th width=\"100px\">Pengajuan Ijin Awal</th>
                      <th width=\"200px\">Pengajuan Akhir</th>
                      <th width=\"200px\">No Passport</th>
                      <th width=\"200px\">Tgl Berlaku Passport</th>
                      <th width=\"200px\">Tgl Berakhir Passport</th>
                      <th width=\"200px\">Jenis Pendanaan</th>
                     
                       <th width=\"200px\">No Kitas</th> 
                       <th width=\"200px\">Tgl Awal Kitas</th> 
                       <th width=\"200px\">Tgl Akhir Kitas</th> 
                       <th width=\"200px\">No SKLD</th> 
                       <th width=\"200px\">Tgl Pengajuan Ijin</th> 
                        
                      </tr>
                  </thead>
                  <tbody>
                  ";
$no = 0;
while ($data = $DB->fetch_array($rResult)) {
     $no++;
     $row = array();
     //print_r($aRow);namauniversitas
     $namamahasiswa = $data["namamahasiswa"];
     $sex=$data["sex"];
     if($sex==1){
         $jl="Pria";
     }else
         $jl="Wania";
     $namamahasiswa2 = ucwords($data["namamahasiswa2"]);
     $tempatlahir = ucwords($data["tempatlahir"]);
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
     //mode 2
     $universitas_iduniversitas = $data["universitas_iduniversitas"];
     $fakultas_idfakultas = $data["nProdi"];
     $jurusan_idjurusan = $data["jurusan_idjurusan"];
     $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
     $qWhere = array("idjenjangstudi" => $jenjangstudi_idjenjangstudi );     
     $data_jenjang = $JENJANG_STUDI->readJenjangStudi($qWhere);
     $namajenjangstudi=$data_jenjang['namajenjangstudi']; 
     
     
     
     
     $mulaibelajar = $UTILITY->format_tanggal($data["mulaibelajar"]);
     $periode_belajar_start = $UTILITY->format_tanggal($data["periode_belajar_awal"]);
     $periode_belajar_end = $UTILITY->format_tanggal($data["periode_belajar_akhir"]);
     $lamaijin = $data["LamaIjin"];
     //mode 3
     $nmrpaspor = $data["nmrpaspor"];
     $mulaipassport = $UTILITY->format_tanggal($data["mulaipassport"]);
     $akhirpassport = $UTILITY->format_tanggal($data["akhirpassport"]);
     $passport1 = $data["passport1"];
     $pembiayaan_idpembiayaan = $data["pembiayaan_idpembiayaan"];
      $qry = $DB->query("select idpembiayaan,jenispembiayaan from pembiayaan where idpembiayaan='$pembiayaan_idpembiayaan' ");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $idpembiayaan = $row->idpembiayaan;
                                                                      $jenispembiayaan = $row->jenispembiayaan;
                                                                 }
     $sumber_pembiayaan = $data["sumber_pembiayaan"];
     $keuangan = $data["keuangan"];
     $pernyataan1 = $data["pernyataan1"];
     $kesehatan = $data["kesehatan"];
     $loa = $data["loa"];
     $kitas = $data["kitas"];
     $skld = $data["skld"];
     $tgl_kitas = $UTILITY->format_tanggal($data["tglkitas"]);
     $tgl_skld = $UTILITY->format_tanggal($data["tglkitas"]);
     $tanggal = str_replace("-", "", $data["tanggallahir"]);
$universitas=$data['namauniversitas'];
     $ekstension = $data["ekstension"];
     $login_mahasiswa = $tanggal . "-" . $universitas_iduniversitas . "" . $fakultas_idfakultas . "" . $jurusan_idjurusan . "" . $jenjangstudi_idjenjangstudi . "" . $id;
     $idmhs = $data["idmahasiswa"];

     $status_ijin = $data['status_idstatus'];
     $keterangan = $data['keterangan'];
     $statusStudyEkstension = $data['statusStudyEkstension'];
     $idijin = $data['idijin'];

     $no_kitas= $data['no_kitas'];
     $no_skld= $data['no_skld'];
     $tgl_kitas_akhir= $UTILITY->format_tanggal($data['tgl_kitas_akhir']);
     $id = $aRow['kode'];
     
     $jml_kitas= $data['jml_kitas'];
     $penyelenggara_program= $data['penyelenggara_program'];
     
     $status_doc = $data["ekstension"];
     if($status_doc==0)
          $status_doc="Baru";
     else $status_doc="Perpanjang ke - $jml_kitas";
     $tgl_update=$UTILITY->format_tanggal($data["tgl_ubah"]);
     $lamaijin = $data["LamaIjin"];

     echo " <tr>
                    <td>$no</td>  
                    <td>$namamahasiswa $namamahasiswa2</td>
                        <td>$jl</td>
                         <td>$tempatlahir / $tanggallahir</td>
                               <td>$country</td>
                               <td>$alamat</td>
                                     <td>$alamatind</td>
                      <td>$universitas</td>
                           <td>$fakultas_idfakultas - $penyelenggara_program</td>
                               <td>$namajenjangstudi</td>
                      <td>$status_doc</td>
                       <td>$lamaijin</td>
                     
                       
<td>$mulaibelajar</td>
                      <td>$periode_belajar_start</td>
                      <td>$periode_belajar_end</td>
                      <td>$nmrpaspor</td>
                      <td>$mulaipassport</td>
                      <td>$akhirpassport</td>
                       <td>$jenispembiayaan - $sumber_pembiayaan</td>
                       <td>$no_kitas</td> 
                       <td>$tgl_kitas</td> 
                       <td>$tgl_kitas_akhir</td> 
                       <td>$no_skld</td>  
                                             <td>$tgl_update</td>
                    
                      </tr>";
}

echo "</tbody></table></body></html>";
?>

