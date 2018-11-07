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
                $level = "<span class='badge badge-primary'>User</span>";
            } elseif ($row['level'] == 1) {
                $level = "<span class='badge badge-warning'>Administrator</span>";
            } elseif ($row['level'] == 0) {
                $level = "<span class='badge badge-danger'>Super Administrator</span>";
            }
        }
    }
    $uuid = $_SESSION['uuid'];
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $confPassword = mysqli_real_escape_string($connection, $_POST["confPassword"]);
    if (!isset($_POST["discord"])) {
      $discord = "";
    } else {
      $discord = mysqli_real_escape_string($connection, $_POST["discord"]);
    }
    $toUsername = "";
    $toPassword = "";
    $result = $connection->query("SELECT username, password, discord, uuid FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $hashedPassword = $row["password"];
            $uuid = $row["uuid"];
            $error = "";
            if ($username != $row['username']) {
                $error = "";
                $updateQuery = $connection->query("UPDATE users SET username='$username' WHERE uuid='$uuid'");
            }
            if ($discord != $row['discord']) {
                $error = "";
                $updateQuery = $connection->query("UPDATE users SET discord='$discord' WHERE uuid='$uuid'");
            }
            if (!password_verify($password, $hashedPassword) && $password != "") {
                if ($password != $confPassword) {
                    renderPage($username, $level, "Passwords do not match.", $password, "", $discord);
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $updateQuery = $connection->query("UPDATE users SET password='$hashedPass' WHERE uuid='$uuid'");
                    $error = "updated pass";
                    renderPage($username, $level, $error, "", "", $discord);
                }
            } else {
                renderPage($username, $level, $error, "", "", $discord);
            }
        }
    }
} elseif (isset($_POST['home'])) {
    header('Location: ' . SITE_URL);
} else {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $uuid = $_SESSION['uuid'];
    $result = $connection->query("SELECT username, level, discord FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $username = $row['username'];
            $discord = $row['discord'];
            if ($row['level'] == 9) {
                $level = "<span class='badge badge-primary'>User</span>";
            } elseif ($row['level'] == 1) {
                $level = "<span class='badge badge-warning'>Administrator</span>";
            } elseif ($row['level'] == 0) {
                $level = "<span class='badge badge-danger'>Super Administrator</span>";
            }
        }
    }
    renderPage($username, $level, "", "", "", $discord);
}

function renderPage($username, $accessLevel, $error, $password, $confPassword, $discord) {
    $file_access = "11111111";
    require '../../core/includes/check_access.php';
    require_once '../../core/includes/cdn_settings.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = '<?php echo SITE_URL; ?>core/assets/bootstrap-<?php echo $theme; ?>.css';
            document.head.appendChild(link);
        </script>
        <title><?php echo TITLE; ?> ● Account</title>
        <?php
        foreach ($requiredFiles as $file) {
            echo $file;
        }
        echo POPPER;
        echo SOLID;
        echo FONTAWESOME;
        echo BOOTSTRAP_NUMBER_INPUT;
        echo SELECT2;
        echo SELECT2_REMOTECSS;
        echo SELECT2_CSS;
        ?>
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
                <?php
                if (DISCORD_MODULE == 1) {
                  ?>
                     <p class="col-md-12 center" style="width: 100%; min-width: 175px;">
                         <b>Discord</b>
                         <input type="text" name="discord" class="form-control" placeholder="Discord" style="width:100%; margin-top: 0px;" value="<?php echo $discord; ?>">
                     </p>
                  <?php
                }
                 ?>
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
                    <input type="submit" name="submit" value="Apply" class="btn btn-primary form-control" style="width:100%; margin-top:6px; margin-bottom:6px;">
                    <a href="<?php echo SITE_URL; ?>"><input type="submit" name="home" value="Home" class="btn btn-primary form-control" style="width:100%; margin-top:6px; margin-bottom:6px;"></a>
                </p>
            <p class="text-center">Access Tag: <?php echo $accessLevel; ?></p>
            </form>
        </div>
</html>
<?php
}
?>
