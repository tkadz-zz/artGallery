<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/adminFilter.inc.php";
?>

    <div class="page-content">
        <div class="container">
            <br>


            <?php
            $nav = new UserView();
            $nav->adminviewArt($_GET['artID']);
            ?>


    <div class="pp-section"></div>


    </div>
    </div>






<?php
include 'includes/footer.inc.php';
?>