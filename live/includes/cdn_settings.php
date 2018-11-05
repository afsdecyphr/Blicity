<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config.php';

$json = json_decode(file_get_contents("_private/cdn.json"));

echo $json->version;
$files = $json->files;
define('CDN_VERSION', '');

$requiredFiles = array();

foreach ($files as $file) {
    $headerReference = str_replace("{SITE_URL}", SITE_URL, $file->headerReference);
    $headerReference = str_replace("{FILE_NAME}", $file->fileName, $headerReference);
    $headerReference = str_replace("{USER_THEME}", $theme, $headerReference);
    define($file->reference, $headerReference);
    if ($file->requiredEverywhere) {
        $requiredFiles[] = $headerReference;
    }
}

?>