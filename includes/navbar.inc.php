<?php
if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
    $lg = new Usercontr();
    $lg->log_out();
}
?>
<body id="top">
<div class="page">
    <header>
        <div class="pp-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container"><a href="index.php"><img src="images/favicon.png" alt="Logo"></a><a class="navbar-brand" href="index.php">Art Gallery</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="mdi mdi-format-list-bulleted text-dark"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a>
                            </li>
                           <!-- <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a>
                            </li> v-->
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <?php
                            if(isset($_SESSION['role']) AND $_SESSION['role'] == 'admin'){
                                ?>
                                <li class="nav-item"><a class="nav-link" href="adminDashboard.php">Management</span> </a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(!isset($_SESSION['id']))
                            {
                            ?>
                            <li class="nav-item"><a class="nav-link" href="signin.php">Login</span> </a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">Register</span> </a></li>
                            <?php
                            }
                            else{
                            ?>
                                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                                <li class="nav-item">
                                    <a class="nav-link mdi mdi-cart" href="cart.php">
                                        (<span style="font-size: 12px" class="">
                                            <?php
                                            $cartc = new UserView();
                                            $cartc->viewCartCount($_SESSION['id']);
                                            ?>
                                        </span>)
                                    </a>
                                </li>
                            <li class="nav-item"><a class="nav-link" href="?logout=true">logout <span class="fa fa-sign-out"></span> </a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <div class="container">
        <?php
        include 'includes/error_report.inc.php';
        ?>
    </div>
