<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['uuid'])) {
    $uuid = $_SESSION['uuid'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT level FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['level'] > 1) {
                echo "noAccess";
                exit();
            }
        }
    } else {
        echo "noAccess";
        exit();
    }
} else {
    echo "noAccess";
    exit();
}
$file_access = "11111111";
require '../../core/includes/check_access.php';

if (isset($_POST['submit'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $title = mysqli_real_escape_string($connection, $_POST["title"]);
    $url = mysqli_real_escape_string($connection, $_POST["url"]);
    $result = $connection->query("SELECT * FROM settings");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($title != $row['title']) {
                $oldTitle = $row['title'];
                $query = $connection->query("UPDATE settings SET title='$title' WHERE title='$oldTitle'");
            }
            if ($url != $row['siteUrl']) {
                $oldUrl = $row['siteUrl'];
                $query = $connection->query("UPDATE settings SET siteUrl='$url' WHERE siteUrl='$oldUrl'");
            }
        }
        renderPage($title, $url, "");
    } else {
        $error = "An error occured.";
        renderPage("", "", $error);
    }
    $connection->close();
} else {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM settings");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $url = $row['siteUrl'];
        }
    }
    renderPage($title, $url, "");
    exit();
}
function renderPage($title, $url, $info) {
$file_access = "11111111";
require '../../core/includes/check_access.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?> ● Admin Panel</title>
        <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '<?php echo SITE_URL; ?>core/assets/bootstrap-<?php echo $theme; ?>.css';
        document.head.appendChild(link);
        </script>
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>core/assets/style.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script src="<?php echo SITE_URL; ?>core/assets/bootstrap-number-input.js"></script>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center" style="margin-top: 10px;"><?php echo TITLE; ?> ● Admin Panel</h1>
        <div class="col-centered" style="width:24%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin-left:5px;">
            <a href="<?php echo SITE_URL; ?>" style="width:100%;"><button class="btn btn-primary" style="width:100%;">Home</button></a>
            <a href="index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">Admin Panel</button></a>
            <a href="ums/index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">User Management System</button></a>
        </div>
        <div class="col-centered" style="width:75%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:right; margin-right:5px;">
            <div style="width:100%;height:100%;margin-top:0px;overflow-y:scroll;line-height:16px;font-size:14px;" id="" class="form-control log-box" contenteditable="false"><?php
            $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $logsQuery = $connection->query("SELECT * FROM user_log");
            $i = 0;
            $add = "";
            if (mysqli_num_rows($logsQuery) >= 0) {
                while ($row = mysqli_fetch_assoc($logsQuery)) {
                    if ($i === 0) { $i = 1; $add = ""; }
                    elseif ($i === 1) { $i = 0; $add = "_dis"; }
                    $uuid = $row['uuid'];
                    $username = "";
                    $userQuery = $connection->query("SELECT * FROM users WHERE uuid='$uuid'");
                    if (mysqli_num_rows($userQuery) >= 0) {
                        while ($row2 = mysqli_fetch_assoc($userQuery)) {
                            $username = $row2['username'];
                        }
                    }
                    echo '<span class="badge badge-dark">' . date('Y-m-d h:i:s', $row['timestamp']) . '</span> <span class="badge badge-dark">' . $username . '</span> <span class="badge badge-dark">' . $row['ip'] . '</span> <span class="badge badge-primary">' . $row['action'] . '</span><br>';
                }
            }
            ?></div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="<?php echo SITE_URL; ?>core/assets/bootstrap-number-input.js"></script>
    </body>
</html>
<?php
}
?>