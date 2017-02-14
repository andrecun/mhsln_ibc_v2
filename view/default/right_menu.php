<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
?>
<div class="col-md-3 te-menubar">
    <div class="list-group">
        <?php
        $level = $_SESSION["level$ID"];
        //  $UTILITY->show_data($_SESSION);
        //echo "Level==$level";
        if ($level == "1") {
            ?>
            <p class="list-group-item active te-menu-title">Main Menu<br/>
                Welcome <?= $_SESSION["user_name$ID"] ?> from <?= $_SESSION['nama_unversitas'] ?>
            </p>
            <a href="<?= $url_rewrite ?>content/" class="list-group-item">Home</a>
            <a href="<?= $url_rewrite ?>content/user" class="list-group-item">User Admin</a>
            <a href="<?= $url_rewrite ?>content/student" class="list-group-item">Data Perizinan</a>
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">Guest Book</a>-->
            <a href="<?= $url_rewrite ?>content/institution" class="list-group-item">Institution Admin</a>
    <!--              <a href="<?= $url_rewrite ?>content/" class="list-group-item">Faculty Admin</a>
            <a href="<?= $url_rewrite ?>content/" class="list-group-item">Major Admin</a>-->
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">List of News</a>-->
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">Level of Study Admin</a>-->
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">Level</a>-->
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">Leader Admin</a>-->
            <a href="<?= $url_rewrite ?>content/report" class="list-group-item">Report</a>
            <a href="<?= $url_rewrite ?>Dokumentasi-Dikti.pdf" class="list-group-item">Guide</a>
            <!--<a href="<?= $url_rewrite ?>content/" class="list-group-item">Contact Us</a>-->
            <a href="<?= $url_rewrite ?>quit" class="list-group-item">Log Out</a>
    <?php
} else if ($level != '4') {
    ?>

            <p class="list-group-item active te-menu-title">Main Menu <br/>
            <?php
            if ($level != "") {
                echo "<small><i>Welcome {$_SESSION["user_name$ID"]} from {$_SESSION['nama_unversitas']} </i></small>";
            }
            ?> 
            </p>
            <a href="<?= $url_rewrite ?>content/" class="list-group-item">Home</a>
            <a href="<?= $url_rewrite ?>Dokumentasi-Dikti.pdf" class="list-group-item">Guide</a>
                <?php
                if ($level == '4') {
                    ?><a href="<?= $url_rewrite ?>content/report" class="list-group-item">Report</a>
            <?php } ?>
    <!--              <a href="<?= $url_rewrite ?>content/password" class="list-group-item">Change Password</a>
            <a href="<?= $url_rewrite ?>content/student" class="list-group-item">Data Perizinan</a>-->

            <a href="<?= $url_rewrite ?>quit" class="list-group-item">Log Out</a>
    <?php
}
?>
        <?php
        if ($level == "4") {
           ?>
               <p class="list-group-item active te-menu-title">Main Menu <br/>
                   <small>Welcome Team CH</small>
            </p>
            <a href="<?= $url_rewrite ?>ch/view" class="list-group-item">Home</a>
            <a href="<?= $url_rewrite ?>ch/report" class="list-group-item">Rekapitulasi Data Mahasiswa</a>
            <a href="<?= $url_rewrite ?>quit" class="list-group-item">Log Out</a>
           
        <?php } ?>
    </div>
</div>