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
                <div class="panel-heading te-panel-heading"><i class="glyphicon glyphicon-th-list"></i> <p>List of All Users</p>
                      <a href="<?=$url_rewrite?>content/user/add" class="btn btn-primary btn-xs te-pull-right">Add New</a>
                </div>

                <div class="clearfix"></div>
                <div class="panel-body">
                  <div class="table-responsive">
                <!-- Table -->
                <table class="table table-striped table-bordered dataTable no-footer" role="grid" id="te_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="30%">Institusi</th>
                      <th width="15%">Username</th>
                      <th width="15%">Level</th>
                      <th width="20%">Email</th>
                      <th width="20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                                                  <td colspan="4" class="dataTables_empty">Loading data from server</td>
                                             </tr>


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
          $('#te_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": true},
                         {"bSortable": true},
                               {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false}],
   
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>api/api_user.php"
               }
                  );
      });
    </script>
  </body>
</html>