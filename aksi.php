<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

require_once './config/application.php';
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
/**
 * [$temp_path description]
 * untuk mengabil resource dari url
 * @var [dari UR]
 */
$temp_path = explode($PROSES_REQUEST, $path);


$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);
//$UTILITY->show_data($data);
if (count($data) == 0)                       // No path elements means home
     include "./index.php";
else {
     //untuk main menu
     switch ($data[1]) {             // Pop off first item and switch
          case 'user':
               if ($data[2] == "huser") {
                    $hapuspengguna = $purifier->purify($data[3]);
               }

               include "./core/user/proses_user.php";
               break;
         case 'password':
               include "./core/password/password.php";
               break;
               
                 case 'institution':
               if ($data[2] == "huniversitas") {
                    $hapusuniversitas= $purifier->purify($data[3]);
               }

               include "./core/universitas/proses_universitas.php";
               break;

          case 'student':
               switch ($data[2]) {
                    case "hstudent":
                         $hapusmahasiswa = $purifier->purify($data[3]);
                         include "./core/mahasiswa/proses_mahasiswa.php";
                         exit;
                         break;
                    case "rfoto":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set foto='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode");
                         exit;
                         
                         break;
                    case "rpassport1":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set passport1='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode");
                         exit;
                         break;

                    case "rkeuangan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set keuangan='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;

                    case "rkeuangan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set keuangan='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;

                    case "rpernyataan1":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set pernyataan1='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;
                    
                    case "rkesehatan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set kesehatan='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;
                    
                    case "rloa":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set loa='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;
                     case "rmou":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set dok_mou='' where kode='$kode'");
                         $UTILITY->location_goto("content/student/edit/$kode/3");
                         exit;
                         break;
                     case "rsrtrek":
                         $kode = urldecode($purifier->purify($data[3]));
                         $tmp=explode("-",$kode);
                         $kode_hapus=end($tmp);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode_hapus" . "/$file";
                         $DB->query("update mahasiswa set srtrek='' where idmahasiswa='$kode'");
                         $DB->query("update ijin set file='' where mahasiswa_idmahasiswa='$kode'");
                         //echo "$file_upload_foto";
                         //exit();
                         $UTILITY->location_goto("content/student/permit/$kode");
                         exit;
                         break;

                    default:
                         break;
               }
               //echo "masukk";
               include "./core/mahasiswa/proses_mahasiswa.php";
               break;
          
                case 'permit':
                         $idmahasiswa=$purifier->purify($data[3]);
                          $hapusijin= $purifier->purify($data[3]);
                          include "./core/ijin/proses_ijin.php";
                         break;
                case 'status':
                         $idmahasiswa=$purifier->purify($data[3]);
                          $hapusijin= $purifier->purify($data[3]);
                          include "./core/ijin/proses_status.php";
                         break;
                    
               case 'keterangan':
                         $idmahasiswa=$purifier->purify($data[3]);
                          include "./core/ijin/proses_keterangan.php";
                         break;
                case 'keterangan1':
                         $idmahasiswa=$purifier->purify($data[3]);
                          include "./core/ijin/proses_keterangan_tab1.php";
                         break;
                case 'keterangan2':
                         $idmahasiswa=$purifier->purify($data[3]);
                          include "./core/ijin/proses_keterangan_tab2.php";
                         break;
           case 'ekstension':
               switch ($data[2]) {
                    case "hstudent":
                         $hapusmahasiswa = $purifier->purify($data[3]);
                         include "./core/mahasiswa/proses_mahasiswa_perpanjangan.php";
                         exit;
                         break;
                    case "rfoto":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set foto='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode");
                         exit;
                         
                         break;
                    case "rpassport1":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set passport1='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode");
                         exit;
                         break;

                    case "rkeuangan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set keuangan='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;

                    case "rkeuangan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set keuangan='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;

                    case "rpernyataan1":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set pernyataan1='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                    
                    case "rkesehatan":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set kesehatan='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                    
                    case "rloa":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set loa='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                    case "rkitas":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set kitas='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                    case "rijazah":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set ijazah='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                       case "rskld":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set rskld='' where kode='$kode'");
                         $UTILITY->location_goto("content/ekstension/edit/$kode/3");
                         exit;
                         break;
                     case "rsrtrek":
                         $kode = $purifier->purify($data[3]);
                         $file = $purifier->purify($data[4]);
                         $file_upload_foto = "$path_upload" . "$kode" . "/$file";
                         unlink($file_upload_foto);
                         $DB->query("update mahasiswa set srtrek='' where idmahasiswa='$kode'");
                         $DB->query("update ijin set file='' where mahasiswa_idmahasiswa='$kode'");
                         $UTILITY->location_goto("content/ekstension/permit/$kode");
                         exit;
                         break;

                    default:
                         break;
               }
               //echo "masukk";
               include "./core/mahasiswa/proses_mahasiswa_perpanjangan.php";
               break;
          
                case 'permit':
                         $idmahasiswa=$purifier->purify($data[3]);
                          $hapusijin= $purifier->purify($data[3]);
                          include "./core/ijin/proses_ijin.php";
                         break;
                case 'status':
                         $idmahasiswa=$purifier->purify($data[3]);
                          $hapusijin= $purifier->purify($data[3]);
                          include "./core/ijin/proses_status.php";
                         break;         
          default:
               header('HTTP/1.1 404 Not Found');
               include "view/404.php";
     }
}
?>
