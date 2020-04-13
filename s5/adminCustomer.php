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
    <h1 class="text-center text-white">Customers</h1>
    <a href="adminMenu.php" class="btn btn-dark">Back</a>
</div>
<p>
</p>
<form action="adminCustomer.php" method="post">
    <div class="btn-group" data-toggle="buttons" style="float: right;">
        <button type="radio" class="btn btn-primary" name="asc_sort" id="asc_sort" value="1">Ascending</button>
        <button type="radio" class="btn btn-light" name="asc_sort" id="asc_sort" value="0">Descending</button>
    </div>
</form>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>First Name</th>
        <th>Second Name</th>
        <th>Email Address</th>
        <th>Mobile Number</th>
        <th>Interest Area</th>
        <th>IDs</th>
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
        $sql = "SELECT * FROM customers ORDER BY surname ASC";

    }else{

        $sql = "SELECT * FROM customers ORDER BY surname DESC";
    }
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '<td>' . $row['firstname'] . '</td>';
        echo '<td>' . $row['surname'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['mobile'] . '</td>';
        echo '<td>' . $row['interest'] . '</td>';
        echo '<td>' . $row['id'] . '</td>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>