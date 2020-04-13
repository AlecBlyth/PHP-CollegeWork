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
// validate input
if (!empty($_GET['event_id'])) {
    $event_id = $_REQUEST['event_id'];
}
if (!empty($_GET['id'])) {
    $id = $_SESSION['id'];
}
if (null == $event_id || null == $id) {
    echo"ID NOT FOUND";

} else {
// insert data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO bookings(event_id, id) values(?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($event_id, $id));
    Database::disconnect();
    echo $event_id;
    echo $id;
    header("Location: userReadBooking.php?id=".$id);
}
