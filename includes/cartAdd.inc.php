<?php
include("autoloader.inc.php");

if(isset($_GET['artID'])) {

    try {
        $s = new Usercontr();
        $s->addcart($_GET['artID'], $_SESSION['id']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}
else{
    $_SESSION['type'] = 'd';
    $_SESSION['err'] = 'Art not found';
    echo "<script type='text/javascript'>;
             history.back(-1);
            </script>";
}