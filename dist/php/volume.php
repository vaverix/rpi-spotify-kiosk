<?php
error_reporting(E_ALL);
$volume = isset($_GET['percent']) ? $_GET['percent'] : '';
if (empty($volume)) {
    $output = system('sudo vol');
} else {
    $output = system('sudo vol '.$volume);
}
?>