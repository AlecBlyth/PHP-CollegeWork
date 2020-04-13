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
if (!empty($_GET['id'])) {
    $id = $_SESSION['id'];
}
if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
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
        background-color: #43b5ff;
    }
</style>
<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">Your Profile</h1>
    <h2><?php echo '<a type="submit" a class="btn btn-success" href="userUpdate.php?id=' . $data['id'] . '">Update Your Profile</a></h2>';
    echo '<a class="btn btn-dark" href="userMenu.php?id=' . $data['id'] . '">Back</a>'?>

</div>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Second Name</th>
        <th>Email Address</th>
        <th>Mobile Number</th>
        <th>Password</th>
        <th>Interest Area</th>
        <th>IDs</th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo '<tr>';
    echo '<td>' . $data['firstname'] . '</td>';
    echo '<td>' . $data['surname'] . '</td>';
    echo '<td>' . $data['email'] . '</td>';
    echo '<td>' . $data['mobile'] . '</td>';
    echo '<td>' . $data['password'] . '</td>';
    echo '<td>' . $data['interest'] . '</td>';
    echo '<td>' . $data['id'] . '</td>';
    echo '</tr>';
    Database::disconnect();
    ?>
    </tbody>
</table>
</body>
</html>


