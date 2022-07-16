<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_POST['btn-update-category'])) {

    $categoryNewNameunset = $_POST['categoryNewName'];
    $categoryNewName = strtoupper($categoryNewNameunset);
    $categoryOldName = $_POST['categoryOldName'];
    $categoryID = $_POST['categoryID'];

    if(strlen($categoryNewName) < 4){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Category length not matching the required minimum value(4) ';
        echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?categoryID='.$categoryID.'&categoryName='.$categoryOldName.'';
                </script>";
    }else {

        try {
            $s = new Usercontr();
            $s->updateCategory($categoryOldName, $categoryNewName, $categoryID);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }

}