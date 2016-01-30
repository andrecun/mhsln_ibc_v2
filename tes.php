<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
//$tgl_update=date("Y-m-d");
//echo $tgl_update;
?>

          <?php
          $a=1;
          $b=2;
          
          if($a<$b)
               $a=$a+$b;
          
          function tambah($a,$b,$kondisi){
               if($kondisi==1){
                    if($a<$b)
                         $a=$a+$b;
                    
               }
               if($kondisi==2){
                    if($b<$s)
                         $b=$b+10;
                    
               }
               $c=$a+$b;
               return $c;
          }
          $c=tambah($a,$b,1);
          $c=tambah($a,$b,2);
          
          
          /*
          require_once __DIR__ .'/config/config.php';
require_once __DIR__ .'/utility/database/mysql_db.php';
require_once __DIR__ . '/model/modelIjin.php';


$CONFIG= new config();
$CONFIG->open_connection();
$DB=new mysql_db();
$IJIN=new modelIjin();
             $data = array(
              'nomor' => "12312313",
              'status_idstatus' => 1,
              'tglijin' => "2013-12-31",
              'atasnama' => "YOHANES",
              'nip' => "123",
              'jabatan' => "Fikri",
              "srtrek" => "Tito",
              "kode" => "12321",
          );

             print_r($data);
          $IJIN->insertIjin($data);
          
          echo "berhasil masuk";*/
       /*   
            require_once './config/application.php';
            $archive_name = "archive.zip"; // name of zip file
            $archive_folder = "data/8"; // the folder which you archivate
            $UTILITY->recurse_zip($archive_name , $archive_folder );
          header("Location: $archive_name ");*/
//          exit;
              /*
                 //error_reporting(E_ALL);
            error_reporting(E_STRICT);

            date_default_timezone_set('Asia/Jakarta');

            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail             = new PHPMailer();

            $body             = file_get_contents('contents.html');
            $body             = eregi_replace("[\]",'',$body);

            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host       = "mail.yourdomain.com"; // SMTP server
            $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
            // 1 = errors and messages
            // 2 = messages only
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "dikti.mhsln@gmail.com";  // GMAIL username
            $mail->Password   = "andreashadiyono";            // GMAIL password

            $mail->SetFrom('dikti.mhsln@gmail.com', 'Sistem Perizinan Mahasiswa Asing Dikti');

            $mail->AddReplyTo('dikti.mhsln@gmail.com', 'Sistem Perizinan Mahasiswa Asing Dikti');

            $mail->Subject    = "Percobaan Sistem Perizininan";

            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

            $mail->MsgHTML("Keterangan :----");

            $address = "andre.hadiyono@gmail.com";
            $mail->AddAddress($address, "Andreas Hadiyono");

            //$mail->AddAttachment("images/phpmailer.gif");      // attachment
            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

            if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
            echo "Message sent!";
            }
           */
          ?>
