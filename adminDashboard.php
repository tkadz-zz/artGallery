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



            <hr>
            <br>
            <div class="row">

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Art Gallery Management Links
                        </div>
                        <ul class="list-group list-group-flush">
                            <a class="-text-decoration-none" href="?addnewart"><li class="list-group-item"><span class="fa fa-plus-circle"></span> Add New Art <span class="fa fa-arrow-circle-right"></span></li></a>
                            <hr>
                            <a class="-text-decoration-none" href="allart.php"><li class="list-group-item"><span class="fa fa-picture-o"></span> Manage All Art <span class="fa fa-arrow-circle-right"></span></li></a>
                            <hr>
                            <a class="-text-decoration-none" href="?artcategories"><li class="list-group-item"><span class="fa fa-list"></span> Manage Art Categories <span class="fa fa-arrow-circle-right"></span></li></a>
                            <hr>
                            <a class="-text-decoration-none" href="?users"><li class="list-group-item"><span class="fa fa-users"></span> All Users <span class="fa fa-arrow-circle-right"></span></li></a>
                            <hr>
                            <a class="-text-decoration-none" href="?contacts"><li class="list-group-item"><span class="fa fa-comment"></span> Contacts <span class="fa fa-arrow-circle-right"></span></li></a>
                            <hr>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">

                    <?php
                        if(isset($_GET['contactUserID'])){
                        ?>
                        <div class="card-header">
                            <a  class="btn btn-secondary" href="?contacts"><span class="fa fa-chevron-circle-left"> </span></a> <span class="h4"> Message</span>
                        </div>
                        <div -class="card-body">
                            <div class="">
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <?php
                                        $contactUserID = $_GET['contactUserID'];
                                        $nnn = new UserView();
                                        $nnn->viewContactMessage($contactUserID);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                        <?php
                        if(isset($_GET['contacts'])){
                            ?>
                            <div class="card-header">
                                <span class="h4">Contacts</span>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Read More</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $n = new UserView();
                                        $n->viewContacts();
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <?php
                        }
                        ?>



                        <?php

                        if(isset($_GET['updateCategory'])){
                            $categID = $_GET['categoryID'];
                            $categoryOldName = $_GET['categoryName'];
                            ?>
                            <div class="card-header">
                                <a  class="btn btn-secondary" href="?artcategories"><span class="fa fa-chevron-circle-left"> </span></a> <span class="h4"> Update Category</span>
                            </div>
                            <div -class="card-body">
                                <div class="">
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <form class="form-group" method="POST" action="includes/updateCategory.inc.php">
                                                <input name="categoryNewName" value="<?php echo $categoryOldName ?>" class="form-control" minlength="4" type="text" placeholder="New Category Name" required> <br>
                                                <input name="categoryID" value="<?php echo $categID ?>" type="text" hidden>
                                                <input name="categoryOldName" value="<?php echo $categoryOldName ?>" type="text" hidden>
                                                <button onclick="return confirm('You are about to change/Update the name of this category! Proceed?');" class="btn btn-primary" name="btn-update-category" type="submit">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        if(isset($_GET['addcategory'])){
                            ?>
                            <div class="card-header">
                                <a  class="btn btn-secondary" href="?artcategories"><span class="fa fa-chevron-circle-left"> </span></a> <span class="h4"> Add Category</span>
                            </div>
                            <div -class="card-body">
                                <div class="">
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <form class="form-group" method="POST" action="includes/addCategory.inc.php">
                                                <input name="category" class="form-control" minlength="4" type="text" placeholder="Category Name" required> <br>
                                                <button onclick="return confirm('Add this category to database?');" class="btn btn-primary" name="btn-add-category" type="submit">Add <span class="mdi mdi-plus"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        if(isset($_GET['artcategories'])){
                            ?>
                            <div class="card-header">
                                <span class="h4">Art Categories</span> <a class="btn btn-outline-primary" href="?addcategory"><span class="mdi mdi-plus"></span></a>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Added</th>
                                            <th>More</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $n = new UserView();
                                        $n->viewAllCategoriesTable();
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if(isset($_GET['addnewart'])){
                            ?>
                            <div class="card-header">
                                <div class="h4"> Add New Art</div>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <form class="form-group" method="POST" action="includes/addNewArt.inc.php" enctype="multipart/form-data">
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label>Name of the art piece</label>
                                                <input class="form-control" type="text" name="artName" placeholder="Name of the art piece..." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Name of the Artist</label>
                                                <input class="form-control" type="text" name="authorName" placeholder="Name of Artist..." required>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label>Date the art was created</label>
                                                <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="datePainted" placeholder="Date the Art-Piece was created..." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Art Category</label>
                                                <select name="artCategory" class="form-control" required>
                                                    <option value=""> -- Select Art Category -- </option>
                                                    <?php
                                                    $acvl = new UserView();
                                                    $acvl->categoryLoopView();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                            <label>Art Description</label>
                                            <textarea style="height: 150px" class="form-control" name="artDescription" placeholder="Add Art Description Here" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <label>Allowed Formats: .jpg/ .jpeg/ .png</label>
                                                <input class="form-control" name="artFile" type="file" required>
                                            </div>
                                            <div class="col-md-4 ">
                                                <label>Art Price $(USD)</label>
                                                <input name="artPrice" class="form-control" type="number" placeholder="Price of this Art Piece" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input name="artStatus" type="checkbox" -class="form-check-input" checked>
                                                <label  style="font-size: 12px" class="form-check-label">Check the box to put art online after submitting this form</label>
                                            </div>
                                        </div>
                                        <div>
                                            <button name="btn-post-new-art" type="submit" class="btn btn-primary">Upload New Art <span class="mdi mdi-upload"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>



                        <?php
                        if(isset($_GET['userID'])){
                            $nc = new UserView();
                            $nc->editUser($_GET['userID']);
                        }
                        ?>





                        <?php
                        if(isset($_GET['users'])){
                            ?>
                            <div class="card-header">
                                All Users
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>More</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $n = new UserView();
                                        $n->viewAllUsersTable();
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>

            <br>




        </div>
    </div>






<?php
include 'includes/footer.inc.php';
?>