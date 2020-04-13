<?php

require 'database.php';

if (!empty($_POST)) {
    // keep track validation errors
    $usernameError = null;
    $passwordError = null;
    $firstnameError = null;
    $surnameError = null;
    $emailError = null;
    $mobileError = null;
    $passwordError = null;
    $interestError = null;

    // keep track post values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $interest = $_POST['interest'];

$pdo = Database::connect();
$sql = "SELECT * FROM customers WHERE username='$username'";
foreach ($pdo->query($sql) as $row) {
    if ($row["username"] == $username) {
        $registered = $username;
    }
}
    // validate input
    $valid = true;

    if (empty($username)) {
        $usernameError = 'Please enter Username';
        $valid = false;
    } else if($username == $registered)
    {
        $usernameError = 'Username has been taken';
        $valid = false;
    }
    if (empty($password)) {
        $passwordError = 'Enter password';
        $valid = false;
    }
    if (empty($firstname)) {
        $firstnameError = 'Enter First Name';
        $valid = false;
    }
    if (empty($surname)) {
        $surnameError = 'Enter Surname';
        $valid = false;
    }
    if (empty($email)) {
        $emailError = 'Enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Enter valid Email Address';
        $valid = false;
    }
    if (empty($mobile)) {
        $mobileError = 'Enter a Mobile Number';
    } else if (!filter_var($mobile, FILTER_VALIDATE_INT)) {
        $mobileError = 'Enter a valid Mobile Number';
        $valid = false;
    }
    if (empty($interest)) {
        $interestError = 'Enter interest';
        $valid = false;
    }
    // insert data
    if ($valid) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO customers (username,password,firstname,surname,email,mobile,interest) values(?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$password,$firstname, $surname, $email, $mobile, $interest));
        Database::disconnect();
        header("Location: index.php");
    }
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
    <h1 class="text-center text-white">Account Creation</h1>
</div>

<div class="container">
    <form class="form-horizontal" action="create.php" method="post">
        <div class="form-group <?php echo !empty($usernameError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="username" type="text" class="form-control" placeholder="Username"
                       value="<?php echo !empty($username) ? $username : ''; ?>">
                <?php if (!empty($usernameError)): ?>
                    <span class="help-inline"><?php echo $usernameError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group <?php echo !empty($passwordError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="password" type="text" class="form-control" placeholder="Password"
                       value="<?php echo !empty($password) ? $password : ''; ?>">
                <?php if (!empty($passwordError)): ?>
                    <span class="help-inline"><?php echo $passwordError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group <?php echo !empty($firstnameError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="firstname" type="text" class="form-control" placeholder="First Name"
                       value="<?php echo !empty($firstname) ? $firstname : ''; ?>">
                <?php if (!empty($firstnameError)): ?>
                    <span class="help-inline"><?php echo $firstnameError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($surnameError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="surname" text="text" class="form-control" placeholder="Surname"
                       value="<?php echo !empty($surname) ? $surname : ''; ?>">
                <?php if (!empty($surnameError)): ?>
                    <span class="help-inline"><?php echo $surnameError; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="email" type="text" class="form-control" placeholder="Email Address"
                       value="<?php echo !empty($email) ? $email : ''; ?>">
                <?php if (!empty($emailError)): ?>
                    <span class="help-inline"><?php echo $emailError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group <?php echo !empty($mobileError) ? 'error' : ''; ?>">
            <div class="controls">
                <input name="mobile" type="text" class="form-control" placeholder="Mobile Number"
                       value="<?php echo !empty($mobile) ? $mobile : ''; ?>">
                <?php if (!empty($mobileError)): ?>
                    <span class="help-inline"><?php echo $mobileError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group <?php echo !empty($interestError) ? 'error' : ''; ?>">
            <label for="interestArea">Interest Area</label>
            <div class="form-group">
                <select name="interest" class="form-control" id="interestArea">
                    <option value="0"></option>
                    <option value="1">Music</option>
                    <option value="2">Cinema</option>
                    <option value="3">Comedy</option>
                    <option value="4">Theatre</option>
                    <option value="5">Magic</option>
                    <option value="6">Convention</option>
                </select>
                <?php if (!empty($interestError)): ?>
                    <span class="help-inline"><?php echo $interestError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn btn-primary" href="index.php">Back</a>
        </div>
    </form>
</div>
</div> <!-- /container -->
</body>
</html>