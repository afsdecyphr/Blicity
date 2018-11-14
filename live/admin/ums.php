<?php
require '../config.php';

$file_access = "11111111";
require '../../core/includes/check_access.php';

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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOSSRP | UMS</title>
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
        <li><a href="logs.php"><i class="fa fa-list"></i> <span>Logs</span></a></li>
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
        User Management System
        <small>LOSSRP</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> LOSSRP</a></li>
        <li class="active">User Management System</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
              $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
              if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
              }
              $result = $connection->query("SELECT id FROM users");
              echo $result->num_rows;
              ?></h3>

              <p>Users Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable" style="width: 100%;">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <h3 class="box-title">
                Users
              </h3>
              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <?php
                  $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                  if ($connection->connect_error) {
                      die("Connection failed: " . $connection->connect_error);
                  }
                  $searchSQL = "";
                  $searchParam = "";
                  if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $searchParam = '&search=' . $search;
                    $searchSQL = " WHERE username LIKE '%$search%'";
                  }
                  $result = $connection->query("SELECT * FROM users" . $searchSQL);
                  $users = mysqli_num_rows($result);
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                  } else {
                    $page = 1;
                  }
                  if ($page == 1) {
                    echo '
                    <li class="page-item disabled">
                      <a class="page-link" href="?page=1">&laquo;</a>
                    </li>';
                  } else {
                    echo '
                    <li class="page-item">
                      <a class="page-link" href="?page=1">&laquo;</a>
                    </li>';
                  }
                  $pages = ceil($users / 8);
                  $pageOn = $page;
                  $startPage = $pageOn - 3;
                  while ($startPage <= $page-1) {
                    if ($startPage >= 1) {
                      echo '<li class="page-item active">
                        <a class="page-link" href="?page=' . $startPage . $searchParam . '">' . $startPage . '</a>
                      </li>';
                    }
                    $startPage++;
                  }
                  echo '<li class="page-item disabled">
                    <a class="page-link" href="#">' . $page . '</a>
                  </li>';
                  $pageOn = $page+1;
                  $pagesOnRightHTML = '';
                  while ($pageOn <= $page+3) {
                    if ($pageOn <= $pages) {
                      echo '<li class="page-item active">
                        <a class="page-link" href="?page=' . $pageOn . $searchParam . '">' . $pageOn . '</a>
                      </li>';
                    }
                    $pageOn++;
                  }
                  if ($page == $pages) {
                    echo '<li class="page-item disabled">
                      <a class="page-link" href="?page=' . $pages . $searchParam . '">&raquo;</a>
                    </li>';
                  } else {
                    echo '<li class="page-item">
                      <a class="page-link" href="?page=' . $pages . $searchParam . '">&raquo;</a>
                    </li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            <div class="box-body">
              <input type="text" class="form-control" id="searchParam" style="width: 75%; float: left; display: block;" placeholder="Search by Username">
              <button class="btn btn-success" style="width: 25%; float: left; display: block;" onclick="location = '?page=1&search='+$('#searchParam').val();">cds</button>
              <br>
              <br>
                        <div class="box">
                          <div class="box-body no-padding" style="color: #444;">
                            <table class="table table-striped">
                              <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Discord</th>
                                <th>Access Tag</th>
                                <th>Edit</th>
                              </tr>
                              <tbody id="usersTable">
                              <?php
                              $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                              if ($connection->connect_error) {
                                  die("Connection failed: " . $connection->connect_error);
                              }
                              $start = $page * 8 - 7;
                              $end = $start + 7;
                              $result = $connection->query("SELECT * FROM users");
                              $return = "";
                              $rows = array();
                              $on = 1;
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                                    if ($on >= $start && $on <= $end) {
                                      echo '<tr><td>' . $row['id'] . '</td><td>' . $row['username'] . '</td><td>' . $row['discord'] . '</td><td>';
                                      if ($row['level'] == 0) {
                                        echo '<span class="badge bg-red">Super Administrator</span>';  
                                      } elseif ($row['level'] == 1) {
                                        echo '<span class="badge bg-yellow">Administrator</span>';  
                                      } else {
                                        echo '<span class="badge bg-light-blue">User</span>';
                                      }
                                      echo '</td><td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal" onclick="editUser(' . "'" . $row['uuid'] . "'" . ');">Edit</button><button class="btn btn-danger btn-sm" style="margin-left: 5px;" onclick="deleteUser(' . "'" . $row['uuid'] . "'" . ');">Delete</button></td></tr>';
                                    }
                                    $on++;
                                  }
                              }
                              ?>
                            </tbody>
                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

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
