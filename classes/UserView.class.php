<?php

class UserView extends Users
{


    public function viewContactMessage($id){
        $rows = $this->GetAllContactById($id);
        ?>
            <div class="row">
                <div class="col-md-6">
                    <p>Name: <?php echo $rows[0]['name'] ?></p>
                    <p>Surname: <?php echo $rows[0]['surname'] ?></p>
                    <p>Email: <?php echo $rows[0]['email'] ?></p>
                    <p>Date Received: <?php echo $rows[0]['dateAdded'] ?></p>
                </div>
                <div class="col-md-6">
                    <h5>Message</h5>
                    <p><u><b>Subject</b></u>: <i><?php echo $rows[0]['subject'] ?></i></p>
                    <p><?php echo $rows[0]['message'] ?></p>
                </div>
            </div>
        <?php
    }


    public function viewContacts(){
        $rows = $this->GetAllContacts();
        $s = 0;
        foreach ($rows as $row){
            $s++;
            ?>
                <tr>
                    <td><?php echo $s ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['surname'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['dateAdded'] ?></td>
                    <td><a href="?contactUserID=<?php echo $row['id'] ?>"> Read.. </a></td>
                </tr>
            <?php
        }
    }

    public function adminPaymentHistoryLoop($id){
        $rows = $this->adminPaymentHistory($id);

        if(count($rows) > 0)
        {
            $s=0;
            foreach ($rows as $row){
                $payc = $this->paymentHistoryByUniueID($row['uniqueGroupID']);
                $user = $this->GetUserById($row['userID']);
                $s++;
                ?>
                <tr>
                    <td><?php echo $s ?></td>
                    <td><?php echo $payc[0]['payMethod'] ?></td>
                    <td><?php echo $row['uniqueGroupID'] ?></td>
                    <td><?php echo $user[0]['email'] ?></td>
                    <td><?php echo $row['datePayed'] ?></td>
                    <td><span class="badge badge-boxed badge-soft-primary">Success</span></td>
                </tr>
                <?php
            }
        }
        else{
            ?>
            <span class="card card-body shadow-sm btn btn-warning text-dark">no payment data on this art piece yet</span>
            <?php
        }
    }


    public function paymentHistoryLoop($id){
        $rows = $this->paymentHistory($id);

        $s=0;
        foreach ($rows as $row){
            $payc = $this->paymentHistoryCount($row['uniqueGroupID'], $id);
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?></td>
                <td><?php echo $row['payMethod'] ?></td>
                <td><?php echo $row['uniqueGroupID'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['datePayed'] ?></td>
                <td>$<?php echo $row['amount'] ?></td>
                <td><?php echo count($payc) ?></td>
                <td><span class="badge badge-boxed badge-soft-primary">Success</span></td>
            </tr>
            <?php
        }
    }






    public function payedArtLoop($id){
        $payedRows = $this->GetPayedArtByUserID($id);
        if(count($payedRows) > 0)
        {
            foreach ($payedRows as $row){
                $artID= $row['artID'];
                $rowart = $this->GetArtById($artID);
                $file_ext   =   explode('.',$rowart[0]['source']);
                ?>
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <img src="<?php echo $rowart[0]['source'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                    </div>
                                    <div class="ms-3">
                                        <h5><?php echo $rowart[0]['name'] ?></h5>
                                        <p class="small mb-0">Author: <?php echo $rowart[0]['author'] ?></p>
                                        <p class="small mb-0"><span class="badge badge-success"><span class="mdi mdi-check"></span> Payed</span></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                            if($file_ext[1] == 'png' || $file_ext[1] == 'jpg' || $file_ext[1] == 'jpeg'){
                                                $imgEx = $file_ext[1];
                                            }
                                            elseif($file_ext[2] == 'png' || $file_ext[2] == 'jpg' || $file_ext[2] == 'jpeg'){
                                                $imgEx =  $file_ext[2];
                                            }
                                            elseif($file_ext[3] == 'png' || $file_ext[3] == 'jpg' || $file_ext[3] == 'jpeg'){
                                                $imgEx = $file_ext[3];
                                            }
                                            else{
                                                $imgEx = 'jpg';
                                            }
                                            ?>
                                        </div>
                                        <div -class="row">

                                            <a download="<?php echo $file_ext[0].$imgEx ?>"  href="<?php echo $rowart[0]['source'] ?>" class="btn btn-success mb-2"><i>Download <span class="mdi mdi-download"></span></i></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <hr>
                            <div -class="col-md-6">
                                <a href="includes/deletePayed.inc.php?artID=<?php echo $artID ?>&paymentID=<?php echo $row['id'] ?>" onclick="return confirm('If deleted, you will need to buy the art again to download it. Proceed?')" class="-btn -btn-danger text-danger"><i><span style="font-size: 13px" class="mdi mdi-trash-can"></span>Delete</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <span class="fa fa-dollar-sign"></span> Purchased Art will appear here
                    </div>
                </div>
            </div>

            <?php
        }
    }








    public function editUser($id){
        $rows = $this->GetUserById($id);
        ?>
        <div class="card-header">
            <a  class="btn btn-secondary" href="?users"><span class="fa fa-chevron-circle-left"> </span></a> <span class="h4"> Update User Details</span>
        </div>
        <div -class="card-body">
            <div class="">
                <div class="card-body">
                    <div class="list-group list-group-flush">

                        <div class="row">
                            <div class="col-6">
                                Name: <?php echo $rows[0]['name']; ?>
                                <hr>
                                Surname: <?php echo $rows[0]['surname']; ?>
                                <hr>
                                Email: <?php echo $rows[0]['email']; ?>
                                <hr>
                                Role: <?php

                                if($rows[0]['role'] == 'admin'){
                                    ?>
                                    <span class="badge badge-warning">ADMIN</span>
                                    <?php
                                }
                                elseif ($rows[0]['role'] == 'user'){
                                    ?>
                                    <span class="badge badge-info">USER</span>
                                    <?php
                                }
                                else{
                                    ?>
                                    <span class="badge badge-danger">ERROR!</span>
                                    <?php
                                }
                                ?>
                                <hr>
                                Status: <?php
                                if($rows[0]['status'] == 1){
                                    ?>
                                    <span class="badge badge-success">ACTIVE</span>
                                    <?php
                                }
                                elseif ($rows[0]['status'] == 0){
                                    ?>
                                    <span class="badge badge-danger">NOT ACTIVE</span>
                                    <?php
                                }
                                else{
                                    ?>
                                    <span class="badge badge-warning">ERROR!</span>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-6">
                                <form class="form-group" method="POST" action="includes/editUser.inc.php">
                                    <label>Name</label>
                                    <input name="name" class="form-control mb-3" type="text" placeholder="Name..." required value="<?php echo $rows[0]['name'] ?>">
                                    <label>Surname</label>
                                    <input name="surname" class="form-control mb-3" type="text" placeholder="Surname..." required value="<?php echo $rows[0]['surname'] ?>">
                                    <label>Email</label>
                                    <input name="email" class="form-control mb-3" type="email" placeholder="Email..." required value="<?php echo $rows[0]['email'] ?>">

                                    <input name="userID" type="text"  value="<?php echo $rows[0]['id'] ?>" hidden>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>User Role</label>
                                            <select class="form-control" name="role" required>
                                                <?php
                                                if($rows[0]['role'] == 'admin'){
                                                    ?>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <option value="user">User</option>
                                                    <option value="admin">Admin</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>User Status</label>
                                            <select class="form-control" name="status" required>
                                                <?php
                                                if($rows[0]['status'] == 1){
                                                    ?>
                                                    <option value="1">Active</option>
                                                    <option value="0">De-Active</option>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <option value="0">De-Active</option>
                                                    <option value="1">Active</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <button onclick="return confirm('Update User Details?');" class="btn btn-primary" name="btn-edit-user" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }




    public function adminviewArt($id){
        $rows = $this->GetArtById($id);
        $artcateg = $this->GetCategoryById($rows[0]['category']);
        ?>

        <div class="container pp-section">
            <div>
                <a href="allart.php" class="btn btn-secondary"><span class="fa fa-chevron-circle-left"></span> Back</a>
            </div>
            <br>
            <div class="h4 font-weight-normal"><?php echo $rows[0]['author'] .': '. $rows[0]['name'] ?></div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <img style="width: 100%;" class="img-fluid -mt-4" src="<?php echo $rows[0]['source'] ?>"/>
                    <hr>
                    Art Payment Details
                    <br>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 12px">
                            <thead>
                            <tr class="align-self-center">
                                <th>#</th>
                                <th>Type</th>
                                <th>Unique#</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $n = new UserView();
                            $n->adminPaymentHistoryLoop($id);
                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-group" method="POST" action="includes/updateArt.inc.php">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Art Name</label>
                                        <input value="<?php echo $rows[0]['name'] ?>" name="artName" type="text" class="form-control" placeholder="Art Name..." required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Author Name</label>
                                        <input value="<?php echo $rows[0]['author'] ?>" name="authorName" type="text" class="form-control" placeholder="Art Author Name..." required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Art Visibility</label>
                                        <select name="artStatus" class="form-control" required>
                                            <?php
                                            if($rows[0]['status'] == 1){
                                                ?>
                                                <option value="1">Online</option>
                                                <option value="0">Offline</option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <option value="0">Offline</option>
                                                <option value="1">Online</option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Art Category</label>
                                        <select name="artCategory" class="form-control" required>
                                            <option value="<?php echo $rows[0]['category'] ?>"><?php echo $artcateg[0]['name'] ?></option>
                                            <?php
                                            $artc = new UserView();
                                            $artc->categoryLoopView();
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Art Date</label>
                                        <input value="<?php echo $rows[0]['creationDate'] ?>" max="<?php echo date('Y-m-d') ?>" name="datePainted" type="date" class="form-control" placeholder="Date Released" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Art Price $(USD)</label>
                                        <input value="<?php echo $rows[0]['price'] ?>" name="artPrice" type="number" class="form-control" placeholder="Art Price..." required>
                                    </div>
                                </div>
                                <input name="artID" type="text" value="<?php echo $id ?>" hidden>


                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Art Description</label>
                                        <textarea style="height: 200px" name="artDescription" class="form-control" placeholder="Description" required><?php echo $rows[0]['description'] ?></textarea>
                                    </div>
                                </div>

                                <button onclick="return confirm('Are you sure you want to submit changes made?')" class="btn btn-primary" name="btn-update-art-details">
                                    Update
                                </button>
                            </form>

                            <hr>


                            <form method="POST" action="includes/delete.inc.php">
                                <input name="artID" type="text" value="<?php echo $_GET['artID']; ?>" hidden>
                                <input type="checkbox" id="checkme"/> Check to enable the deleting button belowe<br>
                                <button type="submit" name="delete-art-btn" id="disbtn" disabled onclick="return confirm('This action can not be un-done. This will delete this art piece.Note: if a user has it in cart, it will also be removed?')" class="btn btn-danger">Delete Art <span class="mdi mdi-trash-can-outline"></span></button>
                            </form>
                            <script>
                                var checker = document.getElementById('checkme');
                                var sendbtn = document.getElementById('disbtn');
                                // when unchecked or checked, run the function
                                checker.onchange = function(){
                                    if(this.checked){
                                        sendbtn.disabled = false;
                                    } else {
                                        sendbtn.disabled = true;
                                    }

                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <?php
    }





    public function categoryShortLoops(){
        $rows = $this->GetAllCategoriesShortLoop();
        foreach ($rows as $row){
            ?>
            <a class="btn btn-outline-primary pp-filter-button" href="#" data-filter="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a>
            <?php
        }
    }


    public function categoryLoopView(){
        $rows = $this->GetAllCategories();
        foreach ($rows as $row){
            ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php
        }
    }

    public function viewAllCategoriesTable(){
        $rows = $this->GetAllCategories();
        $s=0;
        foreach ($rows as $row){
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['dateAdded'] ?></td>
                <td>
                    <a href="?updateCategory&categoryID=<?php echo $row['id'] ?>&categoryName=<?php echo $row['name'] ?>"><span class="mdi mdi-pen"></span> </a>
                    |
                    <a onclick="return confirm('You are about to delete this category: <?php echo $row['name'] ?>');" href="includes/removeCategory.inc.php?categoryID=<?php echo $row['id'] ?>"><span class="text-danger mdi mdi-trash-can-outline"></span> </a>
                </td>
            </tr>
            <?php
        }
    }


    public function viewAllUsersTable(){
        $rows = $this->GetAllUser();
        $s=0;
        foreach ($rows as $row){
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['surname'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td>
                    <?php
                    if($row['role'] == 'admin'){
                        ?>
                        <span class="badge badge-warning">ADMIN</span>
                        <?php
                    }
                    elseif ($row['role'] == 'user'){
                        ?>
                        <span class="badge badge-info">USER</span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge badge-danger">ERROR!</span>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($row['status'] == 1){
                        ?>
                        <span class="badge badge-success">ACTIVE</span>
                        <?php
                    }
                    elseif ($row['status'] == 0){
                        ?>
                        <span class="badge badge-danger">NOT ACTIVE</span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge badge-warning">ERROR!</span>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <a href="?userID=<?php echo $row['id'] ?>"><span class="mdi mdi-pen"></span> </a>
                    |
                    <a onclick="return confirm('THis will delete the user from the database. Proceed?')" href="includes/delete.inc.php?userID=<?php echo $row['id'] ?>"><span class="text-danger mdi mdi-trash-can-outline"></span> </a>
                </td>
            </tr>
            <?php
        }
    }


    public function artCountView($query){
        $rows = $this->artCount($query);
        echo count($rows);
    }


    public function GetCartArtPriceByID($id){
        $rows = $this->GetAllUserArtById($id);
        $price = 0;
        foreach ($rows as $row){
            $artId =  $row['artID'];
            $rows2 = $this->GetArtCartSumById($artId);
            foreach ($rows2 as $row2){
                $price += $row2['price'];
            }
        }
        if($price == NULL || $price <= 0){
            echo '00.00';
        }
        else {
            echo $price;
        }
    }

    public function randomString($length){
        $nn = $this->RandomStrings($length);
        return $nn;
    }



    public function cartLoop($id){
        $rows = $this->GetAllUserArtById($id);
        if(count($rows) > 0)
        {
            foreach ($rows as $rowcart)
            {
                $artID = $rowcart['artID'];
                $rowart = $this->GetArtById($artID);
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div>
                                    <img src="<?php echo $rowart[0]['source'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                </div>
                                <div class="ms-3">
                                    <h5><?php echo $rowart[0]['name'] ?></h5>
                                    <p class="small mb-0"><?php echo $rowart[0]['author'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div style="width: 80px;"><?php echo  $rowart[0]['priceCurrency'] ?>
                                    <h5 class="mb-0"><?php echo  $rowart[0]['price'] ?></h5>
                                </div>
                                <a onclick="return confirm('Are you sure you want to remove from cart?');" href="includes/cartRemove.inc.php?artID=<?php echo $rowcart['id'] ?>" style="color: #cecece;"><i style="font-size: 20px" class="mdi mdi-trash-can-outline text-danger"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                No items in your cart yet
            </div>
            <?php
        }
    }


    public function viewCartCount($id){
        $rows = $this->GetAllUserArtById($id);
        echo count($rows);
    }

    public function viewCart($id){
        $rows = $this->GetAllUserArtById($id);
        ?>
        <section class="h-100 h-custom" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="col-lg-7">
                                        <h5 class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="index.php" class="text-body">
                                                        <i class="mdi mdi-arrow-left-thick me-2"></i>
                                                        Continue Exploring
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="payedArt.php" class="text-body">
                                                        <i class="fa fa-luggage-cart"></i>
                                                        Payed Art
                                                    </a>
                                                </div>
                                            </div>

                                        </h5>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">Art Shopping cart</p>
                                                <p class="mb-0">You have
                                                    <?php
                                                    $cartc = new UserView();
                                                    $cartc->viewCartCount($_SESSION['id']);
                                                    ?>
                                                    item/s in your cart</p>
                                            </div>
                                        </div>

                                        <?php
                                        $cl = new UserView();
                                        $cl->cartLoop($_SESSION['id']);
                                        ?>



                                    </div>
                                    <div class="col-lg-5">

                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Payment Checkout</h5>
                                                    <img src="favicon.ico"
                                                         class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                                </div>

                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p class="mb-2">$
                                                        <?php
                                                        $tap = new UserView();
                                                        $tap->GetCartArtPriceByID($_SESSION['id']);
                                                        ?>
                                                    </p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Shipping</p>
                                                    <p class="mb-2">$00.00</p>
                                                </div>

                                                <div class="d-flex justify-content-between mb-4">
                                                    <p class="mb-2">Total(Incl. taxes)</p>
                                                    <p class="mb-2">$
                                                        <?php
                                                        $tap = new UserView();
                                                        $tap->GetCartArtPriceByID($_SESSION['id']);
                                                        ?>
                                                    </p>
                                                </div>

                                                <a href="payNow.php" type="button" class="btn btn-info btn-block btn-lg">
                                                    <div class="d-flex justify-content-between">
                                                        <span>$
                                                            <?php
                                                            $tap = new UserView();
                                                            $tap->GetCartArtPriceByID($_SESSION['id']);
                                                            ?>
                                                        </span>
                                                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }


    public function viewArt($id){
        $rows = $this->GetArtById($id);
        $artcateg = $this->GetCategoryById($rows[0]['category']);
        ?>




        <div class="page-content">
            <div class="container">
                <div class="container pp-section">
                    <div>
                        <a onclick="history.back(-1)" class="btn btn-secondary text-white"><span class="fa fa-chevron-circle-left"></span> Back</a>
                    </div>
                    <hr>
                    <div class="h3 font-weight-normal"><?php echo $rows[0]['author'] .': '. $rows[0]['name'] ?></div>
                    <img style="width: 100%; height: 800px" class="img-fluid mt-4" src="<?php echo $rows[0]['source'] ?>"/>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <div>
                                <span class="text-uppercase h5">Art Name:</span> <span><?php echo $rows[0]['name'] ?></span>
                                <hr>
                                <span class="text-uppercase h5">Author:</span> <span><?php echo $rows[0]['author'] ?></span>
                                <hr>
                                <span class="text-uppercase h5">Year:</span> <span><?php echo $rows[0]['creationDate'] ?></span>
                                <hr>
                                <span class="text-uppercase h5">Price:</span> <span><?php echo $rows[0]['priceCurrency'] .' '. $rows[0]['price'] ?></span>
                                <hr>
                                <span class="text-uppercase ">Category:</span> <span><?php echo $artcateg[0]['name'] ?></span>
                                <hr>
                            </div>
                            <div class="h5">Purchase</div>
                            <?php
                            if(isset($_SESSION['id'])){
                                ?>
                                <form class="form-group card card-body" method="POST" action="">
                                    <!-- <input class="form-control" type="number" max="10" min="1" placeholder="Quantity" required> <br> -->

                                    <a onclick="return confirm('This art piece will be added to the cart');" href="includes/cartAdd.inc.php?artID=<?php echo $rows[0]['id'] ?>" class="btn btn-primary" name="btn-add-cart" type="submit">Add to cart <span class="fa fa-cart-plus"></span></a>
                                </form>
                                <?php
                            }
                            else{
                                ?>
                                <a class="btn btn-info" href="signin.php">Login to purchase<span class="fa fa-cart-plus"></span></a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-9">
                            <p><?php echo $rows[0]['description'] ?>.</p>
                        </div>
                    </div>
                </div>
                <div class="pp-section"></div></div>
        </div>


        <?php
    }

}