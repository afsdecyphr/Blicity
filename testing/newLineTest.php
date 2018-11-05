<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$str = html_entity_decode(
        preg_replace(
                "/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode(
                        $_GET['q']
                )
        ), null, 'UTF-8'
       );
$len = strlen($str);
strpos($string, "\n");
$str = str_replace("\n", "*", $str)
?>
<html>
    <body>
        <textarea><?php echo $str; ?></textarea>
    </body>
</html>