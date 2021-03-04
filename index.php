<?php require('header.php'); 
//initialize variables 

$id = ""; 
$firstname = null;
$lastname = null; 
$location = null;
$phonenumber = null;
$email = null;
$verificationid= null;
$paymentmethod = null; 
$food = null;
$drinks= null; 
$feedback = null; 

//check if user is editing 

if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
    //grab id and store in a variable 
    $id = filter_input(INPUT_GET, 'id');
    //connect to db 
    require('connect.php'); 
    //set up query 
    $sql = "SELECT * FROM food WHERE user_id = :user_id;"; 
    //prepare 
    $statement = $db->prepare($sql); 
    //bind 
    $statement->bindParam(':user_id', $id); 
    //execute 
    $statement->execute(); 
    //use fetchAll method to store 
    $records = $statement->fetchAll(); 
    foreach($records as $record) :
        $firstname = $record['firstname']; 
        $lastname = $record['lastname']; 
        $location = $record['location']; 
        $phonenumber = $record['phonenumber']; 
        $email = $record['email']; 
        $verificationid= $record['verificationid']; 
        $paymentmethod = $record['paymentmethod'];
        $food  = $record['food'];
        $drinkS = $record['drinks'];
        $feedback = $record['feedback'];
     endforeach; 
     $statement->closeCursor(); 
    }
?>
    
    <main>
        <form action="process.php" method="post">
            <!-- add hidden input to include the id without the user seeing -->
            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <input type="text" name="firstname" placeholder="First Name" class="form-control" value="<?php echo $firstname; ?>" >
            </div>
            <div class="form-group">
                <input type="text" name="lastname" placeholder="Last Name" class="form-control" value="<?php echo $lastname; ?>">
            </div> 
            <div class="form-group">
                <input type="number" name="phonenumber" placeholder="Contact Info" class="form-control" value="<?php echo $phonenumber; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="location" placeholder="Customer Location" class="form-control" value="<?php echo $location; ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <h4>Verification Id</h4>
                <input type="radio" name = "verificationid" id="Visa" <?php if (isset($verificationid) && $verificationid=="DriverLicenece") echo "checked";?>
                 value="Visa">
                <label for="DriverLicence">Driver Licence</label><br>
                <input type="radio" name = "verificationid" id="other"  <?php if (isset($verificationid) && $verificationid=="Visa") echo "checked";?>
                 value="other">
                <label for="other">Other</label><br> 
            </div>
            <div class="form-group">
                <h4>Payment method</h4>
                <input type="radio" name = "paymentmethod" id="creditcard" <?php if (isset($paymentmethod) && $paymentmethod=="creditcard") echo "checked";?>
                 value="creditcard">
                <label for="Credit Card">Credit Card</label><br>
                <input type="radio" name = "paymentmethod"  id="mastercard" <?php if (isset($paymentmethod) && $paymentmethod=="mastercard") echo "checked";?>
                 value="mastercard">
                <label for="MasterCard">Master Card</label><br>
                <input type="radio" name = "paymentmethod" id="visa" <?php if (isset($paymentmethod) && $paymentmethod=="visa") echo "checked";?>
                 value="visa">
                <label for="Visa">Visa</label><br>
                <input type="radio" name = "paymentmethod" id="paytm" <?php if (isset($paymentmethod) && $paymentmethod=="paytm") echo "checked";?>
                 value="paytm">
                <label for="Paytm">Paytm</label><br>
                <input type="radio" name = "paymentmethod"  id="promocard" <?php if (isset($paymentmethod) && $paymentmethod=="promocard") echo "checked";?>
                 value="promocard">
                <label for="Promo Card">Promo Card</label><br>
            </div>
            <div class = "form-group">
                <h4>Type Of Food</h4>
                <input type="radio" name="food" <?php if (isset($food) && $food=="Snacks") echo "checked";?> value="Snacks">Snacks
                <input type="radio" name="food" <?php if (isset($food) && $food=="desert") echo "checked";?> value="desert">desert
                <input type="radio" name="food" <?php if (isset($food) && $food=="starter") echo "checked";?> value="starter">starter
            </div>
            <div class="form-group">
                <h4>Chose the drinks</h4>
                <input type="text" name="drinks" placeholder="Drink with meal" class="form-control" value="<?php echo $drinks; ?>">
           </div>
                <div class="form-group">
            <h5>Feedback:</h5>
                <textarea name="feedback" placeholder="write the feedback" class="form-control" value="<?php echo $feedback; ?>"></textarea>
            </div>
                <input type="submit" value="submit" name="submit" class="btn btn-primary">
                <input type="Reset" value="Reset" name="Reset" class="btn btn-primary">
        </form>
    </main>
<?php require('footer.php'); ?>