<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    $output = system('vol');
} else {
    $output = system('vol '.$volume);
}
echo "<pre>$output</pre>";
?>