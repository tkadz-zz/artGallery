<?php
include("autoloader.inc.php");

if(isset($_GET['artID'])){
    $artID = $_GET['artID'];
    $paymentID = $_GET['paymentID'];
    $id = $_SESSION['id'];
    try {
        $si = new Usercontr();
        $si->deletePayedArt($artID, $paymentID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}
