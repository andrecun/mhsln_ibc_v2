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
$template = 'template/dashboard-final.xlsx';
$tgl_update=date("Y-m-d");
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
$newFilePath = "berkas/$tgl_akhir-report-program.xlsx";

$no = 0;
$data_opentbs=array();

/**
 *
 */
$query="select U.namauniversitas as namaUniv,
                                  M.universitas_iduniversitas as iduniv, 
                                  M.jenjangstudi_idjenjangstudi as jenjangstudi,
                                    J.namajenjangstudi, count(M.idmahasiswa) as jml 
                               from mahasiswa M left join ijin 
                                I on I.mahasiswa_idmahasiswa=M.idmahasiswa 
                                left join status S on S.idstatus=I.status_idstatus 
                                left join nationality N on N.idnationality=M.nationality_idnationality 
                                left join prodi F on F.kodeProdi=M.prodi_idprodi and 
                                    F.kodeUniversitas=M.universitas_iduniversitas 
                                left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas 
                                 left join jenjangstudi J on J.idjenjangstudi=M.jenjangstudi_idjenjangstudi
                                Where S.idstatus ='4' and I.tgl_update >= '$tgl_awal' 
                                and I.tgl_update <= '$tgl_akhir' 
                                group by M.universitas_iduniversitas,M.jenjangstudi_idjenjangstudi";
$qry = $DB->query($query);
$data_univ=array();
while ($row = $DB->fetch_object($qry)) {
    $namaUniv=$row->namaUniv;
    $iduniv=$row->iduniv;
    $jenjangstudi=$row->jenjangstudi;
    $jml=$row->jml;
    $data_univ[$iduniv]["nama"]=$namaUniv;
    $data_univ[$iduniv][$jenjangstudi]=$jml;

}
$no=1;
$grant_total=0;
$data_opentbs=array();
foreach ($data_univ as $key => $value) {
    # code...
    // $UTILITY->show_data($value);
    $total=0;
    $total=$value[1]+$value[2]+$value[3]+$value[4]+$value[5]+$value[6]+$value[7]+$value[8]
        +$value[9]+$value[10]+$value[11];
    /*echo "
                                <tr>
                                 <td>$no</td>
                                 <td>{$value[nama]}</td>
                                <td>{$value[2]}</td>
                                <td>{$value[9]}</td>
                                <td>{$value[6]}</td>
                                <td>{$value[3]}</td>
                                <td>{$value[4]}</td>
                                <td>{$value[5]}</td>
                                <td>{$value[10]}</td>
                                <td>{$value[8]}</td>
                                <td>{$value[7]}</td>
                                <td>{$value[1]}</td>
                                <td>{$value[11]}</td>
                                <td>$total</td>
                              <tr>";*/
    $grant_total=$grant_total+$total;
    $univ=addslashes($value[nama]);
    $data_opentbs[]=array("no"=>"$no",
        "universitas"=>$univ,
        "d3"=>$value[2],
        "d4"=>$value[9],
        "sp1"=>$value[6],
        "s1"=>$value[3],
        "s2"=>$value[4],
        "s3"=>$value[5],
        "sc"=>$value[10],
        "mg"=>$value[8],
        "pf"=>$value[7],
        "se"=>$value[1],
        "seb"=>$value[11],
        "total"=>$total);
    $no++;
}

/**
 *
 *
 */

/**
 * Opent tbs command
 */
$TBS->MergeBlock('t2', $data_opentbs);
$TBS->Show(OPENTBS_FILE, $newFilePath);

$UTILITY->location_goto($newFilePath);

?>

