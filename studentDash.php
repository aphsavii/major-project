<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
// echo $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'essentials/navbar.php';
    ?>
    <button class="btn-primary btn btn-sm"> <a style="text-decoration: none" class="text-light" href="essentials/logout.php">
            Log Out </a></button>
</body>

</html>