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
$book_id = 0;

// validate input

if (!empty($_GET['book_id'])) {
    $book_id = $_REQUEST['book_id'];
}

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id || null == $book_id ) {
    echo"ID NOT FOUND";

} else {
        //Delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM bookings WHERE book_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($book_id));
        Database::disconnect();
        header("Location: adminBookings.php?");
}