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

// Request rebate
if (isset($_POST['requestRebate'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $noOfDays = $_POST['noOfDays'];
    $sql = "INSERT INTO `rebate_requests` (`regno`, `fromdate`, `todate`, `noofdays`) VALUES ('$user', '$fromDate', '$toDate', '$noOfDays')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_errno($conn);
        echo mysqli_error($conn);
        header('location:../studDash.php');
    } else {
        $sql = "select * from `rebate_status` where `regno`=$user";
        $result = mysqli_query($conn, $sql);
        if (!$result)
            echo mysqli_error($conn);
        $row = mysqli_num_rows($result);
        if ($row == 0) {
            $sql = "INSERT INTO `rebate_status` (`regno`, `fromdate`, `todate`, `noofdays`, `status`) VALUES ('$user', '$fromDate', '$toDate', '$noOfDays','0')";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE `rebate_status` SET `fromdate` = '$fromDate', `todate` = '$toDate', `noofdays` = '$noOfDays', `status`='0' WHERE `rebate_status`.`regno` = $user;
            ";
            $result = mysqli_query($conn, $sql);
            // echo "hello";

        }
    }
    header('location:../studDash.php');
}
?>