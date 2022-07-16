<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_POST['btn-update-art-details'])) {
    $artID = $_POST['artID'];
    $artName = $_POST['artName'];
    $authorName = $_POST['authorName'];
    $datePainted = $_POST['datePainted'];
    $artDescription = $_POST['artDescription'];
    $artPrice = $_POST['artPrice'];
    $artCategory = $_POST['artCategory'];
    $artStatus = $_POST['artStatus'];

    try {
        $s = new Usercontr();
        $s->updateArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $artStatus, $artID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}
else{
    $artID = $_POST['artID'];
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>
                    window.location='../adminArtDetails.php?artID='.$artID;
                </script>";
}
