<?php
$servername = "localhost";  // Corrected hostname
$username = "root";
$password = "";
$dbname = "fnmmallc_mega-metal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
