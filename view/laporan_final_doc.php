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
$PHPWord = new PHPWord();
//untuk bersama
$qWhere = array("kode" => $KODE);
$data = $MHS->readMahasiswa($qWhere);
$jData = count($data);
if ($data != "")
    $jData = count($data);
else
    $jData = 0;

if ($jData > 0) {
    $mahasiswa_idmahasiswa = $data['idmahasiswa'];
}

$query_ijin = array("mahasiswa_idmahasiswa" => $mahasiswa_idmahasiswa);
$hasil_ijin = $IJIN->readIjin($query_ijin);
$file = $hasil_ijin['file'];

$query_ijin = array("file" => $file);
$srt_lor = $IJIN->readIjinFull($query_ijin);
$jData = count($srt_lor);

if ($srt_lor != "")
    $jData = count($srt_lor);
else
    $jData = 0;

if ($jData > 0) {
    //$UTILITY->show_data($jData);
    if ($jData == 1) {
//Untuk sendiri
        $sql = "select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah,Je.* ,F.*,P.jenispembiayaan,N.namanegara 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join pembiayaan P on P.idpembiayaan=M.pembiayaan_idpembiayaan
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.kodeprodi=M.prodi_idprodi and F.kodeUniversitas=M.universitas_iduniversitas 
               left join nationality N on N.idnationality=M.nationality_idnationality 
                left join jenjangstudi Je on Je.idjenjangstudi=M.jenjangstudi_idjenjangstudi 
               where M.kode='$KODE' and I.status_idstatus in (2,3,4) limit 1 ";
//echo $sql;
//exit;
        $qry = $DB->query($sql);

        $data = $DB->fetch_array($qry);

        $kode_pt = $data['kodeUniversitas'];
        $sql_univ = "select alamat_jalan,nama_wilayah from prodi where  kodeUniversitas='{$kode_pt}' and nama_wilayah is not null";
        $qry_univ = $DB->query($sql_univ);
        $data_univ = $DB->fetch_array($qry_univ);

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

        if ($data['ekstension'] == 1) {
            $text_ijin = "perpanjangan";
        } else {
            $text_ijin = "baru";
        }


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
        if ($data[sex] == 1) {
            $sex = "Mr";
        } else {
            $sex = "Ms";
        }

        $document->setValue('jenis_ijin', $text_ijin);
        $document->setValue('nama', $sex . "." . $data[namamahasiswa] . " " . $data[namamahasiswa2]);
        $document->setValue('negara', $data['country']);
        $document->setValue('no_paspor', $data[nmrpaspor]);
        $document->setValue('tempat_lahir', $data[tempatlahir]);
        $document->setValue('tanggal_lahir', $UTILITY->format_tanggal_ind($data[tanggallahir]));
        $document->setValue('tempat_belajar', $data[namauniversitas] . " " . $data[namaProdi]);
        $document->setValue('lama_ijin', $data[LamaIjin]);
        $document->setValue('Value3', $UTILITY->format_tanggal_ind($data[mulaiperiode]));
        $document->setValue('waktu_akhir', $UTILITY->format_tanggal_ind($data[batasperiode]));
        if ($data[pembiayaan_idpembiayaan] == 1) {
            $text_biaya = $data[jenispembiayaan];
        } else {
            $text_biaya = $data[jenispembiayaan] . " : (" . $data[sumber_pembiayaan] . ")";
        }
        $document->setValue('biaya', $text_biaya);
        $document->setValue('kedutaan', 'Kedutaan' . ' ' . $data[country]);
        $document->setValue('imigrasi', 'Kanim Wilayah ' . $data_univ['nama_wilayah']);

//echo "<pre>";
//print_r($document);


        $document->save('berkas/ijin_belajar-' . $KODE . '.docx');
//clearstatcache();
        $UTILITY->location_goto('berkas/ijin_belajar-' . $KODE . '.docx');
//akhir untuk sendiri
    } else {
        //untuk massal

        $sql = "select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah,Je.* ,F.*,P.jenispembiayaan,N.namanegara 
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join pembiayaan P on P.idpembiayaan=M.pembiayaan_idpembiayaan
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.kodeprodi=M.prodi_idprodi  and F.kodeUniversitas=M.universitas_iduniversitas
               left join nationality N on N.idnationality=M.nationality_idnationality 
                left join Jenjangstudi Je on Je.idjenjangstudi=M.jenjangstudi_idjenjangstudi 
               where I.file='$file' and I.status_idstatus=4 order by  idijin asc";

        $hasil = $DB->_fetch_array($sql, 1);
        $jml = count($hasil);
        $terbilang = $UTILITY->terbilang($jml, 4);
        //$UTILITY->show_data($data);
        $counter = 0;
        $table = array();
        $no=array();
        $nama=array();
        $ttl=array();
        $passpor=array();
        $program_studi=array();
        $document = $PHPWord->loadTemplate('template/final-masal.docx');
        foreach ($hasil as $key => $data) {
             if ($data['ekstension'] == 1) {
                    $text_ijin = "perpanjangan";
                } else {
                    $text_ijin = "baru";
                }
                if ($data[sex] == 1) {
                    $sex = "Mr";
                } else {
                    $sex = "Ms";
                }
                
            if ($counter == 0) {
               
                $document->setValue('jml', $jml);
                $document->setValue('terbilang', $terbilang);
                $document->setValue('jenis_ijin', $text_ijin);
                $document->setValue('nama', $sex . "." . $data[namamahasiswa] . " " . $data[namamahasiswa2]);
                $document->setValue('negara', $data['country']);

                $kode_pt = $data['kodeUniversitas'];
                $sql_univ = "select alamat_jalan,nama_wilayah from pdpt_universitas where  kode_pt='{$kode_pt}' and nama_wilayah is not null";
                $qry_univ = $DB->query($sql_univ);
                $data_univ = $DB->fetch_array($qry_univ);
                $document->setValue('alamat_jalan', $data_univ['alamat_jalan']);
                $document->setValue('kota', $data_univ['nama_wilayah']);

                $document->setValue('jabatan', $data[jabatan]);
                $document->setValue('universitas', $data[namauniversitas]);
                $document->setValue('no_surat', $data[nosrtrek]);
                $document->setValue('Value1', $UTILITY->format_tanggal_ind($data[tglsrtrek])); //no surat
                $document->setValue('lama_ijin', $data[LamaIjin]);
                $document->setValue('Value3', $UTILITY->format_tanggal_ind($data[mulaiperiode]));
                $document->setValue('jenjang', $data[namajenjangstudi]);
                 if ($data[pembiayaan_idpembiayaan] == 1) {
                    $text_biaya = $data[jenispembiayaan];
                } else {
                    $text_biaya = $data[jenispembiayaan] . " : (" . $data[sumber_pembiayaan] . ")";
                }
                $document->setValue('biaya', $text_biaya);
                $document->setValue('biaya', $text_biaya);
                $document->setValue('kedutaan', 'Kedutaan' . ' ' . $data[country]);
                $document->setValue('imigrasi', 'Kanim Wilayah ' . $data_univ['nama_wilayah']);
            } 
            $no[$counter]=$counter+1;
            $nama[$counter]= $sex . "." . $data[namamahasiswa] . " " . $data[namamahasiswa2];
            $ttl[$counter]=$data[tempatlahir]. ",". $UTILITY->format_tanggal_ind($data[tanggallahir]) ;
            $passpor[$counter]=$data[nmrpaspor];
            $program_studi[$counter]=$data[namaProdi];
            
            $counter++;
        }
        $data_table = array(
		'no' => $no,
		'nama' => $nama,
		'ttl' => $ttl,
                'paspor'=>$passpor,
                'program'=>$program_studi
	);	
        $document->cloneRow('TBL1', $data_table);
         $document->save('berkas/ijin_belajar-' . $KODE . '.docx');
//clearstatcache();
        $UTILITY->location_goto('berkas/ijin_belajar-' . $KODE . '.docx');
    }
}
?>
