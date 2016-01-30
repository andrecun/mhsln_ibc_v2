<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include "config/application.php";
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Perizinan Mahasiswa Asing</title>

    
    <!-- Bootstrap -->
    <link href="<?=$url_rewrite?>styles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$url_rewrite?>styles/css/taufan.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="<?=$url_rewrite?>styles/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=$url_rewrite?>js/jquery-1.10.2.js"></script>
    <script src="<?=$url_rewrite?>js/jquery-ui.js"></script>
     <link href="<?=$url_rewrite?>css/jquery-ui.css" rel="stylesheet">
    <script src="<?=$url_rewrite?>js/jquery.validate.js"></script>
    
    <script src="<?=$url_rewrite?>js/select2.js"></script>
    <link href="<?=$url_rewrite?>js/select2.css" rel="stylesheet">
    <script src="<?=$url_rewrite?>ajax/combo.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$url_rewrite?>styles/js/bootstrap.min.js"></script>
    
    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="<?=$url_rewrite?>styles/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?=$url_rewrite?>styles/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    
        <script src="<?=$url_rewrite?>js/jquery.dataTables.rowGrouping.js"></script>
    
 <script language="javaScript">
var form_id;
function confirm_delete(go_url)
{
	var answer = confirm("Are you sure to delete the  selected row?");
	if (answer)
	{
              
	       location=go_url;
	}
}
</script>
  </head>