<?php
include 'includes/header.inc.php';
include "includes/navbar.inc.php";

?>


<?php
$id = $_GET['art'];

$v = new UserView();
$v->viewArt($id)
?>


<?php
include 'includes/footer.inc.php';
?>