<?php
session_start();
if (!$_SESSION['isLogged']) {
    header("location:index.php");
    die();
} else if (!$_SESSION['uname']) {
    header("location:index.php");
    die();
} else if (!$_SESSION['id']) {
    header("location:index.php");
    die();
}
require 'database.php';
if (!empty($_GET['id'])) {
    $id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<style>
    .jumbotron{
        background-color: #43b5ff;
    }
</style>
<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">Customer Selection</h1>
    <h2 class="text-center">Flexiflash PHP S5</h2>
</div>
<p>
<div class="col-md-12 text-center">
    <?php
    $id = $_SESSION["id"];
    echo '<a class="btn btn-secondary" href="userRead.php?id=' . $id . '">Profile</a>';
    echo '<a class="btn btn-primary" href="userEvents.php?id=' . $id . '">Events</a>';
    echo '<a class="btn btn-success" href="userReadBooking.php?id=' . $id . '">Bookings</a>';
    ?>
</div>
</>
<div class="col-md-12 text-right">
    <a href="index.php" class="btn btn-danger btn-lg">Log out</a>
</div> <!-- /container -->
</body>
</html>