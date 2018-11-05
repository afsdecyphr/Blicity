<?php
/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/
ob_clean();
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
            $userLevel = $row['level'];
        }
    } else {
        echo "noAccess";
        exit();
    }
} else {
    echo "noAccess";
    exit();
}
if (isset($_GET['getUserInfo'])) {
    $editUUID = $_GET['getUserInfo'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM users WHERE uuid='$editUUID'");
    $return = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $return = json_encode($row);
        }
    }
    echo $return;
    exit();
} elseif (isset($_GET['saveUser']) && isset($_GET['username']) && isset($_GET['password']) && isset($_GET['level'])) {
    $editUUID = $_GET['saveUser'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $level = $_GET['level'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM users WHERE uuid='$editUUID'");
    $return = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['level'] <= $userLevel) {
                if ($userLevel == 0) {
                    if ($row['username'] != $username) {
                        $query = $connection->query("UPDATE users SET username='$username' WHERE uuid='$editUUID'");
                    }
                    if ($row['level'] != $level) {
                        $query = $connection->query("UPDATE users SET level='$level' WHERE uuid='$editUUID'");
                    }
                    if ($password != "") {
                        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                        $query = $connection->query("UPDATE users SET password='$password' WHERE uuid='$editUUID'");
                    }
                    echo "success";
                    exit();
                } else {
                    echo "noPermission";
                    exit();
                }
            } else {
                if ($row['username'] != $username) {
                    $query = $connection->query("UPDATE users SET username='$username' WHERE uuid='$editUUID'");
                }
                if ($row['level'] != $level) {
                    $query = $connection->query("UPDATE users SET level='$level' WHERE uuid='$editUUID'");
                }
                if ($password != "") {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $query = $connection->query("UPDATE users SET password='$password' WHERE uuid='$editUUID'");
                }
                echo "success";
                exit();
            }
        }
    }
} elseif (isset($_GET['getUsers'])) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM users");
    $return = "";
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    echo json_encode($rows);
    exit();
} elseif (isset($_GET['getUnits'])) {
    $editUUID = $_GET['getUnits'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT * FROM units WHERE association='$editUUID'");
    $return = "";
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    echo json_encode($rows);
    exit();
} elseif (isset($_GET['saveUnits'])) {
    $uuid = $_SESSION['uuid'];
    $json = $_GET['saveUnits'];
    $arr = json_decode(urldecode($json), true);
    echo $arr['units'][0]['uuid'];
    foreach($arr['units'] as $unit) {
        $editUUID = $unit['uuid'];
        $dispatch = $unit['dispatch'];
        $mdt = $unit['mdt'];
        $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $result = $connection->query("UPDATE units SET dispatch='$dispatch', mdt='$mdt' WHERE uuid='$editUUID'");
    }
    echo "success";
    exit();
} elseif (isset($_GET['deleteUnit'])) {
    $uuid = $_GET['deleteUnit'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("DELETE FROM units WHERE uuid='$uuid'");
    echo "success";
    exit();
} elseif (isset($_GET['deleteUser'])) {
    $deleteUUID = $_GET['deleteUser'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $getLevelQuery = $connection->query("SELECT level FROM users WHERE uuid='$deleteUUID'");
    if ($getLevelQuery->num_rows > 0) {
        while($levelRow = $levelQuery->fetch_assoc()) {
            if ($row['level'] <= $userLevel && $userLevel != 0) {
                echo "cannotDelete";
                exit();
            } else {
                $charactersQuery = $connection->query("SELECT * FROM characters WHERE association='$deleteUUID'");
                if ($charactersQuery->num_rows > 0) {
                    while($characterRow = $charactersQuery->fetch_assoc()) {
                        $characterUUID = $characterRow['uuid'];
                        $vehiclesQuery = $connection->query("DELETE FROM vehicles WHERE association='$characterUUID'");
                        $ticketsQuery = $connection->query("DELETE FROM tickets WHERE giventouuid='$characterUUID'");
                        $warrantsQuery = $connection->query("DELETE FROM warrants WHERE gieventouuid='$characterUUID'");
                    }
                }
                $delCharactersQuery = $connection->query("DELETE FROM characters WHERE association='$deleteUUID'");
                $unitsQuery = $connection->query("DELETE FROM units WHERE association='$deleteUUID'");
                $userQuery = $connection->query("DELETE FROM users WHERE uuid='$deleteUUID'");
                echo "success";
                exit();
            }
        }
    }
    
} else {
    echo 'unknownFunction';
    exit();
}
?>