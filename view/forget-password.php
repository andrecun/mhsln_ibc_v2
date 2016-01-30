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
          <div class="col-md-3 te-menubar">
            <div class="list-group">
              <p class="list-group-item active te-menu-title">Main Menu</p>
              <a href="#" class="list-group-item">Home</a>
              <a href="#" class="list-group-item">User Admin</a>
              <a href="#" class="list-group-item">Student Admin</a>
              <a href="#" class="list-group-item">Guest Book</a>
              <a href="#" class="list-group-item">Institution Admin</a>
              <a href="#" class="list-group-item">Faculty Admin</a>
              <a href="#" class="list-group-item">Major Admin</a>
              <a href="#" class="list-group-item">List of News</a>
              <a href="#" class="list-group-item">Level of Study Admin</a>
              <a href="#" class="list-group-item">Level</a>
              <a href="#" class="list-group-item">Leader Admin</a>
              <a href="#" class="list-group-item">Report</a>
              <a href="#" class="list-group-item">Guide</a>
              <a href="#" class="list-group-item">Contact Us</a>
              <a href="#" class="list-group-item">Log Out</a>
            </div>
          </div>
          <div class="col-md-9 te-content te-col-md-9">
              <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading te-panel-heading">
                  <i class="glyphicon glyphicon-th-large"></i> <p>Fill User Information</p>
                </div>

                <div class="clearfix"></div>

                <div class="panel-body">
                  <form class="form-horizontal" role="form">

                    <div class="form-group">
                      <label for="inputNama" class="col-md-3 control-label">Nama</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputTanggalLahir" class="col-md-3 control-label">Tanggal Lahir</label>
                      <div class="col-md-9">
                        <div class="input-group">
                          <input type="text" class="form-control" id="inputTanggalLahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail" class="col-md-3 control-label">Email</label>
                      <div class="col-md-9">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputNegaraAsal" class="col-md-3 control-label">Negara Asal</label>
                      <div class="col-md-9">
                        <select class="form-control">
                          <option>Pilih Negara Asal</option>
                          <option>Afganishtan</option>
                          <option>Singapora</option>
                          <option>Malaysia</option>
                        </select>
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
                        <button type="submit" class="btn btn-primary">Process</button>
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