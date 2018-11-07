<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$json = json_decode(file_get_contents(__DIR__ . "\_private\cdn.json"), true);

$version = $json['versions'][0]['name'];
$localFiles = $json['versions'][0]['localFiles'];
$remoteFiles = $json['versions'][0]['remoteFiles'];

$requiredFiles = array();

foreach ($remoteFiles as $file) {
    $headerReference = str_replace("{FILE_NAME}", $file['fileName'], $file['headerReference']);
    $headerReference = str_replace("{INTEGRITY}", $file['integrity'], $headerReference);
    define($file['reference'], $headerReference);
    if ($file['requiredEverywhere']) {
        $requiredFiles[] = $headerReference;
    }
}

foreach ($localFiles as $file) {
    $headerReference = str_replace("{SITE_URL}", SITE_URL, $file['headerReference']);
    $headerReference = str_replace("{FILE_NAME}", $file['fileName'], $headerReference);
    $headerReference = str_replace("{USER_THEME}", $theme, $headerReference);
    $headerReference = str_replace("{VERSION}", $version, $headerReference);
    define($file['reference'], $headerReference);
    if ($file['requiredEverywhere']) {
        $requiredFiles[] = $headerReference;
    }
}

?>