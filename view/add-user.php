<!DOCTYPE html>
<html lang="en">
     <?php
     include "view/default/head.php";
     ?>
     <?php
             
               $qWhere = array("iduser" => $user_id);
               $data = $USER->readUser($qWhere);
               //Hitung jmlh data
              // $UTILITY->show_data($data);
               if($data!="")
                    $jData = count($data);
               else
                    $jData=0;
               if ($jData > 0) {
                    $userlogin = $data->userlogin;
                    $password = $data->password;
                    $level_idlevel = $data->level_idlevel;
                    $universitas= $data->universitas_iduniversitas;
                    $email=$data->email;
                    $kode_wilayah_user=$data->kode_wilayah;
                    $cek_eksist=1;
               } else {
                    $cek_eksist=0;
                    $email="";
                    $userlogin = "";
                    $password = "";
                    $level_idlevel ="";
                    $universitas= "";
                    $kode_wilayah_user="";
               }
               if($status_edit==1){
    
                       if($cek_eksist==0){
                          
                            $UTILITY->popup_message("Maaf data user tidak ada");
                            $UTILITY->location_goto("content/user");
                        }
               }
             //  echo "<h1>$universitas</h1>";
               ?>
     
               <script>
                    
$(document).ready(function() { $("#inputUniversity").select2({
     <?php
     if($universitas!=""){
          $iduniversitas=trim($universitas);
     $qry_universitas=$DB->query("select namauniversitas from universitas where kodeUniversitas='$iduniversitas'") ;
      
	if($rown=$DB->fetch_object($qry_universitas))
	{
		$text_universitas=$rown->namauniversitas;
	}
     ?>
               initSelection: function (element, callback) {

      callback({ id: "<?=$iduniversitas?>", text: '<?=$iduniversitas?> - <?=$text_universitas?>' });
},
     <?php }?>
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
                  
                  
               $().ready(function() {
	// validate signup form on keyup and submit
	$("#userForm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
                                        level: "required",
                                        universitas: "required"
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
            	                     level: {
				required: "Please choose level user"
			},
                    inputUniversity: {
				required: "Please choose institution"
			}
			
			
		}
	});
               });
          </script>
               <style type="text/css">
#penggunaForm label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
      color: red;
}
</style>
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
                         <div class="panel panel-default">
                              <!-- Default panel contents -->
                              <div class="panel-heading te-panel-heading">
                                   <i class="glyphicon glyphicon-th-large"></i> <p>Add User Information</p>
                              </div>

                              <div class="clearfix"></div>

                              <div class="panel-body">
                                   <form class="form-horizontal" name="userForm" id="userForm" role="form" method="post" action="<?= $url_rewrite ?>proses/user/">
                                        <div class="form-group ">
                                             <label for="inputInstansi" class="col-md-3 control-label">Instansi</label>
                                             <div class="col-md-9">
                                                  <input class="form-control" type="hidden" id="inputUniversity" name="universitas"/>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputUsername" class="col-md-3 control-label">Username</label>
                                             <div class="col-md-9">
                                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=$userlogin?>">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputPassword" class="col-md-3 control-label">Password</label>
                                             <div class="col-md-9">
                                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="inputEmail" class="col-md-3 control-label">Email</label>
                                             <div class="col-md-9">
                                                  <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?=$email?>">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputLevel" class="col-md-3 control-label">Level</label>
                                             <div class="col-md-9">
                                                  <select class="form-control" id="level" name="level">
                                                       <option value="">Pilih Level</option>
                                                       <?php
                                                                                $qry = $DB->query("select idlevel,nama from level");
                                                                                while ($row = $DB->fetch_object($qry)) {
                                                                                     $id_level = $row->idlevel;
                                                                                     $nama_level = $row->nama;
                                                                                     if ($id_level == $level_idlevel)
                                                                                          echo "<option value=\"$id_level\" selected>$nama_level</option>";
                                                                                     else
                                                                                          echo "<option value=\"$id_level\" >$nama_level</option>";
                                                                                }
                                                                                ?>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="inputLevel" class="col-md-3 control-label">Kode Wilayah</label>
                                             <div class="col-md-9">
                                                  <select class="form-control" id="kode_wilayah" name="kode_wilayah">
                                                       <option value="">All</option>
                                                       <?php
                                                       $qry = $DB->query("select id_wilayah,kode_wilayah from kode_wilayah");
                                                       while ($row = $DB->fetch_object($qry)) {
                                                            $id_wilayah = $row->id_wilayah;
                                                            $kode_wilayah = $row->kode_wilayah;
                                                            if ($kode_wilayah == $kode_wilayah_user)
                                                                 echo "<option value=\"$kode_wilayah\" selected>$kode_wilayah</option>";
                                                            else
                                                                 echo "<option value=\"$kode_wilayah\" >$kode_wilayah</option>";
                                                       }
                                                       ?>
                                                  </select>
                                             </div>
                                        </div>
                                        
                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="reset" class="btn btn-default">Reset</button>
                                             </div>
                                        </div>
                                        <?php
if ($user_id != "")
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"edit\">";
else
     echo"<input type=\"hidden\"  name=\"kondisi\" value=\"tambah\">";

echo"<input type=\"hidden\"  name=\"user_id\" value=\"$user_id\">";
?>
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