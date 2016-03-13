<?php
header('Access-Control-Allow-Origin: *');
$url = $_GET["url"];
$face = $_GET["face"];
$s = "python ./api.py ". $url . " " . $face;

$command = escapeshellcmd($s);
$output = shell_exec($command);
echo $output;

?>
