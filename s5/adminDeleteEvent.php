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

if ( !empty($_GET['event_id'])) {
    $id = $_REQUEST['event_id'];
}

if ( !empty($_POST)) {
    // keep track post values
    $id = $_POST['event_id'];

    // delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM events WHERE event_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: adminEvent.php");

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
        background-color: #ff4e41;
    }
</style>

<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">Delete Event</h1>
</div>
<div class="container">
        <form class="form-horizontal" action="adminDeleteEvent.php" method="post">
            <input type="hidden" name="event_id" value="<?php echo $id;?>"/>
            <p class="alert alert-error">Are you sure you want to delete the event?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn btn-dark" href="adminEvent.php">No</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html>
