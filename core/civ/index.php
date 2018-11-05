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
require_once '../../core/includes/cdn_settings.php';

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

        <title><?php echo TITLE; ?> | Civilian</title>

        
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
        echo CIV_JS;
        ?>
        <style>
            .table th , .table td {
                padding: 0.5rem;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
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

            <div class="modal fade" id="editCharacterModal" role="dialog" aria-labelledby="editCharacterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCharacterModalLabel">Edit Character</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="center-block" id="editCharacterContainer">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="editCharacter();">Save</button>
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
                    <a><button class="btn btn-primary" style="width:25%;" data-toggle="modal" data-target="#editCharacterModal" onclick="loadEditCharacter();">Edit Character</button></a>
                    <br>
                    <a><button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#licensesModal" onclick="loadLicenseData();">Licenses</button></a>
                    <br>
                    <a><button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#dmvModal" onclick="loadDMVData();">DMV</button></a>
                    <br>
                    <a><button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#ticketsModal" onclick="checkTickets();">View Tickets</button></a>
                    <br>
                    <a><button class="btn btn-primary" style="width:25%; margin-top:10px;" data-toggle="modal" data-target="#warrantsModal" onclick="checkWarrants();">View Warrants</button></a>
                    <br>
                    <a href="<?php echo SITE_URL; ?>"><button class="btn btn-info" style="width:25%; margin-top:100px;">Home</button></a>
                </div>
            </div>
        </div>
        
        <footer>
            <p style="margin-bottom: 0px; text-align: center; width: 100%; margin-right: 5px; font-size: 14px; color: black; background-color: #f2f2f2;">
                Blicity v<?php echo $version; ?>
            </p>
        </footer>
    </body>
</html>