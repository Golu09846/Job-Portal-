<?php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP/LAMP me mostly blank hota hai
$database = "job_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

