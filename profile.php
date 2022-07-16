<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
include "includes/userSessionFilter.php";
?>

    <div class="page-content">
        <div class="container">


            <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
                <div class="row ">
                    <div class="col-md-2 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="img/male.png">
                            <span class="font-weight-bold"><?php echo $_SESSION['name'] .' '. $_SESSION['surname']   ?></span>
                            <span class="text-black-50"><?php echo $_SESSION['email'] ?></span>
                        </div>
                    </div>


                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>

                            </div>
                            <form method="post" action="includes/updateProfile.inc.php" >
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $_SESSION['name'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="surname" type="text" class="form-control" value="<?php echo $_SESSION['surname'] ?>" placeholder="surname" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email ID</label>
                                        <input name="email" type="text" class="form-control" placeholder="enter email id" value="<?php echo $_SESSION['email'] ?>">
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button name="btn-update-profile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="col-md-5">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience">
                                <span>Additional Settings</span>
                            </div>
                            <hr>
                            <a href="?password" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>

                            <br>


                            <?php
                            if(isset($_GET['password'])){
                                ?>
                                <hr>
                                <div class="card-body shadow-sm">
                                <form method="post" action="includes/updatePassword.inc.php" >
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="labels">Current Password</label>
                                            <input name="op" type="password" class="form-control" placeholder="Current Password" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="labels">New Password</label>
                                            <input id="password" name="np" type="password" class="form-control" placeholder="New Password" onkeyup='check();' minlength="8" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Confirm Password</label>
                                            <input id="confirmPassword" name="cp" type="password" class="form-control" placeholder="Confirm New Password" onkeyup='check();' minlength="8" required>
                                        </div>
                                    </div>

                                    <script>
                                        var check = function() {
                                            if (document.getElementById('password').value ==
                                                document.getElementById('confirmPassword').value) {
                                                document.getElementById('message').style.color = 'green';
                                                document.getElementById("save-btn").disabled = false;
                                                document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span>Password matched</div>';
                                            }
                                            else {
                                                document.getElementById('message').style.color = 'red';
                                                document.getElementById("save-btn").disabled = true;
                                                document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span>New Password not matching Confirm Password</div>';
                                            }


                                        }
                                    </script>

                                    <div>

                                        <span id='message'></span>

                                    </div>


                                    <div class="mt-5 text-center">
                                        <button disabled id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                                    </div>
                                    <a class="btn btn-danger" href="profile.php"><span class="fa fa-close"></span></a>
                                </form>
                                </div>

                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








<?php
include 'includes/footer.inc.php';
?>