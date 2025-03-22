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

  try {
    // SQL query to insert user data into the users table
    $sql = "INSERT INTO users (first_name, last_name, middle_name, user_type, dob, gender, email, phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Execute the statement with user data
    $stmt->execute([$firstName, $lastName, $middleName, $userType, $dob, $gender, $email, $phone]);

    // Get the last inserted user ID (assuming the 'id' column is auto-increment)
    $user_id = $pdo->lastInsertId();

    // Store user data in the session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;

    // Redirect to the 'khatabook.php' page after successful registration
    header("Location: khatabook.php");
    exit; // Ensure that no further code is executed after the redirect
  } catch (PDOException $e) {
    // If an error occurs, display an error message
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="CSS/register.css">

  <script>
    // JavaScript form validation function
    function validateForm() {
      // Get form inputs
      var firstName = document.getElementById("firstName").value;
      var lastName = document.getElementById("lastName").value;
      var email = document.getElementById("email").value;
      var phone = document.getElementById("phone").value;
      var gender = document.querySelector('input[name="gender"]:checked');
      var dob = document.getElementById("dob").value;
      var userType = document.getElementById("userType").value;

      // Validate first name
      if (firstName.trim() === "") {
        alert("First Name is required.");
        return false;
      }

      // Validate last name
      if (lastName.trim() === "") {
        alert("Last Name is required.");
        return false;
      }

      // Validate email
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailPattern.test(email)) {
        alert("Please enter a valid email.");
        return false;
      }

      // Validate phone number (basic check)
      if (phone.length < 10) {
        alert("Phone number must be at least 10 digits.");
        return false;
      }

      // Validate gender
      if (!gender) {
        alert("Please select a gender.");
        return false;
      }

      // Validate date of birth
      if (!dob) {
        alert("Date of Birth is required.");
        return false;
      }

      // Validate user type selection
      if (userType === "Choose User Type") {
        alert("Please select a User Type.");
        return false;
      }

      // If all validations pass
      return true;
    }
  </script>
</head>

<body class="background-radial-gradient">
  <section class="container">
    <div class="px-md-5 text-center text-lg-start">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-5 fw-bold ls-tight">
            Create Your Account<br />
            <img src="images/Clearifi/png/logo-no-background.png" class="img-fluid" alt="clarifi">
          </h1>
          <p class="mb-2 opacity-70">
            Fill the following details to create a new account.
          </p>
        </div>

        <div class="col-lg-6 position-relative">
          <div class="card bg-light shadow-lg">
            <div class="card-body mt-3 p-4">
              <form action="register.php" method="post" onsubmit="return validateForm()">
                <!-- First Name input -->
                <div class="form-outline mb-2">
                  <input type="text" id="firstName" class="form-control" name="firstname" required />
                  <label class="form-label" for="firstName">First Name</label>
                </div>

                <!-- Last Name input -->
                <div class="form-outline mb-2">
                  <input type="text" id="lastName" class="form-control" name="lastname" required />
                  <label class="form-label" for="lastName">Last Name</label>
                </div>

                <!-- Middle Name input -->
                <div class="form-outline mb-2">
                  <input type="text" id="midName" class="form-control" name="MidName" />
                  <label class="form-label" for="midName">Middle Name</label>
                </div>

                <!-- User Type input -->
                <div class="form-outline mb-2">
                  <select class="form-control" name="user_type" id="userType" required>
                    <option value="Choose User Type" disabled selected>Choose User Type</option>
                    <option value="Personal Use">Personal Use</option>
                    <option value="Erp Use">ERP Use</option>
                    <option value="CRM Use">CRM Use</option>
                  </select>
                  <label class="form-label" for="userType">User Type</label>
                </div>

                <!-- Date of Birth input -->
                <div class="form-outline mb-2">
                  <input type="date" id="dob" class="form-control" name="dob" required />
                  <label class="form-label" for="dob">Date of Birth</label>
                </div>

                <!-- Gender input -->
                <div class="form-outline mb-2">
                  <label class="form-label">Gender</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Female" required />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Male" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Other" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                  <input type="email" id="email" class="form-control" name="email" required />
                  <label class="form-label" for="email">Email Address</label>
                  <input type="tel" id="phone" class="form-control" name="phone" required />
                  <label class="form-label" for="phone">Phone Number</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-2">
                  Register
                </button>

                <!-- Login link -->
                <div class="text-center">
                  <p>If you already have an account, <a href="login.php">Click here to Login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>