<?php

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
$aColumns = array('namamahasiswa', 'universitas_iduniversitas', 'status_idstatus', 'ekstension', 'alamat',);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "kode";

/* DB table to use */
$sTable = "mahasiswa as M";


$keyword = $_GET['keyword'];
$status = $_GET['status'];
$universitas = $_GET['universitas'];
$major = $_GET["major"];
$faculty = $_GET["faculty"];
//$document=$_GET["document"];
$sWhere = "";

$level = $_SESSION["level$ID"];
$universitas_session = trim($_SESSION['unversitas']);
$username_session = $_SESSION["user_name$ID"];
if ($level == 1 || $level == 4) {
     $sWhere = "";
} else if ($level == 2) {
     $sWhere = "Where U.kodeUniversitas='$universitas_session' ";
} else if ($level == 3) {
     $sWhere = "Where idmahasiswa='$username_session' ";
}

if ($status != "") {
    $array_status=array(2,3,4,5);
    if(in_array($status, $array_status)){
        $status=$status;
    }
    else{
        $status="2,3,4,5";
    }
     if ($sWhere != "")
          $sWhere.=" and idstatus in ($status) ";
     else
          $sWhere = "Where idstatus in ($status) ";
     
}else{
    if ($sWhere != "")
          $sWhere.=" and idstatus in (2,3,4,5) ";
     else
          $sWhere = "Where idstatus in (2,3,4,5) "; 
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

$kode_wilayah = $_SESSION["kode_wilayah"];
if ($kode_wilayah != "" and $level == 4) {
    $sQuery = "SELECT DISTINCT(trim(kodeUniversitas))as wilayah FROM `universitas` where kodewilayah='$kode_wilayah' ";
    $kodewil = "";
    $result = $DB->query($sQuery);
    $i = 0;
    while ($row_kode = $DB->fetch_array($result)) {
        $wilayah = $row_kode["wilayah"];
        if ($i == 0)
            $kodewil = " '{$wilayah}'";
        else
            $kodewil .= " ,'{$wilayah}'";
        $i++;
    }
    if ($sWhere != "")
        $sWhere.=" and U.kodeUniversitas in ($kodewil) ";
    else
        $sWhere = "Where U.kodeUniversitas in ($kodewil) ";
}




/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
    if ($sWhere == "")
        $sWhere = "WHERE (";
    else
        $sWhere .= " and (";
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
$sQuery = "select SQL_CALC_FOUND_ROWS M.kode,U.namauniversitas,s.namastatus,M.LamaIjin, M.tgl_update as tgl_ubah,
               M.namamahasiswa as namamahasiswa ,M.universitas_iduniversitas as universitas_iduniversitas,
               I.status_idstatus as status_idstatus  ,M.ekstension as ekstension , M.alamat as alamat 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.idprodi=M.prodi_idprodi
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
while ($aRow = $DB->fetch_array($rResult)) {
     $row = array();
     //print_r($aRow);
     $id = $aRow['kode'];
     $idmhs = $aRow["idmahasiswa"];
     $namamahasiswa = $aRow["namamahasiswa"];
     $namamahasiswa2 = $aRow["namamahasiswa2"];
     $universitas = $aRow["namauniversitas"];
     $status = $aRow["namastatus"];
     $id_status = $aRow["idstatus"];
     $alamat = $aRow["alamat"];
     $status_doc = $aRow["ekstension"];
     $lamaijin = $aRow["LamaIjin"];

     $tgl_update = $UTILITY->format_tanggal_ind($aRow["tgl_ubah"]);
     if ($status_doc == 0)
          $text_doc = "New";
     else
          $text_doc = "Extended";
     $kunci = $aRow["kunci"];
     $tgl_verifikasi_kampus = $UTILITY->format_tanggal_ind($aRow["tgl_verifikasi_kampus"]);
     if ($kunci != 1) {
          if ($status_doc == 0)
               $edit = "<a href=\"$url_rewrite" . "content/student/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
          else {
               $edit = "<a href=\"$url_rewrite" . "content/ekstension/edit/$id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
          }
          $delete = "<a href=\"#\" class=\"btn btn-danger btn-xs\" onClick=\"confirm_delete('$url_rewrite" . "proses/student/hstudent/$id') \"title=\"Hapus\">Hapus</a>";
     } else {
          $edit = "<a href=\"$url_rewrite" . "content/student/view/$id \" class=\"btn btn-success btn-xs\" title=\"View\">View</a>";
          $delete = "";
     }
     $download = "<a href=\"$url_rewrite" . "zip/download/$id \" class=\"btn btn-success btn-xs\" title=\"Download\">Download Berkas</a>";

     $ekstension = "<a href=\"$url_rewrite" . "content/ekstension/edit/$id \" class=\"btn btn-danger btn-xs\" title=\"Edit\">Ekstension</a>";
   if($id_status!=0)
     $permit = "<a href=\"$url_rewrite" . "content/student/permit/$idmhs \" class=\"btn btn-info btn-xs\" title=\"Verifcation\">LOR</a>";
     else $permit="";   
     $verification = "<a href=\"$url_rewrite" . "content/permit/$id \" class=\"btn btn-warning btn-xs\" title=\"Verifcation\">Verification</a>";

     $report = "<a  href=\"$url_rewrite" . "content/report/report/$id\" class=\"btn btn-primary btn-xs\" title=\"Report\">Report</a>";

     if ($id_status == 4 || $id_status == 3 ||$id_status == 2)
          $cetak_berkas = "<a  href=\"$url_rewrite" . "content/report/final/$id\" class=\"btn btn-primary btn-xs\" title=\"Report\">Cetak berkas</a>";
     else {
          $cetak_berkas = "";
     }

     $view = "<center><a href=\"$url_rewrite" . "ch/detail/$id \" class=\"btn btn-success \" title=\"View\">View</a></center>";
     $row[] = "$namamahasiswa $namamahasiswa2";
     //$row[]="$alamat";
     $row[] = "$universitas";
     $row[] = "$status";
     $row[] = "$text_doc";
     $row[] = "$tgl_update";
     $row[] = "$lamaijin";
     $row[] = $view;
     


     $output['aaData'][] = $row;
}

echo json_encode($output);
?>

