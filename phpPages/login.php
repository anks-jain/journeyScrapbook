<?php
include 'db_connect.php';
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
include 'login_security_functions.php';
sec_session_start(); // Our custom secure way of starting a php session. 
 
if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $password = $_POST['p']; // The hashed password.
   if(login($email, $password, $mysqli) == true) {
      // Login success
      header('Location: ./user_main_page.php');
   } else {
      // Login failed
      header('Location: ../index.php?error=true');
   }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}
?>