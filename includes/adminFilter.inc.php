<?php
if($_SESSION['role'] != 'admin'){
    //not admin
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'You are not Authorised to access this page.';
    echo "<script type='text/javascript'>;
              window.location='index.php';
            </script>";
}