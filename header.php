<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Financial Dashboard</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- AOS (Animate On Scroll) Library -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    /* Info color scheme for navbar */
    .navbar {
      background-color: #0dcaf0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      filter: brightness(0) invert(1);
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 500;
      margin: 0 8px;
      transition: all 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
      color: white !important;
      transform: translateY(-2px);
    }

    /* Card Styles with Inner Shadow and Outer Glow */
    .card-summary {
      border-radius: 15px;
      box-shadow:
        inset 0 0 15px rgba(0, 0, 0, 0.1),
        /* Inner shadow */
        0 0 20px 5px rgba(13, 202, 240, 0.2);
      /* Outer glow (20% opacity) */
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      backdrop-filter: blur(5px);
      border: none;
      position: relative;
      overflow: hidden;
      background-color: rgba(255, 255, 255, 0.85);
    }

    /* Different glow colors for each card */
    .card-income {
      box-shadow:
        inset 0 0 15px rgba(0, 0, 0, 0.1),
        0 0 20px 5px rgba(25, 135, 84, 0.2);
      /* Green glow for income */
    }

    .card-investment {
      box-shadow:
        inset 0 0 15px rgba(0, 0, 0, 0.1),
        0 0 20px 5px rgba(13, 110, 253, 0.2);
      /* Blue glow for investment */
    }

    .card-given {
      box-shadow:
        inset 0 0 15px rgba(0, 0, 0, 0.1),
        0 0 20px 5px rgba(255, 193, 7, 0.2);
      /* Yellow glow for given/taken */
    }

    .card-expenses {
      box-shadow:
        inset 0 0 15px rgba(0, 0, 0, 0.1),
        0 0 20px 5px rgba(220, 53, 69, 0.2);
      /* Red glow for expenses */
    }

    .card-summary:hover {
      transform: translateY(-5px);
      box-shadow:
        inset 0 0 20px rgba(0, 0, 0, 0.15),
        0 0 25px 8px rgba(13, 202, 240, 0.3);
    }

    /* Specific hover effects for each card type */
    .card-income:hover {
      box-shadow:
        inset 0 0 20px rgba(0, 0, 0, 0.15),
        0 0 25px 8px rgba(25, 135, 84, 0.3);
    }

    .card-investment:hover {
      box-shadow:
        inset 0 0 20px rgba(0, 0, 0, 0.15),
        0 0 25px 8px rgba(13, 110, 253, 0.3);
    }

    .card-given:hover {
      box-shadow:
        inset 0 0 20px rgba(0, 0, 0, 0.15),
        0 0 25px 8px rgba(255, 193, 7, 0.3);
    }

    .card-expenses:hover {
      box-shadow:
        inset 0 0 20px rgba(0, 0, 0, 0.15),
        0 0 25px 8px rgba(220, 53, 69, 0.3);
    }

    /* Daily Streak Styles */
    .streak-container {
      background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
      border-radius: 15px;
      padding: 20px;
      margin: 20px 0;
      box-shadow:
        inset 0 0 10px rgba(0, 0, 0, 0.1),
        0 0 20px 5px rgba(255, 154, 158, 0.3);
      text-align: center;
      color: white;
    }

    .streak-count {
      font-size: 3rem;
      font-weight: bold;
      margin: 10px 0;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .streak-label {
      font-size: 1.2rem;
      margin-bottom: 10px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .streak-progress {
      height: 10px;
      border-radius: 5px;
      background-color: rgba(255, 255, 255, 0.3);
      margin: 15px 0;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .streak-progress-bar {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body class="body">
  <?php
  include("header.php");
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/Clearifi/png/logo-no-background.png" class="img-fluid" height="100" width="200" alt="Logo">
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php?">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Account_info.php">Account Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Due.php">Dues</a>
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

    // Streak counter animation
    document.addEventListener('DOMContentLoaded', function() {
      // Animate the streak counter
      const streakCount = document.querySelector('.streak-count');
      streakCount.style.transform = 'scale(1.1)';
      setTimeout(() => {
        streakCount.style.transform = 'scale(1)';
      }, 300);

      // Initialize AOS animation
      AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
      });
    });
  </script>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</body>

</html>