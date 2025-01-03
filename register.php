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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstName = $_POST['firstname'];
  $lastName = $_POST['lastname'];
  $middleName = $_POST['MidName'];
  $userType = $_POST['user_type'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  // Insert data into the database
  try {
    $sql = "INSERT INTO users (first_name, last_name, middle_name, user_type, dob, gender, email, phone)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $middleName, $userType, $dob, $gender, $email, $phone]);

    echo "Registration successful!";
  } catch (PDOException $e) {
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
</head>

<body>
  <style>
    .nav {
      background: rgb(164, 209, 255);
      background: linear-gradient(35deg, rgba(164, 209, 255, 1) 0%, rgba(250, 235, 211, 1) 23%, rgba(200, 224, 222, 1) 48%, rgba(218, 245, 235, 1) 85%);
      /* Midnight Blue, suitable for header */
      color: #ffffff;
      /* White text for contrast */
      padding: 15px;
      text-align: center;
    }

    header h1 {
      color: #9edc29;
      /* Logo color for the header title */
      font-size: 2rem;
    }
  </style>
  <?php


  ?>

  <header>
    <nav class="navbar navbar-expand-lg bg-light   fixed-top z-1 ">
      <div class="container-fluid">
        <a class="navbar-brand " href="#">
          <p class=""><img src="images/Final Clearifi/png/logo-no-background.png" class="img-fluid" height="100" width="200" alt=""></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 h5">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Account Info</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="adminlogin.php">Admin login</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Account</a>
              </li>
              <li class="nav-item">
                <a href="login.php" class=""><button class="btn btn-danger">Login</button></a>
              </li>
            </ul>
            <form class="d-flex mt-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <section class="vh-200 gradient-custom mt-5">
    <div class="mt-5">
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
                <p>Fill The Following Fields And Create Account</p>
                <form method="POST">

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="firstName" class="form-control form-control-lg" name="firstname" required />
                        <label class="form-label" for="firstName">First Name</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="lastName" class="form-control form-control-lg" name="lastname" required />
                        <label class="form-label" for="lastName">Last Name</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="midName" class="form-control form-control-lg" name="MidName" />
                        <label class="form-label" for="midName">Middle Name</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label class="form-label select-label">Choose Use</label>
                      <select class="select form-control-lg" name="user_type" required>
                        <option value="1" disabled selected>Using For</option>
                        <option value="2">Personal Use</option>
                        <option value="3">Erp Use</option>
                        <option value="4">CRM Use</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4 d-flex align-items-center">
                      <div class="form-outline datepicker w-100">
                        <input type="date" class="form-control form-control-lg" id="dob" name="dob" required />
                        <label for="birthdayDate" class="form-label">Date Of Birth</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <h6 class="mb-2 pb-1">Gender: </h6>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" required />
                        <label class="form-check-label" for="femaleGender">Female</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" />
                        <label class="form-check-label" for="maleGender">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="otherGender" value="Other" />
                        <label class="form-check-label" for="otherGender">Other</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">
                      <div class="form-outline">
                        <input type="email" id="emailAddress" class="form-control form-control-lg" name="email" required />
                        <label class="form-label" for="emailAddress">Email</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                      <div class="form-outline">
                        <input type="number" id="phoneNumber" class="form-control form-control-lg" name="phone" required />
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                      </div>
                    </div>
                  </div>

                  <div class="mt-4 pt-2">
                    <p>If Account Already Exist <a href="login.php">click me</a></p>
                    <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>