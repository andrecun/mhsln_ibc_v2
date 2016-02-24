<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
$oldpassword= $purifier->purify($_POST[oldpassword]);
$password = $UTILITY->sha512($_POST[oldpassword]);

$new_password= $purifier->purify($_POST[password]);
$second_password= $purifier->purify($_POST[second_password]);

$user_id = $purifier->purify($_POST[user_id]);


$data = array("iduser" => "$user_id");
$hasil = $USER->readUser($data);
$password_lama= $hasil->password;

$password_baru=$UTILITY->sha512($new_password);
$data_pengguna = array(
    "password" => $password_baru,
    "iduser" => $user_id);

//$UTILITY->show_data($_POST);
$kondisi=$purifier->purify($_POST[kondisi]);
 if ($kondisi == "edit") {
     if ($password != $password_lama) {
          $UTILITY->popup_message("Password lama tidak benar");
         $UTILITY->location_goto("content/password");
        
     } else if ($new_password != $second_password) {
          $UTILITY->popup_message("password baru dan konfirmasi password tidak sama");
         $UTILITY->location_goto("content/password");
        //  exit;
    
     } else {
       //   echo "masuk $password $password_lama";
          $USER->updatePassword($data_pengguna);
          $UTILITY->popup_message("Perubahan Password berhasil");
          $UTILITY->location_goto("content/password");
     }
}
else{
     $UTILITY->popup_message("Mohon isi username terlebih dahulu");
          $UTILITY->location_goto("content/home");
}
?>
