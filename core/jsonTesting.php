<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/

$rawJSON = '["cc1acb28-673e-4e54-84d2-55087f2ce2ec","bar","\"baz\"","&blong&","\u00e9"]';
var_dump(json_decode($rawJSON));
$arr = json_decode($rawJSON);
foreach ($arr as $value) {
    echo $value . '<br>';
}
array_push($arr, "617c396f-7aad-4601-b7ce-941cdad1cef3");
foreach ($arr as $value) {
    echo $value . '<br>';
}
echo json_encode($arr) . "<br>";
$count = count($arr);
$on = 0;
foreach ($arr as $value) {
    $on++;
    echo $value;
    if ($on != $count) {
        echo ', ';
    }
}
?>