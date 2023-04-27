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

// Cancel rebate
if (isset($_POST['cancelRebate'])) {
    $sql = "DELETE FROM `rebate_requests` WHERE `regno`='$user'";
    $result = mysqli_query($conn, $sql);
    $sql = "DELETE FROM `rebate_status` WHERE `regno`='$user'";
    $result = mysqli_query($conn, $sql);
    if (!$result)
        echo "error";
}
header('location:../studDash.php');

?>