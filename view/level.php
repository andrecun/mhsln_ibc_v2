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

        <div class="row te-container">
          <?php
  include "view/default/right_menu.php";
  ?>
          <div class="col-md-9 te-content">
              

              <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading te-panel-heading"><i class="glyphicon glyphicon-th-list"></i> <p>List of Levels</p>
                      <a href="#" class="btn btn-primary btn-xs te-pull-right">Add New</a>
                </div>

                <div class="clearfix"></div>
                <div class="panel-body">
                  <div class="table-responsive">

                <!-- Table -->
                <table class="table table-striped table-bordered dataTable no-footer" role="grid" id="te_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Level Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- start of item list -->
                    <tr>
                      <td>Admin/Bag. Kelembagaan DIKTI</td>
                      <td>
                          <a href="#" class="btn btn-default btn-xs te-btn">Edit</a>
                          <a href="#" class="btn btn-danger btn-xs te-btn">Delete</a>
                      </td>
                    </tr>
                    <!-- end of item list -->

                    <!-- start of item list -->
                    <tr>
                      <td>Member/Mahasiswa</td>
                      <td>
                          <a href="#" class="btn btn-default btn-xs te-btn">Edit</a>
                          <a href="#" class="btn btn-danger btn-xs te-btn">Delete</a>
                      </td>
                    </tr>
                    <!-- end of item list -->

                    <!-- start of item list -->
                    <tr>
                      <td>Operator/Universitas</td>
                      <td>
                          <a href="#" class="btn btn-default btn-xs te-btn">Edit</a>
                          <a href="#" class="btn btn-danger btn-xs te-btn">Delete</a>
                      </td>
                    </tr>
                    <!-- end of item list -->


                  </tbody>
                </table>
                </div>
                </div>

              </div>

              
          </div>
        </div>


          <?php
  include "view/default/footer.php";
  ?>
    </div> <!-- /container -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
      $(document).ready(function() {
          $('#te_table').dataTable();
      });
    </script>

  </body>
</html>