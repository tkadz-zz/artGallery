<?php

include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/userSessionFilter.php";

?>


<div class="page-content">
    <div class="container">
        <br>
        <a onclick="history.back(-1)" class="btn btn-secondary text-white"><span class="fa fa-chevron-circle-left"></span> Back</a>

        <div class="-container pp-section">
            <div class="row">
                <div class="col-md-12 col-sm-12 px-0">
                    <h1 class="h3"> Payment History</h1>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title pb-3 mt-0">Payments</h5>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr class="align-self-center">
                                    <th>#</th>
                                    <th>Payment Type</th>
                                    <th>Payment ID</th>
                                    <th>Payment By</th>
                                    <th>Payment Date</th>
                                    <th>Amount Payed</th>
                                    <th>Art Pieces Bought</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $n = new UserView();
                                $n->paymentHistoryLoop($_SESSION['id']);
                                ?>

                                </tbody>
                            </table>
                        </div>
                        <!--end table-responsive-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>


<?php
include 'includes/footer.inc.php';
?>