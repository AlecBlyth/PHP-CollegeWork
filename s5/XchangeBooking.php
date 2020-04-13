<?php
require 'database.php';
// validate input

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_GET['book_id'])) {
    $book_id = $_REQUEST['book_id'];
}
if (!empty($_GET['event_id'])) {
    $newEvent_id = $_REQUEST['event_id'];
}

if (!empty($_GET['oldEvent_id'])) {
    $oldEvent = $_REQUEST['oldEvent_id'];
}
if (null == $newEvent_id || null == $book_id || null == $oldEvent) {
    echo"ID NOT FOUND";

} else {
// insert data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE bookings set event_id = $newEvent_id WHERE book_id = $book_id";
    $q = $pdo->prepare($sql);
    $q->execute(array($newEvent_id));
    Database::disconnect();
    echo $oldEvent;
    echo $newEvent_id;
    header("Location: readBooking.php?id=".$id);
}