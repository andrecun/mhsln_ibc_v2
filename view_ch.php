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
$temp_path = explode($REQUEST_CH, $path);


$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);

//echo "masuk";
if (count($data) == 0)                       // No path elements means home
     include "./index.php";
else
//untuk main menu
     switch ($data[1]) {             // Pop off first item and switch
          case 'view':
               include "view/view_ch.php";
               break;
          case 'detail':
               $id = $purifier->purify($data[2]);
               include "view/detail_ch.php";
               break;
          default:
               header('HTTP/1.1 404 Not Found');
               include "view/404.php";
     }
?>
