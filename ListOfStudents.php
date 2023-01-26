<?php
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>List Of Students</title>
</head>

<body>
    <!-- ADD STUDENTS Modal -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add a Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="listOfStudents.php" method="post">
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

                    <form action="listOfStudents.php" method="post">
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
                    <form action="ListOfStudents.php" method="post">
                        <input type="hidden" name="delhid" id="delhid">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php
    require 'essentials/navbar.php';
    ?>

    <div class="container mt-4">
        <p class="h2 fw-light">List of Students enrolled in Mess</p>
        <div class="table-responsive">
            <table class="table table-sm table-success table-striped table-bordered mt-4" id="myTable">
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
        </div>
        <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#addModal">Add
            Student</button>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous">
        </script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
        $('#myTable').DataTable({
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
    </script>
</body>

</html>