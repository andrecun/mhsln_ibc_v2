<?php
ob_start();
include 'config/application.php';


$id = $_SESSION['user_id'];
/*
  $query="select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*
  from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
  left join universitas U on U.iduniversitas=M.universitas_iduniversitas
  left join status S on S.idstatus=I.status_idstatus
  left join jurusan J on J.idjurusan=M.jurusan_idjurusan
  left join fakultas F on F.idfakultas=M.fakultas_idfakultas

  "; */
/*
$sql = "SELECT mahasiswa.*,pembiayaan.*,user.*,jenjangstudi.*,jurusan.*,prodi.*,universitas.namauniversitas,nationality.*,ijin.*
	FROM mahasiswa,user,jenjangstudi,jurusan,prodi,universitas,nationality,ijin,pembiayaan 
	where user.iduser=mahasiswa.user_iduser 
	and jenjangstudi.idjenjangstudi=mahasiswa.jenjangstudi_idjenjangstudi 
	and jurusan.idjurusan=mahasiswa.jurusan_idjurusan
	and prodi.idprodi=mahasiswa.prodi_idprodi
	and universitas.kodeUniversitas=mahasiswa.universitas_iduniversitas
	and mahasiswa.nationality_idnationality=nationality.idnationality
	and mahasiswa.idmahasiswa=ijin.mahasiswa_idmahasiswa
	and mahasiswa.pembiayaan_idpembiayaan=pembiayaan.idpembiayaan
	and mahasiswa.kode='" . $KODE . "'";*/
$sql="select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah,Je.* ,F.*
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.idprodi=M.prodi_idprodi 
                left join jenjangstudi Je on Je.idjenjangstudi=M.jenjangstudi_idjenjangstudi 
               where M.kode='$KODE' ";

