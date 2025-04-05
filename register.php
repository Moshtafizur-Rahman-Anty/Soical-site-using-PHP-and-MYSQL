<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

$con = mysqli_connect("localhost", "root", "", "social");

if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
}

$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = []; // Should be an array

if (isset($_POST["register_button"])) {

    // First Name
    $fname = strip_tags($_POST["reg_fname"]);
    $fname = str_replace(' ', '', $fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname;

    // Last Name
    $lname = strip_tags($_POST["reg_lname"]);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;

    // Email
    $em = strip_tags($_POST["reg_email"]);    
    $em = str_replace(' ', '', $em);
    $em = strtolower($em); // Removed ucfirst()
    $_SESSION['reg_email'] = $em;


    // Confirm Email
    $em2 = strip_tags($_POST["reg_email2"]);
    $em2 = str_replace(' ', '', $em2);
    $em2 = strtolower($em2); // Removed ucfirst()    
    $_SESSION['reg_email2'] = $em2;


    // Passwords
    $password = strip_tags($_POST["reg_password"]);
    $password2 = strip_tags($_POST["reg_password2"]);

    $date = date("Y-m-d");

    // Email Validation
    if ($em == $em2) {
        
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                array_push($error_array, "email already in use<br>");
            }
        }

        else {
            array_push($error_array, "INVALID FORMAT<br>");
        }



    } else {
        array_push($error_array, "Emails don't match<br>");
    }



    if(strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 charecter<br>");
    }

    
    if(strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 charecter<br>");
    }

    if($password != $password2) {
        array_push($error_array, "Your PassWords don't match<br>");
    }

    else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your passwprd can only contain english charecter or numbers<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 charecter<br>");
    }
    
    if(empty($error_array)) {

        $password = password_hash($password, PASSWORD_BCRYPT);

    //Genrate username by concatenating

    $username = strtolower($fname . "_" . $lname);
    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

    $i = 0;

    while(mysqli_num_rows($check_username_query) > 0) {
        $i++;
        $username = $fname . "_" . $lname . "_" . $i;
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
    }
    

    //Profile Picture assignment

    $rand = rand(1, 2); //random number between 1 and 2

    if($rand == 1) {

    $profile_pic = "assests/images/profile_pics/defaults/head_deep_blue.png";
    }

    else if ($rand == 2)  {
        $profile_pic = "assests/images/profile_pics/defaults/head_deep_blue.png";

    }

    $query = mysqli_query($con, "INSERT INTO users (first_name, last_name, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array, username) 
    VALUES ('$fname', '$lname', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',', '$username')");
    
    array_push($error_array, "<span style='color:#14c800;'> You're all set! Go ahead and login!</span> <br>");

  
    $_SESSION["reg_fname"] = "";
$_SESSION["reg_lname"] = "";
$_SESSION["reg_email"] = "";
$_SESSION["reg_email2"] = "";
$_SESSION["reg_password"] = "";  // Reset password
$_SESSION["reg_password2"] = ""; // Reset confirm password

}  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

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
