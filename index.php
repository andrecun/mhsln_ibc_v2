<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include 'config/application.php';
  if ($_SESSION["user_name$ID"]!=""){
        $level = $_SESSION["level$ID"];
            if($level=="4")
            {
                $UTILITY->location_goto("ch/view/");
                exit();
            }
        $UTILITY->location_goto("content/home");
  }else include "view/index.php";
?>
