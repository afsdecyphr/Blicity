<?php
require '../config.php';

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
                    header('Location: ums.php');
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
    header('Location: ums.php');
  }
$file_access = "11111111";
require '../../core/includes/check_access.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOSSRP | Site Settings</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo SITE_URL; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>LOSS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>LOSS</b>RP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li><a href="index.php"><i class="fa fa-cogs"></i> <span>Site Settings</span></a></li>
        <li><a href="ums.php"><i class="fa fa-users"></i> <span>User Manangement System</span></a></li>
        <li><a href="applications.php"><i class="fa fa-list"></i> <span>Logs</span></a></li>
        <li><a href="applications.php"><i class="fa fa-align-left"></i> <span>Applications</span></a></li>
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Module Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Site Settings
        <small>LOSSRP</small>
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> LOSSRP</a></li>
        <li class="active">Site Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable" style="width: 100%;">
          <div class="col-centered" style="width:calc(-10px + 50%); height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin: 0 5px;">
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
  
          <div class="col-centered" style="width:calc(-10px + 50%); height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin:0 5px;">
            <h3>Module Settings</h3>
            <?php
            if ($customDeps == "1") {
              echo '<a href="' . SITE_URL . 'modules/customDepartmentsModule/config.php"><button class="btn btn-info form-control" style="width:100%; margin-top:6px; margin-bottom:6px;">Manage Departments</button></a><br>';
            }
            ?>
          </div>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="assets/js/ums.js"></script>


        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <b>Username</b>
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <b>Password</b>
                            <input type="password" name="editPass" id="editPass" placeholder="Password" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <b>Password</b>
                            <input type="password" name="editConfPass" id="editConfPass" placeholder="Confirm Password" class="form-control" value="">
                            <small id="editConfPassHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <b>Level</b>
                            <select class="form-control" id="levelSelect">
                                <option value="9">User</option>
                                <option value="1">Administrator</option>
                                <option value="0">Super Administrator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#identitiesModal" onclick="loadUnits();">View Identities</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveUser();">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="identitiesModal" tabindex="-1" role="dialog" aria-labelledby="identitiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="identitiesModalLabel">Identities</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Callsign</th>
                                    <th scope="col">Dispatch Access</th>
                                    <th scope="col">MDT Access</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="unitsTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveUnits();">Apply</button>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<?php
}
?>
