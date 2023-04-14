<?php
// Starting a session
session_start();
// Connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userType = $_POST['userType'];
    if ($userType == "student") {
        $uname = $_POST['username'];
        $pass = $_POST['password'];

        // For Student Login
        // Checking if student exist is registered or not
        $sql = "SELECT * FROM `credentials` WHERE `username`=$uname";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$result) {
            header("Location: ../error.php");
            die();
        } else {
            if ($pass == $row['password']) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $uname;
                header("Location: ../studDash.php");
                die();
            } else
                header("Location: ../error.php");
        }
    }

    // For Admin Login
    else if ($userType == "admin" || $userType == "contractor") {
        $uname = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM `admins` WHERE `username`='$uname'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$result) {
            echo mysqli_error($conn);
            // header("Location: ../error.php");
        } else {
            if ($pass == $row['password']) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['admin'] = $uname;
                header("Location: ../adminDash.php");
                die();
            } else
            echo mysqli_error($conn);
            // header("Location: ../error.php");
        }
    }
}
?>