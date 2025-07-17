<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to dashboard if already logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../images/fav_icon.png" type="image/x-icon">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
        background: linear-gradient(56deg, rgba(245, 224, 101, 0.387) 0%, rgba(245, 155, 219, 0.586) 47%, rgba(245, 165, 207, 0.353) 100%);
        color: #fff;
    }

    .bg-glass {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: rgba(245, 224, 101, 0.8);
        border: none;
        color: #333;
    }

    .btn-primary:hover {
        background-color: rgba(245, 155, 219, 0.9);
        border: none;
    }

    .form-outline input {
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.6);
    }

    .form-label {
        font-weight: bold;
    }

    .text-center a {
        color: #f5a5cf;
        /* Matching the gradient's colors */
        text-decoration: none;
    }

    .text-center a:hover {
        color: #f59bdb;
        /* Lighter hover color */
    }

    /* Additional Styling for text and container */
    h1 {
        color: rgba(33, 37, 41, 0.8);
    }

    p.mb-4 {
        color: rgba(33, 37, 41, 0.7);
    }

    /* Form Container */
    .card {
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .container {
        padding: 0 3rem;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 1.5rem;
        }
    }
</style>

<body>
    <section class="background-radial-gradient">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-5 fw-bold ls-tight">
                        Welcome to <br />
                        <img src="../images/Clearifi/png/logo-no-background.png" class="img-fluid" alt="clarifi">
                    </h1>
                    <p class="mb-4 opacity-70">
                        Please enter your credentials to log in.
                    </p>
                </div>

                <div class="col-lg-6 position-relative ">
                    <div class="card bg-light shadow-lg">
                        <div class="card-title">
                            <h3 class="text-center mt-3">Admin login</h3>
                        </div>
                        <div class="card-body ">
                            <form class="" action="../login_action.php" method="post">
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
                                    <p>If you don't have an account, <a href="../register.php">Click here to Register</a></p>
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