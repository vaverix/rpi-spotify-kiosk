<?php
error_reporting(E_ALL);
$volume = isset($_GET['percent']) ? $_GET['percent'] : '';
if (empty($volume)) {
    $output = system('sudo vol');
} else {
    $output = system('sudo vol '.$volume);
}
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_EX);
die("$output");
?>