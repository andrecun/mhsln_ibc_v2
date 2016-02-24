<?php
//echo "masukk123123";
require_once 'config/application.php';
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$ZIP_REQUEST="dikti/mhsln_ibc/zip";
$temp_path = explode($ZIP_REQUEST, $path);
$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);
echo "masukk123123 $url_rewrite";
$UTILITY->show_data($elements);
switch ($data[1]) {             // Pop off first item and switch
     case 'download':
          $zip = $data[2];
          $archive_name = "berkas/$zip.zip"; // name of zip file
          $archive_folder = "data/$zip"; // the folder which you archivate
          $UTILITY->exec_zip($archive_name, $archive_folder);
          //$UTILITY->recurse_zip($archive_name, $archive_folder);
          break;
}
        header("Location: $url_rewrite$archive_name ");
        $file="$PATH$archive_name";
        header('Content-Type: application/zip');
header('Content-Length: ' . filesize($file));
header('Content-Disposition: attachment; filename="arsip.zip"');
readfile($file);
//unlink($file); 
        
          //break;
?>
