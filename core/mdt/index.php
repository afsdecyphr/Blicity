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

if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM units WHERE uuid='$query'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['association'] != $uuid) {
                header("Location: ../");
            } else {
                if ($row['mdt'] == 0) {
                    header("Location: ../");
                }
            }
        }
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
session_start();
$_SESSION['identifier'] = $_GET['q'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo TITLE; ?> | MDT</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL; ?>core/assets/select2-bootstrap4.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>core/assets/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <style>
        .table th , .table td {
            padding: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>
                    CAD Tools
                    <a href="#" class="sidebarCollapse">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </h3>
                <strong>
                    <a href="#" class="sidebarCollapse">
                        BC&#9776;
                    </a>
                </strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="../">
                        <i class="fas fa-home"></i>
                        Go Home
                    </a>
                    <a data-toggle="modal" data-target="#addBoloModal">
                        <i class="fas fa-car"></i>
                        Add Bolo
                    </a>
                    <a data-toggle="modal" data-target="#charLookupModal" onclick="updateCharacters();">
                        <i class="fas fa-drivers-license"></i>
                        Character Lookup
                    </a>
                    <a data-toggle="modal" data-target="#vehicleLookupModal" onclick="updateVehicles();">
                        <i class="fas fa-drivers-license"></i>
                        Vehicle Lookup
                    </a>
                    <a data-toggle="modal" data-target="#ticketModal">
                        <i class="fas fa-drivers-license"></i>
                        Issue Ticket
                    </a>
                    <a data-toggle="modal" data-target="#warrantModal">
                        <i class="fas fa-drivers-license"></i>
                        Issue Warrant
                    </a>
                </li>
            </ul>
        </nav>

        <div class="modal fade" id="addBoloModal" role="dialog" aria-labelledby="addBoloModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Bolo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vehMakeModelText">Vehicle Make/Model</label>
                            <input type="text" class="form-control" id="vehMakeModelText" placeholder="Make/Model">
                            <small id="vehMakeModelHelp" class="form-text" style="display:none; color:red;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <label for="vehColorText">Vehicle Color</label>
                            <input type="text" class="form-control" id="vehColorText" placeholder="Color">
                            <small id="vehColorHelp" class="form-text" style="display:none; color:red;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <label for="lpText">Vehicle License Plate</label>
                            <input type="text" class="form-control" id="lpText" placeholder="License Plate">
                            <small id="lpHelp" class="form-text text-muted">Leave blank if unknown.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="addBoloBtn">Add bolo</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="charLookupModal" role="dialog" aria-labelledby="charLookupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlg" role="document">
                <div class="modal-content" style="max-height:90vh;overflow-y:auto;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Character Lookup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="characterSelect">Character Lookup</label>
                            <select class="js-example-basic-single" name="state" style="" onchange="showChar(this.value)" id="characterSelect">
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                echo '<option value="default" selected data-select2-id="' . mysqli_num_rows($result) . '">Name or Address</option>';
                                $result = $connection->query("SELECT * FROM characters");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['uuid'] . '">' . $row['name'] . ' - ' . $row['age'] . ' - ' . $row['address'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            
                            <div id="showChar"></div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:10px;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="vehicleLookupModal" role="dialog" aria-labelledby="vehicleLookupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="max-height:90vh;overflow-y:auto;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vehicleLookupModal">Vehicle Lookup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="characterSelect">Vehicle Lookup</label>
                            <select class="js-example-basic-single" name="state" style="" onchange="showVehicle(this.value)" id="vehicleSelect">
                                <option selected data-select2-id="9">Vehicle Lookup</option>
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                echo '<option value="default" selected data-select2-id="' . mysqli_num_rows($result) . '">License Plate - Make/Model - Color</option>';
                                $result = $connection->query("SELECT * FROM vehicles");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['uvid'] . '">' . $row['licensePlate'] . ' - ' . $row['makeModel'] . ' - ' . $row['color'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            
                            <div id="showVeh"></div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:10px;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="ticketModal" role="dialog" aria-labelledby="charLookupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="max-height:90vh;overflow-y:auto;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Issue Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="characterSelect">Issue Ticket To</label>
                            <select class="js-example-basic-single" name="state" style="" id="testsel2">
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                echo '<option value="default" selected data-select2-id="' . mysqli_num_rows($result) . '">Name or Address</option>';
                                $result = $connection->query("SELECT * FROM characters");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['uuid'] . '">' . $row['name'] . ' - ' . $row['age'] . ' - ' . $row['address'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <small id="characterHelp" class="form-text" style="color:red; display:none;">Please to a person to cite.</small>
                            
                            <div id="ticketForm">
                                <div class="form-group">
                                    <label for="reasonText">Ticket Reason</label>
                                    <input type="text" class="form-control" id="reasonText" placeholder="Reason">
                                    <small id="reasonHelp" class="form-text" style="color:red; display:none;">Cannot be left blank.</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Fine Amount</label>
                                    <div class="form-group">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">$</span>
                                        </div>
                                        <input id="amountText" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                          <span class="input-group-text">.00</span>
                                        </div>
                                      </div>
                                    </div>
                                    <small id="amountHelp" class="form-text" style="color:red; display:none">Cannot be left blank.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:10px;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="issueTicket();">Issue Ticket</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="warrantModal" role="dialog" aria-labelledby="charLookupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="max-height:90vh;overflow-y:auto;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Issue Warrant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="characterSelect">Issue Ticket To</label>
                            <select class="js-example-basic-single" name="state" style="" id="testsel3">
                                <?php
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }
                                echo '<option value="default" selected data-select2-id="' . mysqli_num_rows($result) . '">Name or Address</option>';
                                $result = $connection->query("SELECT * FROM characters");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['uuid'] . '">' . $row['name'] . ' - ' . $row['age'] . ' - ' . $row['address'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <small id="warrCharacterHelp" class="form-text" style="color:red; display:none;">Please to a person to cite.</small>
                            
                            <div id="warrantForm">
                                <div class="form-group">
                                    <label for="reasonText">Warrant Reason</label>
                                    <input type="text" class="form-control" id="warrReasonText" placeholder="Reason">
                                    <small id="warrReasonHelp" class="form-text" style="color:red; display:none;">Cannot be left blank.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:10px;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="issueWarrant();">Issue Warrant</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div id = "alert_placeholder"></div>
            <?php
                $identifier = $_SESSION['identifier'];
                $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $result = $connection->query("SELECT callsign FROM units WHERE uuid='$identifier'");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $callsign = $row['callsign'];
                    }
                }
            ?>
            <h3 class="text-center">Accessing as [<?php echo $callsign; ?>].</h3>
            <div class="center-block" style="text-align: center;">
                <div class="center-block" style="margin: 0 auto; text-align: center; width: inherit; display: inline-block;">
                    <button class="btn btn-success center-block" onclick="updateStatus(1);" id="status_1">10-8</button>
                    <button href="#" class="btn btn-warning center-block" onclick="updateStatus(2);" id="status_2">10-6</button>
                    <button href="#" class="btn btn-danger center-block" onclick="updateStatus(0);" id="status_0">10-7</button>
                </div>
            </div>
            <div>
                <h2 style="">Active Calls</h2>
                <div style="max-height:280px; overflow:auto;">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Call Description</th>
                            <th scope="col">Assigned Units</th>
                            <th scope="col">Assign</th>
                          </tr>
                        </thead>
                        <tbody id="callsTableBody">
                        </tbody>
                    </table>
                </div>
                <h2 style="">Active Bolos</h2>
                <div style="max-height:280px; overflow:auto;">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">License Plate</th>
                            <th scope="col">Make/Model</th>
                            <th scope="col">Color</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody id="bolosTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="<?php echo SITE_URL; ?>core/obfuscated_js/mdt.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>

</html>