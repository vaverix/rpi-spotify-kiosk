<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    $output = shell_exec('vol');
} else {
    $output = shell_exec('vol '.$volume);
}
echo "<pre>$output</pre>";
?>