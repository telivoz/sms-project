<?php

$love=$_POST["id"];
$l=$_POST["level"];
//echo "welcome".$love."<br>";
//echo "welcome".$l."<br>";
header('HTTP/1.1 200 OK','Content-Type: text/plain');
echo 'ACK/Jasmin';

$contents='';
foreach ($_GET as $key => $value) {
    $contents .= $key . " => " . $value . "\n"; // or use `"\r\n"`
}
$_GET['space'] = "--------------------------";
file_put_contents("/var/log/nginx/dlr.log", $contents, FILE_APPEND);
