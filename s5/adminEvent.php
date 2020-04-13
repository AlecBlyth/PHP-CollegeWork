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
    <h1 class="text-center text-white">Event Menu</h1>
    <a href="adminCreateEvent.php" class="btn btn-dark">Create</a>
    <a href="adminMenu.php" class="btn btn-secondary">Back</a>
</div>
<form action="adminEvent.php" method="post">
    <div class="btn-group" data-toggle="buttons" style="float: right;">
        <button type="radio" class="btn btn-primary" name="asc_sort" id="asc_sort" value="1">Ascending</button>
        <button type="radio" class="btn btn-light" name="asc_sort" id="asc_sort" value="0">Descending</button>
    </div>
</form>

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

    if( isset( $_POST['ASC'] ) )
        if( $_POST['ASC'] == 1 )
            ASC_sort();
    $_POST['id_sort'] == 0;

    if ($_POST['ASC'] == 0)
        if( isset( $_POST['ASC'] ) )
            if( $_POST['ASC'] == 1 )
                DESC_sort();

    include 'database.php';
    $pdo = Database::connect();

    if(isset($_POST['asc_sort']) && !empty($_POST['asc_sort']) && $_POST['asc_sort']==1)
    {
        $sql = "SELECT * FROM events ORDER BY eventName ASC";

    }else{

        $sql = "SELECT * FROM events ORDER BY eventName DESC";
    }

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>' . $row['eventName'] . '</td>';
        echo '<td>' . $row['eventDesc'] . '</td>';
        echo '<td>' . $row['eventLocation'] . '</td>';
        echo '<td>' . $row['eventType'] . '</td>';
        echo '<td>' . $row['eventDate'] . '</td>';
        echo '<td>' . $row['event_id'] . '</td>';
        echo '<td width=250>';
        echo '<a class="btn btn-success" href="adminReadEvent.php?event_id=' . $row['event_id'] . '">View</a>';
        echo ' ';
        echo '<a class="btn btn-primary" href="adminUpdateEvent.php?event_id=' . $row['event_id'] . '">Update</a>';
        echo ' ';
        echo '<a class="btn btn-danger" href="adminDeleteEvent.php?event_id=' . $row['event_id'] . '">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>