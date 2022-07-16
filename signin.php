<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";

if(isset($_SESSION['id'])){
    echo "<script>
        history.back(-1);
        </script>";
}

?>

    <div class="page-content">
        <div class="container card">
            <div class="row pp-section">
                <div class="col-md-9">
                    <h1 class="h4">Login Page</h1>
                    <p>Login to your account for more and better options and experiences </p>
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
                                        <input class="mr-3 form-control" type="email" name="email" placeholder="Email..." required
                                        <?php
                                        if(isset($_GET['email'])){
                                            ?>
                                            value="<?php echo $_GET['email']; ?>"
                                            <?php
                                        }
                                        ?>
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8 col-sm-12 mb-3">
                                        <input class="form-control" type="password" name="password" placeholder="Password..." required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button name="btn-signin" class="btn btn-primary" type="submit">Sign-in <span class="fa fa-sign-out"></span> </button>
                                    </div>
                                </div>
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