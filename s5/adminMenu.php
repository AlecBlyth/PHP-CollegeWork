<?php
session_start();
if (!$_SESSION['isLogged']) {
    header("location:index.php");
    die();
} else if (!$_SESSION['isAdmin']) {
    header("location:index.php");
    die();
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
    .jumbotron {
        background-color: #22638b;
    }
</style>
<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">Admin Selection</h1>
    <h2 class="text-center">Flexiflash PHP S5</h2>
</div>
<p>
<div class="col-md-12 text-center">
    <a href="adminCustomer.php" class="btn btn-dark btn-lg">Customers</a>
    <a href="adminEvent.php" class="btn btn-dark btn-lg">Events</a>
    <a href="adminBookings.php" class="btn btn-dark btn-lg">Bookings</a>
</div>
</p>
<div class="col-md-12 text-right">
    <a href="index.php" class="btn btn-danger btn-lg">Log out</a>
</div> <!-- /container -->
</body>
</html>
