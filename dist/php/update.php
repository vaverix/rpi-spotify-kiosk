<?php
error_reporting(E_ALL);
$output = shell_exec('git pull origin master');
echo "Output: <pre>$output</pre>";
?>