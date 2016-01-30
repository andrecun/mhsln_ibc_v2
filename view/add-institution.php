<!DOCTYPE html>
<html lang="en">
     <?php
     include "view/default/head.php";
     ?>
     <?php
             
               $qWhere = array("iduniversitas" => $id);
               $data = $UNIVERSITAS->readUniversitas($qWhere);
               //Hitung jmlh data
               
               if($data!="")
                    $jData = count($data);
               else
                    $jData=0;
               if ($jData > 0) {
                    $iduniversitas= $data->idunversitas;
                    $namauniversitas= $data->namauniversitas;
                    $kode= $data->kode;
                    $cek_eksist=1;
               } else {
                    $cek_eksist=0;
                    $iduniversitas= "";
                    $namauniversitas= "";
                    $kode= "";

               }
               if($status_edit==1){
    
                       if($cek_eksist==0){
                          
                            $UTILITY->popup_message("Maaf data univeritas tidak ada");
                            $UTILITY->location_goto("content/institution");
                        }
               }
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
                    <script>
                         $().ready(function() {
                         // validate signup form on keyup and submit
                         $("#frmInstitution").validate({
                         rules: {
                         inputKode: required,
                         inputInstansi: required,
                    }
                    messages:{
                          inputKode: {
                                         required: "Please enter a institution kode "      },
                         inputInstansi: {
                                         required: "Please enter a instition name"      }
                    }});
               
                         </script>
                    <div class="col-md-9 te-content te-col-md-9">
                         <div class="panel panel-default">
                              <!-- Default panel contents -->
                              <div class="panel-heading te-panel-heading">
                                   <i class="glyphicon glyphicon-th-large"></i> <p>Add User Information</p>
                              </div>

                              <div class="clearfix"></div>

                              <div class="panel-body">
                                   <form class="form-horizontal" role="form" id="frmInstitution" method="post" action="<?= $url_rewrite ?>proses/institution/">
                                        <div class="form-group ">
                                             <label for="inputKode" class="col-md-3 control-label">Kode</label>
                                             <div class="col-md-9">
                                                  <input value="<?=$kode?>" type="text" class="form-control" id="inputKode" name="kode" placeholder="Kode">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="inputInstansi" class="col-md-3 control-label">Nama Instansi/Universitas</label>
                                             <div class="col-md-9">
                                                  <input value="<?=$namauniversitas?>"  type="text" class="form-control" id="inputInstansi" name="namauniversitas" placeholder="Nama Instansi/Universitas">
                                             </div>
                                        </div>
                                                <?php
if ($id!= "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

echo"<input type=\"hidden\"  name=\"iduniversitas\" value=\"$id\">";
?>
                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" class="btn btn-primary">Save</button>
                                             </div>
                                        </div>
                                   </form>
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