<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/userSessionFilter.php";
?>


<div class="page-content">
    <div class="container">
        <div class="container pp-section">
            <div>
                <a onclick="history.back(-1)" class="btn btn-secondary text-white"><span class="fa fa-chevron-circle-left"></span> Back</a>
            </div>
            <br>
        </div>



        <?php
        $carv = new UserView();
        $carv->viewCart($_SESSION['id']);
        ?>

        <div class="pp-section"></div>

    </div>
</div>


<?php
include 'includes/footer.inc.php';
?>








