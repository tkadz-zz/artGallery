<?php
if(!isset($_SESSION['id'])){
    //not admin
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'You must login first to view this page resources';
    echo "<script type='text/javascript'>;
              window.location='index.php';
            </script>";
}