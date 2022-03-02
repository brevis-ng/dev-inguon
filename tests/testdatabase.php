<?php
$servername = "27.124.44.16:3306";
$username = "inguon";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "fail";
}
echo "Connected successfully";
?>