<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gpu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "เชื่อมต่อกับฐานข้อมูลแล้ว";
?>