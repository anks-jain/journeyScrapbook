<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "root"); // The database username.
define("PASSWORD", "freebsd"); // The database password. 
define("DATABASE", "journey"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>
