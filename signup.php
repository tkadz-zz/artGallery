<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";
?>

    <div class="page-content">
        <div class="container card">
            <div class="row pp-section">
                <div class="col-md-9">
                    <h1 class="h4">Registration Page</h1>
                    <p>Create a free account below </p>
                </div>
            </div>

            <div class="container -pp-contact px-0 mt-5">
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <div class="pp-contact-message">
                            <div class="h4 mb-3"></div>


                            <form action="includes/authentication.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <input class="mr-3 form-control" type="text" name="name" placeholder="Name..."/>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <input class="form-control" type="text" name="surname" placeholder="Surname..."/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input class="form-control" type="email" name="email" placeholder="E-mail..."/>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">

                                        <input type="password" class="form-control form-control-user"

                                               id="password"

                                               placeholder="Password"

                                               name="password"

                                               required

                                               onkeyup='check();'

                                        >

                                    </div>
                                    <div class="col-sm-6">

                                        <input type="password" class="form-control form-control-user"

                                               id="confirmPassword"

                                               placeholder="Repeat Password"

                                               name="confirmPassword"

                                               required

                                               onkeyup='check();'

                                        >

                                    </div>
                                </div>

                                <div>

                                    <span id='message'></span>

                                </div>

                                <button id="save-btn" name="createAccountBtn" class="btn btn-outline-primary btn-user btn-block" disabled="disabled">

                                    Register Account <span class="fa fa-user-plus"></span>

                                </button>

                                <script>
                                    var check = function() {
                                        if (document.getElementById('password').value ==
                                            document.getElementById('confirmPassword').value) {
                                            document.getElementById('message').style.color = 'green';
                                            document.getElementById("save-btn").disabled = false;
                                            document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span> Password matched</div>';
                                        }
                                        else {
                                            document.getElementById('message').style.color = 'red';
                                            document.getElementById("save-btn").disabled = true;
                                            document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span> Password not matching Confirm Password</div>';
                                        }


                                    }
                                </script>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <div class="pp-section"></div></div>
    </div>
<?php
include 'includes/footer.inc.php';
?>