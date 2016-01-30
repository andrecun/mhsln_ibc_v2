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
                                             <i class="glyphicon glyphicon-user"></i> <p>Login</p>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="panel-body">
                                             <form class="form-horizontal" role="form" action="<?=$url_rewrite?>login" method="post">
                                                       <input type="hidden" name="Login" value="masuk"/>
                                                  <div class="form-group">
                                                       <label for="inputUsername" class="col-md-3 control-label">Username</label>
                                                       <div class="col-md-9">
                                                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <label for="inputPassword" class="col-md-3 control-label">Password</label>
                                                       <div class="col-md-9">
                                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                                                       </div>
                                                  </div>


                                                 
                                                  <div class="form-group">
                                                       <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" class="btn btn-primary">Login</button>
                                                       </div>
                                                  </div>

                                                 <!-- <div class="form-group">

                                                       <label class="col-md-offset-3  col-md-9 control-label te-regular-font">Jika anda lupa akun Anda <a href="forget-password.html">klik disini</a>.</label>
                                                  </div>-->

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