<?php
// Starting a session
session_start();


// Connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['uname'])) {
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        // Checking if user exist in hostel or not
        $sql = "SELECT * FROM `studentslist` WHERE `regno`=$uname";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            $_SESSION['unAuth'] = true;
        } else {
            if ($pass == $cpass) {
                $sql = "INSERT INTO `credentials` (`username`, `password`, `signup time`) VALUES ('$uname', '$pass', current_timestamp())
            ;";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $_SESSION["exist"] = true;
                }

            } else {
                $_SESSION["notMatch"] = true;
            }
        }
    }

    header("Location: ../index.php");
    die();
}
?>