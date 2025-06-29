<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Info</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <style>
        /*bg body*/
        .body {
            background: rgb(222, 240, 255);
            background: linear-gradient(117deg,
                    rgba(222, 240, 255, 0.5635504201680672) 0%,
                    rgba(192, 237, 255, 0.5467436974789917) 31%,
                    rgba(204, 205, 242, 0.6694327389158788) 64%,
                    rgba(181, 182, 182, 0.3534663865546218) 100%,
                    rgba(245, 204, 233, 1) 120%);
        }
    </style>

    <?php
    include('header.php');
    ?>
    <div class="container-fluid mt-6  p-3 body">
        <div class="container card p-3"><img src="images/dummyimg.png" height="200" width="180" class="" alt="">
            <button class="btn btn-primary mb-3 col-2 mt-2" type="button">Edit</button>

        </div>
</body>

</html>