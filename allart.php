<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/adminFilter.inc.php";
?>

    <div class="page-content">
        <div class="container">
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="card-counter success">
                        <i class="mdi mdi-check-box-multiple-outline"></i>
                        <span class="count-numbers">
                        <?php
                        $query = "SELECT * FROM art WHERE status=1";
                        $o = new UserView();
                        $o->artCountView($query);
                        ?>
                    </span>
                        <span class="count-name">Online Art Count</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter danger">
                        <i class="mdi mdi-power"></i>
                        <span class="count-numbers">
                        <?php
                        $query = "SELECT * FROM art WHERE status!=1";
                        $o = new UserView();
                        $o->artCountView($query);
                        ?>
                    </span>
                        <span class="count-name">Offline Art Count</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter info">
                        <i class="mdi mdi-file-tree"></i>
                        <span class="count-numbers">
                        <?php
                        $query = "SELECT * FROM categories";
                        $o = new UserView();
                        $o->artCountView($query);
                        ?>
                    </span>
                        <span class="count-name">Categories Count</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter primary">
                        <i class="mdi mdi mdi-account-box-outline"></i>
                        <span class="count-numbers">
                        <?php
                        $query = "SELECT * FROM users";
                        $o = new UserView();
                        $o->artCountView($query);
                        ?>
                    </span>
                        <span class="count-name">Users Count</span>
                    </div>
                </div>
            </div>


            <br>
            <div>
                <a href="adminDashboard.php" class="btn btn-secondary"><span class="fa fa-chevron-circle-left"></span> Back</a>
            </div>
            <br>
            <!-- End -->

            <div class="row">
                <!-- Gallery item -->

                <?php
                $records = 12;
                $query = 'Select * from art';
                $p = new PignationView();
                $p->adminpigLoopImage($records, $query);
                ?>
                <!-- End -->
            </div>
        </div>
    </div>



    <div class="pp-section"></div>


    </div>
    </div>






<?php
include 'includes/footer.inc.php';
?>