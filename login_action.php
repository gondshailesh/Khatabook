<?php
session_start();

$host = 'localhost'; // your database host
$dbname = 'khata_book'; // your database name
$username = 'root'; // your database username
$password = ''; // your database password

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    // Prepare SQL to fetch user based on email and date of birth
    $sql = "SELECT * FROM users WHERE email = :email AND dob = :dob LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'dob' => $dob]);

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirect to dashboard
        header("Location: index.php");
        exit;
    } else {
        // Invalid credentials
        echo "Invalid email or date of birth.";
    }
}
