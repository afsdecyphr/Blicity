<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
echo MYSQL_HOST;
function logUserAction($uuid, $action) {
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $timestamp = time();
    $ip = getRealIpAddr();
    $addLogQuery = $connection->query("INSERT INTO user_log VALUES (DEFAULT, '$timestamp', '$uuid', '$action', '$ip')");
    $checkKnownIPsQuery = $connection->query("SELECT id FROM known_ips WHERE uuid='$uuid' AND ip='$ip'");
    if (mysqli_num_rows($checkKnownIPsQuery) == 0) {
        $addKnownIPQuery = $connection->query("INSERT INTO known_ips VALUES (DEFAULT, '$uuid', '$ip')");
    }
}

function logUserLogin($uuid) {
     $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $timestamp = time();
    $ip = getRealIpAddr();
    $addLogQuery = $connection->query("INSERT INTO user_log VALUES (DEFAULT, '$timestamp', '$uuid', '$ip'");
    $checkKnownIPsQuery = $connection->query("SELECT id FROM known_ips WHERE uuid='$uuid' AND ip='$ip'");
    if (mysqli_num_rows($checkKnownIPsQuery) == 0) {
        $addKnownIPQuery = $connection->query("INSERT INTO known_ips VALUES (DEFAULT, '$uuid', '$ip')");
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>