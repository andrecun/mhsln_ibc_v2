<?php
include '../config/application.php';
$id=$_SESSION['user_id'];//Nanti diganti

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
$aColumns = array('userlogin', 'password',    'level_idlevel','email','universitas_iduniversitas', 'iduser',);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "iduser";

/* DB table to use */
$sTable = "user";

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
               $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
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
$sWhere = "";
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
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";

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

while ($aRow = $DB->fetch_array($rResult)) {
     $row = array();
     
     $user_id=$aRow['iduser'];
     $username=$aRow['userlogin'];
	$level=$aRow['level_idlevel'];
      $email=$aRow['email'];
      $universitas="";
         $universitas=trim($aRow['universitas_iduniversitas']);
       

	$qry_level=$DB->query("select nama from level where idlevel='$level'") ;
	if($rown=$DB->fetch_object($qry_level))
	{
		$slevel=$rown->nama;
	}
      $qry_universitas=$DB->query("select namauniversitas from universitas where kodeUniversitas='$universitas'") ;
      
	if($rown=$DB->fetch_object($qry_universitas))
	{
		$text_universitas=$rown->namauniversitas;
	}
      if($text_universitas!="")
           $row[]=$text_universitas;
      else
           $row[]="Dikti / BPKLN";
      	 $row[] =$username;
             $row[] =$slevel;
      $row[] =$email;      
             $delete="";
             $edit="";
             if($user_id!=$id) {
		$delete="<a href=\"#\" class=\"btn btn-danger btn-xs\" onClick=\"confirm_delete('$url_rewrite"."proses/user/huser/$user_id') \"title=\"Hapus\">Hapus</a>";
	}
            $edit="<a href=\"$url_rewrite"."content/user/edit/$user_id \" class=\"btn btn-success btn-xs\" title=\"Edit\">Edit</a>";
		
      
$row[] =$edit."  ".$delete;
      
      

     $output['aaData'][] = $row;
}

echo json_encode($output);

?>

