<?php

$servername = "splitwise.cdastitva5m4.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "rootadmin";
$dbname = "foodweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>