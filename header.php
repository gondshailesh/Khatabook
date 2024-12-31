

<style>
        nav{
            background: rgb(205, 229, 252);
            background: linear-gradient(133deg, rgba(219, 235, 250, 0.99) 0%, rgba(214,229,255,0.9641106442577031) 23%, rgba(243, 218, 218, 0.96) 48%, rgba(242, 216, 232, 0.96) 85%);
        }
    </style>
   <?php
    
   
   ?> 
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top ">
  <div class="container-fluid">
    <a class="navbar-brand "  href="#"><p class="h1">khata Book</p></a>
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
            <a class="nav-link" href="register.php">Register</a>
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