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
    <h1 class="text-center text-white">Current Bookings</h1>
    <a href="adminMenu.php" class="btn btn-dark">Back</a>
</div>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th colspan="2"> Customer's Name</th>
        <th>Event Title</th>
        <th>Event Description</th>
        <th>Event Type</th>
        <th>Event Location</th>
        <th>Event Date</th>
        <th>Booking ID</th>
        <th>User ID</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require 'database.php';
        $pdo = Database::connect();
        $sql = 'SELECT bookings.book_id, customers.id, customers.firstname, customers.surname, events.event_id, events.eventName, events.eventDesc, events.eventType,
        events.eventLocation, events.eventDate FROM bookings 
        INNER JOIN customers ON bookings.id = customers.id
        INNER JOIN events ON bookings.event_id = events.event_id';
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td>' . $row['firstname'] . '</td>';
            echo '<td>' . $row['surname'] . '</td>';
            echo '<td>' . $row['eventName'] . '</td>';
            echo '<td>' . $row['eventDesc'] . '</td>';
            echo '<td>' . $row['eventType'] . '</td>';
            echo '<td>' . $row['eventLocation'] . '</td>';
            echo '<td>' . $row['eventDate'] . '</td>';
            echo '<td>' . $row['book_id'] . '</td>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td width=100>';
            echo '<a class="btn btn-danger"  href="adminDeleteBooking.php?book_id=' . $row['book_id'] . '&id=' . $row['id'] . '">Delete</a>';
            echo '</td>';
            echo '</tr>';
    }
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>
