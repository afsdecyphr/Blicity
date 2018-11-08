<?php
/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

$file_access = "11011111";
require_once 'includes/check_access.php';
require_once '../core/includes/cdn_settings.php';
?>

<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo TITLE; ?></title>
        <?php
        foreach ($requiredFiles as $file) {
            echo $file;
        }
        echo SELECT2_CSS;
        echo SELECT2_REMOTECSS;
        echo SELECT2;
        echo POPPER;
        echo SOLID;
        echo FONTAWESOME;
        echo BOOTSTRAP_NUMBER_INPUT;
        echo HOME_JS;
        ?>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
          <?php
          if (isset($_GET['noAccess'])) {
            echo '<div class="alert alert-dismissible alert-danger col-centered" style="width: 50%; margin-bottom: 10px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Woah there!</strong> You do not have access to that page.
                  </div>';
          }
          ?>
          <div class="center-box" style="width:25%; height:auto; padding-top: 50px; max-height: 550px; overflow: auto; max-width:50%">
              <h3 class="text-center">Welcome, <?php echo $username; ?></h3>
              <a href="#dispatch" class="btn btn-primary form-control" data-toggle="modal" data-target="#dispatchModal" style="width:90%; margin: 5px auto;display: block;">Dispatch</a>

              <?php
              if (CUSTOM_DEPARTMENTS_MODULE == 1) {
                require_once 'modules/customDepartmentsModule/index_buttons.php';
              } else {
                echo '<a href="#mdt" class="btn btn-primary form-control" data-toggle="modal" data-target="#mdtModal" style="margin-top:10px;width:90%; margin: 5px auto;display: block;">Law Enforcement</a>';
              }
              ?>
              <a href="#civilian" class="btn btn-primary form-control" data-toggle="modal" data-target="#civModal" style="margin-top:10px;width:90%; margin: 5px auto;display: block;">Civilian</a>
              <a href="account/index.php" class="btn btn-info form-control" style="width:90%; margin: 5px auto;display: block;margin-top:50px;">Account</a>
              <a href="account/logout.php" class="btn btn-warning form-control" style="margin-top:10px;width:90%; margin: 5px auto;display: block;">Logout</a>
              <?php
              if ($theme == "dark") {
                  echo '<button class="btn btn-dark form-control" style="width:90%; margin: 5px auto;display: block;" onclick="changeColor(' . "'" . 'light' . "'" . ')">Use Light Theme</button>';
              } elseif ($theme == "light") {
                  echo '<button class="btn btn-dark form-control" style="width:90%; margin: 5px auto;display: block;" onclick="changeColor(' . "'" . 'dark' . "'" . ')">Use Dark Theme</button>';
              }
              ?>

              <?php
              if ($level <= 1) {
                  echo '<a href="admin/index.php" class="btn btn-danger form-control" style="width:90%; margin: 5px auto;display: block;margin-top:50px;">Admin Panel</a>';
              }
              ?>
              <div style="height:50px;"></div>

              <footer style="position:sticky;">
                  <p style="margin-bottom: 0px; text-align: center; width: 100%; margin-right: 5px; font-size: 14px; color: black; background-color: #f2f2f2;">
                      Blicity v<?php echo $version; ?>
                  </p>
              </footer>
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
                                        echo '<option value="' . SITE_URL . 'civ/view.php?q=' . $row['uuid'] . '">' . $row['name'] . '</option>';
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
                                  <label class="custom-control-label" for="genderRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="genderRadio2" name="genderRadio" class="custom-control-input">
                                  <label class="custom-control-label" for="genderRadio2">Female</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="genderRadio3" name="genderRadio" class="custom-control-input">
                                  <label class="custom-control-label" for="genderRadio3">Unspecified</label>
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
    </body>
</html>
