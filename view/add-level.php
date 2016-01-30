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
                         <div class="panel panel-default">
                              <!-- Default panel contents -->
                              <div class="panel-heading te-panel-heading">
                                   <i class="glyphicon glyphicon-th-large"></i> <p>Add Level Information</p>
                              </div>

                              <div class="clearfix"></div>

                              <div class="panel-body">
                                   <form class="form-horizontal" role="form">
                                        <div class="form-group has-error">
                                             <label for="inputKode" class="col-md-3 control-label">Kode</label>
                                             <div class="col-md-9">
                                                  <input type="text" class="form-control" id="inputKode" name="kode" placeholder="Kode">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="inputLevel" class="col-md-3 control-label">Level</label>
                                             <div class="col-md-9">
                                                  <input type="text" class="form-control" id="inputLevel" name="level" placeholder="Level">
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <div class="col-md-offset-3 col-md-9">
                                                  <div class="alert te-no-margin alert-warning alert-dismissible" role="alert">
                                                       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                       </button>
                                                       <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                                  </div>
                                             </div>
                                        </div>
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