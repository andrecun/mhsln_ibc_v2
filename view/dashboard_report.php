<?php

ob_start();
ob_clean();
include '../config/application.php';
require "library/spout/src/Spout/Autoloader/autoload.php";

$id = $_SESSION['user_id']; //Nanti diganti

/**
 * OPent tbs template engine
 */
include_once('library/opentbs/tbs_class.php'); // Load the TinyButStrong template engine
include_once('library/opentbs/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
$template = 'template/spout-template-final.xlsx';
$tgl_update=date("Y-m-d");
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
$newFilePath = "berkas/$tgl_update-rekapitulasi-ijin-belajar.xlsx";
/* SPOUT 
*/
/*use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

$tgl_update=date("Y-m-d");
$existingFilePath = 'template/spout-template-final.xlsx';
$newFilePath = "berkas/$tgl_update-rekapitulasi-ijin-belajar.xlsx";

// we need a reader to read the existing file...
$reader = ReaderFactory::create(Type::XLSX);
$reader->open($existingFilePath);
$reader->setShouldFormatDates(true); // this is to be able to copy dates

// ... and a writer to create the new file
$writer = WriterFactory::create(Type::XLSX);
//$writer->setColumnsWidth(50);
$writer->openToFile($newFilePath);

// let's read the entire spreadsheet...
foreach ($reader->getSheetIterator() as $sheetIndex => $sheet) {
    // Add sheets in the new file, as we read new sheets in the existing one
    if ($sheetIndex !== 1) {
        $writer->addNewSheetAndMakeItCurrent();
    }

    foreach ($sheet->getRowIterator() as $row) {
        // ... and copy each row into the new spreadsheet
        $writer->addRow($row);
    }
}
*/

/**
 * Akhir Spout
 */
/*
 * EXCEL
 */
//$objReader = PHPExcel_IOFactory::createReader( 'Excel5' );
//$objPHPExcel = $objReader->load( "template/template-final.xls" );
//$baseRow = 4;

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
     $sWhere = "Where S.idstatus ='$status' ";
}
if ($universitas != "") {
     if ($sWhere != "")
          $sWhere.=" and U.kodeUniversitas='$universitas' ";
     else
          $sWhere = "Where U.kodeUniversitas= '$universitas' ";
}

