<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
require_once __DIR__ .'/../config/config.php';
require_once __DIR__ .'/../utility/database/mysql_db.php';
require_once __DIR__ .'/../utility/utilityCode.php';

//Untuk Model 
require_once __DIR__ . '/../model/modelUser.php';
//Akhir Model


$CONFIG= new config();
$DB=new mysql_db();
$UTILITY=new utilityCode();

$USER=new modelUser();

$id = $_POST['Login'];
//echo "ID=$id";
if ( isSet($id)) {
     $user_name1 = $_POST['username'];
     $user_pass1 = $UTILITY->sha512($_POST['password']);
     $pass = $_POST['password'];
 //    echo "$user_pass1";
   //  exit;
     if (!$user_pass1 || !$user_name1) {
          $UTILITY->popup_message("Maaf anda harus login terlebih dahulu!");
          $UTILITY->location_goto(".");
     } else {
          //$data = array("username" => "$user_name1", "status_user" => 1);
          $data = array("userlogin" => "$user_name1");
          $hasil = $USER->readUser($data);
          $panjang = count($hasil);
          if ($panjang < 1) {
               session_destroy();
               $UTILITY->location_goto(".");
          } else {
               $userlogin = $hasil->userlogin;
               $user_id = $hasil->iduser;
               $password= $hasil->password;
               $level_idlevel= $hasil->level_idlevel;
               $email= $hasil->email;
               $universitas_iduniversitas= $hasil->universitas_iduniversitas;
              
          }

          if (($user_name1 == $userlogin) && ($user_pass1 != $password)) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }
          if ($user_name1 != $userlogin&& $user_pass1 == $password) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }
          if ($user_name1 != $userlogin&& $user_pass1 != $password) {
               $UTILITY->popup_message("Maaf password atau username tidak ada!");
               session_destroy();
               $UTILITY->location_goto(".");
          }

          if ($user_name1 == $userlogin&& $user_pass1 == $password) {
               $_SESSION["level$ID"] = $level_idlevel;
               $level=$level_idlevel;
               $_SESSION['user_id'] = $user_id;
               $_SESSION['email'] = $email;
               $_SESSION["user_name$ID"] = $userlogin;
               $_SESSION['unversitas']=trim($universitas_iduniversitas);
               $qry = $DB->query("select namauniversitas from universitas where kodeUniversitas='{$_SESSION['unversitas']}' ");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $nama_universitas=$row->namauniversitas;
                                                                 }
             $_SESSION['nama_unversitas']=$nama_universitas;
                //enkripsi
              // $hash = $UTILITY->enkripsi($algoritma, $mode, $secretkey, "$user_id");
               //$user_id_hash = base64_decode($hash);
               //enkripsi
               //setting cookies --> paramater berasal dari application.php
                 //echo "MASUKKK";
             $user_id_hash=$user_id;  
             
               $status=setcookie($cookie_name, 'usr=' . $userlogin. '&hash=' . $user_id_hash, time() + $cookie_time,"/","$domain");
            //   $_SESSION['cookies'] = 'usr=' . $nam . '&hash=' . $user_id_hash;
              if ($level != ""){
                   //$UTILITY->show_data($_COOKIE);
                    $UTILITY->location_goto("content/home");
              }
 
          }
     }
}
else {
     //bila sudah teridentifikasi
     $username = $_SESSION['username'];
     if ($username != "")
          $UTILITY->location_goto("content/home");
     else
     //bila belum login
     echo "Belum masuk";
       //   $UTILITY->location_goto(".");
}
?>

