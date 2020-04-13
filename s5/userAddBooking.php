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
    <h1 class="text-center text-white">Current Events Menu</h1>
</div>
<p>
<div class="col-md-12 text-center">
    <?php
    $id = $_REQUEST["id"];
    echo '<a class="btn btn-success" href="userReadBooking.php?id=' . $id . '">Back</a>';
    ?>
</div>
</p>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Event Name</th>
        <th>Event Description</th>
        <th>Event Location</th>
        <th>Event Type</th>
        <th>Event Date</th>
        <th>Event ID</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include 'database.php';
    $pdo = Database::connect();
    $sql = "SELECT * FROM events ORDER BY eventName ASC";
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>' . $row['eventName'] . '</td>';
        echo '<td>' . $row['eventDesc'] . '</td>';
        echo '<td>' . $row['eventLocation'] . '</td>';
        echo '<td>' . $row['eventType'] . '</td>';
        echo '<td>' . $row['eventDate'] . '</td>';
        echo '<td>' . $row['event_id'] . '</td>';
        echo '<td width=15>';
        echo '<a class="btn btn-primary" href="userCreateBooking.php?event_id=' . $row['event_id'] . '&id=' . $id = $_REQUEST["id"] . '">Book</a>';
        echo'</td>';
        echo'</tr>';
    }
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>