if ($country != "") {
    if ($sWhere != "")
        $sWhere.=" and M.country='$country' ";
    else
        $sWhere = "Where M.country= '$country   ' ";
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
$sQuery = "select SQL_CALC_FOUND_ROWS M.*,I.*,S.*,M.tgl_update as tgl_ubah,M.jml_kitas as jml_kitas,
    M.penyelenggara_program  as penyelenggara_program,
      F.namaProdi as nProdi,N.namanegara as namanegara,M.email as EM 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join status S on S.idstatus=I.status_idstatus 
                 left join nationality N on N.idnationality=M.nationality_idnationality
               left join prodi F on F.kodeProdi=M.prodi_idprodi and F.kodeUniversitas=M.universitas_iduniversitas
                $sWhere
	$sOrder
	$sLimit";
//echo $sQuery;
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
/*
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
                  ";*/
                 
$no = 0;
$data_opentbs=array();
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
     //$country = $data["country"];
     $country=$data["namanegara"];
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
     $qry_univ = $DB->query("select kodeUniversitas,namauniversitas from universitas 
                    where kodeUniversitas='$universitas_iduniversitas'");
     $universitas ="";
     while ($row_univ = $DB->fetch_array($qry_univ)) {
        $universitas = $row_univ["namauniversitas"];
     }
     $fakultas_idfakultas = $data["nProdi"];
     $jurusan_idjurusan = $data["jurusan_idjurusan"];
     $jenjangstudi_idjenjangstudi = $data["jenjangstudi_idjenjangstudi"];
     $qWhere = array("idjenjangstudi" => $jenjangstudi_idjenjangstudi );     
     $data_jenjang = $JENJANG_STUDI->readJenjangStudi($qWhere);
     $namajenjangstudi=$data_jenjang['namajenjangstudi']; 
     
      if($data_jenjang['show_prodi']==1){
                             $display_prodi="block";
                             $nProdi=$data['nProdi'];
                             $keterangan_jenjang="$nProdi";
                         }else $display_prodi="none";
                         
                         if($data_jenjang["show_mou"]==1){
                             $status_display_mou="block";
                         }else $status_display_mou="none";
                         
                         if($data_jenjang["show_pt_asal"]==1){
                             $status_display_pt_asal="block";
                             $pt_asal=$data["pt_asal"];
                             $keterangan_jenjang="$pt_asal -";
                         }else $status_display_pt_asal="none";
                         
                           if($data_jenjang["show_ket"]==1){
                             $status_display_ket="block";
                             $penyelenggara_program=$data["penyelenggara_program"];
                             //$keterangan_jenjang=" <br/>$penyelenggara_program";
                         }else $status_display_ket="none";
     
     
     
     
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
//$universitas=$data['namauniversitas'];
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
/*
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
 * 
 */
     /*
      * Excel
      */
     $row = $baseRow + $no;
  //echo "$row $r<br/>";
     //if($no!=1)
   
  /**
   * data untuk phpexcel
   */

  /*$objPHPExcel->getActiveSheet()->insertNewRowBefore( $row, 1 );

  $objPHPExcel->getActiveSheet()->setCellValue( 'A'.$row, $no )
  ->setCellValue( 'B'.$row, "$namamahasiswa $namamahasiswa2" )
  ->setCellValue( 'C'.$row, "$jl" )
  ->setCellValue( 'D'.$row, "$tempatlahir / $tanggallahir" )
  ->setCellValue( 'E'.$row, "$country" )
  ->setCellValue( 'F'.$row, "$alamat" )
  ->setCellValue( 'G'.$row, "$alamatind" )
  ->setCellValue( 'H'.$row, "$universitas" )
  ->setCellValue( 'I'.$row, "$fakultas_idfakultas - $penyelenggara_program" )
  ->setCellValue( 'J'.$row, "$namajenjangstudi <br/>$keterangan_jenjang" )
  ->setCellValue( 'K'.$row, "$status_doc" )
  ->setCellValue( 'L'.$row, "$lamaijin" )
  ->setCellValue( 'M'.$row, "$mulaibelajar" )
  ->setCellValue( 'N'.$row, "$periode_belajar_start" )
  ->setCellValue( 'O'.$row, "$periode_belajar_end" )
  ->setCellValue( 'P'.$row, "$nmrpaspor" )
  ->setCellValue( 'Q'.$row, "$mulaipassport" )
  ->setCellValue( 'R'.$row, "$akhirpassport" )
  ->setCellValue( 'S'.$row, "$jenispembiayaan - $sumber_pembiayaan" )
  ->setCellValue( 'T'.$row, "$no_kitas" )
  ->setCellValue( 'U'.$row, "$tgl_kitas" )
  ->setCellValue( 'V'.$row, "$tgl_kitas_akhir" )
  ->setCellValue( 'W'.$row, "$no_skld" )
  ->setCellValue( 'X'.$row, "$tgl_update" );*/


  /**
   * data untuk spout
   */
  
   /* $writer->addRow(["$no", 
   "$namamahasiswa $namamahasiswa2", 
   "$jl", 
   "$tempatlahir / $tanggallahir", 
   "$country", 
   "$alamat", 
   "$alamatind", 
   "$universitas", 
   "$fakultas_idfakultas - $penyelenggara_program", 
   "$namajenjangstudi <br/>$keterangan_jenjang", 
   "$status_doc", 
   "$lamaijin", 
   "$mulaibelajar", 
   "$periode_belajar_start", 
   "$periode_belajar_end", 
   "$nmrpaspor", 
   "$mulaipassport", 
   "$akhirpassport", 
   "$jenispembiayaan - $sumber_pembiayaan", 
   "$no_kitas", 
   "$tgl_kitas", 
   "$tgl_kitas_akhir", 
   "$no_skld", 
   "$tgl_update"]);
   */
  
  $no=addslashes(trim($no));
  $namamahasiswa=addslashes(trim($namamahasiswa));
  $namamahasiswa2=addslashes(trim($namamahasiswa2));
  $jl=addslashes(trim($jl));
  $tempatlahir=addslashes(trim($tempatlahir));
  $tanggallahir=addslashes(trim($tanggallahir));
  $country=addslashes(trim($country));
  $alamat=addslashes(trim($alamat));
  $alamatind=addslashes(trim($alamatind));
  $penyelenggara_program=addslashes(trim($penyelenggara_program));
  $keterangan_jenjang=addslashes(trim($keterangan_jenjang));
  $nmrpaspor=addslashes(trim($nmrpaspor));
  $jenispembiayaan=addslashes(trim($jenispembiayaan)); 
  $sumber_pembiayaan=addslashes(trim($sumber_pembiayaan)); 
  $no_kitas=addslashes(trim($no_kitas)); 

  $data_opentbs[]=array("no"=>"$no",
                "nama"=>"$namamahasiswa $namamahasiswa2",
                "kelamin"=>"$jl", 
                "ttl"=>"$tempatlahir / $tanggallahir", 
                "negara"=> "$country", 
                "alamat"=>"$alamat", 
                "alamatindo"=>"$alamatind", 
                "institusi"=> "$universitas", 
                "prodi"=> "$fakultas_idfakultas - $penyelenggara_program", 
                "program"=>"$namajenjangstudi <br/>$keterangan_jenjang",
                "jenisijin"=> "$status_doc", 
                "lama"=>"$lamaijin", 
                "tgl_awal"=>"$mulaibelajar", 
                "ijin_awal"=>"$periode_belajar_start", 
                "ijin_akhir"=>"$periode_belajar_end",
                "passport"=>"$nmrpaspor", 
                "tgl_pasport"=>"$mulaipassport", 
                "tgl_akhir_pasport"=> "$akhirpassport", 
                "pendanaan"=>"$jenispembiayaan - $sumber_pembiayaan", 
                "kitas"=> "$no_kitas", 
                "tgl_awal_kitas"=> "$tgl_kitas", 
                "tgl_akhir_kitas"=> "$tgl_kitas_akhir", 
                "skld"=>"$no_skld", 
                "tgl_ijin_akhir"=>"$tgl_update"
                );
}
/**
 * Opent tbs command
 */
$TBS->MergeBlock('t2', $data_opentbs);
$TBS->Show(OPENTBS_FILE, $newFilePath);
/**
 * spout command
 */
/*
$reader->close();
$writer->close();
*/
//echo "</tbody></table></body></html>";
/*$tgl_update=date("Y-m-d");
$objPHPExcel->getActiveSheet()->removeRow( $baseRow, 1 );
$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel5' );
$objWriter->save( "berkas/$tgl_update-rekapitulasi-ijin-belajar.xls" );
$UTILITY->location_goto("berkas/$tgl_update-rekapitulasi-ijin-belajar.xls");*/
//header("location:http://google.com");
$UTILITY->location_goto($newFilePath);
//echo "selesai";
?>

