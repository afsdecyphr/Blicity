<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

$file_access = "11111111";
require '../../core/includes/check_access.php';

if (isset($_POST['submit'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $uuid = $_SESSION['uuid'];
    $result = $connection->query("SELECT username, level FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $username = $row['username'];
            if ($row['level'] == 9) {
                $level = "User";
            } elseif ($row['level'] == 1) {
                $level = "Administrator";
            } elseif ($row['level'] == 0) {
                $level = "Super Administrator";
            }
        }
    }
    $uuid = $_SESSION['uuid'];
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $confPassword = mysqli_real_escape_string($connection, $_POST["confPassword"]);
    $toUsername = "";
    $toPassword = "";
    $result = $connection->query("SELECT username, password, uuid FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $hashedPassword = $row["password"];
            $uuid = $row["uuid"];
            $error = "";
            if ($username != $row['username']) {
                $error = "";
                $updateQuery = $connection->query("UPDATE users SET username='$username' WHERE uuid='$uuid'");
            }
            if (!password_verify($password, $hashedPassword) && $password != "") {
                if ($password != $confPassword) {
                    renderPage($username, $level, "Passwords do not match.", $password, "");
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $updateQuery = $connection->query("UPDATE users SET password='$hashedPass' WHERE uuid='$uuid'");
                    $error = "updated pass";
                    renderPage($username, $level, $error, "", "");
                }
            } else {
                renderPage($username, $level, $error, "", "");
            }
        }
    }
} else {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $uuid = $_SESSION['uuid'];
    $result = $connection->query("SELECT username, level FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $username = $row['username'];
            if ($row['level'] == 9) {
                $level = "User";
            } elseif ($row['level'] == 1) {
                $level = "Administrator";
            } elseif ($row['level'] == 0) {
                $level = "Super Administrator";
            }
        }
    }
    renderPage($username, $level, "", "", "");
}

function renderPage($username, $level, $error, $password, $confPassword) {
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css?v=1" rel="stylesheet" />
    <link href="http://localhost:8080/Blicity/core/assets/select2-bootstrap4.css?v=1" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost:8080/Blicity/core/assets/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="http://localhost:8080/Blicity/core/civ/civ.js?v=1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <title><?php echo TITLE; ?> ● Account</title>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }
            
            a:link {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center" style="margin-top: 10px;"><?php echo TITLE; ?> ● Account</h1>
        <div class="col-centered" style="width:25%; height:auto;">
            <form action="" name="form1" method="post">
                <p class="col-md-12 center" style="width: 100%; min-width: 175px;">
                    <b>Username</b>
                    <input type="text" name="username" class="form-control" placeholder="Username" style="width:100%; margin-top: 0px;" value="<?php echo $username; ?>">
                </p>
                <p class="col-md-12 center" style="width: 100%; min-width: 175px;">
                    <b>Password</b>
                    <input type="password" name="password" class="form-control" placeholder="Password" style="width:100%; margin-top: 0px;" value="<?php echo $password; ?>">
                </p>
                <p class="col-md-12 center" style="width: 100%; min-width: 175px;">
                    <b>Confirm Password</b>
                    <input type="password" name="confPassword" class="form-control" placeholder="Confirm Password" style="width:100%; margin-top: 0px;" value="<?php echo $confPassword; ?>">
                </p>
                <?php
                    if ($error != "") {
                        echo '<div class="form-control-error text-center" style="width: 100%; min-width: 175px;"><font color="red">' . $error . '</font></div>';
                    }
                ?>
                <p class="col-md-12 center" style="width: 100%; min-width: 175px;">
                    <input type="submit" name="submit" value="Apply" class="btn btn-primary form-control" style="width:100%; margin-top:6px; margin-bottom:6px; border-color:#13ff13;">
                </p>
                <p class="text-center">Account Level: <?php echo $level; ?></p>
            </form>
        </div>
</html>
<?php
}
?>
