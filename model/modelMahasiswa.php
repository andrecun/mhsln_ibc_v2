<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
require_once __DIR__ . "/../utility/database/mysql_db.php";

class modelmahasiswa extends mysql_db {

     public function insertMahasiswa($data) {
                  $namamahasiswa = addslashes($data["namamahasiswa"]);
          $namamahasiswa2 = addslashes($data["namamahasiswa2"]);
          $tempatlahir = $data["tempatlahir"];
          $tanggallahir = $data["tanggallahir"];
          $sex = $data["sex"];
          $nationality_idnationality = addslashes($data["nationality_idnationality"]);
          $alamat = $data["alamat"];
          $city = addslashes($data["city"]);
          $province = $data["province"];
          $country = addslashes($data["country"]);
          $postal = $data["postal"];
          $alamatind = addslashes($data["alamatind"]);
          $cityind = $data["cityind"];
          $provinceid = $data["provinceind"];
          $postalind = $data["postalind"];
          $telp = $data["telp"];
             $telp2 = $data["telp2"];
          $foto=$data["foto"];
          $ekstension=$data["ekstension"];
          
          $level=$_SESSION["level{$this->ID}"];
          $universitas_session=trim($_SESSION['unversitas']);
         if($level==2)
              $universitas="universitas_iduniversitas='$universitas_session',";
          $query = "insert into mahasiswa set
                         namamahasiswa='$namamahasiswa',
                         namamahasiswa2='$namamahasiswa2',
                         tempatlahir='$tempatlahir',
                         tanggallahir='$tanggallahir',
                         sex='$sex',
                         nationality_idnationality='$nationality_idnationality',
                         alamat='$alamat',
                         city='$city',
                         province='$province',
                         country='$country',
                         postal='$postal',
                         alamatind='$alamatind',
                         cityind='$cityind',
                         provinceind='$provinceid',
                         postalind='$postalind', $universitas
                         foto='$foto',
                         telp='$telp',"
                  . "    telp2='$telp2', ekstension='$ekstension',tgl_update='$tgl_update' ";
                  $result = $this->query($query);
//print_r($this);
          //echo "$query";
//exit();
          return $result;
     }

