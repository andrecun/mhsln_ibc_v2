<!DOCTYPE html>
<html lang="en">
  <?php
  include "view/default/head.php";
  ?>
  <body>
      <div class="container fill">
          <?php
  include "view/default/img_header.php";
  ?>

        <div class="row te-container te-row">
          <?php
  include "view/default/right_menu.php";
  ?>
             
              <script>
$(document).ready(function() { $("#inputStatus").select2(); });
$(document).ready(function() { $("#inputMajor").select2(); });
$(document).ready(function() { $("#inputUniversity").select2({
     /*     initSelection: function (element, callback) {

      callback({ id: "031037", text: '031037 - Universitas Gunadarma' });
},*/
     placeholder: "Pilih Universitas",
       allowClear: true,
    minimumInputLength: 2,

    ajax: {
      url: "<?=$url_rewrite?>api/api_select2_universitas.php",
      dataType: 'json',
      data: function (term, page) {
        return {
          q: term
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    }
  })
  
                  });
                  
                  
$(document).ready(function() { $("#inputFaculty").select2({
     /*     initSelection: function (element, callback) {

      callback({ id: "031037", text: '031037 - Universitas Gunadarma' });
},*/
placeholder: "Pilih Prodi",
       allowClear: true,
    minimumInputLength: 2,

    ajax: {
      url: "<?=$url_rewrite?>api/api_select2_prodi.php",
      dataType: 'json',
      data: function (term, page) {
        return {
          q: term
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    }
  })
  
                  });
                  
                      $(function() {
                                                               $("#periode_belajar_start").datepicker({
                                                               yearRange: '-70:+30',
                                                                       changeMonth: true,
                                                                    changeYear:true,
                                                                       numberOfMonths: 3,
                                                                       dateFormat: 'd M yy ',
                                                                       onClose: function(selectedDate) {
                                                                       $("#periode_belajar_end").datepicker("option", "minDate", selectedDate);
                                                                               var lama=(bulan_studi($('#lamaijin').val())+1)*31;
                                                                               var nyd = new Date(selectedDate);
                                                                               nyd.setDate(nyd.getDate() + lama);
                                                                                //alert(nyd);
                                                                            $("#periode_belajar_end").datepicker("option", "maxDate", nyd);
                                                                         //$("#periode_belajar_end").datepicker("option", "maxDate", " '+ "+lama+"M'");
                                                                       }
                                                               });
                                                                       $("#periode_belajar_end").datepicker({
                                                               yearRange: '-70:+30',
                                                                       changeMonth: true,
                                                                           changeYear: true,
                                                                       numberOfMonths: 3,
                                                                       dateFormat: 'd M yy ',
                                                                       //maxDate: " '+ "+bulan_studi($('#lamaijin').val())+"M'",
                                                                       //onClose: function(selectedDate) {
                                                                      // $("#periode_belajar_start").datepicker("option", "maxDate", selectedDate);
                                                                 
                                                                       //}
                                                               });
                                                               });
</script>
          <div class="col-md-9 te-content te-col-md-9">
              <div class="jumbotron">
                <h1>Report Filter</h1>
                <hr />
                
                <?php
                //keyword=&status=&major=&university=&faculty=&btnSubmit=
             //   $UTILITY->show_data($_POST);
                        $keyword=$_POST['keyword'];
                        $status=$_POST['status'];
                        $universitas=$_POST['university'];
                        $country=$_POST["country"];
                        $faculty=$_POST["faculty"];
                        $periode_belajar_start=$_POST["periode_belajar_start"];
                        $periode_belajar_end=$_POST["periode_belajar_end"];
                        
                ?>
                <form role="form te-form-filter" method="post" action="<?=$url_rewrite?>content/report">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4 te-padding-top">
                        <input type="text" class="form-control" value="<?=$keyword?>" id="inputKeyword" name="keyword" placeholder="Type Keyword">
                      </div>

                      <div class="col-md-4 te-padding-top">
                        <select class="form-control" id="inputStatus" name="status">
                             <option value="">Select Status</option>
                          <?php
                                                                                $qry = $DB->query("select idstatus,namastatus from status");
                                                                                while ($row = $DB->fetch_object($qry)) {
                                                                                     $idstatus= $row->idstatus;
                                                                                     $namastatus= $row->namastatus;
                                                                                     if($idstatus==$status)
                                                                                     {  echo "<option value=\"$idstatus\" selected>$namastatus</option>";
                                                                                     $par_status=$status;     
                                                                                     $status=$namastatus;
                                                                                          
                                                                                     
                                                                                     }
                                                                                     else
                                                                                          echo "<option value=\"$idstatus\" >$namastatus</option>";
                                                                                     
                                                                                }
                                                                                ?>
                        </select>
                      </div>
<div class="col-md-4 te-padding-top">
                        <select class="form-control" id="inputMajor" name="country">
                          <option value="">Pilih Negara</option>
                        <?php
                                                                                $qry = $DB->query("select country from mahasiswa group by country");
                                                                                while ($row = $DB->fetch_object($qry)) {
                                                                                     $p_country= $row->country;
                                                                                     if($country==$p_country)
                                                                                             echo "<option value=\"$country\" selected>$country</option>";
                                                                                             else
                                                                                          echo "<option value=\"$p_country\" >$p_country</option>";
                                                                                }
                                                                                ?>                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4 te-padding-top">

                          <?php
                          if ($_SESSION["level$ID"]=='1' &&$_SESSION["level$ID"]=='4') {
                              ?>
                              <input class="form-control" type="hidden" id="inputUniversity" name="university"/>
                              <?php
                          }else{
                          ?>
                          <select onchange="tampilkanProdi();" class="form-control" name="university" id="universitas_iduniversitas">
                              <?php
                              $ses_uni=trim($_SESSION[unversitas]);
                              if ($_SESSION["level$ID"]!='1')
                                  $where=" where kodeUniversitas='{$ses_uni}' ";
                              else {
                                  $where = '';
                                  echo "<option value=\"\" >All</option>";
                              }
                              $qry = $DB->query("select kodeUniversitas,namauniversitas from universitas $where");
                              while ($row = $DB->fetch_object($qry)) {
                                  $kodeUniversitas = trim($row->kodeUniversitas);
                                  $nama_universitas2 = $row->namauniversitas;
                                  if ($kodeUniversitas == $universitas_iduniversitas)
                                      echo "<option value=\"$kodeUniversitas\" selected>$nama_universitas2</option>";
                                  else
                                      echo "<option value=\"$kodeUniversitas\" >$nama_universitas2</option>";
                              }
                              ?>
                          </select>
                        <?php
                          }
                          ?>
                      </div>

                      <!--<div class="col-md-4 te-padding-top">
                                 <input class="form-control" type="hidden" id="inputFaculty" name="faculty"/>
                          
                      </div>-->
                      <div class="col-md-4 te-padding-top">
                                                            <div class="input-group">
                                                                 <input type="text" readonly="1"  class="form-control" id="periode_belajar_start" value="<?= $periode_belajar_start ?>" name="periode_belajar_start" placeholder="Tanggal Awal Report">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                                               
                                                       <div class="col-md-4 te-padding-top">
                                                            <div class="input-group">
                                                                 <input type="text"  readonly="1"  class="form-control" id="periode_belajar_end" value="<?= $periode_belajar_end ?>" name="periode_belajar_end" placeholder="Tanggal Akhir Report">
                                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                       </div>
                    </div>
                                              
                                                  
                  </div>

                


                  <div class="form-group te-no-margin">
                    <div class="col-md-12 te-form-filter">
                         <a href="<?=$url_rewrite?>content/student " class="btn col-md-2 btn-warning   btn-sm te-pull-right">Reset</a>
                      <button type="submit" name="btnSubmit" class="btn col-md-2 btn-primary btn-sm te-pull-right">Search</button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                </form>
              </div>

              <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading te-panel-heading"><i class="glyphicon glyphicon-th-list"></i> <p>Hasil Report</p>
                                      </div>

                <div class="clearfix"></div>

                <div class="panel-body">
                     
                     <?php
                       
                                          $keyword=$_POST['keyword'];
                                             if ($keyword==""){
                                                  $keyword="-";
                                             }  else {
                                                  $par_keyword="";
                                             }
                                             $par_status=$_POST['status'];
                                              if ($status==""){
                                                  $status="All";
                                             }
                                               if ($universitas==""){
                                                  $universitas="All";
                                                 // echo "masuk";
                                             }else{
                                                    $qry = $DB->query("select kodeUniversitas,namauniversitas from universitas where kodeUniversitas='$universitas'");
                                                                 while ($row = $DB->fetch_object($qry)) {
                                                                      $kodeUniversitas_fix = trim($row->kodeUniversitas);
                                                                      $nama_universitas = $row->namauniversitas;
                                                                 }
                                             }
                                               if ($country==""){
                                                  $country="All";
                                                  $par_country="";
                                             }
                                             else $par_country="$country";
                                               if ($periode_belajar_start==""){
                                                  $text_periode_start="-";
                                             }  else {
                                                  $text_periode_start=$periode_belajar_start;
}
      if ($periode_belajar_end==""){
                                                  $text_periode_end="-";
                                             }  else {
                                                  $text_periode_end=$periode_belajar_end;
}
 $periode_belajar_start=$UTILITY->format_tanggal_db($_POST["periode_belajar_start"]);
                        $periode_belajar_end=$UTILITY->format_tanggal_db($_POST["periode_belajar_end"]);
                     echo "<p>Keyword : $keyword <br/>Status Perijinan : $status <br/> "
                             . "Univesitas : $universitas- $nama_universitas <br/> Negara : $country"
                             . "<br/> Tanggal Awal: $text_periode_start <br/> Tanggal Akhir : $text_periode_end</p>";
                    
                     ?>
                <a href="<?= $url_rewrite ?>content/report/dashboard_report/<?= $par_keyword?>/<?= $par_status ?>/<?= $kodeUniversitas_fix ?>/<?= $par_country ?>/<?=trim($periode_belajar_start)?>/<?=trim($periode_belajar_end)?>" class="btn btn-primary ">Download Excel</a>

                   <!--<a href="<?= $url_rewrite ?>content/ekstension/add " class="btn btn-primary ">PDF</a>-->

                     <!-- Table -->
                <!--    <table class="table table-striped table-bordered dataTable no-footer" role="grid" id="te_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="20%">Nama</th>
                      <th width="10%">Institusi</th>
                      <th width="10%">Status</th>
                      <th width="10%">Tipe Dokumen</th>
                      <th width="10%">Tanggal Perubahan</th>
                      <th width="10%">Lama Ijin</th>
                      <th width="30%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                                                  <td colspan="5" class="dataTables_empty">Loading data from server</td>
                                             </tr>


                  </tbody>
                </table>-->
              </div>
              <!-- end of panel body -->

              </div>

              
          </div>
        </div>


          <?php
  include "view/default/footer.php";
  ?>
    </div> <!-- /container -->
  </body>
</html>