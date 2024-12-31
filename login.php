<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php"); // Redirect to dashboard if already logged in
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body style="background-color:wheat;">

  <section class="background-radial-gradient overflow-hidden">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            Welcome to <br />
            <span style="color: hsl(218, 81%, 75%)">Khata Book</span>
          </h1>
          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
            Please enter your credentials to log in.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form action="login_action.php" method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" class="form-control" name="email" required />
                  <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Date of Birth input -->
                <div class="form-outline mb-4">
                  <input type="date" id="dob" class="form-control" name="dob" required />
                  <label class="form-label" for="dob">Date of Birth</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Log In
                </button>

                <!-- Register button -->
                <div class="text-center">
                  <p>If you don't have an account, <a href="register.php">Click here to Register</a></p>
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