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
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Welcome Dear Users.......!</h3>
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
  </section>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>