<?php
include("autoloader.inc.php");
include "adminFilter.inc.php";

if(isset($_POST['btn-post-new-art'])) {
    $artName = $_POST['artName'];
    $authorName = $_POST['authorName'];
    $datePainted = $_POST['datePainted'];
    $artDescription = $_POST['artDescription'];
    $artCategory = $_POST['artCategory'];
    $artPrice = $_POST['artPrice'];
    $artStatususet = $_POST['artStatus'];





    $artFile = $_FILES['artFile'];
    //File properties
    $file_name  =   $artFile['name'];
    $file_tmp   =   $artFile['tmp_name'];
    $file_size  =   $artFile['size'];
    $file_error =   $artFile['error'];

    //Work out file extension
    $file_ext   =   explode('.',$file_name);
    $file_ext   = strtolower(end($file_ext));

    $allowed    = array('jpg','jpeg','png');

    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size <= 5242880){
                $file_name_new  = uniqid('',true).'.'.$file_ext;
                $file_destination   ='../art/'.$file_name_new;
            }
            else{
                //Art Image too big
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Art Image should be at-least 5MB in size';
                echo "<script>
                    history.back(-1);
                </script>";
            }
            // Initialise these two variables: $file_tmp, $file_destination, $file_name_new
        }
        else{
            //file not uploaded
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Art Image not uploaded';
            echo "<script>
                history.back(-1);
            </script>";
        }
    }
    else{
        //file extension error
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Art Image should be either JPG, JPEG or PNG Image';
        echo "<script>
                history.back(-1);
            </script>";
    }








    if($artStatususet == 'on'){
        $artStatus = 1;
    }
    else{
        $artStatus = 0;
    }



    if(strlen($artName) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Art Name can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    if(strlen($artPrice) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Art Name can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($authorName) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Art Author Name can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($datePainted) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Date Painted can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($artDescription) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Date Painted can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    elseif(strlen($artCategory) < 1){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Art Category can not be empty';
        echo "<script>
                history.back(-1);
            </script>";
    }
    else{

        try {
            $dateAdded = date("Y-m-d h:m:i");
            $s = new Usercontr();
            $s->addNewArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $file_tmp, $file_destination, $file_name_new, $artStatus, $dateAdded, $_SESSION['id']);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }


}