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
            $tableBody = $tableBody . '<tr><td scope="row">' . $row['plate'] . '</th>';
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
} elseif (isset($_GET['updateStatus'])) {
    $status = $_GET['updateStatus'];
    $uuid = $_SESSION['identifier'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE units SET status='$status' WHERE uuid='$uuid'");
} elseif (isset($_GET['setStatus']) && isset($_GET['uuid'])) {
    $status = $_GET['setStatus'];
    $uuid = $_GET['uuid'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("UPDATE units SET status='$status' WHERE uuid='$uuid'");
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
} elseif (isset($_GET['getUnits'])) {
    $tableBody = '';
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM units");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $show = true;
            if ($row['status'] == 0) {
                $show = false;
                $status = "10-7 Off Duty";
                $btns = '<a class="dropdown-item updateunitbtn" href="#" id="' . $row['uuid'] . '" data-status="1">10-8</a>';
                $btn = "danger";
            } elseif ($row['status'] == 1) {
                $status = "10-8 On Duty";
                $btns = '<button class="dropdown-item updateunitbtn" href="#" id="' . $row['uuid'] . '" data-status="2">10-6</button>' . 
                        '<button class="dropdown-item updateunitbtn" href="#" id="' . $row['uuid'] . '" data-status="0">10-7</button>';
                $btn = "success";
            } elseif ($row['status'] == 2) {
                $status = "10-6 Busy";
                $btns = '<button class="dropdown-item updateunitbtn" href="#" id="' . $row['uuid'] . '" data-status="1">10-8</button>' . 
                        '<button class="dropdown-item updateunitbtn" href="#" id="' . $row['uuid'] . '" data-status="0">10-7</button>';
                $btn = "warning";
            }
            if ($show) {
                $tableBody = $tableBody . '<tr><th scope="row">' . $row['callsign'] . '</th>';
                $tableBody = $tableBody . '<td>' . $status . '</td>';
                $tableBody = $tableBody . '<td><div class="btn-group" role="group" aria-label="" style="width:162px;">
                    <button type="button" class="btn btn-' . $btn . ' btn-sm" style="width:114px;">' . $status . '</button>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop' . $row['uuid'] . '" type="button" class="btn btn-' . $btn . ' btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:auto;"></button>
                      <div class="dropdown-menu unitchange" aria-labelledby="btnGroupDrop' . $row['uuid'] . '" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 36px, 0px);" id="' . $row['uuid'] . '">
                        ' . $btns . '
                      </div>
                    </div>
                </div>
                </td></tr>';
            }
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
    $notes = $_GET['saveNotes'];
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

?>