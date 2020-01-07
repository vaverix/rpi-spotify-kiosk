<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');
error_reporting(E_ALL);
$volume = isset($_GET['percent']) ? $_GET['percent'] : '';
if ($volume != 0 && empty($volume)) {
    $command = 'sudo vol';
    $output = shell_exec($command);
} else {
    $command = 'sudo vol '.intval($volume);
    $output = shell_exec($command);
}
die($output)
