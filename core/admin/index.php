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
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?> ● Admin Panel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
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
            <a href="ums/index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">User Management System</button></a>
        </div>
        <div class="col-centered" style="width:75%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:right; margin-right:5px;">
            <form action="" method="POST">
                <b>Website Title</b>
                <input type="text" name="title" class="form-control" placeholder="Website Title" style="width:40%; margin-top: 0px;" value="<?php echo $title; ?>">
                <b>Website URL</b>
                <input type="text" name="siteUrl" class="form-control" placeholder="Website URL (Ex: https://example.com/cad/)" style="width:40%; margin-top: 0px;" value="<?php echo $url; ?>">
                <input type="submit" name="submit" value="Append/Save Changes" class="btn btn-primary form-control" style="width:40%; margin-top:6px; margin-bottom:6px; border-color:#13ff13;">
            </form>
            
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