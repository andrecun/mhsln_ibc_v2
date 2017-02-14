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
            $(document).ready(function () {
                $("#inputStatus").select2();
            });
            $(document).ready(function () {
                $("#inputMajor").select2();
            });
            $(document).ready(function () {
                $("#inputUniversity").select2({
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
                            return {results: data};
                        }
                    }
                })

            });


            $(document).ready(function () {
                $("#inputFaculty").select2({
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
                            return {results: data};
                        }
                    }
                })

            });

            $(function () {
                $("#periode_belajar_start").datepicker({
                    yearRange: '-70:+30',
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 3,
                    dateFormat: 'd M yy ',
                    onClose: function (selectedDate) {
                        $("#periode_belajar_end").datepicker("option", "minDate", selectedDate);
                        var lama = (bulan_studi($('#lamaijin').val()) + 1) * 31;
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
                <h1>Filter Results</h1>
                <hr/>

                <?php
                //keyword=&status=&major=&university=&faculty=&btnSubmit=
                //   $UTILITY->show_data($_POST);
                $keyword = $_POST['keyword'];
                $status = $_POST['status'];
                $universitas = $_POST['university'];
                $major = $_POST["major"];
                $faculty = $_POST["faculty"];
                $periode_belajar_start = $_POST['periode_belajar_start'];
                $periode_belajar_end = $_POST['periode_belajar_end'];
                ?>
                <form role="form te-form-filter" method="post" action="<?= $url_rewrite ?>content/student">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 te-padding-top">
                                <input type="text" class="form-control" value="<?= $keyword ?>" id="inputKeyword"
                                       name="keyword" placeholder="Type Keyword">
                            </div>

                            <div class="col-md-4 te-padding-top">
                                <select class="form-control" id="inputStatus" name="status">
                                    <option value="">Select Status</option>
                                    <?php
                                    $qry = $DB->query("select idstatus,namastatus from status");
                                    while ($row = $DB->fetch_object($qry)) {
                                        $idstatus = $row->idstatus;
                                        $namastatus = $row->namastatus;
                                        if ($idstatus == $status)
                                            echo "<option value=\"$idstatus\" selected>$namastatus</option>";
                                        else
                                            echo "<option value=\"$idstatus\" >$namastatus</option>";

                                    }
                                    ?>
                                </select>
                            </div>
                            <!--<div class="col-md-4 te-padding-top">
                        <select class="form-control" id="inputMajor" name="major">
                          <option value="">Select Major</option>
                        <?php
                            $qry = $DB->query("select idjurusan,namajurusan from jurusan");
                            while ($row = $DB->fetch_object($qry)) {
                                $idjurusan = $row->idjurusan;
                                $namajurusan = $row->namajurusan;
                                if ($idjurusan == $major)
                                    echo "<option value=\"$idjurusan\" selected>$namajurusan</option>";
                                else
                                    echo "<option value=\"$idjurusan\" >$namajurusan</option>";
                            }
                            ?>                        </select>
                      </div>-->
                            <?php if ($_SESSION["level$ID"] != "2") { ?>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 te-padding-top">
                                            <input class="form-control" type="hidden" id="inputUniversity"
                                                   name="university"/>

                                        </div>

                                        <!--<div class="col-md-4 te-padding-top">
                                                   <input class="form-control" type="hidden" id="inputFaculty" name="faculty"/>

                                        </div>-->

                                    </div>
                                    <div class="col-md-4 te-padding-top">
                                        <div class="input-group">
                                            <input type="text" readonly="1" class="form-control"
                                                   id="periode_belajar_start" value="<?= $periode_belajar_start ?>"
                                                   name="periode_belajar_start" placeholder="Tanggal Awal Report">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 te-padding-top">
                                        <div class="input-group">
                                            <input type="text" readonly="1" class="form-control"
                                                   id="periode_belajar_end" value="<?= $periode_belajar_end ?>"
                                                   name="periode_belajar_end" placeholder="Tanggal Akhir Report">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                    <div class="form-group te-no-margin">
                        <div class="col-md-12 te-form-filter">
                            <a href="<?= $url_rewrite ?>content/student "
                               class="btn col-md-2 btn-warning   btn-sm te-pull-right">Reset</a>
                            <button type="submit" name="btnSubmit"
                                    class="btn col-md-2 btn-primary btn-sm te-pull-right">Search
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading te-panel-heading"><i class="glyphicon glyphicon-th-list"></i>
                    <p>Daftar Perizinan</p>
                    <a href="<?= $url_rewrite ?>content/student/add" class="btn btn-primary btn-xs te-pull-right">Ijin
                        Baru</a>

                    <a href="<?= $url_rewrite ?>content/ekstension/add " class="btn btn-info btn-xs  te-pull-right">Perpanjangan
                        Ijin</a>
                </div>

                <div class="clearfix"></div>

                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-striped table-bordered dataTable no-footer" role="grid" id="te_table"
                           cellspacing="0" width="100%">
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
                    </table>
                </div>
                <!-- end of panel body -->

            </div>
            <?php
            $periode_belajar_start = trim($UTILITY->format_tanggal_db($_POST['periode_belajar_start']));
            $periode_belajar_end = trim($UTILITY->format_tanggal_db($_POST['periode_belajar_end']));
            ?>
            <script>
                $(document).ready(function () {
                    $('#te_table').dataTable(
                        {
                            "order": [[ 4, "desc" ]],
                            "aoColumnDefs": [
                                {"aTargets": [2]}
                            ],
                            "aoColumns": [
                                {"bSortable": true},
                                {"bSortable": true},
                                {"bSortable": true},
                                {"bSortable": true},
                                {"bSortable": true},
                                {"bSortable": false},
                                {"bSortable": false}],

                            "bProcessing": true,
                            "bServerSide": true,
                            "sAjaxSource": "<?=$url_rewrite?>api/api_mahasiswa.php?<?php echo "keyword=$keyword&status=$status&universitas=$universitas&major=$major&faculty=$faculty&periode_belajar_start=$periode_belajar_start&periode_belajar_end=$periode_belajar_end";?>"
                        }
                    )/*.rowGrouping({
                     iGroupingColumnIndex: 0,
                     sGroupingColumnSortDirection: "asc",
                     iGroupingOrderByColumnIndex: 0,
                     bExpandableGrouping: true,
                     })*/;
                    ;
                });
            </script>
        </div>
    </div>


    <?php
    include "view/default/footer.php";
    ?>
</div> <!-- /container -->
</body>
</html>