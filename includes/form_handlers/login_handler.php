<?php

echo 'called'; // Debugging: Check if the script is being called

if (isset($_POST['login_button'])) {

    // Sanitize and trim the input
    $email = filter_var(trim($_POST['log_email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['log_pass']); 

    // Store email into session
    $_SESSION['log_email'] = $email;


    // Hash password using MD5
    $hashed_password = md5($password);

    // Formulate the query
    $query = "SELECT * FROM users WHERE email = '$email'";

    // Debugging: Show the SQL query being executed
    echo "SQL Query: $query <br>";

    // Check if the query is successful
    $check_database_query = mysqli_query($con, $query);

    if (!$check_database_query) {
        echo "Error executing query: " . mysqli_error($con);  // Debugging: Display any SQL errors
        exit;
    }

    // Check if there is exactly one matching record
    $check_login_query = mysqli_num_rows($check_database_query);

    // Debugging: Show how many matching rows there are
    echo "Matching rows: $check_login_query <br>";

    if ($check_login_query === 1) {
        // Fetch the user data if the login is successful
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];
        $db_password = $row['password'];


        if(password_verify($password, $db_password)) {
        // Store username in session

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");


        if(mysqli_num_rows($user_closed_query) == 1 ) {
            $reopen_accout = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }
        
        $_SESSION['username'] = $username;


        // Redirect to the homepage after successful login
        header("Location: index.php");
        exit();
        }


    } else {

        array_push($error_array, "Email or Password was incorrect<br>");
    
    }
}
        
?>
