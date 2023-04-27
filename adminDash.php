<!-- 
Sql command for fetching no of student not prensent on a particular date in hostel
SELECT * FROM `rebate_requests` WHERE DATE('$date') BETWEEN `fromdate` AND `todate`;
 -->

<?php
session_start();
if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['admin'])) {
    header('location:index.html');
}
$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Update students details in the database
    if (isset($_POST['hidden'])) {
        $primary = $_POST['hidden'];
        $regno = $_POST['editregno'];
        $name = $_POST['editname'];
        $trade = $_POST['edittrade'];
        $roomno = $_POST['editroomno'];

        $sql = "UPDATE `studentslist` SET `regno` = '$regno', `name` = '$name', `trade` = '$trade', `roomno` = '$roomno' WHERE `studentslist`.`regno` = '$primary'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "error";
        }
    }

    // Delete students details in the database 
    else if (isset($_POST['delhid'])) {
        $regno = $_POST['delhid'];
        $sql = "DELETE FROM `studentslist` WHERE `regno`='$regno'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo mysqli_error($conn);
        }
    }

    // insert students details in the database
    else {
        $regno = $_POST['regno'];
        $name = $_POST['name'];
        $trade = $_POST['trade'];
        $roomno = $_POST['roomno'];

        $sql = "INSERT INTO `studentslist` VALUES 
    ($regno,'$name','$trade',$roomno);";
        $result = mysqli_query($conn, $sql);

        // Setting students default credentials after adding them
        $num = $regno;
        $pass = 0;
        $mul = 1;
        for ($i = 0; $i < 3; $i++) {
            $n = $num % 10;
            $pass = $pass + $mul * $n;
            $num /= 10;
            $mul *= 10;
        }
        $sql = "INSERT INTO `credentials` (`username`, `password`, `signup time`) VALUES ($regno, $pass, current_timestamp());
        ";
        $result = mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="adminDash.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- ADD STUDENTS Modal -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add a Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="regno" class="form-label">Registration No</label>
                            <input name="regno" type="number" class="form-control" id="regno" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="trade" class="form-label">Trade</label>
                            <input name="trade" type="text" class="form-control" id="trade" required>
                        </div>
                        <div class="mb-3">
                            <label for="roomno" class="form-label">Room No</label>
                            <input name="roomno" type="number" class="form-control" id="roomno" required>
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

    <!-- EDIT STUDENTS Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="adminDash.php" method="post">
                        <div class="mb-3">
                            <input type="hidden" id="hidden" name="hidden">
                            <label for="editregno" class="form-label">Registration No</label>
                            <input name="editregno" type="number" class="form-control" id="editregno" required>
                        </div>
                        <div class="mb-3">
                            <label for="editname" class="form-label">Name</label>
                            <input name="editname" type="text" class="form-control" id="editname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edittrade" class="form-label">Trade</label>
                            <input name="edittrade" type="text" class="form-control" id="edittrade" required>
                        </div>
                        <div class="mb-3">
                            <label for="editroomno" class="form-label">Room No</label>
                            <input name="editroomno" type="number" class="form-control" id="editroomno" required>
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

    <!-- DELETE STUDENTS Modal -->

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delmod">
                    <h5>
                        Are you sure to delete details of this student ?
                    </h5>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
                <div class="modal-footer">
                    <form action="adminDash.php" method="post">
                        <input type="hidden" name="delhid" id="delhid">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rebate request Modal -->
    <div class="modal fade" id="rebateRequests" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Rebate Requests</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action='./essentials/grantRebate.php' method='post' id='grantRebateForm'>
                        <input type='hidden' name='grantRebate' id='grantRebate'>
                    </form>
                    <form action='./essentials/rejectRebate.php' method='post' id='rejectRebateForm'>
                        <input type='hidden' name='rejectRebate' id='rejectRebate'>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-sm  mt-4" id="rebateRequestsTable">
                            <thead>
                                <tr>
                                    <th scope="col">Regno</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Roomno</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `rebate_requests` NATURAL JOIN `studentslist`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                    <td>" . $row['regno'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['roomno'] . "</td>
                    <td>" . $row['fromdate'] . "</td>
                    <td>" . $row['todate'] . "</td>
                    <td>" . $row['noofdays'] . "</td>
                    <td>
                
                  <button type='submit' class='btn btn-success btn-sm grant' form='grantRebateForm'>Grant </button>
                    <button class='btn btn-danger btn-sm reject' form='rejectRebateForm'>Reject </button>
                    </td>
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

    <!-- Rebates Granted -->
    <div class="modal fade" id="grantedRebates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Granted Rebates</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm  mt-4" id="grantedRebatesTable">
                            <thead>
                                <tr>
                                    <th scope="col">Regno</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Roomno</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `granted_Rebates` NATURAL JOIN `studentslist`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                    <td>" . $row['regno'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['roomno'] . "</td>
                    <td>" . $row['fromdate'] . "</td>
                    <td>" . $row['todate'] . "</td>
                    <td>" . $row['noofdays'] . "</td>                    
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

    <!-- Complaints modal -->
    <div class="modal fade" id="complaints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Complaints by Students</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm  mt-4" id="rebateRequestsTable">
                            <thead>
                                <tr>
                                    <th scope="col">Regno</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Roomno</th>
                                    <th scope="col">Complaint</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `complaints` NATURAL JOIN `studentslist`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                    <td>" . $row['regno'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['roomno'] . "</td>
                    <td>" . $row['complaint'] . "<br><br><a href='#'>" . $row['time'] . "</a> </td>
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

    <!-- Main page -->

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
                            <li class="nav-item sideadd"><a class="nav-link" href="#rebateRequests"
                                    data-bs-toggle="modal" data-bs-target="#rebateRequests">Rebate Requests</a></li>
                            <li class="nav-item sideadd"><a class="nav-link" href="#grantedRebates"
                                    data-bs-toggle="modal" data-bs-target="#grantedRebates">Granted Rebates</a></li>
                            <li class="nav-item sideadd"><a class="nav-link" href="#">Complaints
                                </a></li>
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
                    <li><a href="#complaints" data-bs-toggle="modal" data-bs-target="#complaints">Complaints</a></li>
                    <li><a href="#rebateRequests" data-bs-toggle="modal" data-bs-target="#rebateRequests">Rebate
                            Requests</a></li>
                    <li><a href="#grantedRebates" data-bs-toggle="modal" data-bs-target="#grantedRebates">Granted
                            Rebates</a></li>
                    <li><a href="essentials/logout.php">Logout</a></li>
                                <?php
                                $date=date("Y-m-d");
                                $tS=250;
                                $sql="SELECT * FROM `rebate_requests` WHERE DATE('$date') BETWEEN `fromdate` AND `todate`";
                                $result=mysqli_query($conn,$sql);
                                $tP=$tS-mysqli_num_rows($result);
                                echo '<div style="position:relative;bottom:-250px;"><a href="#" style="color: #4fcb4f; margin: 10px 20px;
                            }">Presence : '.$tP.'/'.$tS.'  </a></div>';
                                
                                ?>
                </div>
                <div class="mainstudarea table-responsive">
                    <p class="h2 fw-light"><B>List of Students enrolled in Mess</B></p>
                    <table class="table table-sm  mt-4" id="listOfStudents">
                        <thead>
                            <tr>
                                <th scope="col">Reg no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Trade</th>
                                <th scope="col">Room no</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM studentslist";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                    <td>" . $row['regno'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['trade'] . "</td>
                    <td>" . $row['roomno'] . "</td>
                    <td><button type='button' class='btn btn-primary btn-sm edit' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>
                    <button type='button' class='btn btn-danger btn-sm delete' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>
                    </td>
                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Add
                        Student</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous">
        </script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#listOfStudents').DataTable();
        });
        $('#listOfStudents').DataTable({
            responsive: true
        });
        $(document).ready(function () {
            $('#rebateRequestsTable').DataTable();
        });
        $('#rebateRequestsTable').DataTable({
            responsive: true
        });

        $(document).ready(function () {
            $('#grantedRebatesTable').DataTable();
        });
        $('#grantedRebatesTable').DataTable({
            responsive: true
        });

        var edit = document.getElementsByClassName('edit');
        Array.from(edit).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("event", e);

                var tr = e.target.parentNode.parentNode;

                var regno = tr.getElementsByTagName('td')[0].innerText;
                var name = tr.getElementsByTagName('td')[1].innerText;
                var trade = tr.getElementsByTagName('td')[2].innerText;
                var roomno = tr.getElementsByTagName('td')[3].innerText;

                editregno.value = regno;
                editname.value = name;
                edittrade.value = trade;
                editroomno.value = roomno;

                hidden.value = regno;
            })
        });

        var del = document.getElementsByClassName('delete');
        Array.from(del).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("event", e);

                var tr = e.target.parentNode.parentNode;

                var regno = tr.getElementsByTagName('td')[0].innerText;
                var name = tr.getElementsByTagName('td')[1].innerText;
                var trade = tr.getElementsByTagName('td')[2].innerText;
                var roomno = tr.getElementsByTagName('td')[3].innerText;

                var delmod = document.getElementById('delmod');
                delmod.getElementsByTagName('p')[0].innerText = "Reg No - " + regno;
                delmod.getElementsByTagName('p')[1].innerText = "Name - " + name;
                delmod.getElementsByTagName('p')[2].innerText = "Trade - " + trade;
                delmod.getElementsByTagName('p')[3].innerText = "Room No - " + roomno;

                delhid.value = regno;
                // console.log(delmod);

            })
        });


        // Grant  rebate
        var grant = document.getElementsByClassName('grant');
        Array.from(grant).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("event", e);

                var tr = e.target.parentNode.parentNode;
                var regno = tr.getElementsByTagName('td')[0].innerText;
                grantRebate.value = regno;
                console.log(grantRebate);

            })
        });
        // Reject  rebate
        var reject = document.getElementsByClassName('reject');
        Array.from(reject).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("event", e);

                var tr = e.target.parentNode.parentNode;
                var regno = tr.getElementsByTagName('td')[0].innerText;
                rejectRebate.value = regno;
                console.log(rejectRebate);

            })
        });
    </script>
</body>

</html>