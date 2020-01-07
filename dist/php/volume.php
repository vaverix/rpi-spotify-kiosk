<?php
error_reporting(E_ALL);
$volume = isset($_GET['percent']) ? $_GET['percent'] : '';
if ($volume != 0 && empty($volume)) {
    $command = 'sudo vol';
    $output = shell_exec($command);
} else {
    $command = 'sudo vol '.$volume;
    $output = shell_exec($command);
}
echo $output;
?>