     public function updateMahasiswa($data, $mode) {
            $tgl_update=date("Y-m-d");
          $kode=$data["kode"];
          //mode 1
          $namamahasiswa = addslashes($data["namamahasiswa"]);
          $namamahasiswa2 = addslashes($data["namamahasiswa2"]);
          $tempatlahir = $data["tempatlahir"];
          $tanggallahir = $data["tanggallahir"];
          $sex = $data["sex"];
          $nationality_idnationality = addslashes($data["nationality_idnationality"]);
          $alamat = $data["alamat"];
          $city = addslashes($data["city"]);
          $province = $data["province"];
          $country = addslashes($data["country"]);
          $postal = $data["postal"];
          $alamatind = addslashes($data["alamatind"]);
          $cityind = $data["cityind"];
          $provinceid = $data["provinceind"];
          $postalind = $data["postalind"];
          $telp = $data["telp"];
             $telp2 = $data["telp2"];
          $foto=$data["foto"];
          $query_mode1 = "update mahasiswa set
                         namamahasiswa='$namamahasiswa',
                         namamahasiswa2='$namamahasiswa2',
                         tempatlahir='$tempatlahir',
                         tanggallahir='$tanggallahir',
                         sex='$sex',
                         nationality_idnationality='$nationality_idnationality',
                         alamat='$alamat',
                         city='$city',
                         province='$province',
                         country='$country',
                         postal='$postal',
                         alamatind='$alamatind',
                         cityind='$cityind',
                         provinceind='$provinceid',
                         postalind='$postalind',
                         foto='$foto',
                         telp='$telp' , telp2='$telp2',tgl_update='$tgl_update' where kode='$kode' " ;
          
          //MODE 2
          $universitas_iduniversitas=$data["universitas_iduniversitas"];
          $fakultas_idfakultas=$data["fakultas_idfakultas"];
          $jurusan_idjurusan=$data["jurusan_idjurusan"];
          $jenjangstudi_idjenjangstudi=$data["jenjangstudi_idjenjangstudi"];
          $mulaibelajar=$data["mulaibelajar"];
          $periode_belajar_start=$data["periode_belajar-start"];
          $periode_belajar_end=$data["periode_belajar-end"];
          $lamaijin=$data["lamaijin"];
          $ket_program=$data["ket_program"];
          $penyelenggara_program=$data["penyelenggara_program"];
          $query_mode2="update mahasiswa set 
                  universitas_iduniversitas='$universitas_iduniversitas',
                    prodi_idprodi='$fakultas_idfakultas',
                    jurusan_idjurusan='$jurusan_idjurusan',
                    jenjangstudi_idjenjangstudi='$jenjangstudi_idjenjangstudi',
                    mulaibelajar='$mulaibelajar',
                    periode_belajar_awal='$periode_belajar_start',
                    periode_belajar_akhir='$periode_belajar_end',tgl_update='$tgl_update' ,
                         LamaIjin='$lamaijin' , ket_program='$ket_program' ,penyelenggara_program='$penyelenggara_program' 
                      where kode='$kode' ";
          
          
          //Mode 3
          $nmrpaspor=$data["nmrpaspor"];
          $mulaipassport=$data["mulaipassport"];
          $akhirpassport=$data["akhirpassport"];
          $passport1=$data["passport1"];
          $pembiayaan_idpembiayaan=$data["pembiayaan_idpembiayaan"];
          $sumber_pembiayaan=$data["sumber_pembiayaan"];
          $keuangan=$data["keuangan"];
          $pernyataan1=$data["pernyataan1"];
          $kesehatan=$data["kesehatan"];
          $loa=$data["loa"];
          $kitas=$data["kitas"];
          $skld=$data["skld"];
          $tgl_kitas=$data["tgl_kitas"];
          $tgl_skld=$data["tgl_skld"];
          $ijazah=$data["ijazah"];
          
          $no_kitas=$data["no_kitas"];
          $no_skld=$data["no_skld"];
          $tgl_kitas_akhir=$data["tgl_kitas_akhir"];
          
          $query_mode3=" update mahasiswa set
               nmrpaspor='$nmrpaspor',
          mulaipassport='$mulaipassport',
          akhirpassport='$akhirpassport',
          passport1='$passport1',
          pembiayaan_idpembiayaan='$pembiayaan_idpembiayaan',
          sumber_pembiayaan='$sumber_pembiayaan',
          keuangan='$keuangan',
          pernyataan1='$pernyataan1',
          kesehatan='$kesehatan',
          loa='$loa' ,"
                  . "kitas='$kitas',"
                  . "tglkitas='$tgl_kitas',"
                  . "skld='$skld',"
                  . "tglskld='$tgl_skld',tgl_update='$tgl_update' ,"
                       . "no_kitas='$no_kitas', no_skld='$no_skld', tgl_kitas_akhir='$tgl_kitas_akhir', ijazah='$ijazah' "
                  . "where kode='$kode' ";
          
          switch ($mode) {
               case 1:
                    $query=$query_mode1;
                    break;
               case 2:
                    $query=$query_mode2;
                    break;
               case 3:
                    $query=$query_mode3;
                    break;
          }
             $result = $this->query($query);
             return $result;
          
     }

     public function deleteMahasiswa($id) {
            $query = "delete from mahasiswa where kode='$id'";
          //Execute query
          $result = $this->query($query);

          return $result;
     }

     public function readMahasiswa($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from mahasiswa $paramater";
          //Execute query
          $result = $this->query($query);
          //  echo $result;
          //Wrap Output Query
          $data = $this->fetch_array($result);

          return $data;
     }

     public function readMahasiswaFull($data) {
          $parameter = "";
          $count = 0;
          foreach ($data as $key => $value) {
               if ($count == 0)
                    $paramater = "where $key='$value'";
               else
                    $paramater.=" AND $key='$value'";
               $count++;
          }
          $query = "select * from mahasiswa $paramater";
          //Execute query
          $result = $this->query($query);
          //  echo $result;
          //Wrap Output Query
          $data = $this->fetch_object($result);

          return $data;
     }

}

?>