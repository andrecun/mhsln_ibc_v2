<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);

$password = $UTILITY->sha512($_POST[password]);
//$conf_password = $UTILITY->sha512($_POST[conf_password]);

$iduniversitas= $purifier->purify($_POST[iduniversitas]);
$namauniversitas= $purifier->purify($_POST[namauniversitas]);
$kode= $purifier->purify($_POST[kode]);
$kondisi= $purifier->purify($_POST[kondisi]);
$data_universitas = array("userlogin" => $username,
    "iduniversitas" => $iduniversitas,
    "kode"=>$kode,
    "namauniversitas" => $namauniversitas);
//$UTILITY->show_data($data_universitas);
//exit();
if ($kondisi == "tambah") {
     if ($namauniversitas== "") {
          $UTILITY->popup_message("'Mohon isi nama universitas terlebih dahulu");
          $UTILITY->location_goto("content/instituion/add");
     } else {
          
          $UNIVERSITAS->insertUniversitas($data_universitas);
          $UTILITY->location_goto("content/institution");
     }
} else if ($kondisi == "edit") {
   if ($namauniversitas== "") {
          $UTILITY->popup_message("'Mohon isi nama universitas terlebih dahulu");
          $UTILITY->location_goto("content/instituion/add");
     } else {
          
          $UNIVERSITAS->updateUniversitas($data_universitas);
          $UTILITY->location_goto("content/institution");
     }
}
if ($hapusuniversitas!= "") {
   
     $UNIVERSITAS->deleteUniversitas($hapusuniversitas);
     $UTILITY->location_goto("content/institution");
}
?>
