<?php 
ob_start(); 
try {
    $order_id = filter_input(INPUT_GET, 'id'); 
    //connect to db 
    require('connect.php'); 
    //set up query 
    $sql = "DELETE FROM food WHERE user_id = :user_id;"; 
    //prepare 
    $statement = $db->prepare($sql); 
    //bind
    $statement->bindParam(':user_id', $order_id); 
    //execute
    $statement->execute(); 
    //close DB connection 
    $statement->closeCursor();
    header('location:view.php'); 
}
catch(PDOException $e) {
    header('location:error.php');
}
ob_flush(); 
?> 