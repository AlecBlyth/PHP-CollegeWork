<?php
$con=mysqli_connect("localhost","student","","BunnyCorpDatabase");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
require_once 'database.php';
session_start();
$error = false;
$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$pdo = Database::connect();
$sql = "SELECT * FROM customers WHERE username='$username' and password='$password'";
if (!mysqli_query($con,$sql)) {
    header("Location: index.php?injection=true");
    die('Error: ' . mysqli_error($con));
    echo "Injection blocked";
}
error_log($sql);
echo "Invalid Login";
header("Location: index.php?invalid=true");
foreach ($pdo->query($sql) as $row) {
    if ($row["username"] == "admin") {
        $_SESSION["uname"] = "admin";
        header("Location: adminMenu.php");
        $_SESSION['isLogged'] = true;
        $_SESSION['isAdmin'] = true;
    } else {
        $_SESSION["uname"] = $username;
        $id = $row["id"];
        header("Location: userMenu.php?id=".$id);
        $_SESSION["id"] = $id;
        $_SESSION['isLogged'] = true;
        $_SESSION['isAdmin'] = false;
    }
}
Database::disconnect();


