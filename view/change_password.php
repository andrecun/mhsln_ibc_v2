<!DOCTYPE html>
<html lang="en">
     <?php
     include "view/default/head.php";
     ?>
     <?php
     $user_id = $_SESSION['user_id'];
     ?>

     <script>


          $().ready(function() {
               jQuery.validator.addMethod("noSpace", function(value, element) {
                    return value.indexOf(" ") < 0 && value != "";
               }, "No space please and don't leave it empty");
// validate signup form on keyup and submit
               $("#userForm").validate({
                    rules: {
                         oldpassword: {
                              required: true,
                              minlength: 2
                         },
                         password: {
                              required: true,
                              noSpace: true,
                              minlength: 5
                         },
                         second_password: {
                              required: true,
                              noSpace: true,
                              equalTo: "#password",
                              minlength: 5
                         },
                    },
                    messages: {
                         oldpassword: {
                              required: "Please enter old password",
                         },
                         password: {
                              required: "Please provide a password",
                              minlength: "Your password must be at least 5 characters long"
                         },
                         second_password: {
                              required: "Please provide a password same as password",
                              equalTo: "Your Password must be same as password"
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
                                   <i class="glyphicon glyphicon-th-large"></i> <p>Change Password</p>
                              </div>

                              <div class="clearfix"></div>

                              <div class="panel-body">
                                   <form class="form-horizontal" name="userForm" id="userForm" role="form" method="post" action="<?= $url_rewrite ?>proses/password/">


                                        <div class="form-group">
                                             <label for="inputUsername" class="col-md-3 control-label">Old-Password</label>
                                             <div class="col-md-9">
                                                  <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old password" value="">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputPassword" class="col-md-3 control-label">Password</label>
                                             <div class="col-md-9">
                                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="inputEmail" class="col-md-3 control-label">Verify Password</label>
                                             <div class="col-md-9">
                                                  <input type="password" class="form-control" id="second_password" name="second_password" placeholder="verify password" value="">
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