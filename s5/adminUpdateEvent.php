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
$id = null;
if (!empty($_GET['event_id'])) {
    $id = $_REQUEST['event_id'];
}
if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    // keep track validation errors
    $eventNameError = null;
    $descError = null;
    $locationError = null;
    $typeError = null;
    $dateError = null;

    // keep track post values
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventLocation = $_POST['eventLocation'];
    $eventType = $_POST['eventType'];
    $eventDate = $_POST['eventDate'];

    // validate input
    $valid = true;
    if (empty($eventName)) {
        $eventNameError = 'Enter the event name';
        $valid = false;
    }
    if (empty($eventDesc)) {
        $descError = 'Enter the event description';
        $valid = false;
    }

    if (empty($eventLocation)) {
        $locationError = 'Select location';
        $valid = false;
    }
    if (empty($eventType)) {
        $typeError = 'Select event type';
        $valid = false;
    }
    if (empty($eventDate)) {
        $dateError = 'Set event date';
        $valid = false;
    }

    //Update Data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE events set eventName = ?, eventDesc = ?, eventType = ?, eventLocation = ?, eventDate = ? WHERE event_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($eventName, $eventDesc, $eventType, $eventLocation, $eventDate, $id));
        Database::disconnect();
        header("Location: adminEvent.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM events where event_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $eventName = $data['eventName'];
    $eventDesc = $data['eventDesc'];
    $eventType = $data['eventType'];
    $eventLocation = $data['eventLocation'];
    $eventDate = $data['eventDate'];
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="=utf-8">
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
    <h1 class="text-center text-white">Update Event</h1>
</div>
<div class="container">
    <form class="form-horizontal" action="adminUpdateEvent.php?event_id=<?php echo $id ?>" method="post">
        <div class="form-group <?php echo !empty($eventNameError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="eventName" type="text" class="form-control" placeholder="Event Name"
                       value="<?php echo !empty($eventName) ? $eventName : ''; ?>">
                <?php if (!empty($eventNameError)): ?>
                    <span class="help-inline"><?php echo $eventNameError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($descError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="eventDesc" text="text" class="form-control" placeholder="Event Description"
                       value="<?php echo !empty($eventDesc) ? $eventDesc : ''; ?>">
                <?php if (!empty($descError)): ?>
                    <span class="help-inline"><?php echo $descError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($typeError) ? 'error' : ''; ?>">
            <label for="eventTypeArea">Event Types</label>
            <div class="form-group">
                <select name="eventType" class="form-control" id="eventTypeArea">
                    <option value="0"></option>
                    <option value="1">Music</option>
                    <option value="2">Cinema</option>
                    <option value="3">Comedy</option>
                    <option value="4">Theatre</option>
                    <option value="5">Magic</option>
                    <option value="6">Convention</option>
                </select>
                <?php if (!empty($typeError)): ?>
                    <span class="help-inline"><?php echo $typeError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group <?php echo !empty($locationError) ? 'error' : ''; ?>">
            <label for="Locations">Event Locations</label>
            <div class="form-group">
                <select name="eventLocation" class="form-control" id="Locations" placeholder ="Event Location">
                    <option value="0"></option>
                    <option value="1">Kirkcaldy</option>
                    <option value="2">Edinburgh</option>
                    <option value="3">London</option>
                    <option value="4">Tokyo</option>
                    <option value="5">Seoul</option>
                    <option value="6">New York</option>
                    <option value="6">Los Angeles</option>
                </select>
                <?php if (!empty($locationError)): ?>
                    <span class="help-inline"><?php echo $locationError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($dateError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="eventDate" text="number" class="form-control" placeholder="Event Date"
                       value="<?php echo !empty($eventDate) ? $eventDate : ''; ?>">
                <?php if (!empty($dateError)): ?>
                    <span class="help-inline"><?php echo $dateError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-dark">Update</button>
            <a class="btn btn-dark" href="adminEvent.php">Back</a>
        </div>
    </form>
</div>
</div> <!-- /container -->
</body>
</html>