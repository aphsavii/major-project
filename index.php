<!-- <?php
session_start();
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>

<body>

    <!-- SIGN UP MODAL -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="essentials/signup.php" method="post">
                        <div class="mb-3">
                            <label for="uname" class="form-label">Registration No</label>
                            <input type="number" name="uname" class="form-control" id="uname" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" id="pass" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpass" class="form-label">Confirm Password</label>
                            <input type="password" name="cpass" class="form-control" id="cpass" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">I confirm that I am signing up for my
                                registration no</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Student LOGIN MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">Student Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="essentials/login.php" method="post">
                        <div class="mb-3">
                        <input type="hidden" value="set" name="studentLogin" id="studentLogin">
                            <label for="username" class="form-label">Registration No</label>
                            <input type="number" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <a class="text-sm-left" data-bs-toggle="modal" data-bs-target="#adminLoginModal">Login as Admin</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Admin LOGIN MODAL -->
    <div class="modal fade" id="adminLoginModal" tabindex="-1" aria-labelledby="adminLoginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adminLoginModalLabel">Admin Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="essentials/login.php" method="post">
                        <div class="mb-3">
                            <input type="hidden" value="set" name="adminLogin" id="adminLogin">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="adminusername" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="adminpassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- for alerts -->
    <?php

    require 'essentials/alerts.php';
    // echo $_SESSION['user'];
    ?>

    <!-- Navbar -->
    <?php
    require 'essentials/navbar.php';
    ?>

    <!-- Banner area -->
    <div class="banner">
        <div class="bg"></div>
        <div class="logarea">
            <button class="bttn" type="button" style="margin-top: 130px;" data-bs-toggle="modal"
                data-bs-target="#loginModal">LOGIN</button>
            <button class="bttn" type="button" style="margin-top: 180px;" data-bs-toggle="modal"
                data-bs-target="#signupModal">SIGNUP</button>
        </div>
    </div>
</body>

</html>