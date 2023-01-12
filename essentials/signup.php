<?php
// Connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'major_project');
if (!$conn) {
    echo "error";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo $_POST['uname'];
    if (isset($_POST['uname'])) {
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        if ($pass == $cpass) {
            $sql = "INSERT INTO `credentials` (`username`, `password`, `signup time`) VALUES ('$uname', '$pass', current_timestamp())
            ;";
            $result = mysqli_query($conn, $sql);
        } else {
            echo "passwords dosen't match !!";
        }
    }

    header("Location: ../index.php");
    die();
}
?>