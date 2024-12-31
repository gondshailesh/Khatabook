<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "preferedinfo"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>