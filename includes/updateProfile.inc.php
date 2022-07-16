<?php
include("autoloader.inc.php");

if(isset($_POST['btn-update-profile'])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    try {
        $s = new Usercontr();
        $s->updateProfile($name, $surname, $email,$_SESSION['id']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}
else{
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>
                window.location='../profile.php';
            </script>";
}
