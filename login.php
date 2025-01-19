<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: khatabook.php"); // Redirect to dashboard if already logged in
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
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">

</head>
<style>
  body,
  html {
    height: 100%;
    margin: 0;
  }

  .background-radial-gradient {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle, rgba(33, 37, 41, 1) 0%, rgba(58, 61, 66, 1) 50%, rgba(0, 0, 0, 1) 100%);
    color: #fff;
  }

  .bg-glass {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 2rem;
  }

  .btn-primary {
    background-color: #007bff;
    border: none;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>

<body>
  <section class="background-radial-gradient">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-5 fw-bold ls-tight">
            Welcome to <br />
            <span style="color: hsl(218, 81%, 75%)">Khata Book</span>
          </h1>
          <p class="mb-4 opacity-70">
            Please enter your credentials to log in.
          </p>
        </div>

        <div class="col-lg-6 position-relative">
          <div class="card bg-glass">
            <div class="card-body">
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