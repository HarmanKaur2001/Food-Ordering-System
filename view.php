<?php
    require('header.php'); 

    //connect to the database 
    require('connect.php'); 

    //set up SQL statement 
    $sql = "SELECT * FROM food;"; 

    //prepare 
    $statement = $db->prepare($sql); 

    //execute 
    $statement->execute(); 

    //use fetchAll to store results 

    $records = $statement->fetchAll();
    
    //creating the top of the table 
    echo "<table class='table table-striped'><tbody>"; 

    foreach($records as $record) {
        echo "<tr><td>" . $record['firstname'] . "</td><td>" . $record['lastname'] . "</td><td>" . $record['phonenumber'] . "</td><td>". $record['location'] . "</td><td>" . $record['email'] . "</td><td>" . $record['verificationid'] . "</td><td>" . $record['paymentmethod'] . "</td><td>". $record['food'] . "</td><td>". $record['drinks'] . "</td><td>". $record['feedback'] . "</td>
        <td><a href='delete.php?id=". $record['user_id'] . "'> Delete order </a>
        </td>
        <td><a href='index.php?id=". $record['user_id'] . "'> Edit order </a></td>
        </tr>"; 
    }

    echo "</tbody></table>"; 

    //close the DB connection 
    $statement->closeCursor(); 
    require('footer.php'); 
    ?>
