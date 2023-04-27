<?php
session_start();
if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['admin'])) {
    header('location:index.html');
}

$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

// grant rebates
if (isset($_POST['grantRebate'])) {
    // echo "hola";
    $regno = $_POST['grantRebate'];
    $sql = "SELECT * FROM `rebate_requests` WHERE `regno`='$regno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fromdate = $row['fromdate'];
    $todate = $row['todate'];
    echo $row['todate'];
    $noofdays = $row['noofdays'];
    $sql = "INSERT INTO  `granted_rebates` (`regno`, `fromdate`, `todate`, `noofdays`) VALUES ($regno,'$fromdate','$todate',$noofdays)";
    $result = mysqli_query($conn, $sql);
    if (!$result)
        echo mysqli_error($conn);
    $sql = "DELETE FROM `rebate_requests` WHERE `regno`='$regno'";
    $result = mysqli_query($conn, $sql);
    $sql = "UPDATE `rebate_status` SET `status` = '1' WHERE `rebate_status`.`regno` ='$regno';
    ";
    $result = mysqli_query($conn, $sql);
}


header('location:../adminDash.php');