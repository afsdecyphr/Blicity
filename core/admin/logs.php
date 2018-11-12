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
        <div class="col-centered" style="width:75%; height:auto; border:1px solid black; max-height: 100%; border-radius:4px; padding:5px 5px; display:inline; float:right; margin-right:5px;">
          <?php
          $holder = '?';
          $sortNewest = "?sort=newest";
          $sortOldest = "?sort=oldest";
          if (isset($_GET['sort'])) {
            $holder .= 'sort=' . $_GET['sort'];
          }
          if (isset($_GET['user'])) {
            if ($holder == "?") {
              $holder .= 'user=' . $_GET['user'];
              $sortNewest .= 'user=' . $_GET['user'];
              $sortOldest .= 'user=' . $_GET['user'];
            } else {
              $holder .= '&user=' . $_GET['user'];
              $sortNewest .= '&user=' . $_GET['user'];
              $sortOldest .= '&user=' . $_GET['user'];
            }
          }
          if (isset($_GET['ip'])) {
            if ($holder == "?") {
              $holder .= 'ip=' . $_GET['ip'];
              $sortNewest .= 'ip=' . $_GET['ip'];
              $sortOldest .= 'ip=' . $_GET['ip'];
            } else {
              $holder .= '&ip=' . $_GET['ip'];
              $sortNewest .= '&ip=' . $_GET['ip'];
              $sortOldest .= '&ip=' . $_GET['ip'];
            }
          }
          $sortNewestByUser = "?sort=newest&user=";
          $sortOldestByUser = "?sort=oldest&user=";
          $sortNewestByIP = "?sort=newest&ip=";
          $sortOldestByIP = "?sort=oldest&ip=";
          if (isset($_GET['ip'])) {
            $sortNewest = $sortNewestByIP . $_GET['ip'];
            $sortNewestTemplate = $sortNewestByIP;
            $sortOldest = $sortOldestByIP . $_GET['ip'];
            $sortOldestTemplate = $sortOldesttByIP;
          }
          if (isset($_GET['user'])) {
            $sortNewest = $sortNewestByUser . $_GET['user'];
            $sortNewestTemplate = $sortNewestByUser;
            $sortOldest = $sortOldestByUser . $_GET['user'];
            $sortOldestTemplate = $sortOldestByUser;
          }
          ?>
          <a href="<?php echo $sortNewest; ?>"><button class="btn btn-sm btn-info" style="margin: 0 5px;">Sort By Newest</button></a><a href="<?php echo $sortOldest; ?>"><button class="btn btn-sm btn-info" style="margin: 0 5px;">Sort By Oldest</button></a><a href="logs.php?sort=newest"><button class="btn btn-sm btn-warning" style="margin: 0 5px;">Clear Filter</button></a>
            <div style="width:100%; height: 100%; max-height: 490px;margin-top:5px;overflow-y:auto;line-height:16px;font-size:14px;" id="" class="form-control log-box" contenteditable="false"><?php
            $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $sort = "DESC";
            if (isset($_GET['sort'])) {
              if ($_GET['sort'] == "oldest") {
                $sort = "ASC";
              }
            }
            
            if (isset($_GET['user'])) {
              $user = $_GET['user'];
              $logsQuery = $connection->query("SELECT * FROM user_log WHERE uuid='$user' ORDER BY id $sort");
            } elseif (isset($_GET['ip'])) {
              $ip = $_GET['ip'];
              $logsQuery = $connection->query("SELECT * FROM user_log WHERE ip='$ip' ORDER BY id $sort");
            } else {
              $logsQuery = $connection->query("SELECT * FROM user_log ORDER BY id $sort");
            }
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
                    echo '<span class="badge badge-dark">' . date('Y-m-d h:i:s', $row['timestamp']) . '</span> <a href="?sort=newest&user=' . $uuid . '"><span class="badge badge-dark">' . $username . '</span></a> <a href="?sort=newest&ip=' . $row['ip'] . '"><span class="badge badge-dark">' . $row['ip'] . '</span></a> <span class="badge badge-primary">' . $row['action'] . '</span><br>';
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