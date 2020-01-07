<?php
error_reporting(E_ALL);
$output = shell_exec('git pull origin master');
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_EX);
echo "Output: <pre>$output</pre>";
?>