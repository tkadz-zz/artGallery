<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_GET['categoryID'])) {
    $categoryID = $_GET['categoryID'];

    try {
        $s = new Usercontr();
        $s->removeCategory($categoryID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }



}