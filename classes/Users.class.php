<?php


class Users extends Dbh
{


    protected function contactUs($name, $surname, $email, $subject, $message){
        //
        $dateAdded = date("Y-m-d h:m:i");
        $sql = "INSERT INTO contactUs(name, surname, email, subject, message, dateAdded) VALUES (?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $subject, $message, $dateAdded])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Thank you for contacting Us, we will reply as soon as we can';
            echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
        }
        else{
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'OPps! Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../contact.php';
                </script>";
        }

    }


    protected function deletePayedArt($artID, $paymentID, $id){
        $arts = $this->GetPayedArtByArtID($artID);
        $sql = "DELETE FROM payments WHERE artID=? AND id=? AND userID=?";
        $stmt = $this->con()->prepare($sql);

        if($stmt->execute([$artID, $paymentID, $id])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Art Deleted from payed art';
            echo "<script type='text/javascript'>
                    window.location='../payedArt.php';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps, Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../payedArt.php';
                </script>";
        }

    }


    protected function ecocashPay($username, $phone, $datePayed, $uniqID, $id){
        $artCount = $this->GetAllUserArtById($id);
        if(count($artCount)< 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'You should have at-least one item in your cart that you want to purchase';
            echo "<script type='text/javascript'>;
                      window.location='../cart.php';
                    </script>";
        }else {
            $amount = $this->GetTotalCartArtPriceByID($id);

            $payMethod = "ecocash";
            $blank = '';

            $sql = "INSERT INTO paymentDetails(payMethod, uniqueGroupID, username, userID, amount, phone, cardNumber, cardExp, cardCvv, datePayed) 
                VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$payMethod, $uniqID, $username, $id, $amount, $phone, $blank, $blank, $blank, $datePayed])) {
                $this->pay($uniqID, $id);
            } else {
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Failed to Pay, Please try again..';
                echo "<script type='text/javascript'>;
                      window.location='../payNow.php';
                    </script>";
            }
        }
    }

    protected function cardPay($username, $cardNumber, $cardExp, $cardCvv, $datePayed, $uniqID, $id){
        $artCount = $this->GetAllUserArtById($id);
        if(count($artCount) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'You should have at-least one item in your cart that you want to purchase';
            echo "<script type='text/javascript'>;
                      window.location='../cart.php';
                    </script>";
        }
        else {
            $amount = $this->GetTotalCartArtPriceByID($id);

            $payMethod = "card";
            $blank = '';
            $sql = "INSERT INTO paymentDetails(payMethod, uniqueGroupID, username, userID, amount, phone, cardNumber, cardExp, cardCvv, datePayed) 
                VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$payMethod, $uniqID, $username, $id, $amount, $blank, $cardNumber, $cardExp, $cardCvv, $datePayed])) {
                $this->pay($uniqID, $id);
            } else {
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Failed to Pay, Please try again..';
                echo "<script type='text/javascript'>;
                      window.location='../payNow.php';
                    </script>";
            }
        }
    }


    protected function pay($uniqID, $id){
        $arts = $this->GetAllUserArtById($id);
        $dateAdded = date("Y-m-d h:m:i");
        $s = 0;

        foreach ($arts as $row) {
            $artID = $row['artID'];
            $sql = "INSERT INTO payments(artID, userID, uniqueGroupID, datePayed) VALUES(?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$artID, $id, $uniqID, $dateAdded]);

            $sql1 = "DELETE FROM cart WHERE userID=?";
            $stmt1 = $this->con()->prepare($sql1);
            $stmt1->execute([$id]);
        }
        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Payment Was Successfully Done';
        echo "<script type='text/javascript'>;
                      window.location='../payedArt.php';
                    </script>";


    }


    protected function UpdatePassword($op, $cp, $id){
        $rows = $this->GetUserById($id);

        if (password_verify($op, $rows[0]['password'])) {
            //Match
            $sql2 = "UPDATE users SET password=? WHERE id=?";
            $stmt2 = $this->con()->prepare($sql2);
            $pass_safe = password_hash($cp, PASSWORD_DEFAULT);

            if ($stmt2->execute([$pass_safe, $id])) {

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Password Updated Successfully';

                echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
            } else {

                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Password Update Failed';

                echo "<script type='text/javascript'>;
                      window.location='../profile.php?password';
                    </script>";
            }
        } else {
            //Not Matched

            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Old password did not match';

            echo "<script type='text/javascript'>;
                      window.location='../profile.php?password';
                    </script>";
        }

    }





    protected function updateProfile($name, $surname, $email,$id){
        $this->GetUserById($id);
        $sql = "UPDATE users SET name=?, surname=?, email=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name,$surname, $email, $id])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Profle Updated Successfully';

            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $email;

            echo "<script type='text/javascript'>
                    window.location='../profile.php';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps, Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../profile.php';
                </script>";
        }
    }




    protected function deleteUser($id){
        $users = $this->GetUserById($id);

        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);

        $sql1 = "DELETE FROM cart WHERE userID=?";
        $stmt1 = $this->con()->prepare($sql1);

        $sql2 = "DELETE FROM paymentDetails WHERE userID=?";
        $stmt2 = $this->con()->prepare($sql2);

        $sql3 = "DELETE FROM payments WHERE userID=?";
        $stmt3 = $this->con()->prepare($sql3);


        if($stmt->execute([$id]) AND $stmt1->execute([$id]) AND $stmt2->execute([$id]) AND $stmt3->execute([$id]) ){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'User has been Deleted from the database';
            echo "<script type='text/javascript'>
                    window.location='../adminDashboard.php?users';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps, Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    history.back(-2);
                </script>";
        }

    }


    protected function deleteArt($artID){
        $artRows = $this->GetArtById($artID);
        $artsouce_raw = $artRows[0]['source'];
        $artsouce = "../".$artsouce_raw;
        if(unlink($artsouce)){
            $sql = "DELETE FROM cart WHERE artID=?";
            $stmt = $this->con()->prepare($sql);

            $sql1 = "DELETE FROM art WHERE id=?";
            $stmt1 = $this->con()->prepare($sql1);

            if($stmt->execute([$artID]) AND $stmt1->execute([$artID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Art has been Deleted from the database';
                echo "<script type='text/javascript'>
                    window.location='../allart.php';
                </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>
                    window.location='../adminArtDetails.php?artID=".$artID."';
                </script>";
            }
        }else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to unlink Art File from Source';
            echo "<script type='text/javascript'>
                    window.location='../adminArtDetails.php?artID=".$artID."';
                </script>";
        }
    }


    protected function admineditUser($name, $surname, $email, $role, $status, $userID){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        $rows = $stmt->fetchAll();
        if(count($rows) > 0){
            $sql1 = "UPDATE users SET name=?, surname=?, email=?, role=?, status=? WHERE id=?";
            $stmt1 = $this->con()->prepare($sql1);
            if($stmt1->execute([$name, $surname, $email, $role, $status, $userID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Account Updated Successfully';
                echo "<script type='text/javascript'>
                    window.location='../adminDashboard.php?userID=".$userID."';
                </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>
                    window.location='../adminDashboard.php?userID=".$userID."';
                </script>";
            }
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'User Account Not Found';
            echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?users';
                </script>";
        }
    }


    protected function updateArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $artStatus, $artID){
        $sqla = "UPDATE art SET name=?, author=?, category=?, creationDate=?, description=?, price=?, status=? WHERE id=?";
        $stmta = $this->con()->prepare($sqla);
        $stmta->execute([$artName, $authorName, $artCategory, $datePainted, $artDescription, $artPrice, $artStatus, $artID]);
        if($stmta){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Art Details Updated Successfully';
            echo "<script type='text/javascript'>
                    window.location='../adminArtDetails.php?artID=".$artID."';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../adminArtDetails.php?artID=".$artID."';
                </script>";
        }
    }



    protected function addNewArt($artName, $authorName, $datePainted, $artDescription, $artPrice, $artCategory, $file_tmp, $file_destination, $file_name_new, $artStatus, $dateAdded, $id){
        $filed = 'art/'.$file_name_new.'';
        if(move_uploaded_file($file_tmp, $file_destination)){
            $artCurrency = "USD";
            $sql = "INSERT INTO art(name, source, author, category, creationDate, description, uploadedBy, price, priceCurrency, status)
                    VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$artName, $filed, $authorName, $artCategory, $datePainted, $artDescription, $id, $artPrice, $artCurrency, $artStatus]);
            if($stmt){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Art Added Successfully';
                echo "<script>
                    window.location='../adminDashboard.php';
                </script>";
            }
            else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong while uploading the Art Image';
            echo "<script>
                    history.back(-2);
                </script>";
            }
        }
        else{
            //Art Image too big
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong while uploading the Art Image';
            echo "<script>
                    history.back(-2);
                </script>";
        }
    }





    protected function updateCategory($categoryOldName, $categoryNewName, $categoryID){
        $sql = "SELECT * FROM categories WHERE name=? and id=? ";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$categoryOldName, $categoryID]);
        $rows = $stmt->fetchAll();
        if(count($rows) > 0){
            $sql1 = "UPDATE categories SET name=? WHERE id=? AND name=?";
            $stmt1 = $this->con()->prepare($sql1);
            if($stmt1->execute([$categoryNewName, $categoryID, $categoryOldName])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Category was successfully updated from '.$categoryOldName.' to '.$categoryNewName.'.';
                    echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?artcategories';
                </script>";
            }
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Category was not found in the database';
            echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?categoryID='.$categoryID.'&categoryName='.$categoryOldName.'';
                </script>";
        }
    }


    protected function removeCategory($categoryID){
        $sql = "DELETE FROM categories WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$categoryID]);

        $newCateg = 1;
        $sql1 = "UPDATE art SET category=? WHERE category=?";
        $stmt1 = $this->con()->prepare($sql1);
        $stmt1->execute([$newCateg, $categoryID]);

        if($stmt AND $stmt1){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Category successfully deleted';
            echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?artcategories';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Please try again.';
            echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?artcategories';
                </script>";
        }
    }


    protected function addCategory($category, $dateAdded){
        $sql = "SELECT * FROM categories WHERE name=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$category]);
        $rows = $stmt->fetchAll();
        if(count($rows) > 0) {
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Category with the same name _'. $category .'_ already exist';
            echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?addcategory';
                </script>";
        }
        else{
            $sql1 = "INSERT INTO categories(name, dateAdded)
                    VALUES(?,?) ";
            $stmt1 = $this->con()->prepare($sql1);
            if($stmt1->execute([$category, $dateAdded])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Category '.$category.' had been added';
                echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?addcategory';
                </script>";
            }
            else{
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>;
                  window.location='../adminDashboard.php?addcategory';
                </script>";
            }
        }
    }


    protected function removecart($artID, $id){
        $sql = "SELECT * FROM cart WHERE userID=? AND id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id, $artID]);
        $rows = $stmt->fetchAll();
        if(count($rows) > 0){
            $sql1 = "DELETE FROM cart WHERE userID=? AND id=?";
            $stmt1 = $this->con()->prepare($sql1);
            if($stmt1->execute([$id, $artID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Art removed from cart';
                echo "<script type='text/javascript'>;
                  window.location='../cart.php';
                </script>";
            }
            else{
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>;
                  window.location='../cart.php';
                </script>";
            }
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Art not found or already removed from cart';
            echo "<script type='text/javascript'>;
                  window.location='../cart.php';
                </script>";

        }
    }


    protected function addcart($artID,$id){
        $sql = "SELECT * FROM cart WHERE userID=? AND artID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id, $artID]);
        $rows = $stmt->fetchAll();
        if(count($rows) > 0){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Art piece already added to cart';
            echo "<script type='text/javascript'>;
                      history.back(-2);
                    </script>";
        }
        else{
            $quantity = 1;
            $dateAdded = 1;
            $sql1 = "INSERT INTO cart(userID, artID, quantity, dateAdded)
                    VALUES(?,?,?,?)";
            $stmt1 = $this->con()->prepare($sql1);
            if($stmt1->execute([$id, $artID, $quantity, $dateAdded])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Art has been Added to cart';
                echo "<script type='text/javascript'>;
                      window.location='../cart.php';
                    </script>";
            }
            else{
                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>;
                      history.back(-2);
                    </script>";
            }
        }
    }



    protected function createUserAccount($name, $surname, $email, $password, $confirmPassword, $joined, $active_status, $user_role)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->con()->prepare($sql);
        if ($stmt->execute([$email])) {
            $rows = $stmt->fetchAll();
            if (count($rows)>0) {
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Email already registered, try login in if it belongs to you or choose another email address.';
                echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
            } else {
                $setSql = "INSERT INTO users(name, surname, email, password, role, status, dateJoined)
                        VALUES (?,?,?,?,?,?,?)";
                $setStmt = $this->con()->prepare($setSql);
                if ($setStmt->execute([$name, $surname, $email, $password, $user_role, $active_status, $joined])) {
                    Usercontr::SigninUser($email, $confirmPassword);
                } else {
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Failed to create account.';
                    echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
                }
            }

        } else {
            $_SESSION['type'] = 'd';
            $_SESSION['err'] == 'Opps! Something went wrong. Please try again.';
            echo "<script type='text/javascript'>;
                          window.location='../signup.php';
                        </script>";
        }
    }












    // LOGIN/SIGNIN
    protected function SigninUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=? ";
        $stmt = $this->con()->prepare($sql);
        if ($stmt->execute([$email])) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {
                //Proceed to normal login
                foreach ($record as $row) {
                    $passwords = $row["password"];
                    $user_id = $row["id"];

                    if (password_verify($password, $passwords)) {
                        $_SESSION['id'] = $user_id;
                        $par = NULL; //This is a third parameter lm using for password auto login through sign-in pae


                        $rowUser = $this->GetUserByEmail($email);
                        $_SESSION['name'] = $rowUser[0]['name'];
                        $_SESSION['surname'] = $rowUser[0]['surname'];
                        $_SESSION['email'] = $email;
                        $_SESSION['role'] = $rowUser[0]['role'];

                        if($rowUser[0]['status'] != 1){
                            $_SESSION['type'] = 'd';
                            $_SESSION['err'] = 'Your account ('. $rowUser[0]['name'] .' '. $rowUser[0]['surname'] .') is temporarily deactivated. Contact the administrator to get this issue fixed';

                            unset($_SESSION['id']);
                            unset($_SESSION['name']);
                            unset($_SESSION['surname']);
                            unset($_SESSION['email']);
                            unset($_SESSION['role']);
                            unset($_SESSION['status']);

                            echo "<script type='text/javascript'>
                        window.location='../signin.php?email=$email';
                      </script>";
                        }
                        else{
                            $_SESSION['type'] = 'i';
                            $_SESSION['err'] = 'Welcome back '. $rowUser[0]['name'] .' '. $rowUser[0]['surname'] .'.';

                            echo "<script type='text/javascript'>;
                          history.go(-2);
                        </script>";
                        }



                    } else {
                        //Password Did Not match
                        $_SESSION['type'] = 'w';
                        $_SESSION['err'] = 'Wrong Email or Password';

                        echo "<script type='text/javascript'>;
                          window.location='../signin.php?email=".$email."';
                        </script>";
                    }
                }




            }
            /* No rows matched -- do something else */
            else {
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Wrong Email or Password';

                echo "<script type='text/javascript'>;
                          window.location='../signin.php?email=".$email."';
                        </script>";
            }
        }
    }



    protected function GetAllCategoriesShortLoop(){
        $sql = "SELECT * FROM categories order by RAND() limit 0,6";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetPayedArtByUserID($id){
        $sql = "SELECT * FROM payments WHERE userID=? order by id desc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function paymentHistory($id){
        $sql = "SELECT * FROM paymentDetails WHERE userID=? order by id desc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function paymentHistoryByUniueID($uniqueID){
        $sql = "SELECT * FROM paymentDetails WHERE uniqueGroupID=? order by id desc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uniqueID]);
        return $stmt->fetchAll();
    }

    protected function adminPaymentHistory($id){
        $sql = "SELECT * FROM payments WHERE artID=? order by id desc";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function paymentHistoryCount($uniqueID, $id){
        $sql = "SELECT * FROM payments WHERE uniqueGroupID=? AND userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uniqueID ,$id]);
        return $stmt->fetchAll();
    }


    protected function GetAllContacts(){
        $sql = "SELECT * FROM contactUs ORDER BY id DESC ";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetAllContactById($id){
        $sql = "SELECT * FROM contactUs WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Contact not found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetCategoryById($id){
        $sql = "SELECT * FROM categories where id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetPayedArtByArtID($id){
        $sql = "SELECT * FROM payments WHERE artID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Payed Art Not Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
    }


    protected function GetAllCategories(){
        $sql = "SELECT * FROM categories order by name";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    protected function artCount($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function RandomStrings($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    protected function GetUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll();
    }

    protected function GetUserById($id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'User Not Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
    }


    protected function GetTotalCartArtPriceByID($id){
        $rows = $this->GetAllUserArtById($id);
        $price = 0;
        foreach ($rows as $row){
            $artId =  $row['artID'];
            $rows2 = $this->GetArtCartSumById($artId);
            foreach ($rows2 as $row2){
                $price += $row2['price'];
            }
        }
        if($price == NULL || $price <= 0){
            return 0;
        }
        else {
            return $price;
        }
    }

    protected function GetAllUser(){
        $sql = "SELECT * FROM users order by role";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetAllUserArtById($id){
        $sql = "SELECT * FROM cart where userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetArtCartSumById($id){
        $sql = "SELECT * FROM art WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetArtById($id){
        $sql = "SELECT * FROM art where id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) != 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Art Piece Not Available';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
    }



}