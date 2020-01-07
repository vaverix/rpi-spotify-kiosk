<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    system('vol', $output);
} else {
    system('vol '.$volume, $output);
}
echo "<pre>$output</pre>";
?>