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

session_start();

if (isset($_GET['createIdentity'])) {
    $gen_uuid = gen_uuid();
    $uuid = $_SESSION['uuid'];
    $cs = $_GET['createIdentity'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT callsign FROM units WHERE callsign='$cs'");
    if ($result->num_rows == 0) {
        $result = $connection->query("INSERT INTO units (id, uuid, association, callsign, status, currentcall_ucid, dispatch) VALUES (DEFAULT, '$gen_uuid', '$uuid', '$cs', 0, '', 0)");
        echo 'success';
        exit();
    } else {
        echo 'exists';
        exit();
    }
} elseif (isset($_GET['getIdentitiesDisp'])) {
    $uuid = $_SESSION['uuid'];
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
} elseif (isset($_GET['getIdentitiesMDT'])) {
    $uuid = $_SESSION['uuid'];
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
} elseif (isset($_GET['getCharacters'])) {
    $uuid = $_SESSION['uuid'];
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
} elseif (isset($_GET['createCharacter']) && isset($_GET['address']) && isset($_GET['age']) && isset($_GET['gender'])) {
    $name = $_GET['createCharacter'];
    $address = $_GET['address'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    $uuid = $_SESSION['uuid'];
    $ucid = gen_uuid();
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("INSERT INTO characters VALUES (DEFAULT, '$ucid', '$name', '$age', '$gender', '$address', '$uuid', 0, 0)");
    echo "success";
} else {
    echo "error";
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