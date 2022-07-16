<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_POST['delete-art-btn'])) {
    $artID = $_POST['artID'];
    try {
        $s = new Usercontr();
        $s->deleteArt($artID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}


if(isset($_GET['userID'])){
    $userID = $_GET['userID'];
    try {
        $s = new Usercontr();
        $s->deleteUser($userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

