<?php
error_reporting(E_ALL);
$volume = isset($_GET['percent']) ? $_GET['percent'] : '';
if (empty($volume)) {
    $output = system('vol');
} else {
    $output = system('vol '.$volume);
}
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_EX);
echo "Percent: $volume<br>Output: <pre>$output</pre>";
?>