<?php

echo "file called";


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