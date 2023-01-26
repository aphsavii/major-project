<?php
// Starting a session
session_start();
// Connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['studentLogin'])) {
        $uname = $_POST['username'];
        $pass = $_POST['password'];

        // For Student Login
        // Checking if student exist is registered or not
        $sql = "SELECT * FROM `credentials` WHERE `username`=$uname";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            $_SESSION['notRegistered'] = true;
        } else {
            if ($pass == $row['password']) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $uname;
            } else {
                $_SESSION['wrongPass'] = true;
            }
        }
    }

    // For Admin Login
    if (isset($_POST['adminLogin'])) {
        $uname = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM `admins` WHERE `username`='$uname'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "error";
        }
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            $_SESSION['notAdmin'] = true;
        } else {
            if ($pass == $row['password']) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['admin'] = $uname;
            } else {
                $_SESSION['wrongPass'] = true;
            }
        }
    }
}
header("Location: ../index.php");
die();
?>