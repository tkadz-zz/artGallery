<?php
class Usercontr extends Users{


    public function contactUs($name, $surname, $email, $subject, $message)
    {
        parent::contactUs($name, $surname, $email, $subject, $message);
    }

    public function deletePayedArt($artID, $paymentID, $id)
    {
        parent::deletePayedArt($artID, $paymentID, $id);
    }

    public function ecocashPay($username, $phone, $datePayed, $uniqID, $id)
    {
        parent::ecocashPay($username, $phone, $datePayed, $uniqID, $id);
    }

    public function cardPay($username, $cardNumber, $cardExp, $cardCvv, $datePayed, $uniqID, $id)
    {
        parent::cardPay($username, $cardNumber, $cardExp, $cardCvv, $datePayed, $uniqID, $id);
    }

    public function pay($uniqID, $id)
    {
        parent::pay($uniqID, $id);
    }

    public function RandomStrings($length)
    {
        parent::RandomStrings($length);
    }


    public function UpdatePassword($op, $cp, $id)
    {
        parent::UpdatePassword($op, $cp, $id);
    }


    public function updateProfile($name, $surname, $email, $id)
    {
        parent::updateProfile($name, $surname, $email, $id);
    }


    public function deleteUser($id)
    {
        parent::deleteUser($id);
    }

    public function deleteArt($artID)
    {
        parent::deleteArt($artID);
    }

    public function admineditUser($name, $surname, $email, $role, $status, $userID)
    {
        parent::admineditUser($name, $surname, $email, $role, $status, $userID);
    }

    public function updateArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $artStatus, $artID)
    {
        parent::updateArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $artStatus, $artID);
    }


    public function addNewArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $file_tmp, $file_destination, $file_name_new, $artStatus, $dateAdded, $id)
    {
        parent::addNewArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $file_tmp, $file_destination, $file_name_new, $artStatus, $dateAdded, $id);
    }


    public function updateCategory($categoryOldName, $categoryNewName, $categoryID)
    {
        parent::updateCategory($categoryOldName, $categoryNewName, $categoryID);
    }


    public function removeCategory($categoryID)
    {
        parent::removeCategory($categoryID);
    }

    public function addCategory($category, $dateAdded)
    {
        parent::addCategory($category, $dateAdded);
    }

    public function removecart($artID, $id)
    {
        parent::removecart($artID, $id);
    }

    public function addcart($artID, $id){
        parent::addcart($artID, $id);
    }


    public function SigninUser($email, $password){
        parent::SigninUser($email, $password);
    }


    public function createUserAccount($name, $surname, $email, $password, $confirmPassword, $joined, $active_status, $user_role)
    {
        parent::createUserAccount($name, $surname, $email, $password, $confirmPassword, $joined, $active_status, $user_role);
    }

    public function log_out(){
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['status']);

        echo "<script type='text/javascript'>
        window.location='index.php';
      </script>";
    }

}
