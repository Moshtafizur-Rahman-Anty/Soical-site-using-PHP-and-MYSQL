<?php
require 'config/config.php';


if(isset($_SESSION['username'])) {
   $userLoggedIn = $_SESSION['username'];
   $user_data = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
   $user = mysqli_fetch_array($user_data);
}

else {
   header("Location: register.php");
}


?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
 </head>
 <body>

 <div class="top_bar">
  <div class="logo">
    <a href="index.php">Buzzlink!</a>
  </div>

  <div class="menu-toggle" id="mobile-menu">
    <i class="fas fa-bars"></i> 
  </div>

  <nav class="nav-links">
   <a href="<?php echo $userLoggedIn ?>" ><?php echo $userLoggedIn ?></a>
    <a href="#" title="Home"><i class="fas fa-home"></i></a>
    <a href="#" title="Messages"><i class="fas fa-envelope"></i></a>
    <a href="#" title="Notifications"><i class="fas fa-bell"></i></a>
    <a href="#" title="Users"><i class="fas fa-users"></i></a>
    <a href="#" title="Settings"><i class="fas fa-cog"></i></a>
    <a href="includes/handlers/logout.php" title="Settings"><i class="fa fa-sign-out fa-lg"></i></a>
  </nav>
</div>

<div class="wrapper">



