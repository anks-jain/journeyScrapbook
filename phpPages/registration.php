<?php
include 'db_connect.php';
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 

// The hashed password from the form
$password = $_POST['p']; 
// Create a random salt
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted password (Careful not to over season)
$password = hash('sha512', $password.$random_salt);
$username = $_POST['username'];
$email = $_POST['email'];
 
// Add your insert to database script here. 
// Make sure you use prepared statements!
 
if ($insert_stmt = $mysqli->prepare("INSERT INTO j_members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {    
   $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt); 
   // Execute the prepared query.
   if($insert_stmt->execute()) {
	    header('Location: ../index.php?success=true');
	}
}

?>