$html = '<html>
<head>
</head>
<body>';
$result = $DB->query($sql);
while ($data = $DB->fetch_array($result)) {
     //$no++;
     $kode=$data['kode'];
     $alamat="$url_rewrite"."zip/download/".$kode;
     $filename="{$data['kode']}-{$data['idmahasiswa']}.pdf";
     
     $html.="
     <table align=\"center\" border=\"0\"><tr>
               <td colspan=\"4\"><b><u>Informasi Pengajuan</u></b></td>
          </tr>
          <tr>
               <td width=\"140\"><strong>Nomor Registrasi</strong></td>
               <td>:</td>
               <td>{$data['kode']} / {$data['idmahasiswa']}</td>
               <td rowspan=\"5\" valign=\"top\">";
           
               if ($data[foto] == "") {
                         $html.= "<img src=\"{$url_rewrite}/data/call.jpg\" height=\"104\" width=\"84\" />";
                    } else {
                         $html.= "<img src='{$url_rewrite}data/{$data['kode']}/{$data[foto]}' height=\"104\" width=\"84\" />";
                    }
              $html.="</td>
          </tr>
          <tr>
               <td width=\"140\"><strong>Nama</strong></td>
               <td>:</td>
               <td>{$data['namamahasiswa']}  {$data['namamahasiswa2']}</td>
          </tr>
          <tr>
               <td><strong>Tempat/Tanggal Lahir</strong></td>
               <td>:</td>
               <td>{$data['tempatlahir']}  / 
                    
               {$UTILITY->format_tanggal_ind($data['tanggallahir'])}
                    </td>
          </tr>
          <tr>
               <td><strong>Jenis Kelamin</strong></td>
               <td>:</td>
               <td>";
               
               if ($data['sex'] == 2) {
                    $html.="Perempuan";
               } else {
                    $html.="Laki-Laki";
               }
               $html.="</td>
          </tr>
          <tr>
               <td><strong>Kebangsaan</strong></td>
               <td>:</td>
               <td>{$data['namanegara']}</td>
          </tr>
          <tr>
               <td><strong>Alamat Tetap/Alamat Rumah</strong></td>
               <td>:</td>
               <td>{$data['alamat']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td><strong>Kota</strong></td>
               <td>:</td>
               <td>{$data['city']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td><strong>Provinsi/Negara Bagian</strong></td>
               <td>:</td>
               <td>{$data['province']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td><strong>Negara</strong></td>
               <td>:</td>
               <td>{$data['country']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td><strong>Telp/Handphone</strong></td>
               <td>:</td>
               <td>{$data['telp']} / {$data['telp2']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td><strong>Email</strong></td>
               <td>:</td>
               <td>{$data['email']}</td>
               <td>&nbsp;</td>
          </tr><tr>
               <td colspan=\"4\"><strong><u>Informasi Studi</u></strong></td>
          </tr>
          <tr>
               <td><strong>Lama Studi</strong></td>
               <td>:</td>
               <td>{$UTILITY->format_tanggal_ind($data['mulaibelajar'])}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Universitas</strong></td>
               <td>:</td>
               <td>{$data['namauniversitas']}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Prodi</strong></td>
               <td>:</td>
               <td>{$data['namaProdi']}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Jurusan</strong></td>
               <td>:</td>
               <td>{$data['namaJurusan']}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Jenjang</strong></td>
               <td>:</td>
               <td>{$data['namajenjangstudi']}</td>
               <td>&nbsp;</td>
          </tr>
          <tr>
               <td colspan=\"4\"><strong><u>Dokumen Pendukung</u></strong></td>
          </tr>
          <tr>
               <td><strong>Paspor: </strong></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor</td>
               <td>:</td>
               <td>";
               
                    $html.="No : " . $data['nmrpaspor'] . "<br> ";
                    if ($data['passport1'] <> "") {
                         $html.="Berkas terlampir";
                    } else {
                         $html.="Tidak ada berkas";
                    }
               
$html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl Penetapan</td>
               <td>:</td>
               <td>{$UTILITY->format_tanggal_ind($data[mulaipassport])}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl Berakhir</td>
               <td>:</td>
               <td>{$UTILITY->format_tanggal_ind($data[akhirpassport])}</td>
               <td>&nbsp;</td>
          </tr>
          <tr>
               <td colspan=\"4\"><strong>Sponsor: </strong></td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis</td>
               <td>:</td>
               <td>{$data[jenispembiayaan]}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sumber</td>
               <td>:</td>
               <td>{$data[sumber_pembiayaan]}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Akhir</td>
               <td>:</td>
               <td>{$UTILITY->format_tanggal_ind($data[akhirsponsor])}</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Surat Pernyataan</strong></td>
               <td>:</td>
               <td>";
               
                    $html.=" file 1 :";
                    if ($data['pernyataan1'] <> "") {
                         $html.="Berkas terlampir";
                    } else {
                         $html.="Tidak ada berkas";
                    }
                    $html.= "<br>file 2 :";
                    if ($data['pernyataan2'] <> "") {
                         $html.= "Berkas terlampir";
                    } else {
                         $html.= "Tidak ada berkas";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Surat Kesehatan</strong></td>
               <td>:</td>
               <td>";
               if ($data['kesehatan'] <> "") {
                    $html.="Berkas terlampir";
               } else {
                    $html.="Tidak ada berkas";
               }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Surat Keuangan</strong></td>
               <td>:</td>
               <td>";
                            
                    if ($data['keuangan'] <> "") {
                         $html.="Berkas terlampir";
                    } else {
                         $html.="Tidak ada berkas";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>LOA</strong></td>
               <td>:</td>
               <td>";
                    if ($data['loa'] <> "") {
                         $html.="Berkas terlampir";
                    } else {
                         $html.= "Tidak ada berkas";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>KITAS</strong></td>
               <td>:</td>
               <td>";
                    if ($data['kitas'] <> "") {
                         $html.="Berkas terlampir";
                    } else {
                    $html.="Tidak ada berkas!";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>SKLD</strong></td>
               <td>:</td>
               <td>";
                    if ($data['skld'] <> "") {
                         $html.= "Berkas terlampir";
                    } else {
                         $html.= "Tidak ada berkas!";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          <tr valign=\"top\">
               <td><strong>Surat Rekomendasi</strong></td>
               <td>:</td>
               <td>";
                    if ($data['srtrek'] <> "") {
                         $html.= "Berkas terlampir";
                    } else {
                         $html.="Tidak ada berkas!";
                    }
                    $html.="</td>
               <td>&nbsp;</td>
          </tr>
          
     </table>";

}

$html.="<div></div>";
$html.="</body>
</html>";
//echo $html;
//exit;
define("_JPGRAPH_PATH", "$PATH/library/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/library/mpdf/"); 

require "$PATH/library/mpdf/mpdf.php";
$mpdf=new mPDF(); 
$mpdf->SetHeader('{DATE j-M-Y}|Sistem Perizinan Mahasiswa Asing|Dikti');
$mpdf->SetFooter('Colaboration with Universitas Gunadarma||{PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->Output("$filename","D");
/*$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('P','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = 'Progress Bar report';
$mpdf->StartProgressBarOutput();
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;
$mpdf->debug  = true;
$mpdf->WriteHTML($html);

$mpdf->Output('tes.pdf',"D");*/
exit;
