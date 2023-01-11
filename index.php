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

    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="mb-3">
                            <label for="uname" class="form-label">Registration No</label>
                            <input type="number" class="form-control" id="uname">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass">
                        </div>
                        <div class="mb-3">
                            <label for="cpass" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpass">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">I confirm that I am signing up for my registration no</label>
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

    <!-- LOGIN MODAL -->

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Registration No</label>
                            <input type="number" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
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


    <div class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="logo.png" class="navbar-brand">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Home</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">
                        <li class="nav-item"><a class="nav-link" href="#">MENU</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">TIMING</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">COMPLAINT</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">COMMITTE</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="logarea"></div>
    <button class="bttn" type="button" style="margin: 180px 150px;" data-bs-toggle="modal"
        data-bs-target="#loginModal">LOGIN</button>
    <button class="bttn" type="button" style="margin: 230px 150px;" data-bs-toggle="modal"
        data-bs-target="#signupModal">SIGN UP</button>
    <div>
        <img src="banner1.jpg" width="100%" height="450px">
    </div>
</body>

</html>