<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kindergarten";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} else {
 // Optionally, you can print a success message or perform other actions upon successful connection.
 echo "Connected successfully";
}
?>
