<?php
session_start();
$_SESSION['isLogged'] = false;
$_SESSION['isAdmin'] = false;
$_SESSION["uname"] = false;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            width:100%;margin:auto;min-width:600px;max-width:2000px
        }

        .jumbotron{
            background-color: #43b5ff;
        }

        input[type=text], input[type=password] {
            width: 95%;
            padding: 10px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
        }

        a{
            padding: 8px;
            margin: 9px 0;
            border: none;
            cursor: pointer;
            width: 35%;
        }

        button {
            padding: 8px;
            margin: 9px 0;
            border: none;
            cursor: pointer;
            width: 35%;
        }

        img.avatar {
            width: 10%;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="jumbotron text-center">
    <h1 class="text-center">Flexiflash PHP S5 <img src="img/img_avatar.png" alt="Avatar" class="avatar"></h1>
    <h9 class="text-center"><?php if($_GET["invalid"] == "true") echo '<span style="color:#ff0000;text-align:center;">Invalid login!</span>';?></h9>
</div>
<form class="form" action="menu.php" method="post">
    <div class="container">
        <input type="text" placeholder="Enter Username" name="username" required>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button class="btn btn-dark">Login</button>
        <a href="create.php" class="btn btn-primary" role="button">Create an Account</a>
    </div>
</form>
</body>
</html>
