<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
?>


<div class="page-content">
    <div class="container">

        <div class="container pp-section">
            <div class="row">
                <div class="col-md-12 col-sm-12 px-0">
                    <h1 class="h3"> We are Photo Perfect, A Digital Art Gallery.</h1>
                </div>
            </div>
        </div>


        <div class="container px-0 py-4">
            <div class="pp-category-filter">
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-primary pp-filter-button" href="#" data-filter="all">All</a>
                        <?php
                        $nl = new UserView();
                        $nl->categoryShortLoops();
                        ?>
                    </div>
                </div>
            </div>
        </div>




                    <?php
                    $records = 10;
                    $query = 'Select * from art where status=1 order by RAND()';
                    $p = new PignationView();
                    $p->pigLoopImage($records, $query);
                    ?>

        <div class="pp-section"></div>

    </div>
</div>


<?php
include 'includes/footer.inc.php';
?>








