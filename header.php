<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">

</head>

<body class="body">
  <style>
    header {
      background-color: #003366;
      /* Midnight Blue */
      color: #ffffff;
      /* White text */
      padding: 15px;
      text-align: center;
    }

    header h1 {
      color: #9edc29;
      /* Logo color */
      font-size: 2rem;
    }
  </style>

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top z-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/Final Clearifi/png/logo-no-background.png" class="img-fluid" height="100" width="200" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navigation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 h5">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Account Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Account</a>
            </li>
            <li class="nav-item">
              <button class="btn btn-danger" onclick="logout()">Logout</button>
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

  <script>
    // Logout function
    function logout() {
      window.location.href = 'logout.php';
    }
  </script>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>