<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

require('../../core/includes/vehicleColorMatcher.php');
require('../../core/includes/logging.php');

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['identifier'])) {
    $identifier = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT mdt FROM units WHERE uuid='$identifier'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['mdt'] == 0) {
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

if (isset($_POST['makemodel']) && isset($_POST['color']) && isset($_POST['lp'])) {
    if (!empty($_POST['makemodel']) && !empty($_POST['color']) && !empty($_POST['lp'])) {
        $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $makemodel = mysqli_real_escape_string($connection, $_POST['makemodel']);
        $color = mysqli_real_escape_string($connection, $_POST['color']);
        $lp = mysqli_real_escape_string($connection, $_POST['lp']);
        $result = $connection->query("INSERT INTO bolos (id, plate, makemodel, color) VALUES (DEFAULT, '$lp', '$makemodel', '$color')");
        logUserAction($_SESSION['uuid'], "Added bolo. Details: [LicensePlate:" . '"' . $lp . '"' . "], [MakeModel:" . '"' . $makemodel . '"' . "], [Color:" . '"' . $color . '"' . "]");
        echo "success";
        exit();
    } else {
        echo "error";
        exit();
    }
} elseif (isset($_GET['getBolos'])) {
    $tableBody = '';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM bolos");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tableBody = $tableBody . '<tr><td scope="row">' . $row['plate'] . '</td>';
            $tableBody = $tableBody . '<td>' . $row['makemodel'] . '</td>';
            $tableBody = $tableBody . '<td>' . $row['color'] . '</td>';
            $tableBody = $tableBody . '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeBolo(' . $row['id'] . ');">Delete</button></td></tr>';
        }
    }
    echo $tableBody;
} elseif (isset($_GET['searchChar'])) {
    $uuid = $_GET['searchChar'];
    $result2 = "<h5>Information</h5><table class='table'><thead>" . '<tr>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Address</th>
                          </tr>' . "</thead><tbody>";
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM characters WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['gender'] == 0) {
                $gender = "Male";
            } elseif ($row['gender'] == 1) {
                $gender = "Female";
            } elseif ($row['gender'] == 2) {
                $gender = "Unspecified";
            }
            $result2 = $result2 . '<tr>
  <td>' . $row['name'] . '</td>
  <td>' . $row['age'] . '</td>
  <td>' . $gender. '</td>
  <td>' . $row['address']. '</td>
  </tr>';
        }
    }
    $result2 = $result2 . '</tbody></table>';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM tickets WHERE giventouuid='$uuid'");
    $result2 = $result2 . "<h5>Tickets [" . mysqli_num_rows($result) . "]</h5>";
    $result2 = $result2 . "<table class='table'><thead>" . '<tr>
                            <th scope="col">Ticket Reason</th>
                            <th scope="col">Ticket Amount</th>
                            <th scope="col">Issued By</th>
                          </tr>' . "</thead><tbody>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $issuedBy = $row['issuedBy'];
            $connection3 = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $issresult = $connection3->query("SELECT * FROM units WHERE uuid='$issuedBy'");
            if ($issresult->num_rows > 0) {
                while($issrow = $issresult->fetch_assoc()) {
                    $issuedBy = $issrow['callsign'];
                }
            }
            $result2 = $result2 . '<tr>
  <td>' . $row['reason'] . '</td>
  <td>' . $row['amount'] . '</td>
  <td>' . $issuedBy . '</td>
  </tr>';
        }
    }
    $result2 = $result2 . "</tbody></table>";
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM warrants WHERE gieventouuid='$uuid'");
    $result2 = $result2 . "<h5>Warrants [" . mysqli_num_rows($result) . "]</h5>";
    $result2 = $result2 . "<table class='table'><thead>" . '<tr>
                            <th scope="col">Warrant Reason</th>
                            <th scope="col">Issued By</th>
                          </tr>' . "</thead><tbody>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $issuedBy = $row['issuedBy'];
            $connection3 = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $issresult = $connection3->query("SELECT * FROM units WHERE uuid='$issuedBy'");
            if ($issresult->num_rows > 0) {
                while($issrow = $issresult->fetch_assoc()) {
                    $issuedBy = $issrow['callsign'];
                }
            }
            $result2 = $result2 . '<tr>
  <td>' . $row['reason'] . '</td>
  <td>' . $issuedBy . '</td>
  </tr>';
        }
    }
    echo $result2 . '</tbody></table>';
    echo "<button class='btn btn-warning' style='float:right;' onclick='suspendLicense(" . '"' . $uuid . '"' . ");'>Suspend Driver's License</button>";
    logUserAction($_SESSION['uuid'], "Ran character search. Details: [UCID:" . '"' . $uuid . '"' . "]");
} elseif (isset($_GET['updateStatus'])) {
    $status = $_GET['updateStatus'];
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE units SET status='$status' WHERE uuid='$uuid'");
    logUserAction($_SESSION['uuid'], "Updated status. Details: [Target UUID:" . '"' . $uuid . '"' . "], [Status:" . '"' . $status . '"' . "]");
} elseif (isset($_GET['assignSelfToCall'])) {
    $ucid = $_GET['assignSelfToCall'];
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT assigned FROM calls WHERE ucid='$ucid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $rawJSON = $row['assigned'];
          $arr = json_decode($rawJSON);

          $arr[] = $uuid;
          $returnJSON = json_encode($arr);
          $query = $connection->query("UPDATE calls SET assigned='$returnJSON' WHERE ucid='$ucid'");
        }
    }
    logUserAction($_SESSION['uuid'], "Updated status. Details: [Target UUID:" . '"' . $uuid . '"' . "], [Status:" . '"' . $status . '"' . "]");
} elseif (isset($_GET['createCall'])) {
    $desc = $_GET['createCall'];
    $uuid = $_SESSION['identifier'];
    $ucid = gen_uuid();
    $assigned = '["' . $uuid . '"]';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("INSERT INTO calls VALUES (DEFAULT, '$ucid', '$desc', '$assigned')");
    logUserAction($_SESSION['uuid'], "Updated status. Details: [Target UUID:" . '"' . $uuid . '"' . "], [Status:" . '"' . $status . '"' . "]");
} elseif (isset($_GET['suspendLicense'])) {
    $uuid = $_GET['suspendLicense'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE characters SET licenseStatus='2' WHERE uuid='$uuid'");
    logUserAction($_SESSION['uuid'], "Suspended driver's license. Details: [Target UCID:" . '"' . $uuid . '"' . "]");
} elseif (isset($_GET['setStatus']) && isset($_GET['uuid'])) {
    $status = $_GET['setStatus'];
    $uuid = $_GET['uuid'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE units SET status='$status' WHERE uuid='$uuid'");
    logUserAction($_SESSION['uuid'], "Updated own status. Details: [Status:" . '"' . $status . '"' . "]");
} elseif (isset($_GET['getStatus'])) {
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT status FROM units WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['status'];
        }
    } else {
        echo 'error';
    }
} elseif (isset($_GET['getCalls'])) {
    $tableBody = '';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM calls");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rawJSON = $row['assigned'];
            $arr = json_decode($rawJSON);
            $count = count($arr);
            $on = 0;
            $unitsRow = "";
            foreach ($arr as $value) {
                $on++;
                $connection2 = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
                if ($connection2->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $result2 = $connection2->query("SELECT * FROM units WHERE uuid='$value'");
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        $unitsRow = $unitsRow . $row2['callsign'];
                    }
                } else {
                  $unitsRow = $unitsRow . 'UNKNOWN UUID';
                }
                if ($on != $count) {
                    $unitsRow = $unitsRow . ', ';
                }
            }
            $tableBody = $tableBody . '<tr><td>' . $row['description'] . '</td>';
            $tableBody = $tableBody . '<td>' . $unitsRow . '</td>';
            $selfAss = '<button class="btn btn-sm btn-success" onclick="assignSelfToCall(' . "'" . $row['ucid'] . "'" . ');">Assign Self</button>';
            if(in_array($_SESSION['identifier'], $arr)) {
              $selfAss = "Already assigned";
            }
            $tableBody = $tableBody . '<td>' . $selfAss . '</td></tr>';
        }
    }
    $tableBody = $tableBody . '<script>

    $(".updateunitbtn").on("click", function () {
    setStatus($(this).attr("id"), $(this).data("status"));
    });
    </script>';
    echo $tableBody;
    exit();
} elseif (isset($_GET['remBolo'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $id = $_GET['remBolo'];
    $result = $connection->query("DELETE FROM bolos WHERE id='$id'");
    echo "success";
    logUserAction($_SESSION['uuid'], "URemoved bolo. Details: [ID:" . '"' . $id . '"' . "]");
    exit();
} elseif (isset($_GET['ticket']) && isset($_GET['reason']) && isset($_GET['amount'])) {
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $id = $_GET['ticket'];
    $reason = $_GET['reason'];
    $amount = $_GET['amount'];
    $result = $connection->query("INSERT INTO tickets VALUES (DEFAULT, '$id', '$reason', '$amount', '$uuid')");
    echo "success";
    logUserAction($_SESSION['uuid'], "Issued ticket. Details: [IssuedTo UCID:" . '"' . $id . '"' . "], [Reason:" . '"' . $reason . '"' . "], [Amount:" . '"' . $amount . '"' . "]");
    exit();
} elseif (isset($_GET['warrant']) && isset($_GET['reason'])) {
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $id = $_GET['warrant'];
    $reason = $_GET['reason'];
    $result = $connection->query("INSERT INTO warrants VALUES (DEFAULT, '$id', '$reason', '$uuid')");
    echo "success";
    logUserAction($_SESSION['uuid'], "Issued warrant. Details: [IssuedTo UCID:" . '"' . $id . '"' . "], [Reason:" . '"' . $reason . '"' . "]");
    exit();
} elseif (isset($_GET['getCharacters'])) {
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
    exit();
} elseif (isset($_GET['getVehicles'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    echo '<option value="default" selected data-select2-id="' . mysqli_num_rows($result) . '">License Plate - Make/Model - Color</option>';
    $result = $connection->query("SELECT * FROM vehicles");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['uvid'] . '">' . strtoupper($row['licensePlate']) . ' - ' . $row['makemodel'] . ' - ' . getLongName($row['color']) . '</option>';
        }
    }
    exit();
} elseif (isset($_GET['searchVehicle'])) {
    $uvid = $_GET['searchVehicle'];
    $return = "<h5>Information</h5><table class='table'><thead>" . '<tr><th scope="col">License Plate</th><th scope="col">Make/Model</th><th scope="col">Color</th><th scope="col">Vehicle Tag</th><th scope="col">Insurance Status</th><th scope="col">Registered Owner</th></tr>' . "</thead><tbody>";
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM vehicles WHERE uvid='$uvid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tag = $row['vehicleTags'];
            if ($tag == 0) {
                $tag = "None";
            } elseif ($tag == 1) {
                $tag = "Stolen";
            } elseif ($tag == 2) {
                $tag = "Wanted";
            }
            $insuranceStatus = $row['insuranceStatus'];
            if ($insuranceStatus == 0) {
                $insuranceStatus = "Uninsured";
            } elseif ($insuranceStatus == 1) {
                $insuranceStatus = "Insured";
            }
            $association = $row['association'];
            $result2 = $connection->query("SELECT name FROM characters WHERE uuid='$association'");
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $association = $row2['name'];
                }
            } else {
                $association = "Error: dne2a";
            }
            $return .= '<tr><td style="text-transform:uppercase;">' . $row['licensePlate'] . '</td>'
                    . '<td>' . $row['makemodel'] . '</td>'
                    . '<td>' . getLongName($row['color']) . '</td>'
                    . '<td>' . $tag . '</td>'
                    . '<td>' . $insuranceStatus . '</td>'
                    . '<td>' . $association . '</td>'
                    . '</tr>';
        }
    }
    echo $return . '</tbody></table>';
    exit();
} elseif (isset($_GET['getNotes'])) {
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT notes FROM units WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($row['notes'])),null,'UTF-8');
        }
    } else {
        echo 'error';
    }
    echo "";
    exit();
} elseif (isset($_GET['saveNotes'])) {
    $uuid = $_SESSION['identifier'];
    $notes = urlencode($_GET['saveNotes']);
    echo $notes;
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE units SET notes='$notes' WHERE uuid='$uuid'");
    echo "success";
    exit();
} else {
    echo "unknownFunction";
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
?>
