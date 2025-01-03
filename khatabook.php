<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

echo "Welcome, " . $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/fav_icon.png" type="image/x-icon">
  <meta name="description" content="Clarifi: Clean Records, Clean Future">
  <title>ClariFi</title>

  <style>
    .body {
      background-color: whitesmoke;
    }

    /* Make the container div scrollable */
    .container-main {
      max-height: 1000px;
      /* Adjust the height as needed */
      overflow-y: auto;
      /* Allows vertical scrolling */
    }
  </style>
</head>

<body class="body">
  <?php include 'header.php'; ?>

  <!-- Logout Button -->
  <div class="container container-main shadow mt-lg-5 rounded-1">
    <div class="mt-lg-5">
      <div class="spacingtop">
        <div class="row mt-3 justify-content-center text-center">
          <div class="col-lg-5 col-md-6 col-sm-12 bg-success bg-opacity-25 rounded-4 m-1 mt-2 pt-5 clr p-3 bxone content-center">
            <p class="h2">Monthly Income</p>
            <p>like salary/Business/</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-success bg-opacity-25 rounded-4 m-1 mt-2 pt-5 clr p-3 bxtwo content-center">
            <p class="h2">Daily Investment</p>
            <p>like stock investment</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-success bg-opacity-25 rounded-4 m-1 mt-2 pt-5 clr p-3 bxthree content-center">
            <p class="h2">Given & Take</p>
            <p>Record Maintenance</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-success bg-opacity-25 rounded-4 m-1 mt-2 pt-5 clr p-3 bxfour content-center">
            <p class="h2">Daily Expenses</p>
            <p>Weekly/Monthly/Yearly Report Generation</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script>
    function logout() {
      fetch('logout.php')
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.href = data.redirect;
          }
        })
        .catch(err => console.error('Logout failed:', err));
    }
  </script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>