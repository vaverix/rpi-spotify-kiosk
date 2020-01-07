<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    $output = exec('vol');
} else {
    $output = exec('vol '.$volume);
}
echo "<pre>$output</pre>";
?>