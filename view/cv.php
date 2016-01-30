<html>
<head>
</head>
<body>
<?php

include 'config/application.php';
$id = $_SESSION['user_id'];
/*
$query="select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.iduniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join fakultas F on F.idfakultas=M.fakultas_idfakultas 
               
     ";*/

$sql = "SELECT mahasiswa.*,pembiayaan.*,user.*,jenjangstudi.*,jurusan.*,fakultas.*,universitas.namauniversitas,nationality.*,ijin.*
	FROM mahasiswa,user,jenjangstudi,jurusan,fakultas,universitas,nationality,ijin,pembiayaan 
	where user.iduser=mahasiswa.user_iduser 
	and jenjangstudi.idjenjangstudi=mahasiswa.jenjangstudi_idjenjangstudi 
	and jurusan.idjurusan=mahasiswa.jurusan_idjurusan
	and fakultas.idfakultas=mahasiswa.fakultas_idfakultas
	and universitas.iduniversitas=mahasiswa.universitas_iduniversitas
	and mahasiswa.nationality_idnationality=nationality.idnationality
	and mahasiswa.idmahasiswa=ijin.mahasiswa_idmahasiswa
	and mahasiswa.pembiayaan_idpembiayaan=pembiayaan.idpembiayaan
	and mahasiswa.kode='".$KODE."'";
              
               $result=$DB->query($sql);
 	while ($data=$DB->fetch_array($result)) {
	//$no++;
  ?>
  <table align="center" border="0"><tr>
<td colspan="4"><b><u>APPLICANT INFORMATION</u></b></td>
	  </tr>
	<tr>
	  <td width="140"><strong>Number/Reg.Number</strong></td>
	  <td>:</td>
	  <td><?php echo $data['kode']."/".$data['idmahasiswa']; ?></td>
	  <td rowspan="5" valign="top"><?php
	if($data[foto]==""){
	echo "<img src=\"{$url_rewrite}/data/call.jpg\" height=\"104\" width=\"84\" />";
	}else{
      echo "<img src='{$url_rewrite}data/{$data['kode']}/{$data[foto]}' height=\"104\" width=\"84\" />";
	}
	?></td>
	</tr>
	  <tr>
	  <td width="140"><strong>Name</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namamahasiswa']." ".$data['namamahasiswa2']; ?></td>
	  </tr>
	  <tr>
	  <td><strong>Place / Date of Birth</strong></td>
	  <td>:</td>
	  <td><?php echo $data['tempatlahir']; ?> / 
	    <?php 
	  echo $UTILITY->format_tanggal_ind($data['tanggallahir']); 
	  ?></td>
	  </tr>
	  <tr>
	  <td><strong>Gender</strong></td>
	  <td>:</td>
	  <td><?php if($data['sex']==0){ echo "Perempuan"; }else{ echo "Laki-Laki";}?></td>
	  </tr>
	  <tr>
	  <td><strong>Nationality</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namanegara']; ?></td>
	  </tr>
	  <tr>
	  <td><strong>Permanent/Home Address</strong></td>
	  <td>:</td>
	  <td><?php echo $data['alamat']; ?></td>
	  <td>&nbsp;</td>
    </tr><tr>
	  <td><strong>City</strong></td>
	  <td>:</td>
	  <td><?php echo $data['city']; ?></td>
	  <td>&nbsp;</td>
	  </tr><tr>
	  <td><strong>Province / Region</strong></td>
	  <td>:</td>
	  <td><?php echo $data['province']; ?></td>
	  <td>&nbsp;</td>
	  </tr><tr>
	  <td><strong>Country</strong></td>
	  <td>:</td>
	  <td><?php echo $data['country']; ?></td>
	  <td>&nbsp;</td>
	  </tr><tr>
	  <td><strong>Phone / Mobile Number</strong></td>
	  <td>:</td>
	  <td><?php echo $data['telp']; ?> / <?php echo $data['telp2']; ?></td>
	  <td>&nbsp;</td>
	  </tr><tr>
	  <td><strong>Email</strong></td>
	  <td>:</td>
	  <td><?php echo $data['email']; ?></td>
	  <td>&nbsp;</td>
	  </tr><tr>
	  <td colspan="4"><strong><u>PROPOSED STUDY</u></strong></td>
	  </tr>
	<tr>
	  <td><strong>Period of Study</strong></td>
	  <td>:</td>
	  <td><?php echo $UTILITY->format_tanggal_ind($data['mulaibelajar']); ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>University</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namauniversitas']; ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Faculty</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namafakultas']; ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Study Program</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namajurusan']; ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Diploma / Degree</strong></td>
	  <td>:</td>
	  <td><?php echo $data['namajenjangstudi']; ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="4"><strong><u>SUPPORTING DOCUMENTS</u></strong></td>
    </tr>
	  <tr>
	  <td><strong>Passport : </strong></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number</td>
	  <td>:</td>
	  <td><?php echo "No : ".$data['nmrpaspor']."<br> ";
	  if($data['passport1']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['passport1']);
	  //system ("print $data['passport1']"); 
	  }else{
	  echo "Tidak ada berkas";
	  } ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Issue</td>
	  <td>:</td>
	  <td><?php echo $UTILITY->format_tanggal_ind($data[mulaipassport]); ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Expiry</td>
	  <td>:</td>
	  <td><?php echo $UTILITY->format_tanggal_ind($data[akhirpassport]); ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="4"><strong>Sponsorship : </strong></td>
    </tr>
	  <tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type</td>
	  <td>:</td>
	  <td><?php echo $data[jenispembiayaan]; ?></td>
	  <td>&nbsp;</td>
    </tr>
	<tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Source</td>
	  <td>:</td>
	  <td><?php echo $data[sumber_pembiayaan]; ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Expiry</td>
	  <td>:</td>
	  <td><?php echo $UTILITY->format_tanggal_ind($data[akhirsponsor]); ?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Letter Statement</strong></td>
	  <td>:</td>
	  <td><?php echo " file 1 :";
	  if($data['pernyataan1']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['pernyataan1']);
	  //system("print $data['pernyataan1']");
	  //echo " [<a href='".$data['pernyataan1']."'>lihat</a>]";
	  }else{
	  echo "Tidak ada berkas";
	  }
	  echo "<br>file 2 :";
	  if($data['pernyataan2']<>""){
	  echo "Berkas terlampir";
	  //echo " [<a href='".$data['pernyataan2']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas";
	  }?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Health Insurance</strong></td>
	  <td>:</td>
	  <td><?php if($data['kesehatan']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['kesehatan']);
	  //system("print $data['kesehatan']");
	  //echo " file  : [<a href='".$data['kesehatan']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas";
	  }?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Certification of Financial Guarantee</strong></td>
	  <td>:</td>
	  <td><?php if($data['keuangan']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['keuangan']);
	  //system("print $data['keuangan']");
	  //echo " file  : [<a href='".$data['keuangan']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas";
	  }?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>LOA Statement</strong></td>
	  <td>:</td>
	  <td><?php if($data['loa']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['loa']);
	  //system ("print $data['loa']");
	  //echo " file  : [<a href='".$data['loa']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas";
	  }?></td>
	  <td>&nbsp;</td>
	</tr>
<tr valign="top">
	  <td><strong>KITAS</strong></td>
	  <td>:</td>
	  <td><?php if($data['kitas']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['kitas']);
	  //system ("print $data['kitas']");
	  //echo " file  : [<a href='".$data['kitas']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas!";
	  }?></td>
	  <td>&nbsp;</td>
</tr>
	<tr valign="top">
	  <td><strong>SKLD</strong></td>
	  <td>:</td>
	  <td><?php if($data['skld']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['skld']);
	  //system ("print $data['skld']");
	  //echo " file  : [<a href='".$data['skld']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas!";
	  }?></td>
	  <td>&nbsp;</td>
	</tr>
	<tr valign="top">
	  <td><strong>Surat Rekomendasi</strong></td>
	  <td>:</td>
	  <td><?php if($data['srtrek']<>""){
	  echo "Berkas terlampir";
	  //printer_write($handle, $data['srtrek']);
	  //system("print $data['srtrek']");
	  //echo " file  : [<a href='".$data['srtrek']."'>lihat</a>]"; 
	  }else{
	  echo "Tidak ada berkas!";
	  }?></td>
      <td>&nbsp;</td>
	</tr>
</table>
<?php
  }
  ?>
</body>
</html>