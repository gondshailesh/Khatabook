<?php
// Start the session at the very beginning
session_start();

// Include the database connection file
include('conn.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $middleName = $_POST['MidName'];
    $userType = $_POST['user_type'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // Input Validation
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit; // Stop further processing
    }

    // Validate phone number (basic check for length, adjust as needed)
    if (strlen($phone) < 10) {
        echo "Phone number should be at least 10 digits";
        exit; // Stop further processing
    }
}
?>