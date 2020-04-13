<?php
session_start();
if (!$_SESSION['isLogged']) {
    header("location:index.php");
    die();
} else if (!$_SESSION['isAdmin']) {
    header("location:index.php");
    die();
}
require 'database.php';
$event_id = null;
if (!empty($_GET['event_id'])) {
    $event_id = $_REQUEST['event_id'];
}

if (null == $event_id) {
    echo $event_id;
    //header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM events where event_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($event_id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
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
    <h1 class="text-center text-white"><?php echo $data['eventName']?></h1>
    <a type="submit" a class="btn btn-dark" href="adminEvent.php">Back</a>
</div>
<p>
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
    </tr>
    </thead>
    <tbody>
    <?php
    echo '<tr>';
    echo '<td>' . $data['eventName'] . '</td>';
    echo '<td>' . $data['eventDesc'] . '</td>';
    echo '<td>' . $data['eventLocation'] . '</td>';
    echo '<td>' . $data['eventType'] . '</td>';
    echo '<td>' . $data['eventDate'] . '</td>';
    echo '<td>' . $data['event_id'] . '</td>';
    echo '</tr>';
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>


