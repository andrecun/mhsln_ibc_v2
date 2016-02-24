<?php
//include "inc.session.php"; 
include "config/application.php";

header("Content-Type: application/vnd.msword"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=Laporan.doc");
$sql="select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah,Je.* ,F.*
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.idprodi=M.prodi_idprodi 
                left join Jenjangstudi Je on Je.idjenjangstudi=M.jenjangstudi_idjenjangstudi 
               where M.kode='$KODE' ";
/*$sql = "SELECT mahasiswa.*,user.*,jenjangstudi.*,jurusan.*,fakultas.*,universitas.namauniversitas,nationality.*,ijin.*,pembiayaan.*,year(ijin.mulaiperiode) as tahun
	FROM mahasiswa,user,jenjangstudi,jurusan,fakultas,universitas,nationality,ijin,pembiayaan 
	where user.iduser=mahasiswa.user_iduser 
	and jenjangstudi.idjenjangstudi=mahasiswa.jenjangstudi_idjenjangstudi 
	and jurusan.idjurusan=mahasiswa.jurusan_idjurusan
	and fakultas.idfakultas=mahasiswa.fakultas_idfakultas
	and universitas.iduniversitas=mahasiswa.universitas_iduniversitas
	and mahasiswa.nationality_idnationality=nationality.idnationality
	and mahasiswa.idmahasiswa=ijin.mahasiswa_idmahasiswa
	and mahasiswa.pembiayaan_idpembiayaan=pembiayaan.idpembiayaan
	and mahasiswa.kode='".$KODE."'";*/
	$qry = $DB->query($sql); 
		 
	while ($data=$DB->fetch_array($qry)) {
	$no++;
	if(strlen($data[nomor])==0){
		$nmaks="0000";
		}elseif(strlen($data[nomor])==1){
		$nmaks="000".$data[nomor];
		}elseif(strlen($data[nomor])==2){
		$nmaks="00".$data[nomor];
		}elseif(strlen($data[nomor])==3){
		$nmaks="0".$data[nomor];
		}else{
		$nmaks=$data[nomor];
		}
	//$x1=explode("-",$data[]);
  ?>
<html>
<HEAD>	
<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
	<TITLE></TITLE>
               <META NAME="AUTHOR" CONTENT="Sistem Perizininan Mahasiswa Asing Dikti">
	
	<STYLE TYPE="text/css">
           @page {
                 size: A4;
    margin: 0;
}
	<!--
		@page { margin: 2cm }
		P { margin-bottom: 0.21cm }
	-->
	</STYLE>
</HEAD>
<BODY LANG="id-ID" DIR="LTR">
     <div class="page">
          <table>
               <tr>
                    <td width="20%">
               <center><img src="<?=$url_rewrite?>view/logo_dikti.jpg"  width="95px" height="91px"/></center>
                    </td>
                    <td width="70%">
                         <div ALIGN=CENTER STYLE="margin-bottom: 0cm; "><img src=""><h2>KEMENTERIAN RISET , TEKNOLOGI DAN <br/>PENDIDIKAN TINGGI</h2>
</div>

<div ALIGN=CENTER STYLE="margin-bottom: 0cm">Jalan Jenderal Sudirman
Pintu I, Senayan,  Jakarta - 10270</div>

<div ALIGN=CENTER STYLE="margin-bottom: 0cm">Telp. (021) 57946063 -
Fax. (021) 57946062</div>
                    </td>
               </tr>
          </table>
          
     
<div STYLE="margin-bottom: 0cm"><HR><HR>
</div>
<div STYLE="margin-bottom: 0cm"><BR>
</div>
<div STYLE="margin-bottom: 0cm">Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo "....";//echo $nmaks; ?>/E2.4/LN/<?php echo $data[tahun]; ?></P>
<div STYLE="margin-bottom: 0cm">Lampiran : 1 (satu) berkas</div>
<div STYLE="margin-bottom: 0cm">Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Permohonan Ijin Belajar</div>
<div STYLE="margin-bottom: 0cm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Mahasiswa Asing a.n <?php echo $data[namamahasiswa]; ?></div>
<div STYLE="margin-bottom: 0cm"><BR>
</div>
<div STYLE="margin-bottom: 0cm">Yth. Kepala Biro Perencanaan dan
Kerjasama Luar Negeri</P>
<div STYLE="margin-bottom: 0cm">Kementerian Pendidikan dan Kebudayaan</div>
<div STYLE="margin-bottom: 0cm">Jl. Jenderal Soedirman</div>
<div STYLE="margin-bottom: 0cm">Jakarta</div>
<div STYLE="margin-bottom: 0cm"><BR>
</div>
<P STYLE="margin-bottom: 0cm">Merujuk surat <?php echo $data[jabatan]; ?> Nomor
<?php echo $data[nosrtrek]; ?> tanggal <?php echo $UTILITY->format_tanggal_ind($data[tglsrtrek]); ?> perihal seperti tersebut pada pokok surat,
dengan hormat kami sampaikan bahwa ditinjau dari aspek akademik Direktorat Jenderal Pendidikan Tinggi dapat menyetujui  ijin belajar baru, atas nama :</P>
<table style="width: 100%">
<tr><td>Nama</td><td>:</td><td><?php echo $data[namamahasiswa]; ?></td></tr>
<tr><td>Tempat, Tanggal Lahir</td><td>:</td><td><?php echo $data[tempatlahir].",".$UTILITY->format_tanggal_ind($data[tanggallahir]); ?></td></tr>
<tr><td>Warga Negara</td><td>:</td><td><?php echo $data[country]; ?></td></tr>
<tr><td>Paspor</td><td>:</td><td><?php echo $data[nmrpaspor]; ?></td></tr>
<tr><td>Tempat Belajar/Program Studi</td><td>:</td><td><?php echo $data[namauniversitas];echo "/";echo $data[namaProdi]; ?></td></tr>
<tr><td>Pembiayaan</td><td>:</td><td><?php 
if($data[pembiayaan_idpembiayaan]==1){
echo $data[jenispembiayaan]; 
}else{
echo $data[jenispembiayaan]." : (".$data[sumber_pembiayaan].")";
}
?></td></tr>
<tr><td>Periode Ijin Belajar</td><td>:</td><td><?php echo "($data[LamaIjin]) ";echo $UTILITY->format_tanggal_ind($data[mulaiperiode])." s/d ".$UTILITY->format_tanggal_ind($data[batasperiode]); ?></td></tr>
</table>
<P STYLE="margin-bottom: 0cm">Kami mohon bantuan Bapak untuk memproses lebih lanjut persetujuan   ijin belajar baru  ini sesuai dengan ketentuan 
     yang berlaku serta memberitahukan kepada yang bersangkutan melalui pimpinan perguruan tinggi. <br/>
Sebagai bahan pertimbangan bagi Bapak,
terlampir kami sampaikan berkas mahasiswa asing yang bersangkutan.
Atas perhatian dan kerjasama Bapak,
kami ucapkan terimakasih.</P>
<P STYLE="margin-bottom: 0cm"><BR>
</P>
<div STYLE="margin-left: 7cm; margin-bottom: 0cm">a.n. 
     Direktur Jenderal Pendidikan Tinggi<br/>
Direktur Kelembagaan dan Kerjasama<br/>
u.b<br/>
Kepala Sub Direktorat Kerjasama Antar Lembaga</div>
<P STYLE="margin-left: 9.98cm; margin-bottom: 0cm"><BR><BR><BR>
</P>
<P STYLE="margin-left: 9.98cm; margin-bottom: 0cm"><BR>
</P>
<div STYLE="margin-left: 9.98cm; margin-bottom: 0cm">
<?php 
$s="select * from pimpinan";
$t=$DB->query($s);
$u=$DB->fetch_array($t);
echo strtoupper($u[namapimpinan]); ?>
</div>
<div STYLE="margin-left: 10.98cm; margin-bottom: 0cm">NIP.
<?php echo $u[nip]; ?></div>
<P STYLE="margin-bottom: 0cm"><BR>
</P>
<P STYLE="margin-bottom: 0cm">Tembusan :</P>
<OL>
	<LI>Dirjen Pendidikan Tinggi</LI>
	<LI>Direktur Kelembagaan dan Kerjasama, Ditjen Dikti</LI>
      <?php
      if($data[kodeWilayah]!="00"){
     echo "              <LI>Kopertis Wilayah $data[kodeWilayah]</LI>";
      }?>
	<LI>Rektor <?php echo $data[namauniversitas]; ?></LI>
	<LI>Kedubes <?php echo $data[country]; ?> Jakarta</LI>
</OL>
  <?php
  }
  ?>
</div>
</body>
     </html>