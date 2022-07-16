<?php
include("autoloader.inc.php");
$username_small = $_POST['username'];
$username = strtoupper($username_small);

$datePayed = date("Y-m-d h:m:i");


$uniqIDGet = new UserView();
$uniqID = $uniqIDGet->randomString(10);



if(isset($_POST['ecocashPay'])) {

    $phone = $_POST['phone'];

    if(strlen($username) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Username can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif (strlen($phone) < 10){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Phone Number can not be less than 10 Chars ';
        echo "<script>
                history.back(-1);
            </script>";
    }
    else{
        try {
            $s = new Usercontr();
            $s->ecocashPay($username, $phone, $datePayed, $uniqID, $_SESSION['id']);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }


}
elseif (isset($_POST['cardPay'])){

    $cardNumber = $_POST['cardNumber'];
    $cardExp = $_POST['cardExp'];
    $cardCvv = $_POST['cardCvv'];


    if(strlen($username) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Username can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($cardExp) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Card expiration date was not specifed';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($cardCvv) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'You can find the CVV number on from or back of your Debit/Credit Card';
        echo "<script>
                history.back(-1);
            </script>";
    }
    else{
        try {
            $s = new Usercontr();
            $s->cardPay($username, $cardNumber, $cardExp, $cardCvv, $datePayed, $uniqID, $_SESSION['id']);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }
}


else{
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'No Payment Specified';
    echo "<script type='text/javascript'>
                    window.location='../cart.php';
                </script>";
}
