<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

function getLongName($shortName) {
    $search = $shortName;
    $lines = file('http://localhost:8080/Blicity/core/includes/vehicle_color_options.php');
    $line_number = false;

    while (list($key, $line) = each($lines) and !$line_number) {
       $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
    }

    $handle = fopen(__DIR__ . "/vehicle_color_options.php", "r");
    $foundLine = "";
    if ($handle) {
        $lineNumb = 1;
        while (($line = fgets($handle)) !== false) {
            if ($line_number == $lineNumb) {
                $foundLine = $line;
            }
            $lineNumb = $lineNumb + 1;
        }
        fclose($handle);
    } else {
        // error opening the file.
    }
    return get_string_between($foundLine, '">', "</option>");
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
?>