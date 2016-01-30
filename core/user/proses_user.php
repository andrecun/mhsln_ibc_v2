<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$username = $purifier->purify($_POST[username]);

$password = $UTILITY->sha512($_POST[password]);
//$conf_password = $UTILITY->sha512($_POST[conf_password]);

$user_id = $purifier->purify($_POST[user_id]);
$level = $purifier->purify($_POST[level]);
$universitas= $purifier->purify($_POST[universitas]);
$email= $purifier->purify($_POST[email]);
//$hapuspengguna = $purifier->purify($_GET['hpengguna']);
$kondisi = $purifier->purify($_POST['kondisi']);

$data_pengguna = array("userlogin" => $username,
    "password" => $password,
    "level_idlevel" => $level,
    "email" => $email,
    "universitas_iduniversitas" => $universitas,
    "iduser" => $user_id);

if ($kondisi == "tambah") {
     if ($username == "") {
          $UTILITY->popup_message("'Mohon isi username terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     } else if ($password == "") {
          $UTILITY->popup_message("'Mohon isi password terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     }
     /* else if ($conf_password == "") {
          $UTILITY->popup_message("'Mohon isi confirmasi password terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     }*/
          else if ($level == "") {
          $UTILITY->popup_message("'Mohon pilih level terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     }/* else if ($conf_password != $password) {
          $UTILITY->popup_message("'Maaf password yang anda masukan tidak sama");
          $UTILITY->location_goto("content/user/add");
     } */
     else {
          
          $USER->insertUser($data_pengguna);
          $UTILITY->location_goto("content/user");
     }
} else if ($kondisi == "edit") {
     if ($username == "") {
          $UTILITY->popup_message("'Mohon isi username terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     } else if ($password == "") {
          $UTILITY->popup_message("'Mohon isi password terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     }  else if ($level == "") {
          $UTILITY->popup_message("'Mohon pilih level terlebih dahulu");
          $UTILITY->location_goto("content/user/add");
     } else {
          
          $USER->updateUser($data_pengguna);
          $UTILITY->location_goto("content/user");
     }
}
if ($hapuspengguna != "") {
   
     $USER->deleteUser($hapuspengguna);
     $UTILITY->location_goto("content/user");
}
?>
