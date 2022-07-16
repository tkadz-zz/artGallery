<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/userSessionFilter.php";
?>


    <div class="page-content">
        <div class="container">

            <br>
            <a onclick="history.back(-1)" class="btn btn-secondary text-white"><span class="fa fa-chevron-circle-left"></span> Back</a>


            <div class="container pp-section">
                <div class="row">
                    <div class="col-md-12 col-sm-12 px-0">
                        <h1 class="h3"> Payed Art</h1>
                    </div>
                </div>
            </div>
            <br>
            <a href="paymentHistory.php" class="btn btn-outline-primary">Payment History <span class="fa fa-chevron-circle-right"></span></a>
            <br>
            <br>

            <section class="h-100 h-custom" style="background-color: #eee;">
                <br>
            <div class="row">
                <?php
                $n = new UserView();
                $n->payedArtLoop($_SESSION['id']);
                ?>
            </div>
            </section>


        </div>
    </div>


<?php
include 'includes/footer.inc.php';
?>