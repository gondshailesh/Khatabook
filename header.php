<style>
  header {
    background-color: #003366;
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


<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top z-0 ">
  <div class="container-fluid ">
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