<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

require('../../core/includes/vehicleColorMatcher.php');

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['identifier']) && isset($_SESSION['uuid'])) {
    $identifier = $_SESSION['identifier'];
    $uuid = $_SESSION['uuid'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT association FROM characters WHERE uuid='$identifier'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['association'] != $uuid) {
                echo 'noAccess';
                exit();
            }
        }
    }
} else {
    echo 'noAccess';
    exit();
}

if (isset($_GET['getTickets'])) {
    $identifier = $_SESSION['identifier'];
    $return = '<table class="table"><thead><tr><th scope="col">Ticket Reason</th>'
            . '<th scope="col">Ticket Amount</th>'
            . '<th scope="col">Issued By</th></tr></thead><tbody>';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $ticketsQuery = $connection->query("SELECT * FROM tickets WHERE giventouuid='$identifier'");
    if ($ticketsQuery->num_rows > 0) {
        while($ticketsRow = $ticketsQuery->fetch_assoc()) {
            $issuedBy = $ticketsRow['issuedBy'];
            $connection2 = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($connection2->connect_error) {
                die("Connection failed: " . $connection2->connect_error);
            }
            $getCSQuery = $connection2->query("SELECT * FROM units WHERE uuid='$issuedBy'");
            if ($getCSQuery->num_rows > 0) {
                while($callsignRow = $getCSQuery->fetch_assoc()) {
                    $issuedBy = $callsignRow['callsign'];
                }
            } else {
                $issuedBy = "Unknown (Error code: dne1a)";
            }
            $return = $return . '<tr><td>' . $ticketsRow['reason'] . '</td>'
                    . '<td>' . $ticketsRow['amount'] . '</td>'
                    . '<td>' . $issuedBy . '</td></tr>';
        }
    }
    $return = $return . '</tbody></table>';
    echo $return;
    exit();
} elseif (isset($_GET['getDMVData'])) {
    $identifier = $_SESSION['identifier'];
    $vehiclesTable = '<table class="table"><thead><tr><th scope="col">License Plate</th><th scope="col">Make/Model</th><th scope="col">Color</th><th scope="col">Vehicle Tag</th><th scope="col">Insurance Status</th><th scope="col">Edit/Delete</th></tr></thead><tbody>';
    $sqlQuery = $connection->query("SELECT * FROM vehicles WHERE association='$identifier'");
    if ($sqlQuery->num_rows > 0) {
        while($vehicleRow = $sqlQuery->fetch_assoc()) {
            $vehicleTag = '';
            if ($vehicleRow['vehicleTags'] == 0) {
                $vehicleTag = 'None';
            } elseif ($vehicleRow['vehicleTags'] == 1) {
                $vehicleTag = 'Stolen';
            } elseif ($vehicleRow['vehicleTags'] == 2) {
                $vehicleTag = 'Wanted';
            }
            $insuranceStatus = '';
            if ($vehicleRow['insuranceStatus'] == 0) {
                $insuranceStatus = 'Uninsured';
            } elseif ($vehicleRow['insuranceStatus'] == 1) {
                $insuranceStatus = 'Insured';
            }
            $vehiclesTable = $vehiclesTable . '<tr><td style="text-transform:uppercase;">' . $vehicleRow['licensePlate'] . '</td>'
                    . '<td>' . $vehicleRow['makemodel'] . '</td>'
                    . '<td id="colorRow' . $vehicleRow['uvid'] . '">' . getLongName($vehicleRow['color']) . '</td>'
                    . '<td>' . $vehicleTag . '</td>'
                    . '<td>' . $insuranceStatus . '</td>'
                    . '<td><button class="btn btn-info" style="margin-right:10px;" onclick="editVehicle(' . "'" . $vehicleRow['uvid'] . "'" . ');" data-toggle="modal" data-target="#vehicleModal">Edit</button><button class="btn btn-danger" onclick="deleteVehicle(' . "'" . $vehicleRow['uvid'] . "'" . ');">Delete</button></td></tr>';
        }
    }
    $vehiclesTable = $vehiclesTable . '</tbody></table>';
    echo $vehiclesTable;
    exit();
} elseif (isset($_GET['getWarrants'])) {
    $identifier = $_SESSION['identifier'];
    $return = '<table class="table"><thead><tr><th scope="col">Warrant Reason</th>'
            . '<th scope="col">Issued By</th>'
            . '</tr></thead><tbody>';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $warrantsQuery = $connection->query("SELECT * FROM warrants WHERE gieventouuid='$identifier'");
    if ($warrantsQuery->num_rows > 0) {
        while($warrantsRow = $warrantsQuery->fetch_assoc()) {
            $issuedBy = $warrantsRow['issuedBy'];
            $getCSQuery = $connection->query("SELECT * FROM units WHERE uuid='$issuedBy'");
            if ($getCSQuery->num_rows > 0) {
                while($callsignRow = $getCSQuery->fetch_assoc()) {
                    $issuedByCallsign = $callsignRow['callsign'];
                }
            } else {
                $issuedByCallsign = "Unknown (Error code: dne1a)";
            }
            $return = $return . '<tr><td>' . $warrantsRow['reason'] . '</td>'
                    . '<td>' . $issuedByCallsign . '</td></tr>';
        }
    }
    $return = $return . '</tbody></table>';
    echo $return;
    exit();
} elseif (isset($_GET['getLicenseData'])) {
    $return = "<label for='dLicenseStatusSelect'>Driver's License Status</label>";
    $return = $return . '<select class="form-control selectpicker js-example-basic-single" id="dLicenseStatusSelect" name="dLicenseStatusSelect">';
    $js = '';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("SELECT * FROM characters WHERE uuid='$identifier'");
    if ($sqlQuery->num_rows == 1) {
        while($characterRow = $sqlQuery->fetch_assoc()) {
            $return = $return
                    . '<option value="0">Unlicensed</option>'
                    . '<option value="1">Valid</option>'
                    . '<option value="2">Suspended</option>'
                    . '<option value="3">Revoked</option>'
                    . '</select>'
                    . '<label for="wLicenseStatusSelect" style="margin-top: 10px;">Weapon License Status</label>'
                    . '<select class="form-control selectpicker js-example-basic-single" id="wLicenseStatusSelect" name="wLicenseStatusSelect">'
                    . '<option value="0">Unlicensed</option>'
                    . '<option value="1">Valid</option>'
                    . '<option value="2">Suspended</option>'
                    . '<option value="3">Revoked</option>'
                    . '</select>';
            
            $js = $js . '<script>$("#dLicenseStatusSelect").select2();$("#dLicenseStatusSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
            $js = $js . '<script>$("#dLicenseStatusSelect").val("' . $characterRow['licenseStatus'] . '").trigger("change.select2");</script>';
            $js = $js . '<script>$("#wLicenseStatusSelect").select2();$("#wLicenseStatusSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
            $js = $js . '<script>$("#wLicenseStatusSelect").val("' . $characterRow['weaponLicenseStatus'] . '").trigger("change.select2");</script>';
            $js = $js . '<script></script>';
            $settingsQuery = $connection->query("SELECT dowfModule FROM settings WHERE id='1'");
            if ($settingsQuery->num_rows == 1) {
              while($row = $settingsQuery->fetch_assoc()) {
                if ($row['dowfModule'] == 1) {
                  $return = $return 
                          . '<label for="fishingLicenseStatusSelect" style="margin-top: 10px;">Fishing License Status</label>'
                          . '<select class="form-control selectpicker js-example-basic-single" id="fishingLicenseStatusSelect" name="fishingLicenseStatusSelect">'
                          . '<option value="0">Unlicensed</option>'
                          . '<option value="1">Valid</option>'
                          . '<option value="2">Suspended</option>'
                          . '<option value="3">Revoked</option>'
                          . '</select>'
                          . '<label for="huntingLicenseStatusSelect" style="margin-top: 10px;">Hunting License Status</label>'
                          . '<select class="form-control selectpicker js-example-basic-single" id="huntingLicenseStatusSelect" name="huntingLicenseStatusSelect">'
                          . '<option value="0">Unlicensed</option>'
                          . '<option value="1">Valid</option>'
                          . '<option value="2">Suspended</option>'
                          . '<option value="3">Revoked</option>'
                          . '</select>';
                          
                  $js = $js . '<script>$("#fishingLicenseStatusSelect").select2();$("#fishingLicenseStatusSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
                  $js = $js . '<script>$("#fishingLicenseStatusSelect").val("' . $characterRow['fishingLicense'] . '").trigger("change.select2");</script>';
                  $js = $js . '<script>$("#huntingLicenseStatusSelect").select2();$("#huntingLicenseStatusSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
                  $js = $js . '<script>$("#huntingLicenseStatusSelect").val("' . $characterRow['huntingLicense'] . '").trigger("change.select2");</script>';
                }
              }
            }
        }
        echo $return . $js;
        exit();
    } else {
        echo "error";
        exit();
    }
} elseif (isset($_GET['createVehicle']) && isset($_GET['makeModel']) && isset($_GET['color']) && isset($_GET['tag']) && isset($_GET['insurance'])) {
    $licensePlate = $_GET['createVehicle'];
    $makeModel = $_GET['makeModel'];
    $color = $_GET['color'];
    $tag = $_GET['tag'];
    $insurance = $_GET['insurance'];
    $uuid = $_SESSION['identifier'];
    $uvid = gen_uuid();
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("INSERT INTO vehicles VALUES (DEFAULT, '$uvid', '$uuid', '$licensePlate', '$makeModel', '$color', '$tag', '$insurance')");
    echo "success";
    exit();
} elseif (isset($_GET['removeVehicle']) ) {
    $uuid = $_SESSION['identifier'];
    $uvid = $_GET['removeVehicle'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("DELETE FROM vehicles WHERE uvid='$uvid' AND association='$uuid'");
    echo "success";
    exit();
} elseif (isset($_GET['editVehicle']) ) {
    $uuid = $_SESSION['identifier'];
    $uvid = $_GET['editVehicle'];
    $return = '<div class="form-group"><label id="vehEditUVID">UVID: ' . $uvid . '</label></div>';
            $js = "";
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("SELECT * FROM vehicles WHERE uvid='$uvid' AND association='$uuid'");
    if ($sqlQuery->num_rows > 0) {
        while($vehicleRow = $sqlQuery->fetch_assoc()) {
            $return = $return . '<div class="form-group">'
                    . '<label for="lpEditText">License Plate</label>'
                    . '<input style="text-transform:uppercase;" type="text" class="form-control" id="lpEditText" placeholder="License Plate" value="' . $vehicleRow['licensePlate'] . '">'
                    . '<small id="lpEditHelp" class="form-text" style="color:red; display:none;"></small>'
                    . '</div>';
            $return = $return . '<div class="form-group">'
                    . '<label for="mmEditText">Make/Model</label>'
                    . '<input type="text" class="form-control" id="mmEditText" placeholder="Make/Model" value="' . $vehicleRow['makemodel'] . '">'
                    . '<small id="mmEditHelp" class="form-text" style="color:red; display:none;"></small>'
                    . '</div>';
            $return = $return . '<div class="form-group">'
                    . '<label for="colorSelect">Color</label>'
                    . '<select class="js-example-basic-single" name="colorSelect" style="" id="colorSelect">'
                    . file_get_contents('http://localhost:8080/Blicity/core/includes/vehicle_color_options.php')
                    . '</select>'
                    . '<small id="colorEditHelp" class="form-text" style="color:red; display:none;"></small>'
                    . '</div>';
            $js = $js . '<script>$("#colorSelect").select2();$("#colorSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
            $js = $js . '<script>$("#colorSelect").val("' . $vehicleRow['color'] . '").trigger("change.select2");</script>';
            $return = $return . '<div class="form-group">'
                    . '<label for="vehEditTagSelect">Vehicle Tag</label>'
                    . '<select class="form-control js-example-basic-single selectpicker" id="vehEditTagSelect" name="vehEditTagSelect">'
                    . '<option value="0">None</option>'
                    . '<option value="1">Stolen</option>'
                    . '<option value="2">Wanted</option>'
                    . '</select>'
                    . '<small id="vehTagEditHelp" class="form-text" style="color:red; display:none;"></small>'
                    . '</div>';
            $js = $js . '<script>$("#vehEditTagSelect").select2();$("#vehEditTagSelect").select2({width: "100%", minimumResultsForSearch: Infinity, theme: "bootstrap4"});</script>';
            $js = $js . '<script>$("#vehEditTagSelect").val("' . $vehicleRow['vehicleTags'] . '").trigger("change.select2");</script>';
            $return = $return . '<div class="form-group">'
                    . '<label for="insuranceSelect">Insurance Status</label>'
                    . '<select class="form-control js-example-basic-single selectpicker" id="insuranceSelect" name="insuranceSelect">'
                    . '<option value="0">Uninsured</option>'
                    . '<option value="1">Insured</option>'
                    . '</select>'
                    . '<small id="insuranceSelectHelp" class="form-text" style="color:red; display:none;"></small>'
                    . '</div>';
            $js = $js . '<script>$("#insuranceSelect").select2();$("#insuranceSelect").select2({width: "100%", minimumResultsForSearch: Infinity});</script>';
            $js = $js . '<script>$("#insuranceSelect").val("' . $vehicleRow['insuranceStatus'] . '").trigger("change.select2");</script>';
        }
        echo $return . $js;
        exit();
    } else {
        echo "none";
        exit();
    }
} elseif (isset($_GET['saveVehicle']) && isset($_GET['lp']) && isset($_GET['mm']) && isset($_GET['color']) && isset($_GET['tag']) && isset($_GET['insurance'])) {
    $uuid = $_SESSION['identifier'];
    $uvid = $_GET['saveVehicle'];
    $lp = $_GET['lp'];
    $mm = $_GET['mm'];
    $color = $_GET['color'];
    $tag = $_GET['tag'];
    $insurance = $_GET['insurance'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("UPDATE vehicles SET licensePlate='$lp', makemodel='$mm', color='$color', vehicleTags='$tag', insuranceStatus='$insurance' WHERE uvid='$uvid' AND association='$uuid'");
    echo "success";
    exit();
} elseif (isset($_GET['dLicenseData']) && isset($_GET['wLicenseData']) && isset($_GET['fishingLicenseStatus']) && isset($_GET['huntingLicenseStatus'])) {
    $dLicenseData = $_GET['dLicenseData'];
    $wLicenseData = $_GET['wLicenseData'];
    $fishingLicenseStatus = $_GET['fishingLicenseStatus'];
    $huntingLicenseStatus = $_GET['huntingLicenseStatus'];
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("UPDATE characters SET licenseStatus='$dLicenseData', weaponLicenseStatus='$wLicenseData' WHERE uuid='$uuid'");
    if ($huntingLicenseStatus != 9 && $fishingLicenseStatus != 9) {
      $sqlQuery = $connection->query("UPDATE characters SET fishingLicense='$fishingLicenseStatus', huntingLicense='$huntingLicenseStatus' WHERE uuid='$uuid'");
    }
    echo "success";
    exit();
} elseif (isset($_GET['loadEditCharacter'])) {
    $uuid = $_SESSION['identifier'];
    $return = '';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("SELECT * FROM characters WHERE uuid='$uuid'");
    if ($sqlQuery->num_rows > 0) {
        while($characterRow = $sqlQuery->fetch_assoc()) {
            $genderOptions = "";
            if ($characterRow['gender'] == 0) {
                $genderOptions = '<div class="custom-control custom-radio">
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
                                </div>';
            } elseif ($characterRow['gender'] == 1) {
                $genderOptions = '<div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio1" name="genderRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="genderRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio2" name="genderRadio" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="genderRadio2">Female</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio3" name="genderRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="genderRadio3">Unspecified</label>
                                </div>';
            } elseif ($characterRow['gender'] == 2) {
                $genderOptions = '<div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio1" name="genderRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="genderRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio2" name="genderRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="genderRadio2">Female</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderRadio3" name="genderRadio" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="genderRadio3">Unspecified</label>
                                </div>';
            }
            $return = '<div class="form-group">
                            <label for="nameText">Name (First and Last)</label>
                            <input type="text" class="form-control" id="nameText" placeholder="Name" value="' . $characterRow['name'] . '">
                            <small id="nameTextHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <label for="nameText">Age</label>
                            <input id="ageSpinner" class="form-control" type="number" value="' . $characterRow['age'] . '" min="1" max="120" />
                        </div>
                        <div class="form-group">
                            <label for="addressText">Address</label>
                            <input type="text" class="form-control" id="addressText" placeholder="Address" value="' . $characterRow['address'] . '">
                            <small id="addressTextHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <label for="ageSpinner">Gender</label>
                            <div class="form-group">
                                ' . $genderOptions . '
                            </div>
                        </div>';
        }
    }
    echo $return;
    exit();
} elseif (isset($_GET['saveCharacter']) && isset($_GET['address']) && isset($_GET['age']) && isset($_GET['gender'])) {
    $uuid = $_SESSION['identifier'];
    $name = $_GET['saveCharacter'];
    $address = $_GET['address'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sqlQuery = $connection->query("UPDATE characters SET name='$name', address='$address', age='$age', gender='$gender' WHERE uuid='$uuid'");
    echo "success";
    exit();
} else {
    echo 'unknownFunction';
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