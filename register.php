<?php


require 'config/config.php';

require 'includes/form_handlers/register_handler.php';


if (isset($_POST['login_button'])) {
    require 'includes/form_handlers/login_handler.php';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<form action="register.php" method="POST">

    <input type="email" name="log_email" placeholder="Email Address"value = "<?php if(isset($_SESSION['reg_email'])) {
            echo $_SESSION['log_email'];
        }?>" required>
    <br>
    <input type="password" name="log_pass" placeholder="Password" required>
    <br>
    <input type="submit" name="login_button" value="Login">
    <br>
    <br>
    <?php if (in_array("Email or Password was incorrect<br>", $error_array)) echo "Email or Password was incorrect<br>"; ?>

</form>


    <form action="register.php" method="post">
        <input type="text" name="reg_fname" placeholder="First Name" value = "<?php if(isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];
        }?>" required>

        <?php  if(in_array("Your first name must be between 2 and 25 charecter<br>", $error_array)) echo "Your first name must be between 2 and 25 charecter<br>"?>      
        

        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" value = "<?php if(isset($_SESSION['reg_lname'])) {
            echo $_SESSION['reg_lname'];
        }?>"  required>

        <?php  if(in_array("Your last name must be between 2 and 25 charecter<br>", $error_array)) echo "Your last name must be between 2 and 25 charecter<br>"?>

        <br>
        <input type="email" name="reg_email" placeholder="Email" value="<?php 
    if(isset($_SESSION['reg_email'])) {
        echo $_SESSION['reg_email']; // Will be empty after success
    }
?>" required>

        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
    if(isset($_SESSION['reg_email2'])) {
        echo $_SESSION['reg_email2']; // Will be empty after success
    }
?>" required>


        <?php  if(in_array("email already in use<br>", $error_array)) echo "email already in use<br>";
         else if(in_array("INVALID FORMAT<br>", $error_array)) echo "INVALID FORMAT<br>";
         else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>";?>

        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Register">
        <br>
        <?php
         if(in_array("<span style='color:#14c800;'> You're all set! Go ahead and login!</span> <br>", $error_array)) echo "<span style='color:#14c800;'> You're all set! Go ahead and login!</span> <br>";?>


    </form>

</body>
</html>
