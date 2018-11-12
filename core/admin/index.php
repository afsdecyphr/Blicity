<?php
$file_access = "11111111";
require '../../core/includes/check_access.php';

if (isset($_POST['submit'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $title = mysqli_real_escape_string($connection, $_POST["title"]);
    $url = mysqli_real_escape_string($connection, $_POST["siteUrl"]);
    if (isset($_POST['discord'])) {
      $discord = 1;
    } else {
      $discord = 0;
    }
    if (isset($_POST['customDeps'])) {
      $customDeps = 1;
    } else {
      $customDeps = 0;
    }
    if (isset($_POST['dowfModule'])) {
      $dowfModule = 1;
    } else {
      $dowfModule = 0;
    }
    $result = $connection->query("SELECT * FROM settings");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($title != $row['title']) {
                $oldTitle = $row['title'];
                $query = $connection->query("UPDATE settings SET title='$title' WHERE title='$oldTitle'");
            }
            if ($customDeps != $row['customDepartmentsModule']) {
                $oldcustomDeps = $row['customDepartmentsModule'];
                $query = $connection->query("UPDATE settings SET customDepartmentsModule='$customDeps' WHERE customDepartmentsModule='$oldcustomDeps'");
            }
            if ($discord != $row['discordModule']) {
                $oldDiscord = $row['discordModule'];
                $query = $connection->query("UPDATE settings SET discordModule='$discord' WHERE discordModule='$oldDiscord'");
            }
            if ($dowfModule != $row['dowfModule']) {
                $oldDowfModule = $row['dowfModule'];
                $query = $connection->query("UPDATE settings SET dowfModule='$dowfModule' WHERE dowfModule='$oldDowfModule'");
            }
            if ($url != $row['siteUrl']) {
                $oldUrl = $row['siteUrl'];
                $query = $connection->query("UPDATE settings SET siteUrl='$url' WHERE siteUrl='$oldUrl'");
            }
        }
        renderPage($title, $url, "", $discord, $customDeps, $dowfModule);
    } else {
        $error = "An error occured.";
        renderPage("", "", $error, $discord, $customDeps, $dowfModule);
    }
    $connection->close();
} elseif (isset($_POST['manageDepartments'])) {
  header('Location: ' . SITE_URL . 'modules/customDepartmentsModule/config.php');
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
            $discord = $row['discordModule'];
            $customDeps = $row['customDepartmentsModule'];
            $dowfModule = $row['dowfModule'];
        }
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
                if ($row['level'] > 0) {
                  if ($row['level'] == 1) {
                    header('Location: ums/index.php');
                  } else {
                    echo "noAccess";
                    exit();
                  }
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
    renderPage($title, $url, "", $discord, $customDeps, $dowfModule);
    exit();
}
function renderPage($title, $url, $info, $discord, $customDeps, $dowf) {
$file_access = "11111111";
require '../../core/includes/check_access.php';
  if ($level == 1) {
    header('Location: ums/index.php');
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
        <div class="col-centered" style="width:calc(-10px + 33.33%); height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin:0 5px;">
            <a href="<?php echo SITE_URL; ?>" style="width:100%;"><button class="btn btn-primary" style="width:100%;">Home</button></a>
            <a href="ums/index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">User Management System</button></a>
            <a href="logs.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">Logs</button></a>
        </div>
        <div class="col-centered" style="width:calc(-10px + 33.33%); height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin: 0 5px;">
          <h3>Site Settings</h3>
            <form action="" method="POST">
                <b>Website Title</b>
                <input type="text" name="title" class="form-control" placeholder="Website Title" style="width:100%; margin-top: 0px;" value="<?php echo $title; ?>">
                <b>Website URL</b>
                <input type="text" name="siteUrl" class="form-control" placeholder="Website URL (Ex: https://example.com/cad/)" style="width:100%; margin-top: 0px;" value="<?php echo $url; ?>">
                <div class="form-check" style="margin-top: 10px;">
                  <label class="form-check-label">
                    <?php
                    if ($discord == "1") {
                      echo '<input name="discord" class="form-check-input" type="checkbox" value="1" checked="">';
                    } else {
                      echo '<input name="discord" class="form-check-input" type="checkbox" value="0">';
                    }
                    ?>
                    Discord Username Module
                  </label>
                </div>
                <div class="form-check" style="margin-top: 10px;">
                  <label class="form-check-label">
                    <?php
                    if ($customDeps == "1") {
                      echo '<input name="customDeps" class="form-check-input" type="checkbox" value="1" checked="">';
                    } else {
                      echo '<input name="customDeps" class="form-check-input" type="checkbox" value="0">';
                    }
                    ?>
                    Custom Departments Module
                  </label>
                </div>
                <div class="form-check" style="margin-top: 10px;">
                  <label class="form-check-label">
                    <?php
                    if ($dowf == "1") {
                      echo '<input name="dowfModule" class="form-check-input" type="checkbox" value="1" checked="">';
                    } else {
                      echo '<input name="dowfModule" class="form-check-input" type="checkbox" value="0">';
                    }
                    ?>
                    Department of Wildlife and Fisheries Module
                  </label>
                </div>
                <input type="submit" name="submit" value="Append/Save Changes" class="btn btn-success form-control" style="width:100%; margin-top:6px; margin-bottom:6px;">
            </form>
        </div>

        <div class="col-centered" style="width:calc(-10px + 33.33%); height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin:0 5px;">
          <h3>Module Settings</h3>
          <?php
          if ($customDeps == "1") {
            echo '<a href="' . SITE_URL . 'modules/customDepartmentsModule/config.php"><button class="btn btn-info form-control" style="width:100%; margin-top:6px; margin-bottom:6px;">Manage Departments</button></a><br>';
          }
          ?>
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
