<?php

require_once '../config/application.php';
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$temp_path = explode($REQUEST, $path);
$elements = explode('/', $temp_path[1]);                // Split path on slashes
$data = array_filter($elements);
echo "masukk";
exit;
switch ($data[1]) {             // Pop off first item and switch
     case 'download':
          $zip = $data[2];
          $archive_name = "$zip.zip"; // name of zip file
          $archive_folder = "data/$zip"; // the folder which you archivate

          $UTILITY->recurse_zip($archive_name, $archive_folder);
          header("Location: $archive_name ");
          break;
}
?>
