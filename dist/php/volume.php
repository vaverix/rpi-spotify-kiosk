<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    $output = system('vol');
} else {
    $output = system('vol '.$volume);
}
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_EX);
echo "<pre>$output</pre>";
?>