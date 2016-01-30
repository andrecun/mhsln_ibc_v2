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
                <div class="panel-heading te-panel-heading"><i class="glyphicon glyphicon-th-list"></i> <p>List of Institutions</p>
                      <a href="add-institution.html" class="btn btn-primary btn-xs te-pull-right">Add New</a>
                </div>

                <div class="clearfix"></div>
                <div class="panel-body">
                  <div class="table-responsive">

                <!-- Table -->
                <table class="table table-striped table-bordered dataTable no-footer" role="grid" id="institution" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nama Universitas</th>
                      <th>Kode Universitas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- start of item list -->
                     <tr>
                                                  <td colspan="3" class="dataTables_empty">Loading data from server</td>
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
  <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
      $(document).ready(function() {
          $('#institution').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [0] }
                    ],
                    "aoColumns":[
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false}],
   
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>api/api_institution.php"
               }
                  );
      });
    </script>
  </body>
</html>