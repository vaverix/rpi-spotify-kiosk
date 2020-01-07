<?php
error_reporting(E_ALL);
$volume = $_GET['percent'];
if (empty($volume)) {
    passthru('vol', $output);
} else {
    passthru('vol '.$volume, $output);
}
echo "<pre>$output</pre>";
?>