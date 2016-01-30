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
$temp_path = explode($REQUEST, $path);


$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);

if (count($data) == 0)                       // No path elements means home
     include "./index.php";
else
//untuk main menu
     switch ($data[1]) {             // Pop off first item and switch
          case 'home':
               include "view/student-admin.php";
               break;
          case 'password':
               include "view/change_password.php";
               break;
          case 'report':
               $KODE = $data[3];
               if ($data[2] == "view") {
                    include "./view/cv.php";
               } else if ($data[2] == "report") {
                    include "./view/cv_pdf.php";
               } else if ($data[2] == "final") {
                    $KODE = $purifier->purify($data[3]);
                    include "./view/laporan_final.php";
               } else if ($data[2] == "dashboard_report") {
                    $keyword = $purifier->purify($data[3]);
                    $status = $purifier->purify($data[4]);
                    $universitas = $purifier->purify($data[5]);
                    $country = $purifier->purify($data[6]);
                    $periode_belajar_start = $purifier->purify($data[7]);
                    $periode_belajar_end = $purifier->purify($data[8]);
                    include "./view/dashboard_report.php";
               } else {
                    include "./view/report-view.php";
               }


               break;

          case 'user':
               if ($_SESSION["level$ID"] != 1) {
                    $UTILITY->popup_message("Sorry you don\'t have permission");
                    $UTILITY->location_goto("content/home");
                    exit;
               }
               if ($data[2] == "add") {
                    $title_tab = "User Management (Add User)";
                    include "./view/add-user.php";
               } else if ($data[2] == "edit") {
                    $user_id = $purifier->purify($data[3]);
                    $status_edit = 1;
                    if ($user_id == "") {
                         $UTILITY->popup_message("Maaf data user tidak ada");
                         $UTILITY->location_goto("content/user");
                    } else {
                         $title_tab = "User Management (Update User)";
                         include "./view/add-user.php";
                    }
               } else
                    include "./view/user-admin.php";
               break;

          case 'student':

               if ($data[2] == "add") {
                    $title_tab = "Student Administration(Register)";

                    $regnumber = $_POST["regnumber"];
                    if ($regnumber != "") {
                         $UTILITY->location_goto("content/student/edit/$regnumber");
                         exit;
                    } else
                         include "./view/add-student.php";
               } else if ($data[2] == "edit") {
                    $id = $purifier->purify($data[3]);
                    $tab_mode = $purifier->purify($data[4]);
                    $status_edit = 1;
                    if ($id == "") {
                         $UTILITY->popup_message("Sorry regsiter number doesn't eksist");
                         $UTILITY->location_goto("content/student");
                    } else {
                         $title_tab = "Student Administration (Update Data)";
                         include "./view/add-student.php";
                    }
               } else if ($data[2] == "permit") {
                    $id = $purifier->purify($data[3]);
                    include "./view/add-ijin.php";
               } else if ($data[2] == "view") {
                    $id = $purifier->purify($data[3]);
                    include "./view/student_disabled.php";
               } else
                    include "./view/student-admin.php";
               break;


          case 'ekstension':

               if ($data[2] == "add") {
                    $title_tab = "Student Administration(Register)";

                    $regnumber = $_POST["regnumber"];
                    if ($regnumber != "") {
                         $UTILITY->location_goto("content/ekstension/edit/$regnumber");
                         exit;
                    } else
                         include "./view/add-student-ekstension.php";
               } else if ($data[2] == "edit") {
                    $id = $purifier->purify($data[3]);
                    $tab_mode = $purifier->purify($data[4]);

                    if ($id == "") {
                         $UTILITY->popup_message("Sorry regsiter number doesn't eksist");
                         $UTILITY->location_goto("content/student");
                    } else {
                         $title_tab = "Student Administration (Update Data)";
                         include "./view/add-student-ekstension.php";
                    }
               } else if ($data[2] == "permit") {
                    $id = $purifier->purify($data[3]);
                    include "./view/add-ijin.php";
               } else if ($data[2] == "view") {
                    $id = $purifier->purify($data[3]);
                    include "./view/student_disabled.php";
               } else
                    include "./view/student-admin.php";
               break;
          case 'permit':
               if ($_SESSION["level$ID"] != 1) {
                    $UTILITY->popup_message("Sorry you don\'t have permission");
                    $UTILITY->location_goto("content/home");
                    exit;
               }
               $id = $purifier->purify($data[2]);
               $tab_mode = $purifier->purify($data[3]);
               include "./view/verification.php";
               break;


          case 'institution':
               if ($_SESSION["level$ID"] != 1) {
                    $UTILITY->popup_message("Sorry you don\'t have permission");
                    $UTILITY->location_goto("content/home");
                    exit;
               }
               if ($data[2] == "add") {
                    $title_tab = "Institution Admin (Add data)";
                    include "./view/add-institution.php";
               } else if ($data[2] == "edit") {
                    $id = $purifier->purify($data[3]);
                    $status_edit = 1;
                    if ($id == "") {
                         $UTILITY->popup_message("Maaf data institution tidak ada");
                         $UTILITY->location_goto("content/institution");
                    } else {
                         $title_tab = "Institution Admin (Update Institution)";
                         include "./view/add-institution.php";
                    }
               } else
                    include "./view/institution-admin.php";
               break;

          default:
               header('HTTP/1.1 404 Not Found');
               include "view/404.php";
     }
?>
