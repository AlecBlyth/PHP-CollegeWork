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
$id = 0;

// validate input

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    echo"ID NOT FOUND";

} else {
    //Delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM customers WHERE id = $id";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: adminCustomer.php?");
}