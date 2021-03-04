<?php
    ob_start(); 
     require('header.php'); 

    //create variables to store form data 

    
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname'); 
    $phonenumber = filter_input(INPUT_POST, 'phonenumber',FILTER_VALIDATE_INT); 
    $location = filter_input(INPUT_POST, 'location'); 
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
    $verificationid = filter_input(INPUT_POST, 'verificationid'); 
    $paymentmethod = filter_input(INPUT_POST, 'paymentmethod');
    $drinks = filter_input(INPUT_POST, 'drinks');
    $food = filter_input(INPUT_POST,'food');
    $feedback = filter_input(INPUT_POST, 'feedback');
    $id = null; 
    $id = filter_input(INPUT_POST, 'user_id');

   
    //set up a flag variable 
    $ok = true; 

    //a lil' bit of form validation 
    if($phonenumber === false) {
        echo "<p> Please use a numeric value for number!</p>"; 
        $ok = false; 
    }
    if($email === false) {
        echo "<p> Please include a properly formatted email!</p>"; 
        $ok = false; 
    }

    if($ok === true) {
        try {
            //connect to the database
            require('connect.php');
            //set up our SQL query 

            //if we have an id, we are editing 
            
            if(!empty($id)) {
                $sql = "UPDATE food SET firstname = :firstname, lastname = :lastname,"
                ." phonenumber = :phonenumber, location = :location,"
                . " email = :email, verificationid = :verificationid, paymentmethod = :paymentmethod,"
                  ." food = :food, drinks = :drink, feedback = :feedback WHERE user_id = :user_id;"; 
            }
            //if not, adding a new record 
            else {
                $sql = "INSERT INTO food (firstname, lastname,phonenumber,location, email,"
                 . "verificationid, paymentmethod,food,drinks,feedback) "
                 . "VALUES (:firstname, :lastname, :phonenumber, :location, :email, :verificationid, :paymentmethod, :food, :drinks, :feedback);"; 
            }
            //call the prepare method of the PDO object 
            $statement = $db->prepare($sql);
            //bind parameters 
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname); 
            $statement->bindParam(':phonenumber', $phonenumber); 
            $statement->bindParam(':location', $location); 
            $statement->bindParam(':email', $email); 
            $statement->bindParam(':verificationid', $verificationid); 
            $statement->bindParam(':paymentmethod', $paymentmethod);
            $statement->bindParam(':food', $food);
            $statement->bindParam(':drinks', $drinks);
            $statement->bindParam(':feedback', $feedback);

            if(!empty($id)) {
                $statement->bindParam(':user_id', $id ); 
            }
            //execute the query 
            $statement->execute();
            //close the db connection 
            $statement->closeCursor(); 
            header('location:view.php'); 
        }
        catch(PDOException $e) {
            echo "<p> Something went wrong! Sorry :( </p>"; 
            $error_message = $e->getMessage(); 
            echo $error_message; 
        }
    }
    ob_flush(); 
    require('footer.php'); ?>
   