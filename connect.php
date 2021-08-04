<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB="webcoffee";
session_start();
// Create connection
$con = new mysqli($servername, $username, $password,$myDB);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
//echo "Connected successfully";
?>