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

if (!isset($_GET['q'])) {
    header("Location: ../");
}
session_start();
$_SESSION['identifier'] = $_GET['q'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Blicity | Civ</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css?v=1" rel="stylesheet" />
    <link href="<?php echo SITE_URL; ?>core/assets/select2-bootstrap4.css?v=1" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>core/assets/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="<?php echo SITE_URL; ?>core/obfuscated_js/civ.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
                    Civilian Tools
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
                    <a data-toggle="modal" data-target="#licensesModal"  onclick="loadLicenseData();">
                        <i class="fas fa-car"></i>
                        Licenses
                    </a>
                    <a data-toggle="modal" data-target="#dmvModal"  onclick="loadDMVData();">
                        <i class="fas fa-car"></i>
                        DMV
                    </a>
                    <a data-toggle="modal" data-target="#ticketsModal"  onclick="checkTickets();">
                        <i class="fas fa-car"></i>
                        Check Tickets
                    </a>
                    <a data-toggle="modal" data-target="#warrantsModal" onclick="checkWarrants();">
                        <i class="fas fa-car"></i>
                        Check Warrants
                    </a>
                </li>
            </ul>
        </nav>

        <div class="modal fade" id="dmvModal" role="dialog" aria-labelledby="dmvModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dmvModalLabel">DMV</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="dmvContainer">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" onclick="loadDMVData();">Refresh</button>
                        <button type="button" class="btn btn-success" onclick="loadCreateNewVehicle();" data-dismiss="modal" data-toggle="modal" data-target="#vehicleModal">Register New Vehicle</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="vehicleModal" role="dialog" aria-labelledby="vehicleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vehicleModalLabel">Create New Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="vehicleContainer">
                            
                        </div>
                    </div>
                    <div class="modal-footer" id="vehicleModalFooter">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="licensesModal" role="dialog" aria-labelledby="licensesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="licensesModalLabel">Licenses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="licensesContainer">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" onclick="loadLicenseData();">Refresh</button>
                        <button type="button" class="btn btn-success" onclick="saveLicenseData();">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ticketsModal" role="dialog" aria-labelledby="ticketsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ticketsModalLabel">Issued Tickets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="ticketsTableContainer">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" onclick="checkTickets();">Refresh</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="warrantsModal" role="dialog" aria-labelledby="warrantsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="warrantsModalLabel">Issued Warrants</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="warrantsTableContainer">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" onclick="checkWarrants();">Refresh</button>
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
                $result = $connection->query("SELECT name FROM characters WHERE uuid='$identifier'");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                    }
                }
            ?>
            <h3 class="text-center">Accessing as <?php echo $name; ?>.</h3>
            <div class="text-center">
                <button class="btn btn-primary" style="width:25%;" data-toggle="modal" data-target="#licensesModal" onclick="loadLicenseData();">Licenses</button>
                <br>
                <button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#dmvModal" onclick="loadDMVData();">DMV</button>
                <br>
                <button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#ticketsModal" onclick="checkTickets();">View Tickets</button>
                <br>
                <button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#warrantsModal" onclick="checkWarrants();">View Warrants</button>
            </div>
        </div>
    </div>
</body>

</html>