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
$connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$result = $connection->query("SELECT customDepartmentsModule FROM settings");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['customDepartmentsModule'] == 0) {
            header("Location: " . SITE_URL . 'admin/index.php');
            exit();
        }
    }
}
$file_access = "11111111";
require '../../../core/includes/check_access.php';
renderPage("");
function renderPage($info) {
$file_access = "11111111";
require '../../../core/includes/check_access.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
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


        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="<?php echo SITE_URL; ?>core/assets/bootstrap-number-input.js"></script>
        <script src="<?php echo SITE_URL; ?>modules/customDepartmentsModule/customDepartmentsModule.js"></script>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center" style="margin-top: 10px;"><?php echo TITLE; ?> ● UMS</h1>
        <div class="col-centered" style="width:24%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin-left:5px;">
            <a href="<?php echo SITE_URL; ?>" style="width:100%;"><button class="btn btn-primary" style="width:100%;">Home</button></a>
            <a href="<?php echo SITE_URL; ?>admin/index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">Admin Panel</button></a>
            <a href="<?php echo SITE_URL; ?>admin/logs.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">Logs</button></a>
            <button class="btn btn-primary" style="width:100%; margin-top:5px;" data-toggle="modal" data-target="#createDepartmentModal">Add Department</button>
        </div>
        <div class="col-centered" style="width:75%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:right; margin-right:5px;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="departmentsTableBody">
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="createDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="createDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createDepartmentModalLabel">New Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <b>Department Name</b>
                            <input type="text" name="depName" id="depName" placeholder="Department Name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="createDepartment();">Create</button>
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
