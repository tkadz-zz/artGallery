<?php
include("autoloader.inc.php");

if(isset($_POST['btn-contact-us'])) {

    $name = $_POST['first_name'];
    $surname = $_POST['last_name'];
    $subject = $_POST['subject'];
    $email = $_POST['replyto'];
    $message = $_POST['message'];

    if(strlen($name) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Name must not be empty';
        echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";

    }
    elseif (strlen($surname) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Surname must not be empty';
        echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
    }

    elseif (strlen($subject) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Subject must not be empty';
        echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
    }

    elseif (strlen($email) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Email must not be empty';
        echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
    }

    elseif (strlen($message) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Message Body must not be empty';
        echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
    }

    else{
        try {
            $s = new Usercontr();
            $s->contactUs($name, $surname, $email, $subject, $message);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }

}
else{
    $_SESSION['type'] = 'w';
    $_SESSION['err'] = 'No Command';
    echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
}
