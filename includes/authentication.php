<?php
include("autoloader.inc.php");

if(isset($_POST['btn-signin'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $login = new Usercontr();
        $login->SigninUser($email, $password);

    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}



elseif (isset($_POST['createAccountBtn'])){

    $nameRaw = $_POST["name"];
    $name = strtoupper($nameRaw);

    $surnameRaw = $_POST["surname"];
    $surname = strtoupper($surnameRaw);

    $emailRaw = $_POST["email"];
    $email = $emailRaw;

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password != $confirmPassword) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Password did match';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    }
    elseif (strlen($password) < 8 || strlen($confirmPassword) < 8) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Password did not meet required minimum limit';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    }
   elseif (strlen($email) < 1) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Email is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } elseif (strlen($name) < 1) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Name is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } elseif (strlen($surname) < 1) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Surname is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } elseif (strlen($password) < 8 || strlen($confirmPassword) < 8) {
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Password is too short: must be at least 8 characters long';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } else {

        $password = password_hash($confirmPassword, PASSWORD_BCRYPT);

        $joined = date("Y-m-d h:m:i");
        $active_status = 1;
        $user_role = "user";


        try {
            $sign_up_now = new Usercontr();
            $sign_up_now->createUserAccount($name, $surname, $email, $password, $confirmPassword, $joined, $active_status, $user_role);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }


    }


}



else{
    echo "<script type='text/javascript'>;
             window.location='../unauthorized.php';
            </script>";
}

