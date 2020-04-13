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
        background-color: #87ff96;
    }
</style>
<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">User Bookings</h1>
</div>
<p>
<div class="col-md-12 text-center">
    <?php
    $id = $_SESSION["id"];
    echo '<a class="btn btn-success" href="userAddBooking.php?id=' . $id . '">Create</a>';
    echo '<a class="btn btn-primary" href="userMenu.php?id=' . $id . '">Back</a>';
    ?>
</div>
</p>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Event Title</th>
        <th>Event Description</th>
        <th>Event Type</th>
        <th>Event Location</th>
        <th>Event Date</th>
        <th>Booking ID</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require 'database.php';
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if (null == $id) {
    header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $sql = 'SELECT bookings.book_id, customers.id, events.event_id, events.eventName, events.eventDesc, events.eventType,
        events.eventLocation, events.eventDate FROM bookings INNER JOIN customers ON bookings.id = customers.id
        INNER JOIN events ON bookings.event_id = events.event_id WHERE customers.id = '.$id;
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td>' . $row['eventName'] . '</td>';
            echo '<td>' . $row['eventDesc'] . '</td>';
            echo '<td>' . $row['eventType'] . '</td>';
            echo '<td>' . $row['eventLocation'] . '</td>';
            echo '<td>' . $row['eventDate'] . '</td>';
            echo '<td>' . $row['book_id'] . '</td>';
            echo '</td>';
            echo '</tr>';
        }
    }
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>
