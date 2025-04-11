<?php
$host = "localhost";
$user = "root";
$pass = ""; // Default for XAMPP
$dbname = "job_portal"; // Change to your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
?>
