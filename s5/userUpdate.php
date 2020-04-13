<?php
session_start();
if (!$_SESSION['isLogged']) {
    header("location:index.php");
    die();
} else if (!$_SESSION['uname']) {
    header("location:index.php");
    die();
}else if (!$_SESSION['id']) {
    header("location:index.php");
    die();
}

require 'database.php';
if (!empty($_GET['id'])) {
    $id = $_SESSION['id'];
}
if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    //Keep track validation errors
    $firstnameError = null;
    $secondnameError = null;
    $emailError = null;
    $mobileError = null;
    $passwordError = null;
    $interestError = null;

    //Keep track post values
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $interest = $_POST['interest'];

    // validate input
    $valid = true;
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
        $emailError = 'Enter a valid Email Address';
        $valid = false;
    }
    if (empty($mobile)) {
        $mobileError = 'Enter a Mobile Number';
    } else if (!filter_var($mobile, FILTER_VALIDATE_INT)) {
        $mobileError = 'Enter a valid Mobile Number';
        $valid = false;
    }
    if (empty($interest)) {
        $interestError = 'Select valid Interest';
        $valid = false;
    }
    if (empty($password)) {
        $passwordError = 'Enter valid password';
        $valid = false;
    }

    //Update Data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE customers set firstname = ?, surname = ?, email = ?, mobile = ?, password = ?, interest = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($firstname, $surname, $email, $mobile, $password, $interest, $id));
        Database::disconnect();
        header("Location: userRead.php?id=" . $id);
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $firstname = $data['firstname'];
    $surname = $data['surname'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $password = $data['password'];
    $interest = $data['interest'];
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
        background-color: #43b5ff;
    }
</style>

<body>
<div class="jumbotron text-center">
    <h1 class="text-center text-white">Update Customer</h1>
</div>
<div class="container">
        <form class="form-horizontal" action="userUpdate.php?id=<?php echo $id ?>" method="post">
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

            <div class="form-group <?php echo !empty($passwordError) ? 'error' : ''; ?>">
                <div class="controls">
                    <input name="password" type="text" class="form-control" placeholder="Password"
                           value="<?php echo !empty($password) ? $password : ''; ?>">
                    <?php if (!empty($passwordError)): ?>
                        <span class="help-inline"><?php echo $passwordError; ?></span>
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
                <button type="submit" class="btn btn-success">Update</button>
                <?php echo '<a type="submit" a class="btn btn-dark" href="userRead.php?id=' . $id . '">Back</a>';?>
            </div>
        </form>
    </div>
</div> <!-- /container -->
</body>
</html>