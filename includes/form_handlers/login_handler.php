<?php

echo 'called'; // Debugging: Check if the script is being called

if (isset($_POST['login_button'])) {

    // Sanitize and trim the input
    $email = filter_var(trim($_POST['log_email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['log_pass']); 

    // Store email into session
    $_SESSION['log_email'] = $email;

    // Debugging: Show the email and password (don't do this in production)
    echo "Email: $email <br>";
    echo "Raw password: $password <br>";

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
        $_SESSION['username'] = $username;

        // Redirect to the homepage after successful login
        header("Location: index.php");
        exit();
        }


    } else {
        echo "Invalid credentials."; // Show an error if credentials don't match
    }
}

?>
