<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

$userID = $_POST['userID'];
if(isset($_POST['btn-edit-user'])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    try {
        $s = new Usercontr();
        $s->admineditUser($name, $surname, $email,$role, $status, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}
else{
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>
                    window.location='../adminDashboard.php?userID=".$userID."';
                </script>";
}
