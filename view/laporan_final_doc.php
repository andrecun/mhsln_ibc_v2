<?php

//include "inc.session.php"; 
include "config/application.php";
?>

<!DOCTYPE html>
<html lang="en">
     <?php
     include "view/default/head.php";
     ?>
     <body>
          <div class="container">
               <?php
               include "view/default/img_header.php";
               ?>

               <div class="row te-container te-row">
                    <?php
                    include "view/default/right_menu.php";
                    ?>
                    <div class="col-md-9 te-content te-col-md-9">
                         <div class="row">
                              <div class="col-md-7 te-container-login">
                                   <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading te-panel-heading">
                                             <i class="glyphicon glyphicon-warning-sign"></i> <p>Information</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             Document Telah di download silahkan klik menu home untuk kembali halaman utama
                                             </form>
                                        </div>
                                        <!-- end of panel body -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>


               <?php
               include "view/default/footer.php";
               ?>
          </div> <!-- /container -->


     </body>
</html>
<?php
$sql = "select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah,Je.* ,F.*,P.jenispembiayaan,N.namanegara 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join pembiayaan P on P.idpembiayaan=M.pembiayaan_idpembiayaan
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.idprodi=M.prodi_idprodi 
               left join nationality N on N.idnationality=M.nationality_idnationality 
                left join Jenjangstudi Je on Je.idjenjangstudi=M.jenjangstudi_idjenjangstudi 
               where M.kode='$KODE' limit 1 ";
//echo $sql;
$qry = $DB->query($sql);

$data = $DB->fetch_array($qry);

$kode_pt=$data['kodeUniversitas'];
$sql_univ="select alamat_jalan,nama_wilayah from pdpt_universitas where  kode_pt='{$kode_pt}' and nama_wilayah is not null";
$qry_univ=$DB->query($sql_univ);
$data_univ=$DB->fetch_array($qry_univ);

//$UTILITY->show_data($data);
$no++;
if (strlen($data[nomor]) == 0) {
    $nmaks = "0000";
} elseif (strlen($data[nomor]) == 1) {
    $nmaks = "000" . $data[nomor];
} elseif (strlen($data[nomor]) == 2) {
    $nmaks = "00" . $data[nomor];
} elseif (strlen($data[nomor]) == 3) {
    $nmaks = "0" . $data[nomor];
} else {
    $nmaks = $data[nomor];
}

if($data['ekstension']==1){
    $text_ijin="Perpanjangan";
}else{
    $text_ijin="Perpanjangan";
}

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('template/ijin-sendiri.docx');

$document->setValue('jenis_ijin', $text_ijin);
$document->setValue('kebangsaan', $data['country']);
$document->setValue('kebangsaan', $data['namanegara']);

$document->setValue('alamat_jalan', $data_univ['alamat_jalan']);
$document->setValue('kota', $data_univ['nama_wilayah']);

$document->setValue('jabatan', $data[jabatan]);
$document->setValue('universitas', $data[namauniversitas]);
$document->setValue('no_surat', $data[nosrtrek]);
$document->setValue('Value1', $UTILITY->format_tanggal_ind($data[tglsrtrek])); //no surat
//$document->setValue('surat', 'xx');

$document->setValue('jenis_ijin', $text_ijin);
$document->setValue('nama', $data[namamahasiswa]." ".$data[namamahasiswa2]);
$document->setValue('negara', $data['country']);
$document->setValue('no_paspor', $data[nmrpaspor]);
$document->setValue('tempat_lahir', $data[tempatlahir]);
$document->setValue('tanggal_lahir', $UTILITY->format_tanggal_ind($data[tanggallahir]));
$document->setValue('tempat_belajar', $data[namauniversitas]." ".$data[namaProdi]);
$document->setValue('lama_ijin', $data[LamaIjin]);
$document->setValue('Value3', $UTILITY->format_tanggal_ind($data[mulaiperiode]));
$document->setValue('waktu_akhir', $UTILITY->format_tanggal_ind($data[batasperiode]));
if($data[pembiayaan_idpembiayaan]==1){
$text_biaya=$data[jenispembiayaan]; 
}else{
$text_biaya=$data[jenispembiayaan]." : (".$data[sumber_pembiayaan].")";
}
$document->setValue('biaya', $text_biaya);
$document->setValue('kedutaan', 'Kedutaan'. ' '.$data[country]);
$document->setValue('imigrasi', 'Kanim Wilayah '.$data_univ['nama_wilayah']);

//echo "<pre>";
//print_r($document);


$document->save('berkas/ijin_belajar-'.$KODE.'.docx');
//clearstatcache();
 $UTILITY->location_goto('berkas/ijin_belajar-'.$KODE.'.docx');

?>