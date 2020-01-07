<?php
error_reporting(E_ALL);
$output = shell_exec('sudo sh /var/www/html/dist/php/update.sh');
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_EX);
echo "<pre>$output</pre>";
?>