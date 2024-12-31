<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khata Book</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Make the container div scrollable */
    .container {
      max-height: 500px;
      /* Adjust the height as needed */
      overflow-y: auto;
      /* Allows vertical scrolling */
    }
  </style>
</head>

<body style="background:whitesmoke">
  <?php include 'header.php'; ?>

  <!-- Logout Button -->
  <div class="container shadow rounded-1 mt-5">
    <div class="spacingtop">
      <div class="row mt-3 justify-content-center text-center">
        <div class="col-lg-5 col-md-6 col-sm-12 bg-warning bg-opacity-50 rounded-4 m-1 mt-2 pt-5 clr p-3 bxone content-center">
          <p class="h2">Monthly Income</p>
          <p>like salary/Business/</p>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 bg-warning bg-opacity-50 rounded-4 m-1 mt-2 pt-5 clr p-3 bxtwo content-center">
          <p class="h2">Daily Investment</p>
          <p>like stock investment</p>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 bg-warning bg-opacity-50 rounded-4 m-1 mt-2 pt-5 clr p-3 bxthree content-center">
          <p class="h2">Given & Take</p>
          <p>Record Maintenance</p>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 bg-warning bg-opacity-50 rounded-4 m-1 mt-2 pt-5 clr p-3 bxfour content-center">
          <p class="h2">Daily Expenses</p>
          <p>Weekly/Monthly/Yearly Report Generation</p>
        </div>
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script>
    function logout() {
      // Make an AJAX call to logout.php
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "logout.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          window.location.href = "login.php"; // Redirect to login page after logout
        }
      };
      xhr.send();
    }
  </script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>