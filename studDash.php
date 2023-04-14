<?php
session_start();
if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['user'])) {
    header('location:index.html');
}

$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

$user = $_SESSION['user'];

// Change students password
if (isset($_POST['changePass'])) {
    $sql = "SELECT * FROM `credentials` WHERE `username`=$user";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $oldPass = $_POST['oldPass'];
    $toDate = $_POST['noOfDays'];
    if ($oldPass == $row['password']) {
        $sql1 = "UPDATE `credentials` SET `password`='$toDate' WHERE `username`='$user'";
        $result1 = mysqli_query($conn, $sql1);
        if (!$result1) {
            echo mysqli_errno($conn);
            echo mysqli_error($conn);
        }
    }
}



// Upload profile Photo
if (isset($_POST['uploadDp'])) {
    $filename = $_FILES['dp']['name'];
    $tempname = $_FILES['dp']['tmp_name'];
    $folder = "dp/" . $filename;
    $sql = "SELECT * FROM `profiles` WHERE `regno`=$user";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO `profiles` (`regno`,`filename`) VALUES ('$user','$filename')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo mysqli_errno($conn);
            echo mysqli_error($conn);
        }

        if (move_uploaded_file($tempname, $folder)) {
            // echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            // echo "<h3>  Failed to upload image!</h3>";
            header('location:studDash.php');
        }
    }
    else{
        $sql = "UPDATE `profiles` SET `filename` = '$filename' WHERE `profiles`.`regno` = '$user';
        ";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo mysqli_errno($conn);
            echo mysqli_error($conn);
        }

        if (move_uploaded_file($tempname, $folder)) {
            // echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            // echo "<h3>  Failed to upload image!</h3>";
            header('location:studDash.php');
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css” />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" type="text/css" href="studDash.css">
    <title>Student Dashboard</title>
</head>

<body>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="studDash.php" method="post">
                        <input type="hidden" id="changePass" name="changePass">
                        <div class="mb-3">
                            <label for="oldPass" class="form-label">Old Password</label>
                            <input name="oldPass" type="text" class="form-control" id="oldPass" required>
                        </div>
                        <div class="mb-3">
                            <label for="toDate" class="form-label">New Password</label>
                            <input name="toDate" type="password" class="form-control" id="toDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="noOfDays" class="form-label">Confirm Password</label>
                            <input name="noOfDays" type="password" class="form-control" id="noOfDays" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload image Modal -->
    <div class="modal fade" id="uploadDp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Change Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="studDash.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" name="dp" class="form-control" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="image/*" value="">
                            <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04"
                                name="uploadDp">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Rebate Modal -->
    <div class="modal fade" id="requestRebate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Request Rebate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./essentials/requestRebate.php" method="post">
                        <input type="hidden" name="requestRebate" id="requestRebate">
                        <div class="mb-3">
                            <label for="fromDate" class="form-label">From Date</label>
                            <input name="fromDate" type="date" class="form-control" id="fromDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="toDate" class="form-label">To Date</label>
                            <input name="toDate" type="date" class="form-control" id="toDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="noOfDays" class="form-label">No of Days</label>
                            <input name="noOfDays" type="number" class="form-control" id="noOfDays" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Status Modal -->
    <div class="modal fade" id="showStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Rebate Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm  mt-4" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">To</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `rebate_status` WHERE `regno` = '$user'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                if (mysqli_num_rows($result) > 0) {
                                    $btn = "";
                                    if ($row['status'] == 0) {
                                        $btn = "<button type='button' class='btn btn-warning btn-sm edit'>Pending</button>";
                                    } else if ($row['status'] == 1) {
                                        $btn = "<button type='button' class='btn btn-success btn-sm edit'>Accepted</button>";
                                    } else {
                                        $btn = "<button type='button' class='btn btn-danger btn-sm edit'>Rejected</button>";
                                    }
                                    echo "<tr>
                                            <td>" . $row['todate'] . "</td>
                                            <td>" . $row['fromdate'] . "</td>
                                            <td>" . $row['noofdays'] . "</td>
                                            <td>" . $btn . "</td>
                                        </tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Main body -->

    <div class="mainPageFull">
        <img class="webb" src="images/webb3.jpg">
        <div class="navbar navbar-expand-lg fixed-top navbar-light">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="images/logo.png" class="navbar-brand">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar">
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
                            <li class="nav-item"><a class="nav-link" href="#">COMMITTE</a></li>
                            <li class="nav-item sideadd"><a class="nav-link" href="#" data-bs-toggle='modal'
                                    data-bs-target='#changePass'>CHANGE PASSWORD</a></li>
                            <li class="nav-item sideadd"><a class="nav-link" href="#" data-bs-toggle='modal'
                                    data-bs-target='#uploadDp'>Upload Photo</a></li>
                            <li class="nav-item sideadd"><a class="nav-link" href="essentials/logout.php">LOGOUT</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute col-lg-12">
            <div class="d-flex">
                <div class="sidebar">
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#" data-bs-toggle='modal' data-bs-target='#changePass'>Change Password</a></li>
                    <li><a href="#" data-bs-toggle='modal' data-bs-target='#uploadDp'>Upload Photo</a></li>
                    <li><a href="essentials/logout.php">Logout</a></li>
                </div>
                <div class="mainstudarea">
                    <div class="container">
                        <div>
                            <?php
                            $sql = "SELECT * FROM `profiles` WHERE `regno`='$user'";
                            $result = mysqli_query($conn, $sql);
                            $source = "";
                            if (mysqli_num_rows($result) == 0) {
                                $source = "default_dp.jpg";
                            } else {
                                $row = mysqli_fetch_assoc($result);
                                $source = $row['filename'];
                            }
                            ?>
                            <img src="dp/<?php echo $source; ?>" class="pp">
                            <!-- <button type="button" class="ppedit">edit</button> -->
                        </div>
                        <ul>
                            <?php
                            $sql = "SELECT * FROM `studentslist` WHERE `regno`=$user";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);

                            echo "
                            <li>" . $row['name'] . "</li>
                            <li>Room No. " . $row['roomno'] . "</li>
                            <li>Reg No. " . $row['regno'] . "</li>"
                                ?>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div
                            class="container-fluid col-lg-10 col-md-10 col-sm-10 col-10 offset-lg-1 offset-md-1 offset-sm-1 offset-1 cards">
                            <div class="box">
                                <h4 class="px-5">Rebate History</h4>
                                <button type="button">Show</button>
                            </div>
                            <div class="box">
                                <h4 class="px-5">Request Rebate</h4>
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#requestRebate">Apply</button>
                            </div>
                            <div class="box">
                                <h4 class="px-5">Rebate Status</h4>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#showStatus">Show</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>