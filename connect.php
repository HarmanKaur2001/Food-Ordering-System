<?php
try {
    $dsn = 'mysql:host=localhost;dbname=food order'; 
    $username = 'root'; 
    //$password = 'W54pmddcpU'; //mamp users 
    $password = '';// wamp users  

    $db = new PDO($dsn, $username, $password); 
    //echo "<p> Successfully connected!!! Whoo hoo! </p>";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<p> Something went wrong :( </p>"; 
    $error_message = $e->getMessage(); 
    echo $error_message; 
}
?>