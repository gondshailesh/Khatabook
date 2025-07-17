<?php
// Database connection
$host = 'localhost'; // or your database server IP
$dbname = 'khata_book';
$username = 'root'; // your database username
$password = ''; // your database password

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>