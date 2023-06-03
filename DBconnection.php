<?php
$servername = "localhost";
$username = "id20831592_muhamadyasin";
$password = "Yl3a4ic400!";
$dbname = "id20831592_yasorestaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>