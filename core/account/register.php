<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

if (isset($_POST["submit"])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $confPassword = mysqli_real_escape_string($connection, $_POST["confPassword"]);
    if (!isset($_POST["discord"])) {
      $discord = "";
    } else {
      $discord = mysqli_real_escape_string($connection, $_POST["discord"]);
    }
    $result = $connection->query("SELECT uuid FROM users WHERE username='$username'");
    if ($result->num_rows > 0) {
        $error = "A user with this username already exists.";
        renderPage($username, $password, $confPassword,  $error, $discord);
    } else {
        if ($password == $confPassword) {
            $uuid = gen_uuid();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $result2 = $connection->query("INSERT INTO users VALUES (DEFAULT, '$uuid', '$username', '$hashedPassword', 9, DEFAULT, '$discord')");
            header('Location: ' . SITE_URL);
        } else {
            $error = "The passwords do not match.";
            renderPage($username, $password, $confPassword,  $error, $discord);
        }
    }
    $connection->close();
} else {
    renderPage("", "", "", "", "");
    exit();
}

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function renderPage($username, $password, $confPassword, $error, $discord) {
?>

<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css?v=1" rel="stylesheet" />
    <link href="<?php echo SITE_URL; ?>core/assets/select2-bootstrap4.css?v=1" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>core/assets/bootstrap-dark.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>core/assets/style-dark.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="<?php echo SITE_URL; ?>core/civ/civ.js?v=1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <title><?php echo TITLE; ?> ● Register</title>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }

            a:link {
                text-decoration: underline;
            }
            .login-box {
              background-image: linear-gradient(to left bottom, #434343, #3c3c3c, #353535, #2e2e2e, #272727);
              height: auto;
              width: auto;
              position: relative;
              top: 50%;
              transform: translateY(-50%);
              margin: 0 auto;
              width:25%;
              min-width: 480px;
            }
            .login-input-container {
              width: 100%;
              margin-top: 6px;
              margin-bottom: 6px;
              color: #fff;
              border:none;
              border-radius: 0px;
              background-color: #444444;
              border-top: solid 1px #f7f7f7;
              color: white;
            }
            .login-input {
              width: 100%;
              margin-top: 6px;
              margin-bottom: 6px;
              color: #fff;
              border:none;
              border-radius: 0px;
              background-color: #444444;
              color: white;
            }
            .login-input::placeholder {
              color: #d8d8d8;
            }
            .login-input:focus {
              background-color: #444444;
              color: #d8d8d8;
            }
            .login-button {
              width: 100%;
              margin-top: 6px;
              margin-bottom: 6px;
              background-image: linear-gradient(to left bottom, #000000, #080808, #0e0e0e, #141414, #181818);
              color: #fff;
              border:none;
              border-radius: 36px;
            }
            .login-button:hover {
              background-image: linear-gradient(to right, #2c3e50, #fd746c);
              color: white;
            }
            .gradient-container {
                top: -1px; bottom: -1px;
                left: -1px; right: -1px;
                background: linear-gradient(to right, #2c3e50, #fd746c);
                content: '';
                z-index: -1;
                border-radius: 38px;
                width:30%;
            }

            @media only screen and (max-width: 600px) {
              .login-box {
                width:90%;
                min-width: 90%;
              }
              .gradient-container {
                  width:35%;
              }
            }
            body {
              background-image: linear-gradient(to right, #2c3e50, #fd746c);
            }
        </style>
    </head>
    <body>
      <div class="login-box" style=" height:auto; padding-top: 100px; padding-bottom: 100px;">
            <h1 class="text-center" style="margin-bottom:40px">Register</h1>
            <form action="" name="form1" method="post">
                <p class="col-md-12 center login-input-container" style="width: 100%; min-width: 175px; margin: 0 auto; padding: 0 0; height:45px;">
                    <i class="fa fa-user icon" style="width:10%; display: inline-block;"></i><input name="username" class="form-control login-input" placeholder="Username"  style="width:90%; margin: 0 auto; display: inline-block; height:100%;" value="<?php echo $username; ?>">
                </p>

                <?php
                if (DISCORD_MODULE == 1) {
                  ?>
                 <p class="col-md-12 center login-input-container" style="width: 100%; min-width: 175px; margin: 0 auto; padding: 0 0; height:45px;">
                       <img src="<?php echo SITE_URL; ?>core/assets/discord.svg" style="width:10%; height: 100%; display: inline-block;"></i><input name="discord" class="form-control login-input" placeholder="Discord (Ex: Username#9999)"  style="width:90%; margin: 0 auto; display: inline-block; height:100%;" value="<?php echo $discord; ?>">
                 </p>
                  <?php
                }
                 ?>

                <p class="col-md-12 center login-input-container" style="width: 100%; min-width: 175px; margin: 0 auto; padding: 0 0; height:45px;">
                      <i class="fa fa-key icon" style="width:10%; display: inline-block;"></i><input type="password" name="password" class="form-control login-input" placeholder="Password"  style="width:90%; margin: 0 auto; display: inline-block; height:100%;" value="<?php echo $password; ?>">
                </p>

                <p class="col-md-12 center login-input-container" style="width: 100%; min-width: 175px; margin: 0 auto; padding: 0 0; height:45px;">
                      <i class="fa fa-key icon" style="width:10%; display: inline-block;"></i><input type="password" name="confPassword" class="form-control login-input" placeholder="Confirm Password"  style="width:90%; margin: 0 auto; display: inline-block; height:100%;" value="<?php echo $password; ?>">
                </p>

                <?php
                    if ($error != "") {
                        echo '<div class="form-control-error text-center" style="width: 100%; min-width: 175px;"><font color="red">' . $error . '</font></div>';
                    }
                ?>
                <div style="width: 100%;">
                  <div class="gradient-container" style="margin: 0 auto; margin-top: 40px;display:inline-block; margin-left: 25px;">
                    <input type="submit" name="submit" value="Register" class="btn btn-primary form-control login-button" style="width:calc(-4px + 100%); transform:translate(2px, 0); margin: 2px 0;">
                  </div>
                  <p class="text-center" style="display:inline-block; width: auto; margin-left: 20px; color: white; margin-bottom: 0px;">Already a member? Login <a href="login.php">here</a>.</p>
                </div>

                <p class="col-md-12 center" style="width: calc(-50px + 100%); min-width: 175px; margin: 0px 25px; padding: 0 0; height:auto; font-size: 14px; margin-top:100px; text-align: center;">
                  Hawk Technologies <a href="https://discordapp.com/invite/Ue3RGph" style="color:#7289da;">Discord</a> - © 2018 Hawk Technologies
                  <br>
                  Purchase this CAD <a href="https://shophawktechnology.com/">here</a>.
                </p>
            </form>
      </div>
    </body>
</html>

<?php
}
?>
