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
$connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM settings");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $title = $row['title'];
        }
    }
renderPage($title, "");
function renderPage($title, $info) {
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?> ● Admin Panel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost:8080/Blicity/core/assets/style.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script src="http://localhost:8080/Blicity/core/assets/bootstrap-number-input.js"></script>
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
            <b>Website Title</b>
            <input type="text" name="title" class="form-control" placeholder="Website Title" style="width:100%; margin-top: 0px;" value="<?php echo $title; ?>">
        </div>
        
        <div class="modal fade" id="dispatchModal" tabindex="-1" role="dialog" aria-labelledby="dispatchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Identity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="identifierSelect">Select Identitifier</label>
                            <select class="form-control" id="identifierSelect" onchange="location = this.value;">
                                <option selected disabled>Select Identitifier</option>
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                $result = $connection->query("SELECT * FROM units WHERE association='$uuid'");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . SITE_URL . 'cad/index.php?q=' . $row['uuid'] . '">' . $row['callsign'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#createIdentityModal">Create Identity</button>
                    </div>
                </div>
            </div>
        </div>        
        <div class="modal fade" id="mdtModal" tabindex="-1" role="dialog" aria-labelledby="mdtModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Identity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="identifierSelect">Select Identitifier</label>
                            <select class="form-control" id="identifierSelectMDT" onchange="location = this.value;">
                                <option selected disabled>Select Identitifier</option>
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                $result = $connection->query("SELECT * FROM units WHERE association='$uuid'");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . SITE_URL . 'mdt/index.php?q=' . $row['uuid'] . '">' . $row['callsign'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#createIdentityModal">Create Identity</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="civModal" tabindex="-1" role="dialog" aria-labelledby="civModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Character</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="identifierSelect">Select Character</label>
                            <select class="form-control" id="characterSelect" onchange="location = this.value;">
                                <option selected disabled>Select Character</option>
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                $result = $connection->query("SELECT * FROM characters WHERE association='$uuid'");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . SITE_URL . 'civ/index.php?q=' . $row['uuid'] . '">' . $row['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#createCharacterModal">Create Character</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="createIdentityModal" tabindex="-1" role="dialog" aria-labelledby="createIdentityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Identity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="csText">Callsign</label>
                                <input type="text" class="form-control" id="csText" placeholder="Callsign">
                                <small id="csHelp" class="form-text text-muted">Format Example: SU-1</small>
                                <small id="csHelp2" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="createIdentity();">Create Identity</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="dispatchModal" tabindex="-1" role="dialog" aria-labelledby="dispatchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Character</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="identifierSelect">Select Character</label>
                            <select class="form-control" id="identifierSelect" onchange="location = this.value;">
                                <option selected disabled>Select Character</option>
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                $result = $connection->query("SELECT * FROM characters WHERE association='$uuid'");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . SITE_URL . 'civ/view.php?q=' . $row['uuid'] . '">' . $row['callsign'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#createIdentityModal">Create Character</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createCharacterModal" tabindex="-1" role="dialog" aria-labelledby="createCharacterModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Character</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nameText">Name (First and Last)</label>
                                <input type="text" class="form-control" id="nameText" placeholder="Name">
                                <small id="nameTextHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                            </div>
                            <div class="form-group">
                                <label for="ageSpinner">Age</label>
                                <input id="ageSpinner" class="form-control" type="number" value="1" min="1" max="120" />
                            </div>
                            <div class="form-group">
                                <label for="addressText">Address</label>
                                <input type="text" class="form-control" id="addressText" placeholder="Address">
                                <small id="addressTextHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                            </div>
                            <div class="form-group">
                                <label for="ageSpinner">Gender</label>
                                <div class="form-group">
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="genderRadio1" name="genderRadio" class="custom-control-input" checked="">
                                  <label class="custom-control-label" for="genderRadio1">Toggle this custom radio</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="genderRadio2" name="genderRadio" class="custom-control-input">
                                  <label class="custom-control-label" for="genderRadio2">Or toggle this other custom radio</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="genderRadio3" name="genderRadio" class="custom-control-input">
                                  <label class="custom-control-label" for="genderRadio3">Disabled custom radio</label>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="createCharacter();">Create Character</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="http://localhost:8080/Blicity/core/assets/bootstrap-number-input.js"></script>
    </body>
</html>
<?php
}
?>